<?php

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpContratosAcomer extends Model{

		public function sp_acomer_empresas_contratos(){
			//PARAMETROS DE ENTRADA Y DE SALUDA DEL PROCEDIMIENTO
			//CONEXION
			$db = Yii::$app->params['awadb'];		

			$CONEXION = oci_connect('USR_AWA', '0RCAWASYST', $db);

			//EMPRESAS QUE TIENE CONTRATOS
			$CURSOR_EMPRESAS;
			//LOS CONTRATOS DE CADA EMPRESA
			$CURSOR_CONTRATOS;
			//FACTURAS DE LOS CONTRATOS
			$CURSOR_FACTURAS;

			//LLAMA AL PROCEDIMIENTO QUE RETORNA LAS EMPRESAS LOS CONTRATOS Y LAS FACTURAS						
			$stid = oci_parse($CONEXION, 'BEGIN SP_ACOMER_EMPRESAS_CONTRATOS(:EMPRESA, :CONTRATO, :FACTURA); END;');
			//SE DECLARAN LOS CURSOR 
			$CURSOR_EMPRESAS = oci_new_cursor($CONEXION);
			$CURSOR_CONTRATOS = oci_new_cursor($CONEXION);
			$CURSOR_FACTURAS = oci_new_cursor($CONEXION);
			//SE PASAN COMO PARAMETRO LOS CURSOR 
			oci_bind_by_name($stid, ':EMPRESA', $CURSOR_EMPRESAS, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':CONTRATO', $CURSOR_CONTRATOS, -1, OCI_B_CURSOR);
			oci_bind_by_name($stid, ':FACTURA', $CURSOR_FACTURAS, -1, OCI_B_CURSOR);

		    //SE EJECUTA  LA SENTENCIA SQL
		    oci_execute($stid);
		    oci_execute($CURSOR_EMPRESAS, OCI_DEFAULT);
		    oci_execute($CURSOR_CONTRATOS, OCI_DEFAULT);
		    oci_execute($CURSOR_FACTURAS, OCI_DEFAULT);

		    //extrae cada fila de cada cursor de una variable 
		    oci_fetch_all($CURSOR_EMPRESAS, $cursor1, null, null, OCI_FETCHSTATEMENT_BY_ROW);
		    oci_fetch_all($CURSOR_CONTRATOS, $cursor2, null, null, OCI_FETCHSTATEMENT_BY_ROW);
		    oci_fetch_all($CURSOR_FACTURAS, $cursor3, null, null, OCI_FETCHSTATEMENT_BY_ROW);

		    //SE RETORNA LAS VARIABLES QUE CONTIENE LA INFROMACION DE LOS CURSORES
			return array ($cursor1 , $cursor2, $cursor3);
		}
	}