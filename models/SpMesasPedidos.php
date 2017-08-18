<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpMesasPedidos extends Model{

		public function procedimiento(){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			//cursor que recibira los datos de las mesas
			$cursor_mesas;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_RESTAURANTES.SP_ACOMER_PEDIDOS_ENTREGAR(:cursor); END;");
			//inicializa el cursor pasa como parametro
			$cursor_mesas = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, 'cursor',$cursor_mesas,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($cursor_mesas,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($cursor_mesas, $cursor);
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
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);

			$stid = oci_parse($conexion, 'BEGIN PKG_ACOMER_RESTAURANTES.SP_ACOMER_PEDIDOS(:c1,:C2,:C3,:C4,:C5,:c6); END;');    

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
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);
			// cursor con los codigos de las mesas que estan unidas
			$c2;
			// codigo de la mesa principal
			$c3;
			//ejecuta el procedimeinto
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_MESAS_UNIDAS(:c1,:c2,:c3); END;");
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
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);

			$stid = oci_parse($conexion, 'BEGIN PKG_ACOMER_RESTAURANTES.SP_ACOMER_PEDIDOS_ADD(:c1,:C2,:C3,:C4,:C5,:C6); END;');    

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
			//establece la conexion con la bese de dato AWA
			$conexion1 = oci_connect('USR_AWA', '0RCAWASYST', $db);
			$conexion2 = oci_connect('USR_AWA', '0RCAWASYST', $db);
			// procedimeintos a ejecutar
			$stid1 = oci_parse($conexion1, 'BEGIN PKG_ACOMER_RESTAURANTES.SP_ACOMER_PEDIDOS(:c1,:C2,:C3,:C4,:C5,:c6); END;');    
		    $stid2 = oci_parse($conexion1, 'BEGIN PKG_ACOMER_RESTAURANTES.SP_ACOMER_PEDIDOS(:c7,:C8,:C9,:C10,:C11,:c12); END;');
		    $stid3 = oci_parse($conexion2, 'BEGIN SP_ACOMER_UNION_MESAS(:c13,:C14,:C15); END;');    
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
	} 
