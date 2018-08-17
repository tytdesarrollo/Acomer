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
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//cursor que recibira los datos de las mesas
			$cursor_puestos;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_aCOMER_FACTURA_PUESTOS(:c1,:c2); END;");
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
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//cursor que recibira los datos de las mesas
			$cursor_puestos;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURACION(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8,:c9); END;");
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
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];	
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_ESTADO_MESA_FAC(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			oci_bind_by_name($stid, ":c1", $c1, 10, OCI_B_INT);    
		    oci_bind_by_name($stid, ":c2", $c2, 10, OCI_B_INT);   		    
		     // se ejecuta el procedimiento 
		    oci_execute($stid);

		    return $c2;
		}

		public function procedimiento4($c1,$c2,$c3,$c4,$c5){
			//$c1: fecha de la factura
			//$c2: hora de la factura
			//$c3: array con los codigos de las facturas generales
			//$c4: codigo del meser0
			//$c5: propina que el cliente deja 
			//$c6: cursor con los datos para mostrar la factura
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURA_CLIENTE(:c1,:c2,:c3,:c4,:c5,:c6); END;");
			//inicializa el cursor pasa como parametro
			$c6 = oci_new_cursor($conexion);
			oci_bind_by_name($stid, ":c1", $c1, 11);    
		    oci_bind_by_name($stid, ":c2", $c2, 60);  
		    oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);   
		    oci_bind_by_name($stid, ":c4", $c4, 11);	
		    oci_bind_by_name($stid, ":c5", $c5, 10);	
		    oci_bind_by_name($stid, ':c6', $c6, -1, OCI_B_CURSOR);		
		    // se ejecuta el procedimiento 
		    oci_execute($stid);
		    oci_execute($c6,OCI_DEFAULT);   	

		    oci_fetch_all($c6, $array); 

		    return $array;	

		}

		public function procedimiento5($c1){
			//$c1: mesa que se le hace el respaldo 
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURA_RESPALDO(:c1,:c2); END;");
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
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURACION_REVER(:c1,:c2); END;");
			//inicializa el cursor pasa como parametro
			oci_bind_by_name($stid, ":c1", $c1, 10, OCI_B_INT);    
			oci_bind_by_name($stid, ":c2", $c2, 10, OCI_B_INT);    
			// se ejecuta el procedimiento 
			oci_execute($stid);			
		}

		public function procedimiento7($c1,$c2,$c3,$c4,$c5,$c6){
			//$c1: codigo del cliente
			//$c2: nombre completo del clinete
			//$c3: direccion del cliente
			//$c4: correo electronico del cliente
			//$c5: telefono del cliente
			//$C6: ciudad de direccion de cliente
			//$c7: codigo que indicia el estado de la ejecucion
				//O: CLIENTE YA SE ENCUENTRA REGISTRADO EN LA BASE DE DATOS 
				//1: REGISTRO COMPLETADO
				//2: REGISTRO ERRONEO
			//
			//dsn de la conexion a la base de datos			
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_REGISTRO_CLIENTE(:c1,:c2,:c3,:c4,:c5,:C6,:c7); END;");			
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 11);
			oci_bind_by_name($stid, ":c2", $c2, 60);
			oci_bind_by_name($stid, ":c3", $c3, 75);
			oci_bind_by_name($stid, ":c4", $c4, 30);
			oci_bind_by_name($stid, ":c5", $c5, 15);
			oci_bind_by_name($stid, ":c6", $c6, 75);
			oci_bind_by_name($stid, ":c7", $c7, 10);
			// se ejecuta el procedimiento 
			oci_execute($stid);		

			return $c7;
		}

		public function procedimiento8($c1){
			//$c1:codigo del cliente
			//$c2: nombre del cliente
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_DATOS_CLIENTE(:c1,:c2); END;");		
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 11);
			oci_bind_by_name($stid, ":c2", $c2, 60);	
			// se ejecuta el procedimiento 
			oci_execute($stid);		

			return $c2;
			
		}

		public function procedimiento9($c1){
			//$c1: codigo de la mesa
			//$c2: mensaje
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CTRL_ENTREGA_PEDyFAC(:c1,:c2); END;");		
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ":c2", $c2, 20);	
			// se ejecuta el procedimiento 
			oci_execute($stid);		

			return $c2;
		}

		public function procedimiento10($c1){
			//$c1: codigo de la factura
			//$c2: correo del cliente
			//$c3: esquema html de la factura
			//$c4: prodcutos facturados
			//$c5: valores de la factura			
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURA_EMAIL(:c1,:c2,:c3,:c4,:c5); END;");		
			//
			$c4 = oci_new_cursor($conexion);
			$c5 = oci_new_cursor($conexion);
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ":c2", $c2, 50);
			oci_bind_by_name($stid, ":c3", $c3, 32676);
			oci_bind_by_name($stid, ":c4", $c4, -1, OCI_B_CURSOR);		
			oci_bind_by_name($stid, ":c5", $c5, -1, OCI_B_CURSOR);		

			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c4,OCI_DEFAULT);   
			oci_execute($c5,OCI_DEFAULT);   
			//se extrae los datos del cursor en un array
			oci_fetch_all($c4, $cursor1);
			oci_fetch_all($c5, $cursor2);

			/****************************************************************************************************************************/
			if($c2 !== 'N/A'){
				//se arman los array con la informacion de la factura como parametro de url (GET)
				$parametrosProductos = http_build_query(array($cursor1), 'productos');
				$parametrosCabecera = http_build_query(array($cursor2), 'cabecera');

				// reemplazan los nombres de los parametros
				$parametrosProductos = str_replace("productos0","productos",$parametrosProductos);
				$parametrosCabecera = str_replace("cabecera0","cabecera",$parametrosCabecera);

				// se arama la ur 
				$pagina = "http://www.talentsw.com/Acomer/intento1/phpmailer/examples/smtp.php?".$parametrosProductos."&".$parametrosCabecera;;
				
			   	// se ejecuta l envio de la factura por correo
				$ejecuta = @file_get_contents($pagina);	
				
				/*if($ejecuta === false){
					echo "error";
				}else{
					echo $ejecucion;
				}*/
				
			}
			/****************************************************************************************************************************/
			
		}

		public function procedimiento11($c1,$c2,$c3,$c4,$c5,$c6){
			//$c1: codigo del cliente
			//$c2: codigo de la mesa
			//$c3: cedula del mesero
			//$c4: forma de pago
			//$c5: puestos a facturar	
			//$c6: porcentaje de propina
			//$c7: cabecera de la fatura
			//$c8: detalle de factura
			//$c9: numero rever
			//$C10: numero de la factura asignada
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURAR_FULL(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8,:c9,:c10); END;");		
			//
			$c7 = oci_new_cursor($conexion);
			$c8 = oci_new_cursor($conexion);
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 11);
			oci_bind_by_name($stid, ":c2", $c2, 10);
			oci_bind_by_name($stid, ":c3", $c3, 10);
			oci_bind_by_name($stid, ":c4", $c4, 3);		
			oci_bind_array_by_name($stid, ":c5", $c5, 100, -1, SQLT_CHR);
			oci_bind_by_name($stid, ":c6", $c6, 10);
			oci_bind_by_name($stid, ":c7", $c7, -1, OCI_B_CURSOR);		
			oci_bind_by_name($stid, ":c8", $c8, -1, OCI_B_CURSOR);	
			oci_bind_by_name($stid, ":c9", $c9, 10);
			oci_bind_by_name($stid, ":c10", $c10, 10);

			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c7,OCI_DEFAULT);   
			oci_execute($c8,OCI_DEFAULT);   
			//se extrae los datos del cursor en un array
			oci_fetch_all($c7, $cursor1);
			oci_fetch_all($c8, $cursor2);	

			// retorna la cabecera, el detalle y el numero rever
			return array($cursor1,$cursor2,$c9,$c10);
		}

		public function procedimiento12($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8){
			//$c1: codigo del cliente
			//$c2: codigo de la mesa 1
			//$c3: codigo de la mesa 2
			//$c4: codigo del mesero
			//$c5: formas de pago
			//$c6: puesto de la mesa 1
			//$c7: puestos de la mesa 2
			//$c8: porcentaje de a propina
			//$c9: cabecera de la factura
			//$c10: detalle de la factura 
			//$c11: numero rever asignado
			//$c12: numero de la factura asignada
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURAR_FULL_DOBLE(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8,:c9,:c10,:c11,:c12); END;");		
			//
			$c9 = oci_new_cursor($conexion);
			$c10 = oci_new_cursor($conexion);
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 11);
			oci_bind_by_name($stid, ":c2", $c2, 10);
			oci_bind_by_name($stid, ":c3", $c3, 10);
			oci_bind_by_name($stid, ":c4", $c4, 10);		
			oci_bind_by_name($stid, ":c5", $c5, 3);			
			oci_bind_array_by_name($stid, ":c6", $c6, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c7", $c7, 100, -1, SQLT_CHR);
			oci_bind_by_name($stid, ":c8", $c8, 10);
			oci_bind_by_name($stid, ":c9", $c9, -1, OCI_B_CURSOR);		
			oci_bind_by_name($stid, ":c10", $c10, -1, OCI_B_CURSOR);	
			oci_bind_by_name($stid, ":c11", $c11, 10);
			oci_bind_by_name($stid, ":c12", $c12, 10);

			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c9,OCI_DEFAULT);   
			oci_execute($c10,OCI_DEFAULT);   
			//se extrae los datos del cursor en un array
			oci_fetch_all($c9, $cursor1);
			oci_fetch_all($c10, $cursor2);	

			// retorna la cabecera, el detalle y el numero rever
			return array($cursor1,$cursor2,$c11,$c12);
		}

		public function procedimiento13($c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10){
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
			//$c11: numero de la factura
			//$c12: detalle de la factura
			//$c13: subtotal de la factura
			//$c14: impuestos de la factura
			//$c15: propina de la factura
			//$c16: atenciones de la factura
			//$c17: total a pagar de la factura 
			//$c18: fecha de la factura
			//$C19: hora de la factura
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');	
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURACION_SMILLE(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8,:c9,:c10,:c11,:c12,:c13,:c14,:c15,:c16,:c17,:c18,:c19); END;");

			$c12 = oci_new_cursor($conexion);

			oci_bind_by_name($stid, ":c1", $c1, 11);
			oci_bind_by_name($stid, ":c2", $c2, 60);
			oci_bind_by_name($stid, ":c3", $c3, 10);
			oci_bind_by_name($stid, ":c4", $c4, 11);
			oci_bind_by_name($stid, ":c5", $c5, 3);			
			oci_bind_by_name($stid, ":c6", $c6, 200);
			oci_bind_array_by_name($stid, ":c7", $c7, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c8", $c8, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c9", $c9, 100, -1, SQLT_CHR);
			oci_bind_by_name($stid, ":c10", $c10, 30);
			oci_bind_by_name($stid, ":c11", $c11, 200);
			oci_bind_by_name($stid, ":c12", $c12, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c13", $c13, 10);
			oci_bind_by_name($stid, ":c14", $c14, 10);
			oci_bind_by_name($stid, ":c15", $c15, 10);
			oci_bind_by_name($stid, ":c16", $c16, 10);
			oci_bind_by_name($stid, ":c17", $c17, 10);
			oci_bind_by_name($stid, ":c18", $c18, 15);
			oci_bind_by_name($stid, ":c19", $c19, 15);
			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c12,OCI_DEFAULT);    
			//se extrae los datos del cursor en un array
			oci_fetch_all($c12, $cursor);

			// retorna la cabecera, el detalle y el numero rever
			return array($c11,$cursor,$c13,$c14,$c15,$c16,$c17,$c18,$c19);
		}

		public function procedimiento14($c1,$c2){
			//$c1: numero de la factura a reversar
			//$c2: cedul del mesero que reversa
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');	
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURA_SMILE_REVER(:c1,:c2); END;");
			//
			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_by_name($stid, ":c2", $c2, 10);
			// se ejecuta el procedimiento 
			oci_execute($stid);

			return "ok";			
		}

		public function procedimiento15($c1,$c2){
			//$c1: codigo de la mesa
			//$c2: puestos de factura
			//$c3: detalle de la factura
			//$c4: subtotal
			//$c5: impuestos
			//$c6: total a pagar
			//$c7: fecha de factura
			//$c8: hora de factura
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');	
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_FACTURA_SMILE_VIEW(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8); END;");

			$c3 = oci_new_cursor($conexion);

			oci_bind_by_name($stid, ":c1", $c1, 10);
			oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);
			oci_bind_by_name($stid, ":c3", $c3, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c4", $c4, 10);
			oci_bind_by_name($stid, ":c5", $c5, 10);
			oci_bind_by_name($stid, ":c6", $c6, 10);
			oci_bind_by_name($stid, ":c7", $c7, 15);
			oci_bind_by_name($stid, ":c8", $c8, 15);
			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c3,OCI_DEFAULT);    
			//se extrae los datos del cursor en un array
			oci_fetch_all($c3, $cursor);

			return array($cursor,$c4,$c5,$c6,$c7,$c8);
		}

		public function procedimiento16($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');	
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN VENTAS_DETIMPFACTU(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8,:c9,:c10,:c11); END;");

			$c2 = oci_new_cursor($conexion);

			oci_bind_by_name($stid, ":c1", $c1, 20);
			oci_bind_by_name($stid, ":c2", $c2, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c3", $c3, 15);
			oci_bind_by_name($stid, ":c4", $c4, 15);
			oci_bind_by_name($stid, ":c5", $c5, 15);
			oci_bind_by_name($stid, ":c6", $c6, 15);
			oci_bind_by_name($stid, ":c7", $c7, 15);
			oci_bind_by_name($stid, ":c8", $c8, 20);
			oci_bind_by_name($stid, ":c9", $c9, 20);
			oci_bind_by_name($stid, ":c10", $c10, 20);
			oci_bind_by_name($stid, ":c11", $c11, 20);

			// se ejecuta el procedimiento 
			oci_execute($stid);		
			oci_execute($c2,OCI_DEFAULT);    
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor);

			return array($cursor,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11);
		}

	}
