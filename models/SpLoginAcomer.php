<?php

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;


	Class SpLoginAcomer extends Model{		

		public function procedimiento(){
			//============================================
			//OPERACION - DESCRIPCION
			//	L       - consulta
			//	C       - insercion
			//	U       - actualizacion cuando se olvida la contraseña 
			//	T       - validacion de token
			//	F       - crear contraseña por primera vez
			//============================================
			
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');		

			//Usuairo ingresado y capturado por get
			$user =  Yii::$app->request->get('usuario');
			//Contraseña ingresada y capturada por get
			$clave = Yii::$app->request->get('clave');
			//Operacion que se va a realizar dentro del procedimiento almacenado
			$operacion = Yii::$app->request->get('operacion');
			//La clave de activacion dada
			$key_act = Yii::$app->request->get('tokenreset');

			//PARAMETROS DE ENTRADA Y DE SALIDA QUE LLEVA EL PROCEDIMIETNO
			//usuario que esta haciendo login 
			$V_IN_USER_ID= $user;
			//contraseña con la que ingresa
			$V_IN_USER_PASS= $clave;
			//operacion a realizar en el procedimiento
			$V_IN_OPER= $operacion;
			//clave de activacion de cuanta dada
			$V_IN_ACT_PASS= $key_act;
			//cedula del usuario
			$V_OUT_USER_ID= '';			
			//mensaje devuelto por el procedimiento 
			$V_OUT_MESS= '';
			//codigo del mensaje devuelto por el procedimiento 
			$V_OUT_COD_MESS= '';

			//se hace el llamado del procediemiento almacenado en la base de datos con sus respectivos parametros de entrada y salida			
			$stid = oci_parse($conexion,"BEGIN SP_LOGIN_ACOMER (:V_IN_USER_ID,:V_IN_USER_PASS,:V_IN_OPER,:V_IN_ACT_PASS,:V_OUT_USER_ID,:V_OUT_MESS,:V_OUT_COD_MESS); END;");

			//establece el valor de los parametros
			oci_bind_by_name($stid, ":V_IN_USER_ID"  , $V_IN_USER_ID  , 11);
			oci_bind_by_name($stid, ":V_IN_USER_PASS", $V_IN_USER_PASS, 200);
			oci_bind_by_name($stid, ":V_IN_OPER"	 , $V_IN_OPER	  , 200);
			oci_bind_by_name($stid, ":V_IN_ACT_PASS" , $V_IN_ACT_PASS , 200);
			oci_bind_by_name($stid, ":V_OUT_USER_ID" , $V_OUT_USER_ID , 11);
			oci_bind_by_name($stid, ":V_OUT_MESS"	 , $V_OUT_MESS    , 200);
			oci_bind_by_name($stid, ":V_OUT_COD_MESS", $V_OUT_COD_MESS, 10);

			//se ejecuta el procidimiento 
			oci_execute($stid);
			
			//retorna los valores devueltos por el procedimiento (identificacion del usuario, codigo de mensaje y el mensaje)
			return $SpLoginAcomer = array($V_OUT_USER_ID,$V_OUT_COD_MESS,$V_OUT_MESS);
		}

		public function procedimiento2($c1){
			//$c1: cedula de quien inicia sesion
			//$c2: rol que tiene 
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			
			$c2 = '';
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CONSULTA_ROL(:c1,:c2); END;");

			oci_bind_by_name($stid, ":c1", $c1, 11);
			oci_bind_by_name($stid, ":c2", $c2, 200);			

			//Se ejecuta el procedimiento 
			oci_execute($stid);

			return $c2;
		}
	}