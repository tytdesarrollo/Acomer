<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpMesasPedidos extends Model{

		public function procedimiento($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//cursor que recibira los datos de las mesas
			$c2;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PEDIDOS_ENTREGAR(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10, SQLT_INT);    
			oci_bind_by_name($stid, ":c2", $c2,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);
			//retona el array de datos
			return $cursor;
		}

		public function procedimiento2($c1,$c2,$c3,$c4,$c5,$c6){
			//c1: Variable correspondiente al arraY de los puestos  
			//c2: Variable correspondiente al arraY de los platos
			//c3: Variable correspondiente al arraY de la cantidad
			//c4: Variable correspondiente al arraY del termino
			//c5: Variable correspondiente alcodigo del mesero
			//c6: Variable correspondiente al arraY al codigo de la mesa
			
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						

			$stid = oci_parse($conexion, 'BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PEDIDOS(:c1,:C2,:C3,:C4,:C5,:c6); END;');    

			oci_bind_array_by_name($stid, ":c1", $c1, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c4", $c4, 100, -1, SQLT_CHR);
		    oci_bind_by_name($stid, ":c5", $c5, 10);    
		    oci_bind_by_name($stid, ":c6", $c6, 4);

		    oci_execute($stid);
		}

		public function procedimiento3($c1){
			//c1: codigo de la mesa que ha clickeado 
			
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			// cursor con los codigos de las mesas que estan unidas
			$c2;
			// codigo de la mesa principal
			$c3;
			//ejecuta el procedimeinto
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_MESAS_UNIDAS(:c1,:c2,:c3); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ':c1',$c1, 10);   
			oci_bind_by_name($stid, ':c2',$c2,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c3',$c3, 10);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor1);
			//retona el array de datos
			return array($cursor1,$c3);
		}
		
		public function procedimiento4($c1,$c2,$c3,$c4,$c5,$c6){
			//c1: Variable correspondiente al arraY de los puestos  
			//c2: Variable correspondiente al arraY de los platos
			//c3: Variable correspondiente al arraY de la cantidad
			//c4: Variable correspondiente al arraY del termino
			//c5: Variable correspondiente alcodigo del mesero
			//c6: Variable correspondiente al arraY al codigo de la mesa

			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						

			$stid = oci_parse($conexion, 'BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PEDIDOS_ADD(:c1,:C2,:C3,:C4,:C5,:C6); END;');    

			oci_bind_array_by_name($stid, ":c1", $c1, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c4", $c4, 100, -1, SQLT_CHR);
		    oci_bind_by_name($stid, ":c5", $c5, 10);    
		    oci_bind_by_name($stid, ":c6", $c6, 4);

		    oci_execute($stid);
		}

		public function procedimiento5($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$c13,$c14,$c15){
			// Mesa 1
			//c1: Variable correspondiente al arraY de los puestos  
			//c2: Variable correspondiente al arraY de los platos
			//c3: Variable correspondiente al arraY de la cantidad
			//c4: Variable correspondiente al arraY del termino
			//c5: Variable correspondiente alcodigo del mesero
			//c6: Variable correspondiente al arraY al codigo de la mesa
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
			
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion1 = oci_connect($usuario, $contrasena, $db);						
			$conexion2 = oci_connect($usuario, $contrasena, $db);						
			// procedimeintos a ejecutar
			$stid1 = oci_parse($conexion1, 'BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PEDIDOS(:c1,:C2,:C3,:C4,:C5,:c6); END;');    
		    $stid2 = oci_parse($conexion1, 'BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PEDIDOS(:c7,:C8,:C9,:C10,:C11,:c12); END;');
		    $stid3 = oci_parse($conexion2, 'BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_UNION_MESAS(:c13,:C14,:C15); END;');    
		    //parametros para los procedimientos    
		    // parametros del procedimientos 1
			oci_bind_array_by_name($stid1, ":c1", $c1, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid1, ":c2", $c2, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid1, ":c3", $c3, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid1, ":c4", $c4, 100, -1, SQLT_CHR);
		    oci_bind_by_name($stid1, ":c5", $c5, 10);    
		    oci_bind_by_name($stid1, ":c6", $c6, 4);
		    // parametros del procedimientos 2
		    oci_bind_array_by_name($stid2, ":c7", $c7, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid2, ":c8", $c8, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid2, ":c9", $c9, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid2, ":c10", $c10, 100, -1, SQLT_CHR);
		    oci_bind_by_name($stid2, ":c11", $c11, 10);    
		    oci_bind_by_name($stid2, ":c12", $c12, 4);
		    // parametros del procedimeitno 3
		    oci_bind_by_name($stid3, ":c13", $c13, 10);    
		    oci_bind_by_name($stid3, ":c14", $c14, 4);
		    oci_bind_array_by_name($stid3, ":c15", $c15, 100, -1, SQLT_CHR);  

		    oci_execute($stid1);
		    oci_execute($stid2);
		    oci_execute($stid3);
		}

		public function procedimiento6($c1){
			//c1: codigo de la mesa 
			
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			// cursor con los codigos de las mesas que estan unidas
			$c2;			
			//ejecuta el procedimeinto
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DETALLE_PEDIDO(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ':c1',$c1, 10);   
			oci_bind_by_name($stid, ':c2',$c2,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor1);
			//retona el array de datos
			return $cursor1;
		}

		public function procedimiento7($c1){
			//$c1: codigo del plato que ingresa en el procedimiento
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			// cursor con los codigos de las mesas que estan unidas
			$c2;
			$c3;			
			//ejecuta el procedimeinto
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_NOMBRE_PLATOS(:c1,:c2,:c3); END;");				
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ':c1',$c1, 20);   
			oci_bind_by_name($stid, ':c2',$c2, 200);
			oci_bind_by_name($stid, ':c3',$c3, 50);
			//se ejecuta el procidimiento 
			oci_execute($stid);

			return array($c2,$c3);
		}

		public function procedimiento8($c1,$c2,$c3,$c4,$c5){
			//$c1: tipo de cancelacion
			//$c2: codigo de la mesa donde se va hacer la cancelacion
			//$c3: codigo del plato que se va a cancelar
			//$c4: cantidad que se va a cancelar
			//$c5: puesto del plato donde se va a cancelar	
			//$c6: codigo del mensaje 0: correcto , 1: error 
			$db = Yii::$app->params['awadb'];	
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];	
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//mensaje que se recibe
			$c6;			
			//ejecuta el procedimeinto
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PEDIDOS_CANCEL(:c1,:C2,:C3,:C4,:c5,:c6); END;");				
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ':c1',$c1, 10);   
			oci_bind_by_name($stid, ':c2',$c2, 10);
			oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c4", $c4, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c5", $c5, 100, -1, SQLT_CHR); 		
			oci_bind_by_name($stid, ':c6',$c6, 10);
			//se ejecuta el procidimiento 
			oci_execute($stid);

			return $c6;
		}

		public function procedimiento9($c1,$c2){
			//$c1: codigo de la mesa
			//$c2: array con los puestos que va a visualizar
			//$c3: cursor que retorna con los datos pertinentes
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//ejecuta el procedimeinto
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_VISUALIZA_FAC(:c1,:c2,:c3,:c4); END;");	
			//establece el cursor
			$c3 = oci_new_cursor($conexion);		
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ":c1", $c1, 10, OCI_B_INT);    
		    oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);
		    oci_bind_by_name($stid, ':c3',$c3,-1, OCI_B_CURSOR);
		    oci_bind_by_name($stid, ":c4", $c4, 40);  

		    oci_execute($stid);
    		oci_execute($c3,OCI_DEFAULT);

    		oci_fetch_all($c3, $cursor);

    		return array($cursor,$c4);
		}

		public function procedimiento10($c1){
			//$c1: codigo de la mesa
			//$c2: cadena de codigo de mesa que hay unidas
			
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//ejecuta el procedimeinto
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_MESA_PRINC_HIJOS(:c1,:c2); END;");	
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ":c1", $c1, 10, OCI_B_INT);    
			oci_bind_by_name($stid, ":c2", $c2, 200, SQLT_CHR);    

			oci_execute($stid);

			// transforma en un array los puestos
			$result = explode("_*", $c2);

			return $result;
			
		}

		public function procedimiento11($c1){
			//$c1: codigo de la mesa
			//$c2: codigo del mensaje
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PED_ENTREG_MESUNIDA(:c1,:c2); END;");		
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ":c2", $c2, 10);	
			// se ejecuta el procedimiento 
			oci_execute($stid);		

			return $c2;
			
		}

		public function procedimiento12($c1){
			//$c1: codigo de la mesa
			//$c2: codigo del mensaje
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_PEDIDOS_CANCEL_REST(:c1); END;");		
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 10);	
			// se ejecuta el procedimiento 
			oci_execute($stid);		
			
		}

		public function procedimeinto13($c1,$c2){
			//$c1: array con codigo de la mesa
			//$c2: array con el avatar seleccionado
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];	
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];	
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_AVATAR_MESAS(:c1,:c2); END;");		
			//pasa los parametros del proceimiento
			oci_bind_array_by_name($stid, ":c1", $c1, 100, -1, SQLT_CHR);
		    oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);
			// se ejecuta el procedimiento 
			oci_execute($stid);		
		}

		public function procedimeinto14($c1){
			//$c1: codigo de la mesa
			//$c2: cursor con los datos de la consulta
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db);						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CONSULTA_AVATAR(:c1,:c2); END;");	
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 			
			oci_bind_by_name($stid, ':c1',$c1, 10);   
			oci_bind_by_name($stid, ':c2',$c2,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor1);
			//retona el array de datos
			return $cursor1;
		}


	} 

