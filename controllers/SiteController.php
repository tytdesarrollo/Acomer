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
use app\models\SpMesasPlaza;
use app\models\SpMenusPlaza;
use app\models\SpMesasPedidos;
use app\models\funcionesArray;
use app\models\SpMesasFactura;



class SiteController extends Controller
{ 	


	public function actionPrueba(){		


        return $this->render('prueba'); 
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

    public function actionJsonmesas(){
        $fn_mesas = new SpMesasPlaza;
        //obtiene las posiciones de las mesas 
        $datosMesas = $fn_mesas->procedimiento(); 
        //imprime los datos en tipo json         
        echo json_encode($datosMesas);
    }

    public function actionJsonpedidos(){
        $fn_pedidos = new SpMesasPedidos;
        //obtiene las posiciones de las mesas 
        $datosPedidos = $fn_pedidos->procedimiento(); 
        //imprime los datos en tipo json         
        echo json_encode($datosPedidos);
    }

    public function actionJsonpuestosfac(){
        //parametros pasados por GET
        $c1 = $_GET['mesa'];

        $fn_fac_puestos = new SpMesasFactura;
        //obtiene las posiciones de las mesas 
        $puestos = $fn_fac_puestos->procedimiento($c1); 
        //imprime los datos en tipo json         
        echo json_encode($puestos);
    }

	public function actionMesa()
    {	
        //=============================DATOS ENVIADOS POR GET=======================================
        //codigo de la mesa 
        if(!isset($_GET['codigoM'])){
            $this->layout=false;    
            return $this->redirect(['site/plaza']); 
        }else{
            $codigomesa = $_GET['codigoM'];  
        }
       
        //datos enviados desde la plaza
        if(!isset($_GET['estadoM'])){
            $estadomesa = 1;
        }else{
            $estadomesa = $_GET['estadoM'];
        }        

        //datos enviados desde el menu
        if(!isset($_GET['platos'], $_GET['cantidad'], $_GET['puestos'])){
            $platos = 0;
            $cantidad = 0;
            $puestos = 0;
            $arrpuestos = 0;
        }else{
            $platos = $_GET['platos'];
            $cantidad = $_GET['cantidad'];            
            $puestos = $_GET['puestos'];
            // acomodar el array de los puestos
            $funciones1 = new funcionesArray();
            $funciones2 = $funciones1->crearArray($_GET['puestos']);
            $arrpuestos = $funciones1->arrayNuevo(array_unique($funciones2));
            $arrpuestos = $funciones1->arrayToChar($arrpuestos);

            $tamano = $_GET['tamanoM']; //tamano de la mesa que se esta usando
        }

        if(!isset($_GET['tamanoM'])){            
            $tamano = 4;
        }else{
            $tamano = $_GET['tamanoM'];
        }
        //=============================DATOS ENVIADOS POR GET=======================================
        


        
		$this->layout=false;    
        return $this->render('mesa',["estadomesa" => $estadomesa, "codigomesa" => $codigomesa,
                                     "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos,
                                     "tamano" => $tamano, "arrpuestos" => $arrpuestos]);
		
    }
   

    public function actionVarsesions(){
        //cantidad de personas en la mesa
        $tamano = $_GET['tamano'];

        // dependiendo del tamano de la mesa se crear n variables de session
        if($tamano > 4 && $tamano <= 6){
            $codigo1 = $_GET['mesas'];
            setcookie('mesa1', $codigo1);   
            echo $_COOKIE["mesa1"];
        }
        
    }


    public function actionJsonmesasunidas(){
        $in_var = $_GET['mesaclick'];

        $clase = new SpMesasPedidos();
        $procedimiento = $clase->procedimiento3($in_var);
        $a = $procedimiento[0];
        $b = $procedimiento[1];

        $c = arraY($a,$b);
        echo json_encode($c);
    }

    public function actionRealizarpedido(){
        //c1: Variable correspondiente al arraY de los puestos  
        //c2: Variable correspondiente al arraY de los platos
        //c3: Variable correspondiente al arraY de la cantidad
        //c4: Variable correspondiente al arraY del termino
        //c5: Variable correspondiente alcodigo del mesero
        //c6: Variable correspondiente al arraY al codigo de la mesa
        
        //capturas los datos enviados por get
        $get1 = $_GET['puestos'];
        $get2 = $_GET['platos'];
        $get3 = $_GET['cantidad'];
        $get4 = $_GET['termino'];        
        $get5 = '16743485';//$_SESSION['cedula'];
        $get6 = $_GET['mesa'];
        
        $funcionArr = new funcionesArray();
        //
        $c1 = $funcionArr->crearArray($get1);
        $c1 = $funcionArr->arrayPuestos($c1);
        $c2 = $funcionArr->crearArray($get2);
        $c3 = $funcionArr->crearArray($get3);
        $c4 = $funcionArr->arrayTermino($get4);
        $c5 = $get5;//$_SESSION['cedula'];
        $c6 = $get6;


        //return $this->redirect(['site/prueba','c1'=>$c1,'c2'=>$c2,'c3'=>$c3,'c4'=>$c4,'c5'=>$c5,'c6'=>$c6]);   
        
        $pedido = new SpMesasPedidos();
        $tomarpedido = $pedido->procedimiento2($c1,$c2,$c3,$c4,$c5,$c6);

        return $this->redirect(['site/plaza']);

    }

    public function actionAdicionarpedido(){
        //c1: Variable correspondiente al arraY de los puestos  
        //c2: Variable correspondiente al arraY de los platos
        //c3: Variable correspondiente al arraY de la cantidad
        //c4: Variable correspondiente al arraY del termino
        //c5: Variable correspondiente alcodigo del mesero
        //c6: Variable correspondiente al arraY al codigo de la mesa
        
        //capturas los datos enviados por get
        $get1 = $_GET['puestos'];
        $get2 = $_GET['platos'];
        $get3 = $_GET['cantidad'];
        $get4 = $_GET['termino'];        
        $get5 = '16743485';//$_SESSION['cedula'];
        $get6 = $_GET['mesa'];
        
        $funcionArr = new funcionesArray();
        //
        $c1 = $funcionArr->crearArray($get1);
        $c1 = $funcionArr->arrayPuestos($c1);
        $c2 = $funcionArr->crearArray($get2);
        $c3 = $funcionArr->crearArray($get3);
        $c4 = $funcionArr->arrayTermino($get4);
        $c5 = $get5;//$_SESSION['cedula'];
        $c6 = $get6;

        echo "paila";

        //return $this->redirect(['site/prueba','c1'=>$c1,'c2'=>$c2,'c3'=>$c3,'c4'=>$c4,'c5'=>$c5,'c6'=>$c6]);   
        
        $pedido = new SpMesasPedidos();
        $tomarpedido = $pedido->procedimiento4($c1,$c2,$c3,$c4,$c5,$c6);

        return $this->redirect(['site/plaza']);
    }

    public function actionRealizarpedidox(){
        // Mesa 1
        //c1: Variable correspondiente al arraY de los puestos  
        //c2: Variable correspondiente al arraY de los platos
        //c3: Variable correspondiente al arraY de la cantidad
        //c4: Variable correspondiente al arraY del termino
        //c5: Variable correspondiente alcodigo del mesero
        //c6: Variable correspondiente al codigo de la mesa
        // mesa 2
        //c7: Variable correspondiente al arraY de los puestos  
        //c8: Variable correspondiente al arraY de los platos
        //c9: Variable correspondiente al arraY de la cantidad
        //c10: Variable correspondiente al arraY del termino
        //c11: Variable correspondiente alcodigo del mesero
        //c12: Variable correspondiente al arraY al codigo de la mesa
        //
        // union de las mesas
        // c13: variable correspondiente a la mesa principal
        // c14: variable correspondiente al numero de personas 
        // c15: variable correnpondiente a las mesas que se van a unir
        
        //capturas los datos enviados por get   
        //pedido para la mesa principal     
        $get1 = $_GET['puestos1'];
        $get2 = $_GET['platos1'];
        $get3 = $_GET['cantidad1'];
        $get4 = $_GET['termino1'];        
        $get5 = '16743485';//$_SESSION['cedula'];
        $get6 = $_GET['mesa1'];        
        $get7 = $_GET['mesa2'];
        
        $fn_arrays = new funcionesArray();

        //0: dos mesas unidas
        //1: tres mesas unidad
        if($_GET['tamano'] === '0'){
            $arrayMesa1 = $fn_arrays->arrayPorPuesto($get1,$get2,$get3,$get4,'1');
            $arrayMesa2 = $fn_arrays->arrayPorPuesto($get1,$get2,$get3,$get4,'2');
            
            // variables de la mesa 1
            $c1 = $arrayMesa1[0];
            $c1 = $fn_arrays->arrayPuestos($c1);
            $c2 = $arrayMesa1[1];
            $c3 = $arrayMesa1[2];
            $c4 = $arrayMesa1[3];
            $c5 = $get5;
            $c6 = $get6;

            // variables de la mesa 2
            $c7 = $arrayMesa2[0];
            $c7 = $fn_arrays->arrayPuestos($c7);
            $c8 = $arrayMesa2[1];
            $c9 = $arrayMesa2[2];
            $c10 = $arrayMesa2[3];
            $c11 = $get5;
            $c12 = $get7;

            // variables de union
            $c13 = $get6;
            $c14 = '6';
            $c15 =  array($get7);

            // se realiza el pedido
            /*$pedido1 = new SpMesasPedidos();
            $tomarpedido1 = $pedido1->procedimiento5($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14,$c15);*/

            var_dump($c1);
            
        }else if($_GET['tamano'] === '1'){
            //toma de pedido con el procedimiento para 3 mesas unidas
            echo 'a';
        }        
        
        return $this->redirect(['site/plaza']);

    }

    public function actionAdicionarpedidox(){
        // Mesa 1
        //c1: Variable correspondiente al arraY de los puestos  
        //c2: Variable correspondiente al arraY de los platos
        //c3: Variable correspondiente al arraY de la cantidad
        //c4: Variable correspondiente al arraY del termino
        //c5: Variable correspondiente alcodigo del mesero
        //c6: Variable correspondiente al codigo de la mesa
        // mesa 2
        //c7: Variable correspondiente al arraY de los puestos  
        //c8: Variable correspondiente al arraY de los platos
        //c9: Variable correspondiente al arraY de la cantidad
        //c10: Variable correspondiente al arraY del termino
        //c11: Variable correspondiente alcodigo del mesero
        //c12: Variable correspondiente al arraY al codigo de la mesa
        
        //capturas los datos enviados por get
        $get1 = $_GET['puestos1'];
        $get2 = $_GET['platos1'];
        $get3 = $_GET['cantidad1'];
        $get4 = $_GET['termino1'];        
        $get5 = '16743485';//$_SESSION['cedula'];
        $get6 = $_GET['mesa1'];        
        $get7 = $_GET['mesa2'];

        $fn_arrays = new funcionesArray();

        if($_GET['tamano'] === '0'){

            $arrayMesa1 = $fn_arrays->arrayPorPuesto($get1,$get2,$get3,$get4,'1');
            $arrayMesa2 = $fn_arrays->arrayPorPuesto($get1,$get2,$get3,$get4,'2');

            if(sizeof($arrayMesa1[0]) === 0){
                echo '';
            }

        }else if($_GET['tamano'] === '1'){
            //toma de pedido con el procedimiento para 3 mesas unidas
            echo 'a';
        }  
        
        


        //return $this->redirect(['site/plaza']);
    }

    public function actionFacturar(){
        //c1: Variable correspondiente a la cedula del cliente (opcional)
        //c2: Variable correspondiente al nombre de quien queda la factura (opcional)
        //c3: Variable correspondiente al codigo de la mesa
        //c4: Variable correspondiente a la cedula del mesero
        //c5: Variable correspondiente a la forma de pago
        //c6: Variable correspondiente a los puestos que se facturan
        //caputra de datos por get
        $get1 = $_GET['puestos'];
        $get2 = $_GET['mesa'];
        $get3 = $_GET['full'];

        // parametros del procedimiento
        $c1 = "N/A";
        $c2 = "N/A";
        $c3 = $get2;
        $c4 = '16743485';//$_SESSION['cedula'];
        $c5 = "01";
        $c6 = $get1;



        $fn_facturar = new SpMesasFactura();
        

        if($get3 === "false"){     
            $c6 = array("0");
            $facturar = $fn_facturar->procedimiento2($c1,$c2,$c3,$c4,$c5,$c6);
            echo json_encode($facturar);
        }else{
            $funcionArr = new funcionesArray();                        
            $c6 = $funcionArr->arrayPuestos($c6);
            $facturar = $fn_facturar->procedimiento2($c1,$c2,$c3,$c4,$c5,$c6);
            echo json_encode($facturar);

        }
        //echo '[{"NUMERO_FAC":["000003"],"FECHA":["17\/08\/2017"]},{"PRODES":["TORO CAESAR","ENSALDA FUSION","ENSALDA ORIENTE"],"PEDUNI":["1","1","1"],"PEDVALTUN":["24990","22015","26537"]},"73542"]';

        
        
    }

	public function actionMenu()
    {	
        //=============================CARGA DEL MENU=======================================
        // se hace el llamado de la funcion que ejecuta el procedimiento
        $fn_menus = new SpMenusPlaza;
        $datosMenus = $fn_menus->procedimiento();
        // se asignana los valores que retorna la funcion respectivamente 
        // tipos de comidas
        $categorias = $datosMenus[0];
        // los platos 
        $comidas = $datosMenus[3];
        //=============================CARGA DEL MENU=======================================
        

        //=============================LOGICA DE PEDIDO=======================================
        //captura el puesto al que se le va a tomar el pedido
        $puesto = $_GET['puesto'];
        $codmesa = $_GET['codigoM'];
        $tamano = $_GET['tamanoM'];
        $estado = $_GET['estadoM'];
        // si se recibe platos, cantidad y puesto redirecciona con unos parametros 
        if(isset($_GET['platos'], $_GET['cantidad'], $_GET['puestos'])){
            // variables que se pasan como parametro
            $platos = $_GET['platos']; // los platos que se han pedido en la mesa 
            $cantidad = $_GET['cantidad']; // cantidad de platos que se han pedido  en la mesa
            $puestos = $_GET['puestos']; // numero de los puestos donde se han pedido
            // redirecciona a la vista menu con los parametros del menu y de los pedidos de la mesa ya hechos 
            $this->layout=false;    
            return $this->render('menu',["categorias" => $categorias, "comidas" => $comidas, "puesto" => $puesto,
                                         "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos,
                                         "codmesa" => $codmesa, "tamano" => $tamano, "estado" => $estado]);
        }else{
            $platos = 0;
            $cantidad = 0;
            $puestos = 0;
            // redirecciona a la vista menu con los parametros del menu 
            $this->layout=false;    
            return $this->render('menu',["categorias" => $categorias, "comidas" => $comidas, "puesto" => $puesto,
                                         "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos,
                                         "codmesa" => $codmesa, "tamano" => $tamano, "estado" => $estado]);
        }
        //=============================LOGICA DE PEDIDO=======================================        
        

		
		
    }

	public function actionMenunew()
    {
		 //=============================CARGA DEL MENU=======================================
        // se hace el llamado de la funcion que ejecuta el procedimiento
        $fn_menus = new SpMenusPlaza;
        $datosMenus = $fn_menus->procedimiento();
        // se asignana los valores que retorna la funcion respectivamente 
        // tipos de comidas
        $categorias = $datosMenus[0];
        // los platos 
        $comidas = $datosMenus[3];
        //=============================CARGA DEL MENU=======================================
        

        //=============================LOGICA DE PEDIDO=======================================
        //captura el puesto al que se le va a tomar el pedido
        $puesto = '1'; //$_GET['puesto'];
        // si se recibe platos, cantidad y puesto redirecciona con unos parametros 
        if(isset($_GET['platos'], $_GET['cantidad'], $_GET['puestos'])){
            // variables que se pasan como parametro
            $platos = $_GET['platos']; // los platos que se han pedido en la mesa 
            $cantidad = $_GET['cantidad']; // cantidad de platos que se han pedido  en la mesa
            $puestos = $_GET['puestos']; // numero de los puestos donde se han pedido
            // redirecciona a la vista menu con los parametros del menu y de los pedidos de la mesa ya hechos 
            $this->layout=false;    
            return $this->render('menu',["categorias" => $categorias, "comidas" => $comidas, "puesto" => $puesto,
                                         "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos]);
        }else{
            $platos = 0;
            $cantidad = 0;
            $puestos = 0;
            // redirecciona a la vista menu con los parametros del menu 
            $this->layout=false;    
            return $this->render('menunew',["categorias" => $categorias, "comidas" => $comidas, "puesto" => $puesto,
                                         "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos]);
        }
        //=============================LOGICA DE PEDIDO=======================================    
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

