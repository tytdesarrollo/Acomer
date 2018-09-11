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

		public function procedimiento4($c1,$c2,$c3,$c4){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN VENTAS_CIERRE(:c1,:c2,:c3,:c4,:c5,:c6); END;");	
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);		
			oci_bind_by_name($stid, ":c2", $c2, 8);
			oci_bind_by_name($stid, ":c3", $c3, 10);
			oci_bind_by_name($stid, ":c4", $c4, 8);
			oci_bind_by_name($stid, ":c5", $c5, 10);
			oci_bind_by_name($stid, ":c6", $c6, 10);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			//retona el array de datos
			return array($c5,$c6);
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
			$stid = oci_parse($conexion,"BEGIN VENTAS_CIERRE_DETALLE(:c1,:c2,:c3,:c4,:c5,:c6,:c7); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 	
			oci_bind_by_name($stid, ":c1", $c1, 10);			
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);			
			oci_bind_by_name($stid, ":c3", $c3, 10);
			oci_bind_by_name($stid, ":c4", $c4, 10);
			oci_bind_by_name($stid, ":c5", $c5, 10);
			oci_bind_by_name($stid, ":c6", $c6, 10);
			oci_bind_by_name($stid, ":c7", $c7, 10);			
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return array($cursor,$c3,$c4,$c5,$c6,$c7);
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
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CUENTA_ADMIN(:c1,:c2,:c3,:c4,:c5,:c6); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			$c3 = oci_new_cursor($conexion);
			$c4 = oci_new_cursor($conexion);
			$c5 = oci_new_cursor($conexion);
			$c6 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);			
			oci_bind_by_name($stid, ':c2', $c2,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c3', $c3,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c4', $c4,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c5', $c5,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c6', $c6,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			oci_execute($c3,OCI_DEFAULT);
			oci_execute($c4,OCI_DEFAULT);
			oci_execute($c5,OCI_DEFAULT);
			oci_execute($c6,OCI_DEFAULT);			
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor1);
			oci_fetch_all($c3, $cursor2);
			oci_fetch_all($c4, $cursor3);
			oci_fetch_all($c5, $cursor4);
			oci_fetch_all($c6, $cursor5);
			//retona el array de datos
			return array($cursor1,$cursor2,$cursor3,$cursor4,$cursor5);
		}

		public function procedimiento10($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');									
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURA_RESTRASADA(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8,:c9,:c10,:c11,:c12,:c13,:c14,:c15,:c16,:c17,:c18,:c19,:c20,:c21,:c22,:c23); END;");
			//inicializa el cursor pasa como parametro
			$c16 = oci_new_cursor($conexion);
			//
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ":c2", $c2, 8);		
			oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c4", $c4, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c5", $c5, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c6", $c6, 100, -1, SQLT_CHR);
			oci_bind_by_name($stid, ":c7", $c7, 11);
			oci_bind_by_name($stid, ":c8", $c8, 10);
			oci_bind_by_name($stid, ":c9", $c9, 11);
			oci_bind_by_name($stid, ":c10", $c10, 3);
			oci_bind_by_name($stid, ":c11", $c11, 20);
			oci_bind_array_by_name($stid, ":c12", $c12, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c13", $c13, 100, -1, SQLT_CHR);
			oci_bind_by_name($stid, ":c14", $c14, 10);
			oci_bind_by_name($stid, ":c15", $c15, 20);
			oci_bind_by_name($stid, ":c16", $c16,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c17", $c17, 10);
			oci_bind_by_name($stid, ":c18", $c18, 10);
			oci_bind_by_name($stid, ":c19", $c19, 10);
			oci_bind_by_name($stid, ":c20", $c20, 10);
			oci_bind_by_name($stid, ":c21", $c21, 10);
			oci_bind_by_name($stid, ":c22", $c22, 10);
			oci_bind_by_name($stid, ":c23", $c23, 8);

			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c16,OCI_DEFAULT);

			oci_fetch_all($c16, $cursor1);

			return $c15;
		}

		public function procedimiento11($c1,$c2,$c3,$c4){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_OPCIONES_NOTA(:c1,:c2,:c3,:c4,:c5); END;");
			//inicializa el cursor pasa como parametro
			$c5 = oci_new_cursor($conexion);
			//
			oci_bind_by_name($stid, ":c1", $c1, 200);
			oci_bind_by_name($stid, ":c2", $c2, 10);	
			oci_bind_by_name($stid, ":c3", $c3, 100);
			oci_bind_by_name($stid, ":c4", $c4, 20);	
			oci_bind_by_name($stid, ":c5", $c5, -1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c5,OCI_DEFAULT);

			oci_fetch_all($c5, $cursor1);

			return $cursor1;

		}

		public function procedimiento12($c1){
			//$c1: codigo del cliente
			//$c2: nombre del clente
			//$c3: codigo de la mesa
			//$c4: cedula del mesero
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');	
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_GANANCIA_ADMIN(:c1,:c2,:c3,:c4,:c5); END;");

			$c2 = oci_new_cursor($conexion);
			$c3 = oci_new_cursor($conexion);
			$c4 = oci_new_cursor($conexion);
			$c5 = oci_new_cursor($conexion);

			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ":c2", $c2, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c3", $c3, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c4", $c4, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c5", $c5, -1, OCI_B_CURSOR);
			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c2,OCI_DEFAULT);   
			oci_execute($c3,OCI_DEFAULT);   
			oci_execute($c4,OCI_DEFAULT);   
			oci_execute($c5,OCI_DEFAULT);   
			//se extrae los datos del cursor en un array			
			oci_fetch_all($c2, $cursor2);
			oci_fetch_all($c3, $cursor3);
			oci_fetch_all($c4, $cursor4);
			oci_fetch_all($c5, $cursor5);

			return array($cursor2,$cursor3,$cursor4,$cursor5);
		}

		public function procedimiento13($c1,$c2,$c3,$c4,$c5,$c6,$c7){
			//$c1: operacion a reaizar
			//$c2: codigo de reserva
			//$c3: codigo de mesa
			//$c4: nuero de puesto
			//$c5: nombre ciente
			//$c6: fecha de reserba
			//$c7: hora de reserva
			//$c8: cursor
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');	
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_RESERVAR_MESA(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8); END;");

			$c8 = oci_new_cursor($conexion);
			
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ":c2", $c2, 10);
			oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c4", $c4, 100, -1, SQLT_CHR);
			oci_bind_by_name($stid, ":c5", $c5, 30);
			oci_bind_by_name($stid, ":c6", $c6, 10);
			oci_bind_by_name($stid, ":c7", $c7, 10);
			oci_bind_by_name($stid, ":c8", $c8, -1, OCI_B_CURSOR);

			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c8,OCI_DEFAULT);    
			//se extrae los datos del cursor en un array			
			oci_fetch_all($c8, $cursor1);

			return $cursor1;
		}
	} 