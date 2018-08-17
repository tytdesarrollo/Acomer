<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpCrearMenus extends Model{

		public function procedimiento1($c1,$c2,$c3){
			//c1: nombre de la categoria que se crea
			//c2: codigo de la empresa a la que le crea la categoria 
			//c3: imagen categoria
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');		
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CREAR_CATEGORIA_MENU(:c1,:c2,:c3); END;");
			//parametros del procedimiento
			oci_bind_array_by_name($stid, ":c1", $c1, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
		    //ejecuta el procedimiento 
		    oci_execute($stid);
		}

		public function procedimiento2($c1,$c2,$c3,$c4,$c5,$c6){
			//c1: codigo de la empresa a la que pertenece el plato
			//c2: nombre del plato
			//c3: codigo de la categoria 
			//c4: descripcion del plato
			//c5: precio del plato
			//c6: imagen de plato
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');		
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CREAR_PLATO_MENU(:c1,:c2,:c3,:c4,:c5,:c6); END;");
			//parametros del procedimiento
			oci_bind_array_by_name($stid, ":c1", $c1, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c4", $c4, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c5", $c5, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c6", $c6, 100, -1, SQLT_CHR);
			//ejecuta el procedimiento 
		    oci_execute($stid);
		}	

		public function procedimiento3($c1,$c2,$c3){
			//c1: codigo de la categoria
			//c2: nombre de la categoria 
			//c3: imagen de la categoria 
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');		
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_EDIT_CATEGORIA_MENU(:c1,:c2,:c3); END;");
			//parametros del procedimiento
			oci_bind_by_name($stid, ":c1", $c1, 8);
			oci_bind_by_name($stid, ":c2", $c2, 75);
			oci_bind_by_name($stid, ":c3", $c3, 50);
			//ejecuta el procedimiento 
		    oci_execute($stid);	
		}

		public function procedimiento4($c1,$c2,$c3,$c4,$c5,$c6){
			//c1: codigo del plato
			//c2: nombre del plato
			//c3: precio del plato 
			//c4: imagen del plato 
			//c5: codigo de la categoria 
			//c6: codigo de la empresa
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');		
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_EDIT_PLATO_MENU(:c1,:c2,:c3,:c4,:c5,:c6); END;");
			//parametros del procedimiento
			oci_bind_by_name($stid, ":c1", $c1, 20);
			oci_bind_by_name($stid, ":c2", $c2, 200);
			oci_bind_by_name($stid, ":c3", $c3, 10);
			oci_bind_by_name($stid, ":c4", $c3, 255);
			oci_bind_by_name($stid, ":c5", $c3, 8);
			oci_bind_by_name($stid, ":c6", $c3, 13);
			//ejecuta el procedimiento 
		    oci_execute($stid);	
		}

		public function procedimiento5($c1,$c2){
			//c1: codigo del plato
			//c2 codigo de la empresa
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');		
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DELET_PLATO_MENU(:c1,:c2); END;");
			//parametros del procedimiento
			oci_bind_by_name($stid, ":c1", $c1, 20);
			oci_bind_by_name($stid, ":c2", $c2, 13);
			//ejecuta el procedimiento 
		    oci_execute($stid);	
		}

		public function procedimiento6(){
			//c1: codigo de la categoria
			//c2: codigo de la empresa
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');		
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DELET_CATEGORIA_MENU(:c1,:c2); END;");
			//parametros del procedimiento
			oci_bind_by_name($stid, ":c1", $c1, 8);
			oci_bind_by_name($stid, ":c2", $c2, 13);
			//ejecuta el procedimiento 
		    oci_execute($stid);	
		}
	}	
