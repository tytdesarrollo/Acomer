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

		
	} 
