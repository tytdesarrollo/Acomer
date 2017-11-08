<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpMesasFactura extends Model{

		public function procedimiento($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			//cursor que recibira los datos de las mesas
			$cursor_puestos;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_aCOMER_FACTURA_PUESTOS(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			$cursor_puestos = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 4);
			oci_bind_by_name($stid, ':c2',$cursor_puestos,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($cursor_puestos,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($cursor_puestos, $cursor);
			//retona el array de datos
			return $cursor;
		}

		public function procedimiento2($c1,$c2,$c3,$c4,$c5,$c6){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			//cursor que recibira los datos de las mesas
			$cursor_puestos;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_FACTURACION(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8,:c9); END;");
			//cursores que reciben datos
			$cursor_cabecera;
			$cursor_detalle;
			// total a pagar
			$c9;
			//inicializa el cursor pasa como parametro
			$cursor_cabecera = oci_new_cursor($conexion);
			$cursor_detalle = oci_new_cursor($conexion);
			oci_bind_by_name($stid, ":c1", $c1, 11);    
		    oci_bind_by_name($stid, ":c2", $c2, 60);  
		    oci_bind_by_name($stid, ":c3", $c3, 4);    
		    oci_bind_by_name($stid, ":c4", $c4, 11);
		    oci_bind_by_name($stid, ":c5", $c5, 4);
		    oci_bind_array_by_name($stid, ":c6", $c6, 100, -1, SQLT_CHR);
		    oci_bind_by_name($stid, ':c7', $cursor_cabecera, -1, OCI_B_CURSOR);
		    oci_bind_by_name($stid, ':c8', $cursor_detalle, -1, OCI_B_CURSOR);
		    oci_bind_by_name($stid, ":c9", $c9, 10);
		    // se ejecuta el procedimiento 
		    oci_execute($stid);
		    oci_execute($cursor_cabecera,OCI_DEFAULT);   
		    oci_execute($cursor_detalle,OCI_DEFAULT);  

		    //se extrae los datos del cursor en un array
			oci_fetch_all($cursor_cabecera, $arr1); 
			oci_fetch_all($cursor_detalle, $arr2); 

			return array($arr1,$arr2,$c9);
		}

		public function procedimiento3($c1){
			//$c1: codigo de la mesa 
			//$c2: estado de la mesa despues de facturar
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_ESTADO_MESA_FAC(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			oci_bind_by_name($stid, ":c1", $c1, 10, OCI_B_INT);    
		    oci_bind_by_name($stid, ":c2", $c2, 10, OCI_B_INT);   		    
		     // se ejecuta el procedimiento 
		    oci_execute($stid);

		    return $c2;
		}

		public function procedimiento4($c1,$c2,$c3,$c4){
			//$c1: fecha de la factura
			//$c2: hora de la factura
			//$c3: array con los codigos de las facturas generales
			//$c4: codigo del meser0
			//$c5: cursor con los datos para mostrar la factura
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_FACTURA_CLIENTE(:c1,:c2,:c3,:c4,:c5); END;");
			//inicializa el cursor pasa como parametro
			$c5 = oci_new_cursor($conexion);
			oci_bind_by_name($stid, ":c1", $c1, 11);    
		    oci_bind_by_name($stid, ":c2", $c2, 60);  
		    oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);   
		    oci_bind_by_name($stid, ":c4", $c4, 11);	
		    oci_bind_by_name($stid, ':c5', $c5, -1, OCI_B_CURSOR);		
		    // se ejecuta el procedimiento 
		    oci_execute($stid);
		    oci_execute($c5,OCI_DEFAULT);   	

		    oci_fetch_all($c5, $array); 

		    return $array;	

		}

		public function procedimiento5($c1){
			//$c1: mesa que se le hace el respaldo 
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_FACTURA_RESPALDO(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			oci_bind_by_name($stid, ":c1", $c1, 10, OCI_B_INT);    
			oci_bind_by_name($stid, ":c2", $c2, 10, OCI_B_INT);    
			// se ejecuta el procedimiento 
			oci_execute($stid);

			return $c2;
		}

		public function procedimiento6($c1,$c2){
			//$c1: numero de la factura que se da al cliente y que se va a revertir
			//$c2: numero de rever que se le asigna al momento de facturar 			
			
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_FACTURACION_REVER(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			oci_bind_by_name($stid, ":c1", $c1, 10, OCI_B_INT);    
			oci_bind_by_name($stid, ":c2", $c2, 10, OCI_B_INT);    
			// se ejecuta el procedimiento 
			oci_execute($stid);			
		}

	}
