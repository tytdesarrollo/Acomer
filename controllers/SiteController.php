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
use app\models\SpCocinaPedidos;
use app\models\SpAdministracion;
use app\models\SpCrearMenus;
use app\models\AcRptVentasProd;


class SiteController extends Controller
{   


    public function actionPrueba(){     
        
        
        $this->layout=false;
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
        }elseif($spLoginAcomer[1]=="11"){            
            return $this->redirect(['site/index', "error"=>$spLoginAcomer[2]]);   
        //si el codigo devuelto no es ni 10 ni 11         
        }else{            
            return $this->redirect(['site/index', "error"=>$spLoginAcomer[2]]);            
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

    public function actionActivapassword()
    {
        //declaramos la clase del procedimiento para login acomer
        $model = new SpLoginAcomer;
        //llamamos la funcion que ejecuta el procedimeinto almacenado 
        $spLoginAcomer = $model->procedimiento();
                        
         if(isset($_POST['activate'])){                             
                    
            $datos = $spLoginAcomer[2];
                    
            echo(($datos)?json_encode($datos):'');
        
        }else{
            
            $datos = 0; 
            
            echo(($datos)?json_encode($datos):''); 
        }           
    }

    public function actionPrincipal(){
        //si hay una sesion abierta
        if (isset(Yii::$app->session['cedula'])){
            //cedula ingresada
            $cedula = $_SESSION['cedula'];

            $fn_login = new SpLoginAcomer();
            $rol = $fn_login->procedimiento2($cedula)[0];

            if($rol === 'MESERO'){
                return $this->redirect(['site/plaza']);
            }else if($rol === 'COCINERO'){
                return $this->redirect(['site/cocina']);
            }else if($rol === 'ADMINISTRADOR' || $rol === 'ADMINMENOR'){
                return $this->redirect(['site/administrador']);
            }else{
                session_destroy();
                return $this->redirect(['site/index']);
            }          
        }else{                                        
            //retornamos al index
            return $this->redirect(['site/index']);
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
        if(!isset(Yii::$app->session['cedula'])){
            return $this->redirect(['site/index']);
        }else{
            $cedula = Yii::$app->session['cedula'];
            $cedula = trim($cedula);

            $fn_login = new SpLoginAcomer();
            $rol = $fn_login->procedimiento2($cedula)[0];

            if($rol === 'COCINERO'){
                return $this->redirect(['site/cocina']);
            }else if($rol === 'ADMINISTRADOR'){
                return $this->redirect(['site/administrador']);
            }
        }

        //==========================================================
        //codigos de los container
        $fn_plaza = new SpMesasPlaza();
        $codigos = $fn_plaza->procedimiento2();   
        $container1 = $codigos[0];  
        $container2 = $codigos[1]; 
        $container3 = $codigos[2]; 
        $container4 = $codigos[3]; 
        //==========================================================


        return $this->render('plaza', ["container1"=>$container1, "container2"=>$container2, "container3"=>$container3,
                                       "container4"=>$container4, "rol"=>$rol]);           
    }

    public function actionPlaza2(){

        $cedula = Yii::$app->session['cedula'];
        $cedula = trim($cedula);
        
        $fn_login = new SpLoginAcomer();
        $rol = $fn_login->procedimiento2($cedula)[0];
        //==========================================================
        //codigos de los container
        $fn_plaza = new SpMesasPlaza();
        $codigos = $fn_plaza->procedimiento2();   
        $container1 = $codigos[0];  
        $container2 = $codigos[1]; 
        $container3 = $codigos[2]; 
        $container4 = $codigos[3]; 
        //==========================================================
        //
        return $this->render('plaza2',["container1"=>$container1, "container2"=>$container2, "container3"=>$container3,
                                       "container4"=>$container4, "rol"=>$rol]);
    }

    public function actionJsonmesas(){
        $fn_mesas = new SpMesasPlaza;
        //obtiene las posiciones de las mesas 
        $datosMesas = $fn_mesas->procedimiento('PLAZA1'); 
        //imprime los datos en tipo json         
        echo json_encode($datosMesas);
    }

    public function actionJsonmesas2(){
        $fn_mesas = new SpMesasPlaza;
        //obtiene las posiciones de las mesas 
        $datosMesas = $fn_mesas->procedimiento('PLAZA2'); 
        //imprime los datos en tipo json         
        echo json_encode($datosMesas);
    }

    public function actionJsonpedidos(){
        //$c1: cedula del mesero
        $c1 = Yii::$app->session['cedula'];

        $fn_pedidos = new SpMesasPedidos;
        //obtiene las posiciones de las mesas 
        $datosPedidos = $fn_pedidos->procedimiento($c1);
        //imprime los datos en tipo json         
        echo json_encode($datosPedidos);
    }

    public function actionEntregarpedido(){
        $c1 = Yii::$app->request->get('puestos');
        $c2 = Yii::$app->request->get('platos');
        $c3 = Yii::$app->request->get('documento');
        $c4 = Yii::$app->request->get('empresa');

        $fn_mesas = new SpMesasPlaza();
        $fn_mesas->procedimiento3($c1,$c2,$c3,$c4); 
        
    }

    public function actionJsonpuestosfac(){
        //parametros pasados por GET
        $c1 = Yii::$app->request->get('mesa');

        $fn_fac_puestos = new SpMesasFactura;
        //obtiene las posiciones de las mesas 
        $puestos = $fn_fac_puestos->procedimiento($c1); 
        //imprime los datos en tipo json         
        echo json_encode($puestos);
    }

    public function actionJsonpuestosfacx(){
         //parametros pasados por GET
        $mesa1 = Yii::$app->request->get('mesa1');
        $mesa2 = Yii::$app->request->get('mesa2');

        if($mesa2 == 'undefined'){
            session_start()   ;
            if(is_array($_SESSION['mesa1'])){
                $mesa2 = $_SESSION["mesa1"][0];
            }else{
                $mesa2 = $_SESSION["mesa1"];
            }
        }
        $fn_fac_puestos = new SpMesasFactura;
        //obtiene las posiciones de las mesas 
        $puestos1 = $fn_fac_puestos->procedimiento($mesa1); 
        $puestos2 = $fn_fac_puestos->procedimiento($mesa2); 
        //array que va a contener los dos resultados de las mesas
        $puestosTotal = array($puestos1, $puestos2);
        //imprime los datos en tipo json         
        echo json_encode($puestosTotal);
    }

    public function actionMesa()
    {   
        //=============================DATOS ENVIADOS POR GET=======================================
        //codigo de la mesa 
        if(!isset($_GET['codigoM'])){
            $this->layout=false;    
            return $this->redirect(['site/plaza']); 
        }else{
            $codigomesa = Yii::$app->request->get('codigoM');
        }
       
        //datos enviados desde la plaza
        if(!isset($_GET['estadoM'])){
            $estadomesa = 1;
        }else{
            $estadomesa = Yii::$app->request->get('estadoM');
        }        

        //datos enviados desde el menu
        if(!isset($_GET['platos'], $_GET['cantidad'], $_GET['puestos'],$_GET['avatars'])){
            $platos = 0;
            $cantidad = 0;
            $puestos = 0;
            $arrpuestos = 0;
            $avatars = 0;
            $notas = 0;
        }else{
            $platos = Yii::$app->request->get('platos');
            $cantidad = Yii::$app->request->get('cantidad');
            $puestos = Yii::$app->request->get('puestos');
            $avatars = Yii::$app->request->get('avatars');
            $notas = Yii::$app->request->get('notas');
            // acomodar el array de los puestos
            $funciones1 = new funcionesArray();
            $funciones2 = $funciones1->crearArray(Yii::$app->request->get('puestos'));
            $arrpuestos = $funciones1->arrayNuevo(array_unique($funciones2));
            $arrpuestos = $funciones1->arrayToChar($arrpuestos);

            $tamano = Yii::$app->request->get('tamanoM'); //tamano de la mesa que se esta usando
        }

        if(!isset($_GET['tamanoM'])){            
            $tamano = 4;
        }else{
            $tamano = Yii::$app->request->get('tamanoM');
        }


        $model = new SpMesasPedidos();        
        // se crea la ession correspondiente para las mesas unidas
        if($tamano >= 5 && $tamano <= 6 && $plato = 0){
            $mesasUnidas = $model->procedimiento3($codigomesa);
            $mesaSecundaria = $mesasUnidas[0]['MESCODUNI'][0];
            //inicia la session y se crea la mesa secundaria
            session_start();
            $_SESSION['mesa1'] = $mesaSecundaria ; 
        }


        // si el estado es ocupado ya hay pedido confirmado 
        // y se consulta lo que se ha pedido
        if($estadomesa === '0'){
            $confirmados = 1;
        }else{
            $confirmados = 0;
        }
        //=============================DATOS ENVIADOS POR GET=======================================
        
        //=============================EMPRESAS=======================================
        $fn_menus_new = new SpCrearMenus();
        $empresas = $fn_menus_new->procedimiento7();
        //=============================EMPRESAS=======================================
        


        //=============================RESERVAS=======================================
        if(!isset($_GET['puestoRsr'])){
            $puestosReserv = "NO_RESERVA";
        }else{
            $puestosReserv = Yii::$app->request->get('puestoRsr');            
        }
        
        //=============================RESERVAS=======================================

        
        $this->layout=false;    
        return $this->render('mesa',["estadomesa" => $estadomesa, "codigomesa" => $codigomesa,
                                     "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos,
                                     "tamano" => $tamano, "arrpuestos" => $arrpuestos, 
                                     "confirmados" => $confirmados,"avatars"=>$avatars,"empresas"=>$empresas,"notas"=>$notas, "puestosReserv"=>$puestosReserv]);
        
    }
   

    public function actionVarsesions(){
        //cantidad de personas en la mesa
        $tamano = Yii::$app->request->get('tamano');

        // dependiendo del tamano de la mesa se crear n variables de session
        if($tamano > 4 && $tamano <= 6){
            if(session_status() != 1){
                session_destroy();
            } 

            session_start(); 
            //modifica la variable con la mesa correspondiente
            if(is_array($_GET['mesa1'])){
                $_SESSION['mesa1'] = Yii::$app->request->get('mesa1')[0];
            }else{
                $_SESSION['mesa1'] = Yii::$app->request->get('mesa1');
            }
            
            echo $_SESSION["mesa1"];
        }
        
    }


    public function actionJsonmesasunidas(){
        $in_var = Yii::$app->request->get('mesaclick');

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
        $get1 = Yii::$app->request->get('puestos');
        $get2 = Yii::$app->request->get('platos');
        $get3 = Yii::$app->request->get('cantidad');
        $get4 = Yii::$app->request->get('notas');
        $get5 = Yii::$app->session['cedula'];
        $get5 = trim($get5);
        $get6 = Yii::$app->request->get('mesa');
        $get7 = Yii::$app->request->get('avatar');
        
        $funcionArr = new funcionesArray();
        
        $c1 = $funcionArr->crearArray($get1);
        $c1 = $funcionArr->arrayPuestos($c1);
        $c2 = $funcionArr->crearArray($get2);
        $c3 = $funcionArr->crearArray($get3);
        $c4 = explode(',',$get4);
        $c5 = Yii::$app->session['cedula'];
        $c5 = trim($c5);
        $c6 = $get6;
    

        /*var_dump($c1);
        var_dump($c2);
        var_dump($c3);
        var_dump($c4);
        echo $c5; echo "<br>";
        echo $c6;*/
        
        $pedido = new SpMesasPedidos();
        $tomarpedido = $pedido->procedimiento2($c1,$c2,$c3,$c4,$c5,$c6);

        $c1 = $funcionArr->crearArray($get6);
        $c2 = $funcionArr->crearArray($get7);

        $pedido->procedimeinto13($c1,$c2);

        //actualiza los puesto de la mesa
        $c1 = Yii::$app->request->get('mesa');
        $c2 = Yii::$app->request->get('tamano');
        $tomarpedido = $pedido->procedimiento15($c1,$c2);

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
        $get1 = Yii::$app->request->get('puestos');
        $get2 = Yii::$app->request->get('platos');
        $get3 = Yii::$app->request->get('cantidad');
        $get4 = Yii::$app->request->get('termino');
        $get5 = Yii::$app->session['cedula'];
        $get5 = trim($get5);
        $get6 = Yii::$app->request->get('mesa');
        $get7 = Yii::$app->request->get('avatar');
        
        $funcionArr = new funcionesArray();
        //
        $c1 = $funcionArr->crearArray($get1);
        $c1 = $funcionArr->arrayPuestos($c1);
        $c2 = $funcionArr->crearArray($get2);
        $c3 = $funcionArr->crearArray($get3);
        $c4 = $funcionArr->arrayTermino($get4);
        $c5 = Yii::$app->session['cedula'];
        $c5 = trim($c5);
        $c6 = $get6;

        echo "paila";

        //return $this->redirect(['site/prueba','c1'=>$c1,'c2'=>$c2,'c3'=>$c3,'c4'=>$c4,'c5'=>$c5,'c6'=>$c6]);   
        
        $pedido = new SpMesasPedidos();
        $tomarpedido = $pedido->procedimiento4($c1,$c2,$c3,$c4,$c5,$c6);

        if(strcmp($get7,"0") !== 0){
            $c1 = $funcionArr->crearArray($get6);
            $c2 = $funcionArr->crearArray($get7);

            $pedido->procedimeinto13($c1,$c2);
        }

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
        $get1 = Yii::$app->request->get('puestos1');
        $get2 = Yii::$app->request->get('platos1');
        $get3 = Yii::$app->request->get('cantidad1');
        $get4 = Yii::$app->request->get('termino1');
        $get5 = Yii::$app->session['cedula'];
        $get5 = trim($get5);
        $get6 = Yii::$app->request->get('mesa1');
        $get7 = Yii::$app->request->get('mesa2');
        $get8 = Yii::$app->request->get('avatar');
        
        $fn_arrays = new funcionesArray();

        //0: dos mesas unidas
        //1: tres mesas unidad
        if(Yii::$app->request->get('tamano') === '0'){
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
            $pedido1 = new SpMesasPedidos();
            $tomarpedido1 = $pedido1->procedimiento5($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14,$c15);


            $c1 = $fn_arrays->crearArray($get6.','.$get7);
            $c2 = $fn_arrays->crearArray($get8);

            $pedido1->procedimeinto13($c1,$c2);        
            
        }else if(Yii::$app->request->get('tamano') === '1'){
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
        $get1 = Yii::$app->request->get('puestos1');
        $get2 = Yii::$app->request->get('platos1');
        $get3 = Yii::$app->request->get('cantidad1');
        $get4 = Yii::$app->request->get('termino1');        
        $get5 = Yii::$app->session['cedula'];
        $get5 = trim($get5);
        $get6 = Yii::$app->request->get('mesa1');        
        $get7 = Yii::$app->request->get('mesa2');
        $get8 = Yii::$app->request->get('avatar');

        $fn_arrays = new funcionesArray();
        $fn_adicion = new SpMesasPedidos();

        if(Yii::$app->request->get('tamano') === '0'){
            //los arrays correspondientes a la mesa 1
            $arrayMesa1 = $fn_arrays->arrayPorPuesto($get1,$get2,$get3,$get4,'1');
            $c1 = $fn_arrays->arrayPuestos($arrayMesa1[0]);
            $c2 = $arrayMesa1[1];
            $c3 = $arrayMesa1[2];
            $c4 = $arrayMesa1[3];
            $c5 = $get5;
            $c6 = $get6;

            //los arrays correspondientes a la mesa 2
            $arrayMesa2 = $fn_arrays->arrayPorPuesto($get1,$get2,$get3,$get4,'2');
            $c7  = $fn_arrays->arrayPuestos($arrayMesa2[0]);
            $c8  = $arrayMesa2[1];
            $c9  = $arrayMesa2[2];
            $c10 = $arrayMesa2[3];
            $c11 = $get5;
            $c12 = $get7;

            // si la adicion a la mesa uno es nula no se ejecuta el procedimiento 
            if(count($arrayMesa1[0]) !== 0){
                $adicionMesa1 = $fn_adicion->procedimiento4($c1,$c2,$c3,$c4,$c5,$c6);
            }      

            // si la adicion a la mesa dos es nula no se ejecuta el procedimiento 
            if(count($arrayMesa2[0]) !== 0){
                $adicionMesa2 = $fn_adicion->procedimiento4($c7,$c8,$c9,$c10,$c11,$c12);
            }               

            
            if(strcmp($get8,"0") !== 0){
                $c1 = $fn_arrays->crearArray($get6.",".$get7);
                $c2 = $fn_arrays->crearArray($get8);

                $fn_adicion->procedimeinto13($c1,$c2);  
            }

        }else if(Yii::$app->request->get('tamano') === '1'){
            //toma de pedido con el procedimiento para 3 mesas unidas
            echo 'a';
        }  
        

        return $this->redirect(['site/plaza']);
    }

    public function actionCancelarpedido(){
        //$c1: tipo de cancelacion 0: plato 1: todo el pedido
        //$c2: codigo de la mesa donde se va hacer la cancelacion
        //$c3: codigo del plato que se va a cancelar
        //$c4: cantidad que se va a cancelar
        //$c5: puesto del plato donde se va a cancelar  
        //$c6: codigo del mensaje 0: correcto , 1: error         
        
        // codigo de la mesa que 
        $c1 = 0;
        $c2 = Yii::$app->request->get('mesa');
        $c3 = array($_GET['plato']);
        $c4 = array($_GET['cantidad']);
        $c5 = array($_GET['puesto']);
        $c6 = 1;
               
        $fn_cancelar = new SpMesasPedidos();
        $c6 = $fn_cancelar->procedimiento8($c1,$c2,$c3,$c4,$c5);
        
        /*echo $c2.'<br>';
        var_dump($c3);
        var_dump($c4);
        var_dump($c5);*/

        echo $c6;        

    }

    public function actionCancelartodo(){
         //$c1: tipo de cancelacion 0: plato 1: todo el pedido
        //$c2: codigo de la mesa donde se va hacer la cancelacion
        //$c3: codigo del plato que se va a cancelar
        //$c4: cantidad que se va a cancelar
        //$c5: puesto del plato donde se va a cancelar  
        //$c6: codigo del mensaje 0: correcto , 1: error         
        
        $fn_cancelar = new SpMesasPedidos();

        // datos eviados por get
        $get1 = Yii::$app->request->get('tamano');

        if($get1 >= 0 && $get1 <= 12){
            // captura los demas datos
            $get2 = Yii::$app->request->get('mesa');
            //parametros de entrada
            $c1 = 1;
            $c2 = $get2;
            $c3 = array("");
            $c4 = array("");
            $c5 = array("");

            $c6 = $fn_cancelar->procedimiento8($c1,$c2,$c3,$c4,$c5);


        }

        echo $c6;        
    }

    public function actionCancelarresto(){
        $fn_cancelar = new SpMesasPedidos();

        // datos eviados por get
        $get1 = $_GET['tamano'];

        if($get1 <= 4){
             // captura los demas datos
            $get2 = $_GET['mesa'];
            $c1 = $get2;

            $fn_cancelar->procedimiento12($c1);
            
        }else if($get1 >= 5 and $get1 <=6){
            //mesa principal y la mesa unida a ella
            $get2 = $_GET['mesa1'];
            $get3 = $_GET['mesa2'];

            $c1 = $get2;            
            $fn_cancelar->procedimiento12($c1);

            $c1 = $get3;
            $fn_cancelar->procedimiento12($c1);
        }

        echo 1;
    }

    public function actionFacturar(){ 
        //$c1: codigo del cliente
        //$c2: nombre del clente
        //$c3: codigo de la mesa
        //$c4: cedula del mesero
        //$c5: formas de pago
        //$c6: numero de autorizacion
        //$c7: puesto a facturar            
        //$c8: valor de la atencion
        //$c9: empresa de la atencion
        //$c10: porcentaje de la propina
        //
        //caputra de datos por get
        $get1 = Yii::$app->request->get('codigoCliente');
        $get2 = Yii::$app->request->get('nombreCliente');
        $get3 = Yii::$app->request->get('codigoMesa');
        $get4 = Yii::$app->session['cedula'];
        $get5 = Yii::$app->request->get('formaPago');
        $get6 = Yii::$app->request->get('codigoAuth');
        $get7 = Yii::$app->request->get('puestos');
        $get8 = Yii::$app->request->get('valorAtencion');
        $get9 = Yii::$app->request->get('empresaAtencion');
        $get10 = Yii::$app->request->get('porcentajePropina');

        $fn_array = new funcionesArray();

        $c1 = $get1;
        $c2 = $get2;
        $c3 = $get3;
        $c4 = $get4;
        $c5 = $get5;
        $c6 = $get6;
        $c7 = $fn_array->arrayPuestos($get7);
        $c8 = $fn_array->crearArray($get8);
        $c9 = $fn_array->crearArray($get9);
        $c10 = $get10;

        $fn_facturar = new SpMesasFactura();

        $factura = $fn_facturar->procedimiento13($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10);
        $email = $fn_facturar->procedimiento10($factura[0]);

        echo json_encode($factura);

        /*echo $c1; echo "<br>";
        echo $c2; echo "<br>";
        echo $c3; echo "<br>";
        echo $c4; echo "<br>";
        echo $c5; echo "<br>";
        echo $c6; echo "<br>";
        var_dump($c7); echo "<br>";
        var_dump($c8); echo "<br>";
        var_dump($c9); echo "<br>";
        echo $c10; echo "<br>";*/
       
    }

    public function actionReversarfactura(){
        //$c1: numero de rever que se le asigna al momento de facturar 
        //$c2: numero de la factura que se da al cliente y que se va a revertir
        //        
        $get1 = Yii::$app->request->get('factura');

        $c1 = $get1;
        $c2 = Yii::$app->session['cedula'];

        $fn_factura = new SpMesasFactura();
        $fn_factura->procedimiento14($c1,$c2);

        echo '1';
        
    }

    public function actionFacturarx(){
        //$c1: codigo del cliente
        //$c2: codigo de la mesa 1
        //$c3: codigo de la mesa 2
        //$c4: codigo del mesero
        //$c5: formas de pago
        //$c6: puesto de la mesa 1
        //$c7: puestos de la mesa 2
        //$c8: porcentaje de a propina
        //$c9: cabecera de la factura
        //$C10: detalle de la factura 
        //$C11: numero rever asignado
        //$C12: numero de la factura asignada
        //
        //caputra de datos por get
        $get1 = $_GET['puestos'];
        $get2 = $_GET['mesa1'];
        $get3 = $_GET['full'];
        $get4 = $_GET['mesa2'];
        $get5 = $_GET['propina'];
        $get6 = $_GET['codCli'];
        

        $puestos1 = array();
        $puestos2 = array();

        // recorreo los puestos y los separo
        for($i = 0 ; $i < count($get1) ; $i++){
            //puests para la mesa 1
            if ($get1[$i] === '1' or $get1[$i] === '2' or $get1[$i] === '6') {
                //asigna el valor al array
                $puestos1[] = '0'.$get1[$i];
            //puests para la mesa 2
            }else if ($get1[$i] === '3' or $get1[$i] === '4' or $get1[$i] === '5') {
                //asigna el valor al array
                $puestos2[] = '0'.$get1[$i];
            }
        }

        if(count($puestos1) === 0){
            $puestos1[0] = 'SIN_PUESTOS';
        }

        if(count($puestos2) === 0){
            $puestos2[0] = 'SIN_PUESTOS';
        }

        //parametros del procedimiento
        $c1 = $get6;
        $c2 = $get2;
        $c3 = $get4;
        $c4 = Yii::$app->session['cedula'];
        $c4 = trim($c4);
        $c5 = "01";
        $c6 = $puestos1;
        $c7 = $puestos2;
        $c8 = $get5;       

        /*echo $c1; echo "<br>";
        echo $c2; echo "<br>";
        echo $c3; echo "<br>";
        echo $c4; echo "<br>";        
        echo $c5; echo "<br>";
        var_dump($c6); echo "<br>";
        var_dump($c7); echo "<br>";
        echo $c8; echo "<br>";*/

        //objeto para facturar
        $fn_facturar = new SpMesasFactura();      

        $datos = $fn_facturar->procedimiento12($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);
        //se envia al correo la factura
        $fn_facturar->procedimiento10($datos[3]);
        //
        $cabeceraDetalle = array($datos[0], $datos[1], $datos[2]);       
        //
        echo json_encode($cabeceraDetalle);        
    }

    public function actionVisualizarfac(){
        //$c1: codigo de la mesa
        //$c2: array con los puestos que va a visualizar
        $model1 = new funcionesArray();
        $c1 = $_GET["mesa"];
        $c2 = $model1->arrayPuestos($_GET["puestos"]);

        $model2 = new SpMesasFactura();
        $visualiza = $model2->procedimiento15($c1,$c2);
        
        //var_dump($c2)
        echo json_encode($visualiza);
    }

    public function actionConsultacliente(){
        //c1: codigo del cliente
        //
        $c1 = $_GET['codigocliente'];

        $fn_facturacion = new SpMesasFactura();
        $nombreCliente = $fn_facturacion->procedimiento8($c1);

        echo utf8_decode(utf8_encode($nombreCliente));
    }

    public function actionRegistrarcliente(){
        //$c1: codigo del cliente
        //$c2: nombre completo del clinete
        //$c3: direccion del cliente
        //$c4: correo electronico del cliente
        //$c5: telefono del cliente
        //
        $c1 = $_GET['codCli'];
        $c2 = $_GET['nomCli'];
        $c3 = $_GET['dirCli'];
        $c4 = $_GET['corCli'];
        $c5 = $_GET['telCli'];
        $c6 = $_GET['ciuCli'];

        $fn_registro = new SpMesasFactura();
        $resultado = $fn_registro->procedimiento7($c1,$c2,$c3,$c4,$c5,$c6);

        echo $resultado;
    }

    public function actionVisualizarfacx(){
        //$c1: codigo de la mesa
        //$c2: array con los puestos que va a visualizar        
        $tamano = $_GET['tamano'];
        
        if($tamano >= 5 and $tamano <= 6){
            // captura la mesa principal y la unida a ella 
            $c11 = $_GET["mesa1"];
            $c12 = $_GET["mesa2"];

            $get1 = $_GET["puestos"];

            $c21 = array();
            $c22 = array();

            // puestos de cada mesa
            for($i = 0 ; $i < count($get1) ; $i++){
                //puests para la mesa 1
                if ($get1[$i] === '1' or $get1[$i] === '2' or $get1[$i] === '6') {
                    //asigna el valor al array
                    $c21[] = '0'.$get1[$i];
                //puests para la mesa 2
                }else if ($get1[$i] === '3' or $get1[$i] === '4' or $get1[$i] === '5') {
                    //asigna el valor al array
                    $c22[] = '0'.$get1[$i];
                }
            }

            $model1 = new SpMesasPedidos();
            $producto = array();
            $unidad = array();
            $precio = array();
            $fecha = array();
            $iva = array();

            if(count($c21) != 0){
                $pedidos1 = $model1->procedimiento9($c11,$c21);
                $detalle1 = $pedidos1[0];
                $fecha1 = $pedidos1[1];

                for($i = 0 ; $i < count($detalle1['PRODUCTO']) ; $i++){
                                     
                    $producto[] = $detalle1['PRODUCTO'][$i];
                    $unidad[] = $detalle1['UNIDAD'][$i];
                    $precio[] = $detalle1['VALOR'][$i];
                    $iva[] = $detalle1['VALOR_IVA'][$i];
                }

                $fecha[] = $fecha1;

            }

            if(count($c22) != 0){
                $pedidos2 = $model1->procedimiento9($c12,$c22);
                $detalle2 = $pedidos2[0];
                $fecha2 = $pedidos2[1];

                for($i = 0 ; $i < count($detalle2['PRODUCTO']) ; $i++){
                                     
                    $producto[] = $detalle2['PRODUCTO'][$i];
                    $unidad[] = $detalle2['UNIDAD'][$i];
                    $precio[] = $detalle2['VALOR'][$i];
                    $iva[] = $detalle2['VALOR_IVA'][$i];
                }

                $fecha[] = $fecha2;
            }

            // se crea el array calve valor
            $detalle = array(
                'PRODUCTO' => $producto,
                'UNIDAD' => $unidad,
                'VALOR' => $precio, 
                'VALOR_IVA' => $iva           
            );                       

            /*$full = array($detalle, $fecha[0]);
           
            echo json_encode($full);*/
            
            $fn_array = new funcionesArray();
            $detalle = $fn_array->arrayAdjuntarDatosVisualizarFacx($detalle);

            $full = array($detalle, $fecha[0]);

            echo json_encode($full);
        }
        
    }

     public function actionEstadomesafac(){
        $c1 = $_GET["mesa"];

        $model = new SpMesasFactura();
        $estado = $model->procedimiento3($c1);

        echo $estado;
    }

    public function actionConsultarpedido(){
        // obtengo el codigo de la mesa 
        $c1 = $_GET['mesa'];
        //inicia el objeto
        $fn_pedidos = new SpMesasPedidos();
        //llamo el procedimiento del objeto
        $resultado = $fn_pedidos->procedimiento6($c1);
        //el array como json
        echo json_encode($resultado);
    }

    public function actionConsultarpedidox(){
        // obtengo el codigo de la mesa 
        $c1 = $_GET['mesa'];
        //inicia el objeto
        $fn_pedidos = new SpMesasPedidos();
        //llamo el procedimiento del objeto
        $mesasUnidad = $fn_pedidos->procedimiento10($c1);
        $tamano = count($mesasUnidad);
        //array que contiene todos los pedidos de la mesa
        $arrayUnido = array();
        //array para los datos que se muestran de los platos
        $platos = array();
        $cantidad = array();
        $puesto = array();
        $codigo = array();
        $imagen = array();
        $mesa = array();

        for ($i = 0 ; $i < count($mesasUnidad) ; $i++) {
            $pedidoMesa = $fn_pedidos->procedimiento6($mesasUnidad[$i]);                      

            //rellena el array con la informacion correspondiente retornada por el procedimiento
            for ($j = 0 ; $j < count($pedidoMesa['PLATO']) ; $j++) {
                array_push($platos  , $pedidoMesa['PLATO'][$j]);
                array_push($cantidad, $pedidoMesa['CANTIDAD'][$j]);
                array_push($puesto  , $pedidoMesa['PUESTO'][$j]);
                array_push($codigo  , $pedidoMesa['CODIGO'][$j]);
                array_push($imagen  , $pedidoMesa['IMAGEN'][$j]);
                array_push($mesa    , $mesasUnidad[$i]);                           
            }       

        }

        // se llena el array a retornar en json con sus respectivos datos en clave valor
        $arrayUnido[] = array(
                                'PLATO'    => $platos,
                                'CANTIDAD' => $cantidad,
                                'PUESTO'   => $puesto,
                                'CODIGO'   => $codigo,
                                'IMAGEN'   => $imagen,
                                'MESA'     => $mesa
                            );        

        echo json_encode($arrayUnido[0]) ;


        
        
    }

    public function actionConsultanomplato(){
        // obtengo el codigo de la mesa 
        $platosPlano = $_GET['plato'];
        //funciones para array
        $fn_array = new funcionesArray();
        //convierto la cadena en array
        $c1 = $fn_array->crearArray($platosPlano);
        //array con los nombres ya definidos
        $arrayNombres = array();    
        // array con las imagenes de los platos
        $arrayImg = array();
        //inicia el objeto
        $fn_pedidos = new SpMesasPedidos();

        foreach ($c1 as $keyA) {
            //llamo el procedimiento del objeto
            $resultado = $fn_pedidos->procedimiento7($keyA);
            
            array_push($arrayNombres,$resultado[0]);
            array_push($arrayImg,$resultado[1]);
        }
        

        echo json_encode(array($arrayNombres,$arrayImg));
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
        // si ninguna de estas vriables existe retorna a la plaza
        if(isset($_GET['puesto'], $_GET['codigoM'], $_GET['tamanoM'], $_GET['estadoM'])){
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
        }else{
            $this->layout=false;    
            return $this->redirect(['site/plaza']); 
        }
        //=============================LOGICA DE PEDIDO=======================================        
        

        
        
    }

    /* Menu new */

    public function actionMenunew()    {
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
        
        // si ninguna de estas vriables existe retorna a la plaza
        if(isset($_GET['puesto'], $_GET['codigoM'], $_GET['tamanoM'], $_GET['estadoM'])){
            //captura el puesto al que se le va a tomar el pedido
            $puesto = $_GET['puesto'];
            $codmesa = $_GET['codigoM'];
            $tamano = $_GET['tamanoM'];
            $estado = $_GET['estadoM'];


            // si se recibe platos, cantidad y puesto redirecciona con unos parametros 
            if(isset($_GET['platos'], $_GET['cantidad'], $_GET['puestos'],$_GET['avatars'])){
                // variables que se pasan como parametro
                $platos = $_GET['platos']; // los platos que se han pedido en la mesa 
                $cantidad = $_GET['cantidad']; // cantidad de platos que se han pedido  en la mesa
                $puestos = $_GET['puestos']; // numero de los puestos donde se han pedido
                $notas = $_GET['notas']; // notas de los platos
                $avatars = $_GET['avatars'];
                // redirecciona a la vista menu con los parametros del menu y de los pedidos de la mesa ya hechos 
                $this->layout=false;    
                return $this->render('menunew',["categorias" => $categorias, "comidas" => $comidas, "puesto" => $puesto,
                                             "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos,
                                             "codmesa" => $codmesa, "tamano" => $tamano, "estado" => $estado,
                                             "avatars"=>$avatars,"notas"=>$notas]);
            }else{
                $platos = 0;
                $cantidad = 0;
                $puestos = 0;
                $notas = 0;
                $avatars = $_GET['avatars'];
                // redirecciona a la vista menu con los parametros del menu 
                $this->layout=false;    
                return $this->render('menunew',["categorias" => $categorias, "comidas" => $comidas, "puesto" => $puesto,
                                             "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos,
                                             "codmesa" => $codmesa, "tamano" => $tamano, "estado" => $estado,
                                             "avatars"=>$avatars,"notas"=>$notas]);
            }
        }else{
            $this->layout=false;    
            return $this->redirect(['site/plaza']); 
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

    public function actionCocina()
    {   
       if(!isset(Yii::$app->session['cedula'])){
            return $this->redirect(['site/index']);
        }else{
            $cedula = Yii::$app->session['cedula'];
            $cedula = trim($cedula);

            $fn_login = new SpLoginAcomer();
            $rol = $fn_login->procedimiento2($cedula)[0];            

            if($rol === 'MESERO'){
                return $this->redirect(['site/plaza']);
            }
        }

        //consulta el nombre de la cocina
        //        
        $c1 = $cedula;
        $c1 = trim($c1);

        $fn_cocina = new SpCocinaPedidos();
        $nomcocina = $fn_cocina->procedimiento5($c1);

        $this->layout="main_cocina";
        return $this->render('cocina',["nomcocina"=>$nomcocina,"rol"=>$rol]);        
    }

    public function actionPedidoscocina(){
        //$c1: cedula del cocinero
        //  
        $c1 = Yii::$app->session['cedula'];
        $c1 = trim($c1);
        // se crea el objeto 
        $fn_cocina = new SpCocinaPedidos();
        // se ejecuta el procedimiento
        $result = $fn_cocina->procedimiento($c1);

        echo json_encode($result);
    }

    public function actionPedidolisto(){
        //$c1: codigo del restaurante al que pertenece el plato
        //$c2: codigo del pedido que tiene asignado el plato
        //$c3: nombre del plato
        //
        $get1 = $_GET['empresa'];
        $get2 = $_GET['pednro'];
        $get3 = $_GET['plato'];        

        $c1 = $get1;
        $c2 = $get2;
        $c3 = $get3;
        
        
        // se crea el objeto 
        $fn_cocina = new SpCocinaPedidos();
        // se ejecuta el procedimiento
        $result = $fn_cocina->procedimiento2($c1,$c2,$c3);


        //echo $c1; echo '<br>';
        //echo $c2; echo '<br>';
        //echo $c3; echo '<br>';        
    }

    public function actionConsultaavatar(){

        $c1 = $_GET['mesa'];
        //crea el objeto
        $fn_mesas = new SpMesasPedidos;
        // ejecuta el procedimiento
        $avatar = $fn_mesas->procedimeinto14($c1);

        echo json_encode($avatar);
    }

    public function actionAgregahistorial(){
        //$c1: cedula del cocinero
        //$c2: nombre del plato
        //$c3: cantidad
        //  
        $c1 = Yii::$app->session['cedula'];
        $c1 = trim($c1);
        $c2 = $_GET['plato'];                
        $c3 = $_GET['cantidad'];
        
        $fn_cocina = new SpCocinaPedidos;
        $historial = $fn_cocina->procedimiento3($c1,$c2,$c3);

        echo 1;
    }

    public function actionHistorialcocina(){
        //$c1: cedula del cocinero
        //  
        $c1 = Yii::$app->session['cedula'];
        $c1 = trim($c1);

        $fn_cocina = new SpCocinaPedidos;
        $historial = $fn_cocina->procedimiento4($c1);

        $jsonTable = '';

        for ($i=0 ; $i<count($historial['PLATO']) ; $i++) {             

            $jsonTable = $jsonTable .
                '['.                    
                    '"'.$historial['PLATO'][$i].'",'.
                    '"'.$historial['CANTIDAD'][$i].'",'.
                    '"'.$historial['FECHA'][$i].'",'.
                    '"'.$historial['HORAFIN'][$i].'"'.                  
                '],';
        }

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';
        //
        echo $jsonTable;
        
    }

    public function actionMesanew(){
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
        if(!isset($_GET['platos'], $_GET['cantidad'], $_GET['puestos'],$_GET['avatars'])){
            $platos = 0;
            $cantidad = 0;
            $puestos = 0;
            $arrpuestos = 0;
            $avatars = 0;
        }else{
            $platos = $_GET['platos'];
            $cantidad = $_GET['cantidad'];            
            $puestos = $_GET['puestos'];
            $avatars = $_GET['avatars'];
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

        // si el estado es ocupado ya hay pedido confirmado 
        // y se consulta lo que se ha pedido
        if($estadomesa === '0'){
            $confirmados = 1;
        }else{
            $confirmados = 0;
        }
        //=============================DATOS ENVIADOS POR GET=======================================
        


        
        $this->layout=false;    
        return $this->render('mesanew',["estadomesa" => $estadomesa, "codigomesa" => $codigomesa,
                                     "platos" => $platos, "cantidad" => $cantidad, "puestos" => $puestos,
                                     "tamano" => $tamano, "arrpuestos" => $arrpuestos, 
                                     "confirmados" => $confirmados,"avatars"=>$avatars]);
    }

    public function actionMostrarbotonfactura(){
        //c1: mesa que se va a consultar
        //
        $c1 = Yii::$app->request->get('mesa');
        //modelo para eecutar el procedimiento
        $fn_facturacion = new SpMesasFactura();
        $mensaje = $fn_facturacion->procedimiento9($c1);

        echo $mensaje;
    }

    public function actionAdministrador(){

        if(!isset(Yii::$app->session['cedula'])){
            return $this->redirect(['site/index']);
        }else{
            $cedula = Yii::$app->session['cedula'];
            $cedula = trim($cedula);

            $fn_login = new SpLoginAcomer();
            $resutadoRol = $fn_login->procedimiento2($cedula);
            $rol = $resutadoRol[0];
            $rolEmp = $resutadoRol[1];

            if($rol === 'COCINERO'){
                return $this->redirect(['site/cocina']);
            }else if($rol === 'MESERO'){

                $cierre = Yii::$app->request->get('cierre');        
                
                if(!$cierre){
                    return $this->redirect(['site/plaza']);   
                }                
            }
        }
        //obtiene  la fecha actual
        $fecha = getdate();
        $hoy = $fecha['mday']."/".$fecha['mon']."/".$fecha['year'];

        // ejecutar los primeros datos de las tablas
        $admin = new SpAdministracion();
        $documentos = $admin->procedimiento1($hoy);
        //imagees que hay para las categorias en el directorio
        $directorio = 'img/categorias/';
        $imgcategorias  = scandir($directorio);
        //categorias disonibles
        $fn_menus = new SpMenusPlaza();
        $categorias = $fn_menus->procedimiento()[0];

        $platos_data = $fn_menus->procedimiento()[3];     
        $platos = array();           
        $codPlatos = array();           
        for($i=0 ; $i <= count($platos_data)-1 ; $i++){
            array_push($platos, $platos_data[$i]["NOMBRE"]);
            array_push($codPlatos, $platos_data[$i]["COD_PRODUCTO"]);
        }         
        //
        $fn_menus_new = new SpCrearMenus();
        $empresas = $fn_menus_new->procedimiento7();

        //saber si se hay movimiento en una categoria
        if(!isset(Yii::$app->session['movcat'])){
            $movcat = 0;
        }else{
            $movcat = 1;
        }


        //codigos de los container
        $fn_plaza = new SpMesasPlaza();
        $codigos = $fn_plaza->procedimiento2();   
        $nitcontainer1 = $codigos[0];  
        $nitcontainer2 = $codigos[1]; 
        $nitcontainer3 = $codigos[2]; 
        $nitcontainer4 = $codigos[3]; 
        $container1 = $codigos[4];  
        $container2 = $codigos[5]; 
        $container3 = $codigos[6]; 
        $container4 = $codigos[7]; 

        //codigos de las empresas para generar los reportes 
        $fn_reporte = new AcRptVentasProd();
        $empresasReporte = $fn_reporte->sp_list_empresas();

        $this->layout=false;
        return $this->render('administrador',["documentos"=> $documentos,"categorias"=>$categorias,"imgcategorias"=>$imgcategorias,"empresas"=>$empresas,"rol"=>$rol,"movcat"=>$movcat,"platos"=>$platos,"codPlatos"=>$codPlatos, "container1"=>$container1,"container2"=>$container2,"container3"=>$container3,"container4"=>$container4,"nitcontainer1"=>$nitcontainer1,"nitcontainer2"=>$nitcontainer2,"nitcontainer3"=>$nitcontainer3,"nitcontainer4"=>$nitcontainer4,"empresasReporte"=>$empresasReporte,"rolEmp"=>$rolEmp]);
    }

    public function actionDocumentos(){
        $fecha =  Yii::$app->request->get('fechaHist');

        $admin = new SpAdministracion();
        $documentos = $admin->procedimiento1($fecha);

        $jsonTable = '';

        for ($i=0 ; $i<count($documentos['NIT']) ; $i++) { 
            $iconTable = "<i class='material-icons'  onclick='mostrarDetallesVentas(".$i.")'> &#xE417;</i>";

            $docAttr = "id='docuHist".$i."' ".
                            "attr-histnit='".$documentos['NIT'][$i]."' ".
                            "attr-histemp='".$documentos['EMPRESA'][$i]."' ".
                            "attr-histdoc='".$documentos['DOCUMENTO'][$i]."' ".
                            "attr-histfec='".$documentos['FECHA'][$i]."' ".
                            "attr-histsub='".number_format($documentos['SUBTOTAL'][$i], 2,',', '.')."' ".
                            "attr-histpro='".number_format($documentos['PROPINA'][$i], 2,',', '.')."' ".
                            "attr-histimp='".number_format($documentos['IMPUESTO'][$i], 2,',', '.')."' ".
                            "attr-histatn='".number_format($documentos['ATENCIONES'][$i], 2,',', '.')."' ".
                            "attr-histval='".number_format($documentos['VALOR'][$i], 2,',', '.')."' ";

            $jsonTable = $jsonTable .
                '['.
                    '"'.$iconTable.'",'.                                        
                    '"<span '.$docAttr.'>'.$documentos['DOCUMENTO'][$i].'</span>",'.
                    '"'.$documentos['FECHA'][$i].'",'.
                    '"'.number_format($documentos['SUBTOTAL'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['PROPINA'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['IMPUESTO'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['ATENCIONES'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['VALOR'][$i], 2,',', '.').'"'.
                '],';
        }

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';
        //
        echo $jsonTable;
    }

    public function actionDetalledocumentos(){        
        $c1 =  Yii::$app->request->get('documento');

        $admin = new SpAdministracion();
        $documentos = $admin->procedimiento2($c1);

        $jsonTable = '';

        for ($i=0 ; $i<count($documentos['PLATO']) ; $i++) {            

            $jsonTable = $jsonTable .
                '['.
                    '"'.$documentos['PLATO'][$i].'",'.
                    '"'.$documentos['CANTIDAD'][$i].'",'.
                    '"'.number_format($documentos['VALOR'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['IMPUESTO'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['TOTAL'][$i], 2,',', '.').'"'.
                '],';
        }

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';
        //
        echo $jsonTable;
    }

    public function actionDetalleatencion(){
        $c1 =  Yii::$app->request->get('documento');

        $admin = new SpAdministracion();
        $documentos = $admin->procedimiento7($c1);

        $jsonTable = '';

        for ($i=0 ; $i<count($documentos['NIT']) ; $i++) {            
        
            $jsonTable = $jsonTable .
                '['.
                    '"'.$documentos['NIT'][$i].'",'.
                    '"'.$documentos['EMPRESA'][$i].'",'.
                    '"'.number_format($documentos['VALOR'][$i], 2,',', '.').'"'.
                '],';           
        }

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';
        //
        echo $jsonTable;
    }

    public function actionDetallexempresa(){
        $c1 =  Yii::$app->request->get('documento');

        $admin = new SpAdministracion();
        $documentos = $admin->procedimiento8($c1);

        $jsonTable = '';

        for ($i=0 ; $i<count($documentos['NIT']) ; $i++) {            
        
            $jsonTable = $jsonTable .
                '['.
                    '"'.$documentos['NIT'][$i].'",'.
                    '"'.$documentos['EMPRESA'][$i].'",'.
                    '"'.number_format($documentos['SUBTOTAL'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['IMPUESTOS'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['ATENCIONES'][$i], 2,',', '.').'",'.
                    '"'.number_format($documentos['TOTAL'][$i], 2,',', '.').'"'.                    
                '],';           
        }

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';
        //
        echo $jsonTable;
    }

    public function actionDetalleempresa(){
        $c1 =  Yii::$app->request->get('fecha');

        $admin = new SpAdministracion();
        $datos = $admin->procedimient9($c1);

        /*$detalleEmp = $datos[0];
        $totales = $datos[1];
        $acumuMes = $datos[2];
        $acumuAno = $datos[3];
        $acumuSem = $datos[4];

        $jsonTable = '';

        for ($i=0 ; $i<count($detalleEmp['NIT']) ; $i++) {            
        
            $jsonTable = $jsonTable .
                '['.
                    '"'.$detalleEmp['EMPRESA'][$i].'",'.
                    '"'.number_format($detalleEmp['TOTAL'][$i], 2,',', '.').'",'.
                    '"'.$detalleEmp['PORC_DIA'][$i].'",'.
                    '"'.number_format($acumuSem['ACUM_SEMA'][$i], 2,',', '.').'",'.
                    '"'.$acumuSem['PORC_SEMA'][$i].'",'.
                    '"'.number_format($acumuMes['ACUM_MES'][$i], 2,',', '.').'",'.
                    '"'.$acumuMes['PORC_MES'][$i].'",'.
                    '"'.number_format($acumuAno['ACUM_YEAR'][$i], 2,',', '.').'",'.
                    '"'.$acumuAno['PORC_YEAR'][$i].'",'.
                    '"'.number_format($detalleEmp['SUBTOTAL'][$i], 2,',', '.').'",'.
                    '"'.number_format($detalleEmp['IMPUESTOS'][$i], 2,',', '.').'",'.
                    '"'.number_format($detalleEmp['ATENCIONES'][$i], 2,',', '.').'"'.
                '],';           
        }

        $jsonTable = $jsonTable .
            '['.
                '"TOTALES",'.
                '"'.number_format($totales['VALOR'][0], 2,',', '.').'",'.
                '"100%",'.
                '"'.number_format($detalleEmp['TOTAL_SEMA'][0], 2,',', '.').'",'.
                '"100%",'.
                '"'.number_format($detalleEmp['TOTAL_MES'][0], 2,',', '.').'",'.
                '"100%",'.
                '"'.number_format($detalleEmp['TOTAL_YEAR'][0], 2,',', '.').'",'.
                '"100%",'.
                '"'.number_format($totales['SUBTOTAL'][0], 2,',', '.').'",'.
                '"'.number_format($totales['IMPUESTO'][0], 2,',', '.').'",'.
                '"'.number_format($totales['ATENCIONES'][0], 2,',', '.').'"'.
            '],'; 

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';*/

        //
        //echo $jsonTable;
        
        echo json_encode($datos);
    }

    public function actionGananciasemp(){
        $c1 =  Yii::$app->request->get('fecha');

        $admin = new SpAdministracion();
        $datos = $admin->procedimiento12($c1);

        echo json_encode($datos);

    }

    public function actionRealizacierre(){
        $c1 =  Yii::$app->request->get('fechaIni');
        $c2 =  Yii::$app->request->get('horaIni');
        $c3 =  Yii::$app->request->get('fechaFin');
        $c4 =  Yii::$app->request->get('horaFin');

        $admin = new SpAdministracion();
        $platos = $admin->procedimiento4($c1,$c2,$c3,$c4);
        //$platos = array("0","0");

        echo json_encode($platos);
    }


    public function actionCierres(){        

        $admin = new SpAdministracion();
        $cierre = $admin->procedimiento5();

        $jsonTable = '';

        for ($i=0 ; $i<count($cierre['GEN_CIE_ID']) ; $i++) { 
            $iconTable = "<i class='material-icons'  onclick='mostrarDetalleCierre(".$i.")'> &#xE417;</i>";

            $cierreId = "id='cierreId".$i."'";

            $jsonTable = $jsonTable .
                '['.
                    '"'.$iconTable.'",'.
                    '"<span '.$cierreId.'>'.$cierre['GEN_CIE_ID'][$i].'",'.
                    '"'.$cierre['GEN_CIE_FECHINI'][$i].'",'.
                    '"'.$cierre['GEN_CIE_HORAINI'][$i].'",'.
                    '"'.$cierre['GEN_CIE_FECHFIN'][$i].'",'.
                    '"'.$cierre['GEN_CIE_HORAFIN'][$i].'",'.
                    '"'.$cierre['GEN_CIE_TIPPROC'][$i].'"'.
                '],';
        }

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';
        //
        echo $jsonTable;        
    }

    public function actionDetallecierres(){        
        $c1 = Yii::$app->request->get('codigo');
        $opcion = Yii::$app->request->get('opcion');
        // 1: datos para la tabla detalle
        // 2: datos para la cabecer

        $admin = new SpAdministracion();
        $cierre = $admin->procedimiento6($c1);

        switch($opcion){
            case 1:
                $datosCab = array($cierre[1],$cierre[2],$cierre[3],$cierre[4],$cierre[5]);
                echo json_encode($datosCab);    
                break;
            case 2:
                $datosDetalle = $cierre[0];
                $jsonTable = '';

                for ($i=0 ; $i<count($datosDetalle['NIT']) ; $i++) {                     

                    $jsonTable = $jsonTable .
                        '['.                            
                            '"'.$datosDetalle['NIT'][$i].'",'.
                            '"'.$datosDetalle['NOMBRE'][$i].'",'.
                            '"'.$datosDetalle['VEN_FAC_PROCOD'][$i].'",'.
                            '"'.$datosDetalle['VEN_REF_PRODES'][$i].'",'.
                            '"'.$datosDetalle['CANT'][$i].'",'.
                            '"'.number_format($datosDetalle['TOTAL'][$i], 2).'"'.
                        '],';
                }

                $jsonTable = substr($jsonTable,0,-1);
                $jsonTable = '{"data":['.$jsonTable.']}';
                //
                echo $jsonTable;        
                break;
            
        }
    }

    public function actionAdminmenus(){
        $opcion = Yii::$app->request->get('opcion');
        // 1: categorias
        // 2: platos
        // 
        $fn_menus = new SpMenusPlaza;
        $datosMenus = $fn_menus->procedimiento();   

        switch ($opcion) {
            case 1:
                $datosCategoria = $datosMenus[0];
                $jsonTable = '';

                for ($i=0 ; $i<count($datosCategoria) ; $i++) {       
                    $iconEdit = "<i class='material-icons editIcon btn-link'  onclick='editarCategoria(".$i.")'> edit</i>";              
                    $iconDelete = "<i class='material-icons deleteIcon btn-link'  onclick='eliminarCategoria(".$i.")'> delete</i>";
                    $imagenCateg = "<img id='imgCat".$i."' src='img/categorias/".$datosCategoria[$i]['IMAGEN']."' >";

                    $categoriaId = "id='categoriaId".$i."'";
                    $nombreCatId = "id='nombreCatId".$i."'";

                    $jsonTable = $jsonTable .
                        '['.
                            '"<span '.$categoriaId.'>'.$datosCategoria[$i]['COD_CATEGORIA'].'</span>",'.                            
                            '"<span '.$nombreCatId.'>'.$datosCategoria[$i]['DESCRIPCION'].'</span>",'.
                            '"'.$imagenCateg.'",'.
                            '"'.$iconEdit.'",'.
                            '"'.$iconDelete.'"'.
                        '],';
                }

                $jsonTable = substr($jsonTable,0,-1);
                $jsonTable = '{"data":['.$jsonTable.']}';
                //
                echo $jsonTable; 
                break;
            
            case 2:
                $datosPlatos = $datosMenus[3];                
                $jsonTable = '';

                for ($i=0 ; $i<count($datosPlatos) ; $i++) {       
                    $iconEdit = "<i class='material-icons editIcon btn-link'  onclick='editarPlato(".$i.")'> edit</i>";              
                    $iconDelete = "<i class='material-icons deleteIcon btn-link'  onclick='eliminarPlato(".$i.")'> delete</i>";
                    //$imagenPlato = "<img id='imgCat".$i."' src='img/categorias/".$datosPlatos[$i]['IMAGEN']."' >";

                    $dataPlAttr = "id='platoId".$i."' ".
                                    "attr-platoId='".$datosPlatos[$i]['COD_PRODUCTO']."' ".
                                    "attr-platonombre='".$datosPlatos[$i]['NOMBRE']."' ".
                                    "attr-platoprebru='".number_format($datosPlatos[$i]['PRECIO'], 2)."' ".
                                    "attr-platoprenet='".number_format($datosPlatos[$i]['PRECIO_FULL'], 2)."' ".
                                    "attr-platocodcat='".$datosPlatos[$i]['CATEGORIA']."' ".
                                    "attr-platonomcat='".$datosPlatos[$i]['NOM_CATEGORIA']."' ".
                                    "attr-platotiempo='".$datosPlatos[$i]['TIEMPO']."' ".
                                    "attr-platocodemp='".$datosPlatos[$i]['COD_EMPRESA']."' ".
                                    "attr-platonomemp='".$datosPlatos[$i]['EMPRESA']."' ".
                                    "attr-platodescri='".$datosPlatos[$i]['DESCRIPCION']."' ";

                    $jsonTable = $jsonTable .
                        '['.                        
                            '"<span '.$dataPlAttr.'>'.$datosPlatos[$i]['NOMBRE'].'</span>",'.                            
                            '"'.number_format($datosPlatos[$i]['PRECIO'], 2).'",'.
                            '"'.number_format($datosPlatos[$i]['PRECIO_FULL'], 2).'",'.                                                        
                            '"'.$datosPlatos[$i]['NOM_CATEGORIA'].'",'.
                            '"'.$datosPlatos[$i]['TIEMPO'].'",'.                            
                            '"'.$datosPlatos[$i]['EMPRESA'].'",'.
                            '"'.$datosPlatos[$i]['DESCRIPCION'].'",'.
                            '"'.$iconEdit.'",'.
                            '"'.$iconDelete.'"'.
                        '],';
                }

                $jsonTable = substr($jsonTable,0,-1);
                $jsonTable = '{"data":['.$jsonTable.']}';
                //
                echo $jsonTable; 
                break;
        }
    }

    public function actionFuncionescategorias(){
        //accion a realizar
        $opcion = Yii::$app->request->get('opcion');

        // funcion con los proceidmientos
        $fn_categoria = new SpCrearMenus();

        switch ($opcion) {
            case 'NEW':
                //c1: nombre de la categoria que se crea
                //c2: codigo de la empresa a la que le crea la categoria 
                //c3: imagen categoria
                //
                //datos para crear la categoria
                $c1 = array(Yii::$app->request->get('nombre'));
                $c2 = array(Yii::$app->request->get('empresa'));
                $c3 = array(Yii::$app->request->get('imagen'));
                //ejecuta el procedimiento para almacenar 
                $fn_categoria->procedimiento1($c1,$c2,$c3);
                echo 'ok';                
                break;
            
            case 'EDIT':
                //c1: codigo de la categoria
                //c2: nombre de la categoria 
                //c3: imagen de la categoria 
                //
                //datos para crear la categoria
                $c1 = Yii::$app->request->get('codigo');
                $c2 = Yii::$app->request->get('nombre');
                $c3 = Yii::$app->request->get('imagen');
                //ejecuta el procedimiento para almacenar 
                $fn_categoria->procedimiento3($c1,$c2,$c3);
                echo 'ok';                
                break;
            case 'DELET':
                //c1: codigo de la categoria
                //c2: codigo de la empresa
                //
                //datos para crear la categoria
                $c1 = Yii::$app->request->get('categoria');
                $c2 = Yii::$app->request->get('empresa');
                //ejecuta el procedimiento para almacenar 
                $fn_categoria->procedimiento6($c1,$c2);
                echo "ok";
                break;
        }       

    }

    public function actionFuncionesplatos(){             
        //accion a realizar
        $opcion = Yii::$app->request->get('opcion');

        // funcion con los proceidmientos
        $fn_plato = new SpCrearMenus();

        switch ($opcion) {
            case 'NEW':
                //datos del plato a crear o editar
                $c1 = array(Yii::$app->request->get('empresa'));
                $c2 = array(Yii::$app->request->get('nombre'));
                $c3 = array(Yii::$app->request->get('categoria'));                
                $c4 = array(Yii::$app->request->get('desc'));
                $c5 = array(Yii::$app->request->get('precio'));
                $c6 = array("");
                $c7 = Yii::$app->request->get('tiempo');
                $unidadt = Yii::$app->request->get('unidadT');
                

                //tiempo en minutos
                switch($unidadt){
                    case "seg":
                        $c7 = array((string)ceil($c7 / 60));
                        break;
                    case "min":
                        $c7 = array((string)$c7);
                        break;
                    case "hor":
                        $c7 = array((string)ceil(($c7 / 60) / 60));
                        break;
                }

                $fn_plato->procedimiento2($c1,$c2,$c3,$c4,$c5,$c6,$c7);
                echo 'ok';                
                break;
            
            case 'EDIT':
             //datos del plato a crear o editar
                $c1 = Yii::$app->request->get('codigo');
                $c2 = Yii::$app->request->get('nombre');
                $c3 = Yii::$app->request->get('precio');               
                $c4 = "";
                $c5 = Yii::$app->request->get('categoria');
                $c6 = Yii::$app->request->get('descripcion');
                $c7 = Yii::$app->request->get('tiempo');
                $unidadt = Yii::$app->request->get('unidadT');
                $c8 = Yii::$app->request->get('empresa');       

                //tiempo en minutos
                switch($unidadt){
                    case "seg":
                        $c7 = (string)ceil($c7 / 60);
                        break;
                    case "min":
                        $c7 = (string)$c7;
                        break;
                    case "hor":
                        $c7 = (string)ceil(($c7 / 60) / 60);
                        break;
                }         

                $fn_plato->procedimiento4($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8);
                echo 'ok';  
                break;
            case 'DELET':
                //c1: codigo de la categoria
                //c2: codigo de la empresa
                //
                //datos para crear la categoria
                $c1 = Yii::$app->request->get('plato');
                $c2 = Yii::$app->request->get('empresa');
                //ejecuta el procedimiento para almacenar 
                $fn_plato->procedimiento5($c1,$c2);
                echo "ok";
                break;
        }       
    }

    public function actionImprimirfactura(){

        $this->layout=false;

        $c1 = Yii::$app->request->get('codigoFactura');

        $fn_factura = new SpMesasFactura();
        $datos = $fn_factura->procedimiento16($c1);
        $datos = json_encode($datos);

        $url = "http://192.168.194.127:8094/imp/example/interface/imp_Factura.php?params=".$datos;        

        /*echo $url;
        echo "<br><br>";*/
        //
        //echo @file_get_contents($url);         
        header('Location: '.$url);
        exit;

    }

    public function actionFacturaretrasada(){
        $c1 = Yii::$app->request->get('fecha');
        $c2 = Yii::$app->request->get('hora');
        $c3 = Yii::$app->request->get('puestos');
        $c4 = Yii::$app->request->get('productos');
        $c5 = Yii::$app->request->get('cantidad');
        $c6 = Yii::$app->request->get('termino');
        $c7 = Yii::$app->request->get('mesero');
        $c8 = Yii::$app->request->get('mesa');
        $c9 = Yii::$app->request->get('cliente');
        $c10 = Yii::$app->request->get('formapago');
        $c11 = Yii::$app->request->get('numautorizacion');
        $c12 = Yii::$app->request->get('valoratencion');
        $c13 = Yii::$app->request->get('empresaatencion');
        $c14 = Yii::$app->request->get('propina');

        $fn_factura = new SpAdministracion();
        $numFac = $fn_factura->procedimiento10($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14);

        echo $numFac;

    }

    public function actionCarganotaspedido(){
        $c1 = Yii::$app->request->get('categoria');
        $c2 = Yii::$app->request->get('plato');

        $models = new SpMenusPlaza();
        $data = $models->procedimiento2($c1,$c2);

        echo json_encode($data);
    }

    public function actionNotasadmin(){
        $fn_notas = new SpAdministracion;

        $datosNotas = $fn_notas->procedimiento11('READ',0,'','');           
        $jsonTable = '';

        for ($i=0 ; $i<count($datosNotas['NOTA_DESCRIPCION']) ; $i++) {                   
            $iconEdit = "<i class='material-icons editIcon btn-link'  onclick='editarNota(".$i.")'> edit</i>";              
            $iconDelete = "<i class='material-icons deleteIcon btn-link'  onclick='eliminarNota(".$i.")'> delete</i>";            

            $notasAttr = "id='notaRow".$i."' attr-notaid='".$datosNotas['NOTA_ID'][$i]."' attr-pltcatid='".$datosNotas['ID_PLT_CAT'][$i]."' attr-nompltcat='".$datosNotas['CATE_PLA'][$i]."' attr-notadesc='".$datosNotas['NOTA_DESCRIPCION'][$i]."'";

            $jsonTable = $jsonTable .
                '['.
                    '"<span '.$notasAttr.'>'.$datosNotas['NOTA_DESCRIPCION'][$i].'</span>",'.
                    '"'.$datosNotas['CATE_PLA'][$i].'",'.
                    '"'.$iconEdit.'",'.
                    '"'.$iconDelete.'"'.
                '],';
        }

        $jsonTable = substr($jsonTable,0,-1);
        $jsonTable = '{"data":['.$jsonTable.']}';
        //
        echo $jsonTable; 
    }

    public function actionOpcionesnotasadmin(){

        $c1 = Yii::$app->request->get('opcion');        

        $fn_notas = new SpAdministracion;

        switch ($c1) {
            case 'NEW':
                $c2 = Yii::$app->request->get('codigopltcat');
                $c3 = Yii::$app->request->get('nota');

                $crearNota = $fn_notas->procedimiento11('NEW',0,$c3,$c2);           
                echo "ok";
                break;
            case 'EDIT':
                $c2 = Yii::$app->request->get('codigopltcat');
                $c3 = Yii::$app->request->get('nota');
                $c4 = Yii::$app->request->get('codigoNota');

                $crearNota = $fn_notas->procedimiento11('EDIT',$c4,$c3,$c2);           
                echo "ok";                
                break;
            case 'DELETE':
                $c2 = Yii::$app->request->get('codigoNota');

                $crearNota = $fn_notas->procedimiento11('DELETE',$c2,"","");           
                echo "ok";
                break;
        }        
    }

    public function actionActualizarformapago(){
        $c1 = Yii::$app->request->get('numfac');
        $c2 = Yii::$app->request->get('numauth');
        $c3 = Yii::$app->request->get('valortar');
        $c4 = Yii::$app->request->get('efectivo');

        $fn_faturar = new SpMesasFactura;
        $devuelta = $fn_faturar->procedimiento17($c1,$c2,$c3,$c4);


        echo number_format($devuelta, 2,',', '.');
    }

    public function actionRptvenprod()
    {
        $empr = $_GET["empresa"];
        $fecini = $_GET["fechaini"];
        $fecfin = $_GET["fechafin"];        
        
        //Declaro la clase para el procedimeinto que trae los datos para imprimir la factura
        $model = new AcRptVentasProd;
        $datosVenprod = $model->sp_ac_RptVentaprod($empr, $fecini, $fecfin);
        
        //Obtengo el array donde estan todas las empresas almacenadas
        $datos_rptvenprod = $datosVenprod[0];
            
        $this->layout=false; 
        return $this->render('rptvenprod',["datos_rptvenprod"=>$datos_rptvenprod,"codi_empre"=>$empr,"fech_ini"=>$fecini,"fech_fin"=>$fecfin]);
    }

    public function actionReservasmesas(){
        //$c1: operacion a reaizar
        //$c2: codigo de reserva
        //$c3: codigo de mesa
        //$c4: nuero de puesto
        //$c5: nombre ciente
        //$c6: fecha de reserba
        //$c7: hora de reserva
        //$c8: cursor
        
        $opcion = Yii::$app->request->get('opcion');        

        switch ($opcion) {
            case 'READ':                           

                $c1 = 'READ';
                $c2 = '';
                $c3 = array('');
                $c4 = array('');
                $c5 = '';
                $c6 = Yii::$app->request->get('fecha');
                $c7 = '';

                $fn_reservas = new SpAdministracion;
                $data = $fn_reservas->procedimiento13($c1,$c2,$c3,$c4,$c5,$c6,$c7);

                $jsonTable = '';

                for ($i=0 ; $i<count($data['VEN_RESV_COD']) ; $i++) {     

                    if(strcmp($data['VEN_RESV_COD'][$i], "N/A") === 0){
                        $iconTable = "<i class='material-icons'> &#xE417;</i>";
                        $iconEdit = "<i class='material-icons editIcon btn-link' > edit</i>";              
                        $iconDelete = "<i class='material-icons deleteIcon btn-link'> delete</i>"; 

                        $darRsvrAttr = "id='reserva".$i."' ".
                                    "attr-rsvrcod='".$data['VEN_RESV_COD'][$i]."' ".
                                    "attr-rsvrmesa='".$data['VEN_RESV_MESCOD'][$i]."' ".
                                    "attr-rsvrpuestos='".$data['VEN_RESV_NUMPOS'][$i]."' ".
                                    "attr-rsvrfecha='".$data['VEN_RESV_FECHA'][$i]."' ".
                                    "attr-rsvrhora='".$data['VEN_RESV_HORA'][$i]."' ".
                                    "attr-rsvrcliente='".$data['VEN_RESV_NOMBRE'][$i]."'";

                        $jsonTable = $jsonTable .
                            '['.      
                                '"'.$iconTable.'",'.
                                '"<span '.$darRsvrAttr.'>'.$data['VEN_RESV_COD'][$i].'</span>",'.
                                '"'.$data['VEN_RESV_MESCOD'][$i].'",'.                                                        
                                '"'.$data['VEN_RESV_FECHA'][$i].'",'.
                                '"'.$data['VEN_RESV_HORA'][$i].'",'.
                                '"'.$data['VEN_RESV_NOMBRE'][$i].'",'.                            
                                '"'.$iconEdit.'",'.
                                '"'.$iconDelete.'"'.
                            '],';
                    }else{
                        $iconTable = "<i class='material-icons'  onclick='mostrarReserva(".$i.")'> &#xE417;</i>";
                        $iconEdit = "<i class='material-icons editIcon btn-link'  onclick='editarReserva(".$i.")'> edit</i>";              
                        $iconDelete = "<i class='material-icons deleteIcon btn-link'  onclick='deleteReserva(".$i.")'> delete</i>"; 

                        $darRsvrAttr = "id='reserva".$i."' ".
                                    "attr-rsvrcod='".$data['VEN_RESV_COD'][$i]."' ".
                                    "attr-rsvrmesa='".$data['VEN_RESV_MESCOD'][$i]."' ".
                                    "attr-rsvrpuestos='".$data['VEN_RESV_NUMPOS'][$i]."' ".
                                    "attr-rsvrfecha='".$data['VEN_RESV_FECHA'][$i]."' ".
                                    "attr-rsvrhora='".$data['VEN_RESV_HORA'][$i]."' ".
                                    "attr-rsvrcliente='".$data['VEN_RESV_NOMBRE'][$i]."'";

                        $jsonTable = $jsonTable .
                            '['.      
                                '"'.$iconTable.'",'.
                                '"<span '.$darRsvrAttr.'>'.$data['VEN_RESV_COD'][$i].'</span>",'.
                                '"'.$data['VEN_RESV_MESCOD'][$i].'",'.                                                        
                                '"'.$data['VEN_RESV_FECHA'][$i].'",'.
                                '"'.$data['VEN_RESV_HORA'][$i].'",'.
                                '"'.$data['VEN_RESV_NOMBRE'][$i].'",'.                            
                                '"'.$iconEdit.'",'.
                                '"'.$iconDelete.'"'.
                            '],';
                    }   
                }

                $jsonTable = substr($jsonTable,0,-1);
                $jsonTable = '{"data":['.$jsonTable.']}';  

                echo $jsonTable;              
                break;

            case 'SAVE':
                $c1 = 'SAVE';
                $c2 = '';
                $c3 = array(Yii::$app->request->get('mesa'));
                $c4 = array(Yii::$app->request->get('puesto'));
                $c5 = Yii::$app->request->get('cliente');
                $c6 = Yii::$app->request->get('fecha');
                $c7 = Yii::$app->request->get('hora').":00";             

                $fn_reservas = new SpAdministracion;
                $data = $fn_reservas->procedimiento13($c1,$c2,$c3,$c4,$c5,$c6,$c7);

                echo json_encode($data);
                break;

            case 'EDIT':
                $c1 = 'UPDATE';
                $c2 = Yii::$app->request->get('codigo');;
                $c3 = array(Yii::$app->request->get('mesa'));
                $c4 = array(Yii::$app->request->get('puesto'));
                $c5 = Yii::$app->request->get('cliente');
                $c6 = Yii::$app->request->get('fecha');
                $c7 = Yii::$app->request->get('hora').":00";             

                $fn_reservas = new SpAdministracion;
                $data = $fn_reservas->procedimiento13($c1,$c2,$c3,$c4,$c5,$c6,$c7);

                echo json_encode($data);
                break;

             case 'DELETE':
                $c1 = 'DELETE';
                $c2 = Yii::$app->request->get('codigo');
                $c3 = array("");
                $c4 = array("");
                $c5 = "";
                $c6 = "";
                $c7 = "";

                $fn_reservas = new SpAdministracion;
                $data = $fn_reservas->procedimiento13($c1,$c2,$c3,$c4,$c5,$c6,$c7);

                echo json_encode($data);
                break;

            case 'VALIDAR':
                $c1 = Yii::$app->request->get('reserva');

                $fn_reservas = new SpMesasPlaza;
                $data = $fn_reservas->procedimiento4($c1);
                break;
        }                
    }


}