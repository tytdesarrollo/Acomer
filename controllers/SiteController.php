<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\IndexForm;
use app\models\AsignaForm;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
use PDO;
use app\models\SpLoginAcomer;
use app\models\SpContratosAcomer;
use app\models\RememberForm;
use app\models\PrbUsuario;
use app\models\Ldap;



class SiteController extends Controller
{ 	


	public function actionPrueba(){

		 $form = new FormSearch();
        $search = null; //valor de la busqueda que da el usuario
        if($form->load(Yii::$app->request->get())){ // si el formulario ha sido enviado
            if($form->validate()){ // si el formulario es valido
                $search = Html::encode($form->q); // guarda el valor de la busqueda del usuario
                $table = Gen0011::find()
                        ->where(["like", "TERCOD", $search])
                        ->orwhere(["like", "TERRAZ", $search])
                        ->orwhere(["like", "TERDIR", $search]);
                $count = clone $table;
                $pages = new Pagination([
                        "pageSize" => 1, // registros por pagina
                        "totalCount" => $count->count() //cantidad total de registros
                    ]);
                $model = $table->offset($pages->offset)->limit($pages->limit)->all();
            }else{
                $form->getErrors();
            }
        }else{
            $table = Gen0011::find();
            $count = clone $table;
            $pages = new Pagination([
                    "pageSize" => 3,
                    "totalCount" => $count->count()
                ]);
            $model = $table->offset($pages->offset)->limit($pages->limit)->all();
        }

        return $this->render("prueba",['model' => $model, 'form' => $form, 'search' => $search, 'pages' => $pages]);
	}	
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        //variable para etiquetas de recordar contraseña en caso de que no se utilice directorio activo
		$recordar = null;
		
		$this->layout=false;       			
		//modelo delos datos ingresados (usuario y contraseña) 
        $model = new IndexForm(); 
        //modelo de recuperar contraseña
        $model2 = new RememberForm();
		//Se declara la clase de directorio activo
		$modeladp = new Ldap;
		///Acciona el metodo directorioactivo retornando los datos pertienen al directorio activo en caso de ser usado
		$ladpcon = $modeladp->directorioactivo();
		
        //si no posee directorio activo permite la recuperacion de la contraseña
		if($ladpcon[2]=="false"){
			//etiquetas para recuperar contraseña en vista 
			$recordar = "<a class='color-white' href='' data-toggle='modal' data-target='#recordarpass'>Olvidaste tu contraseña?</a>";
		}

    //===================================INICIA RECORDAR CONTRASEÑA =======================================
        //la validacion del modelo (que el campo este correctamente)
        //Validación mediante ajax - si es de tipo ajax
        if($model2->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            //respuesta en formato json
            Yii::$app->response->format = Response::FORMAT_JSON;
            //retorna el modelo como valido 
            return ActiveForm::validate($model2);           
        }
        
        if($model2->load(Yii::$app->request->post())){
            //valida que el modelo si es valdo
            if($model2->validate()){        
                //redireccionamos a la accion para el olvido de contraseña
                return $this->redirect(['site/olvidapassword','usuario'=>$model2->cedula,'operacion'=>'U']);                
            }else{                
                 return $this->goBack();                 
            }
        }       
    //===================================TERMINA RECORDAR CONTRASEÑA=======================================
		

    //===================================INICIA VALIDACION PARA USUARIO Y CONTRASEÑA=======================================        
        //la validacion del modelo (que los los campos esten correctamente)
        //Validación mediante ajax - si es de tipo ajax
		if($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
			// respuesta en formato json
			Yii::$app->response->format = Response::FORMAT_JSON;
            //retorna el modelo como valido
			return ActiveForm::validate($model);			
		}
		
		if($model->load(Yii::$app->request->post())){
            //Valida que el modelo si es valido
            if($model->validate()){			
                // retorna a la vista de loguep 	
                return $this->redirect(['site/logueo','usuario'=>$model->usuario,'clave'=>$model->clave,'operacion'=>'L']);			
            }else{			
                return $this->goBack();			 
			}		
		}
    //===================================TERMINA VALIDACION PARA USUARIO Y CONTRASEÑA=======================================


    //===================================INICIA VALIDAR QUE LA SESION SIGUE ABIERTA=======================================    		
        //Valida que la variable de sesion cedula no este vacia indicando que hay una sesion abierta
        if(isset(Yii::$app->session['cedula'])){
            //redireccionamos a la pantalla principapl 
            return $this->redirect(['site/principal']);
        }else{
            //renderizamos el index
            return $this->render('index', ['model' => $model,'model2' => $model2,'recordar' => $recordar]);        
        }
    //===================================INICIA VALIDAR QUE LA SESION SIGUE ABIERTA=======================================          
    }

    public function actionLogueo()
    {   
        //Declaracion de  directorio activo
        $modeladp = new Ldap;        
        ///Acciona el metodo directorioactivo retornando los datos pertienen al directorio activo en caso de ser usado         
        $ladpcon = $modeladp->directorioactivo();
        //si hay un usuario con el id ingresado y el directorio activo esta activo
        if(isset($ladpcon[0]) && $ladpcon[2]=='true'){
            //la variable de sesion cedula le asigno el identificador del usuario
            Yii::$app->session['cedula'] = $ladpcon[0];
            // redireccionado a la pantalla principal una vez los datos son correctos
            return $this->redirect(['site/principal']);
        //si se recibio un error y el directorio activo esta activo
        }elseif(isset($ladpcon[1]) && $ladpcon[2]=='true'){
            //redireccionamos al inicio de sesion y enviamos como parametro el error arrojado al iniciar sesion
            return $this->redirect(['site/index', "error"=>$ladpcon[1]]);
        //si el directorio activo no esta activo
        }elseif($ladpcon[2]=='false'){
            //declaramos la clase del procemiento para login acomer
            $model = new SpLoginAcomer;
            //llamamos la funcion que ejecuta el procedimeinto almacenado 
            $spLoginAcomer = $model->procedimiento();
            //si el codigo de mensaje enviado por el procedimiento es igual a 2
            if($spLoginAcomer[1]=="2"){
                //redireccinamos 
                return $this->redirect(['site/asignapassword',"error"=>$spLoginAcomer[2]]);                
            //si el codigo d mensaje enviado por el procedimiento es igual a 1
            }elseif($spLoginAcomer[1]=="1"){
                //La variable de sesion cedula es asignada con el valor de la cedula que retorna el procedimiento 
                Yii::$app->session['cedula']=$spLoginAcomer[0];
                //redirecciona a la pantalla principal una vez los datos son correctos                
                return $this->redirect(['site/principal',"message"=>$spLoginAcomer[2]]);                
            //Si el codigo de mensaje enviado por el procedimiento es igual a 0
            }elseif($spLoginAcomer[1]=="0"){
                //redireccionamos al incio de sesion con 
                return $this->redirect(['site/index',"activate"=>$spLoginAcomer[2],'usuario'=>Yii::$app->request->get('usuario'), 'clave'=>Yii::$app->request->get('clave')]);
            }else{
                //redireccinamos al index con el error 
                return $this->redirect(['site/index',"error"=>$spLoginAcomer[2]]);
            }
        }else{
            //redireccionamos al index con el error de conexion
            return $this->redirect(['site/index',"error"=>"No hay conexion, por favor contacte con el administrador"]);
        }        
    }

    public function actionOlvidapassword()
    {
        //declaramos la clase del procemiento para login acomer
        $model = new SpLoginAcomer;
        //llamamos la funcion que ejecuta el procedimeinto almacenado 
        $spLoginAcomer = $model->procedimiento();
        //Si el codigo devuelto por el procedimiento es 9
        if($spLoginAcomer[1]=="9"){
            //redirecccioinamos al index con el mensaje devuelto respectivo a lo accionado
            return $this->redirect(['site/index', "remember"=>$spLoginAcomer[2]]);
        //si el codigo devuelto por el procedimeinto es 0
        }elseif($spLoginAcomer[1]=="0"){
            //redireccionamos al index con el error respectivo al codigo 0
            return $this->redirect(['site/index', "error"=>$spLoginAcomer[2]]);
        // si el codigo devuelto no es 9 ni 0
        }else{
            //redireccionamos al index con el error arrojado
            return $this->redirect(['site/index', "error"=>$spLoginAcomer[2]]);
        }
    }

    public function actionAsignapassword(){
        $this->layout=false;
        //modelo de los datos ingresdos
        $modelform = new AsignaForm();
        //declaramos la clase del procemiento para login acomer
        $model = new SpLoginAcomer;
        //llamamos la funcion que ejecuta el procedimeinto almacenado 
        $spLoginAcomer = $model->procedimiento();      
        //la validacion del modelo (que el campo este correctamente)
        //Validación mediante ajax - si es de tipo ajax
        if($modelform->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            //Respuesta en formato json
            Yii::$app->response->format = Response::FORMAT_JSON;
            //el modelo es retornado como valido
            return ActiveForm::validate($modelform);            
        }
        
        if($modelform->load(Yii::$app->request->post())){
            //si el modelo es valido 
            if($modelform->validate()){     
                //redireccionamos a validapassword  
                return $this->redirect(['site/validapassword','clave'=>$modelform->nuevaclave, 'tokenreset'=>Yii::$app->request->get('tokenreset') , 'usuario'=>Yii::$app->request->get('usuario'), 'operacion'=>'F']);            
            }   
        }
        
        //si el codigo devuelto por el procedimiento es 10
        if($spLoginAcomer[1]=="10"){
            //renderizamos asignapassword
            return $this->render('asignapassword',['model' => $modelform]);
        //si el codigo devuelto por el procedimiento es 11
        }elseif($SpLoginAcomer[1]=="11"){            
            return $this->redirect(['site/index', "error"=>$SpLoginAcomer[2]]);   
        //si el codigo devuelto no es ni 10 ni 11         
        }else{            
            return $this->redirect(['site/index', "error"=>$SpLoginAcomer[2]]);            
        }
    }

    public function actionValidapassword()
    {
        //declaramos la clase del procedimiento para login acomer
        $model = new SpLoginAcomer;
        //llamamos la funcion que ejecuta el procedimeinto almacenado 
        $spLoginAcomer = $model->procedimiento();
        //si el codigo devuelto por el procedimiento es 1
        if($spLoginAcomer[1]=="1"){
            //declara la variable de sesion cedula con el valor de la cedula del usuario que ingreso
            Yii::$app->session['cedula'] = $spLoginAcomer[0];
            //redireccionamos a la pantalla principal
            return $this->redirect(['site/principal', "message"=>$spLoginAcomer[2]]);
        // de lo contrario
        }else{
            //redireccionamos 
            return $this->redirect(['site/asignapassword', "error"=>$spLoginAcomer[2], 'tokenreset'=>Yii::$app->request->get('tokenreset') , 'usuario'=>Yii::$app->request->get('usuario'), 'operacion'=>'T']);
        }   
    }

    public function actionPrincipal(){
        //si hay una sesion abierta
        if (isset(Yii::$app->session['cedula'])){
            // renderizamos
            return $this->render('principal');
        }else{                                        
            //retornamos al index
            return $this->goHome();                                        
        }
    }


    public function actionSalida()
    {
        //Elimino session de la cedula que es el parametro principal
        Yii::$app->session['cedula'];
        
        Yii::$app->session->destroy();
        
        return $this->goHome();
    }
    
	public function actionPlaza()
    {				
        return $this->render('plaza');
		
    }
	public function actionMesa()
    {	
		$this->layout=false;    
        return $this->render('mesa');
		
    }
	public function actionMenu()
    {	
		$this->layout=false;    
        return $this->render('menu');
		
    }

	public function actionContratos()
    {			
        //Declareo la clase  para el procedimeinto que trae las empresas y los contratos	
        $model = new SpContratosAcomer;
        $datosEmpCont = $model->sp_acomer_empresas_contratos();
        //Obtengo el array donde estan todas las empresas almacenadas
        $empresas = $datosEmpCont[0];
        //Obtengo el array donde estan todos los contratos almacenados
        $contratos = $datosEmpCont[1];
        //Obtengo el array donde estan todas las facturas almacenadas
        $facturas = $datosEmpCont[2];
        //Estado de la factura (pendiente o cancelada)
        $facturacancelada = '<div class="icon-est-factcan">C</div>';
        $facturapendiente = '<div class="icon-est-factura">P</div>';

        $this->layout=false; 
        return $this->render('contratos',["empresas"=>$empresas,"contratos"=>$contratos,"facturas"=>$facturas,
                                          "facturacancelada"=>$facturacancelada,"facturapendiente"=>$facturapendiente]);
    }

}

