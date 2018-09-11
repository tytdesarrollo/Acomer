<?php
	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;
	
	class AcRptVentasProd extends Model{
		
		public function sp_ac_RptVentaprod($empcod, $fechaini, $fechafin){
			//PARAMETROS DE ENTRADA Y DE SALIDA DEL PROCEDIMIENTO
			//CONEXION
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];

			$CONEXION = oci_connect($usuario, $contrasena, $db);
			
			//DATOS DE REPORTE VENTAS POR PRODUCTO
			$CURSOR_DATOSVENPROD;

			//LLAMA AL PROCEDIMIENTO QUE RETORNA LAS EMPRESAS LOS CONTRATOS Y LAS FACTURAS						
			$stid = oci_parse($CONEXION, 'BEGIN RPT_VENTAS_PRODUCTO(:EMPRESA, :FECHAINI, :FECHAFIN, :DATOSVENPROD); END;');
			
			//SE DECLARAN LOS CURSOR 
			$CURSOR_DATOSVENPROD = oci_new_cursor($CONEXION);
			
			//SE PASAN COMO PARAMETRO LOS CURSOR 
			oci_bind_by_name($stid, ':EMPRESA', $empcod, 13); 
			oci_bind_by_name($stid, ':FECHAINI', $fechaini, 10);			
			oci_bind_by_name($stid, ':FECHAFIN', $fechafin, 10);			
			oci_bind_by_name($stid, ':DATOSVENPROD', $CURSOR_DATOSVENPROD, -1, OCI_B_CURSOR);

		    //SE EJECUTA  LA SENTENCIA SQL
		    oci_execute($stid);
		    oci_execute($CURSOR_DATOSVENPROD, OCI_DEFAULT);

		    //extrae cada fila de cada cursor de una variable 
		    oci_fetch_all($CURSOR_DATOSVENPROD, $cursor1, null, null, OCI_FETCHSTATEMENT_BY_ROW);

		    //SE RETORNA LAS VARIABLES QUE CONTIENE LA INFROMACION DE LOS CURSORES
			return array ($cursor1);
		}	

		public function sp_list_empresas(){
			//PARAMETROS DE ENTRADA Y DE SALIDA DEL PROCEDIMIENTO
			//CONEXION
			$db = Yii::$app->params['awadb'];	
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];	

			$CONEXION = oci_connect($usuario, $contrasena, $db);
			
			//LISTA EMPRESAS
			$CURSOR_LISTEMPRESAS;			

			//LLAMA AL PROCEDIMIENTO QUE RETORNA LAS EMPRESAS LOS CONTRATOS Y LAS FACTURAS						
			$stid = oci_parse($CONEXION, 'BEGIN LISTA_EMPRESAS(:LISTA_EMPRESA); END;');
			
			//SE DECLARAN LOS CURSOR 
			$CURSOR_LISTEMPRESAS = oci_new_cursor($CONEXION);
			
			//SE PASAN COMO PARAMETRO LOS CURSOR 
			oci_bind_by_name($stid, ':LISTA_EMPRESA', $CURSOR_LISTEMPRESAS, -1, OCI_B_CURSOR);

		    //SE EJECUTA  LA SENTENCIA SQL
		    oci_execute($stid);
			oci_execute($CURSOR_LISTEMPRESAS, OCI_DEFAULT);

		    //extrae cada fila de cada cursor de una variable 
			oci_fetch_all($CURSOR_LISTEMPRESAS, $cursor1, null, null, OCI_FETCHSTATEMENT_BY_ROW);

		    //SE RETORNA LAS VARIABLES QUE CONTIENE LA INFROMACION DE LOS CURSORES
			return $cursor1;
		}		
	}
?>	