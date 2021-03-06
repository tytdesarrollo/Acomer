<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpMenusPlaza extends Model{

		public function procedimiento(){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la base de datos 
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//cursores que recibiran los datos del menu
			$cursor_categorias; 
			$cursor_subcategorias;
			$cursor_terminos;
			$cursor_comidas;
			// llamado al rocedimiento con los parametros correspondientes
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_MENU(:c1,:c2,:c3,:c4); END;");
			//inicializa los cursores
			$cursor_categorias = oci_new_cursor($conexion);
			$cursor_subcategorias = oci_new_cursor($conexion);
			$cursor_terminos = oci_new_cursor($conexion);
			$cursor_comidas = oci_new_cursor($conexion);
			//se pasan los parametros 
			oci_bind_by_name($stid, ':c1',$cursor_categorias, -1 , OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c2',$cursor_subcategorias, -1 , OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c3',$cursor_terminos, -1 , OCI_B_CURSOR);
			oci_bind_by_name($stid, ':c4',$cursor_comidas, -1 , OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($cursor_categorias,OCI_DEFAULT);
			oci_execute($cursor_subcategorias,OCI_DEFAULT);
			oci_execute($cursor_terminos,OCI_DEFAULT);
			oci_execute($cursor_comidas,OCI_DEFAULT);
			// se extraen los datos de los cursores
			oci_fetch_all($cursor_categorias, $cursor1, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_fetch_all($cursor_subcategorias, $cursor2, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_fetch_all($cursor_terminos, $cursor3, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_fetch_all($cursor_comidas, $cursor4, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			// retorna los datos devueltos por el procedimiento
			return array($cursor1, $cursor2, $cursor3, $cursor4);
		}

		public function procedimiento2($c1, $c2){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la base de datos 
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//cursores que recibiran los datos del menu
			$cursor_categorias; 
			$cursor_subcategorias;
			$cursor_terminos;
			$cursor_comidas;
			// llamado al rocedimiento con los parametros correspondientes
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_NOTAS_PEDIDO(:c1,:c2,:c3); END;");
			//inicializa los cursores
			$c3 = oci_new_cursor($conexion);
			//
			oci_bind_by_name($stid, ":c1", $c1, 8);
			oci_bind_by_name($stid, ":c2", $c2, 20);
			oci_bind_by_name($stid, ':c3',$c3, -1 , OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($c3,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($c3, $arr); 

			return $arr;
		}
	} 
