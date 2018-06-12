<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpAdministracion extends Model{		

		public function procedimiento1($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DOCUMENTOS_FAC(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return $cursor;
		}

		public function procedimiento2($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DETALLE_DOCUMENTO(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);			
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return $cursor;
		}		

		public function procedimiento3($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN VENTAS_DIARIAS(:c1,:c2,:c3,:c4); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c3", $c3, 10);			
			oci_bind_by_name($stid, ":c4", $c4, 10);

			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return array($cursor,$c3,$c4);
		}	

		public function procedimiento4(){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN VENTAS_CIERRE; END;");			
			//se ejecuta el procidimiento 
			oci_execute($stid);			
		}	

		public function procedimiento5(){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN VENTAS_CIERRE_GENERAL(:c1); END;");
			//inicializa el cursor pasa como parametro
			$c1 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ':c1', $c1,-1, OCI_B_CURSOR);			
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c1,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c1, $cursor);
			//retona el array de datos
			return $cursor;
		}	

		public function procedimiento6($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN VENTAS_CIERRE_DETALLE(:c1,:c2,:c3,:c4,:c5,:c6); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 	
			oci_bind_by_name($stid, ":c1", $c1, 10);			
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);			
			oci_bind_by_name($stid, ":c3", $c3, 10);
			oci_bind_by_name($stid, ":c4", $c4, 10);
			oci_bind_by_name($stid, ":c5", $c5, 10);
			oci_bind_by_name($stid, ":c6", $c6, 10);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return array($cursor,$c3,$c4,$c5,$c6);
		}

		public function procedimiento7($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DETALLE_ATENCIONES(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);			
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return $cursor;
		}			

		public function procedimiento8($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DET_EMPRESA_FACDOC(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 13);			
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return $cursor;
		}			

		public function procedimient9($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CUENTA_ADMIN(:c1,:c2,:c3); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			$c3 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);			
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c3', $c3,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			oci_execute($c3,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor1);
			oci_fetch_all($c3, $cursor2);
			//retona el array de datos
			return array($cursor1,$cursor2);
		}
	} 
