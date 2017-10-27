<?php

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpCocinaPedidos extends Model{

		public function procedimiento($c1){
			//$c1: cedula del cocinero
			//@C2: cursor para los conjuntos 
			//$c3: cursor que retorna las mesas y el conjunto al que pertenecen
			//$c4: cursor que retorna los platos que hay para cada mesa
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_PEDIDOS_COCINA(:c1,:c2,:c3,:C4); END;");
			//inicializa el cursor pasa como parametro
			$c2 = oci_new_cursor($conexion);
			$c3 = oci_new_cursor($conexion);
			$c4 = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 10);    
			oci_bind_by_name($stid, ":c2", $c2,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c3", $c3,-1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ":c4", $c4,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c2,OCI_DEFAULT);
			oci_execute($c3,OCI_DEFAULT);
			oci_execute($c4,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c2, $cursor1);
			oci_fetch_all($c3, $cursor2);
			oci_fetch_all($c4, $cursor3);
			//retona el array de datos
			return array($cursor1, $cursor2,$cursor3);
		}

		public function procedimiento2($c1,$c2,$c3,$c4){
			//$c1: codigo del restaurante al que pertenece el plato
			//$c2: codigo del pedido que tiene asignado el plato
			//$c3: puesto al que pertenece el pedido 
			//$c4: cantidad que se esta alistando para aetregar
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect('USR_AWA', '0RCAWASYST', $db);						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN SP_ACOMER_ENTREGA_PEDIDO(:c1,:c2,:c3,:c4); END;");
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 13,SQLT_CHR);    
			oci_bind_by_name($stid, ":c2", $c2, 10,SQLT_INT);
			oci_bind_by_name($stid, ":c3", $c3, 3 ,SQLT_CHR);
			oci_bind_by_name($stid, ":c4", $c4, 10 ,SQLT_INT);
			//se ejecuta el procidimiento 
			oci_execute($stid);			
		}
	}