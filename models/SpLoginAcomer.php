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

			//Usuairo ingresado y capturado por get
			$usuario =  Yii::$app->request->get('usuario');
			//Contraseña ingresada y capturada por get
			$clave = Yii::$app->request->get('clave');
			//Operacion que se va a realizar dentro del procedimiento almacenado
			$operacion = Yii::$app->request->get('operacion');
			//La clave de activacion dada
			$key_act = Yii::$app->request->get('tokenreset');

			//PARAMETROS DE ENTRADA Y DE SALIDA QUE LLEVA EL PROCEDIMIETNO
			//usuario que esta haciendo login 
			$V_IN_USER_ID= $usuario;
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
			$rows = Yii::$app->usrawa->createCommand("BEGIN SP_LOGIN_ACOMER (:V_IN_USER_ID,:V_IN_USER_PASS,:V_IN_OPER,:V_IN_ACT_PASS,:V_OUT_USER_ID,:V_OUT_MESS,:V_OUT_COD_MESS); END;");

			//establece el valor de los parametros
			$rows->bindParam(":V_IN_USER_ID"  , $V_IN_USER_ID  , PDO::PARAM_STR);
			$rows->bindParam(":V_IN_USER_PASS", $V_IN_USER_PASS, PDO::PARAM_STR);
			$rows->bindParam(":V_IN_OPER"	  , $V_IN_OPER	   , PDO::PARAM_STR);
			$rows->bindParam(":V_IN_ACT_PASS" , $V_IN_ACT_PASS , PDO::PARAM_STR);
			$rows->bindParam(":V_OUT_USER_ID" , $V_OUT_USER_ID , PDO::PARAM_INT,200);			
			$rows->bindParam(":V_OUT_MESS"	  , $V_OUT_MESS    , PDO::PARAM_STR,200);
			$rows->bindParam(":V_OUT_COD_MESS", $V_OUT_COD_MESS, PDO::PARAM_INT,200);

			//Se ejecuta el procedimiento 
			$rows->execute();
			
			//retorna los valores devueltos por el procedimiento (identificacion del usuario, codigo de mensaje y el mensaje)
			return $SpLoginAcomer = array($V_OUT_USER_ID,$V_OUT_COD_MESS,$V_OUT_MESS);
		}

		public function procedimiento2($c1){
			//$c1: cedula de quien inicia sesion
			//$c2: rol que tiene 
			
			$c2 = '';
			//			
			$rows = Yii::$app->usrawa->createCommand("BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CONSULTA_ROL(:c1,:c2); END;");

			$rows->bindParam(":c1", $c1, PDO::PARAM_STR);
			$rows->bindParam(":c2", $c2, PDO::PARAM_STR,200);

			//Se ejecuta el procedimiento 
			$rows->execute();

			return $c2;
		}
	}