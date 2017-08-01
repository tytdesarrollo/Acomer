<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpMesasPlaza extends Model{

		public function procedimiento(){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			//establece la conexion con la bese de dato AWA
			//cursor que recibira los datos de las mesas
			$cursor_mesas;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_RESTAURANTES.SP_ACOMER_MESAS(:cursor); END;");
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

		public function matrizDatos(){
			//variable donde estaran alamacenas las posiciones de cada mesa
			$posmesas = array();
			//ejecutamos el procedimiento de la funcion
			$consulta = $this->procedimiento();
			//asignados los valores retornados del procedimiento a la variable creada 
			foreach ($consulta as $key) {	
				$posmesas[] = array($key['COD_MESA'],$key['ESTADO'],$key['COD_EMPRESA'],$key['POSICION'],$key['PUESTOS']);
			}
			//retornamos las posiciones
			return $posmesas;
		}

		//$columna es el numeo de la columna donde estan los datos que se queiren tener en un array
		// 0-codigos de las mesas
		// 1-estado de las mesas
		// 2-codigo de la empresa a la que pertenece la mesa
		// 3-posicion en vista de la mesa
		// 4-cantidad de puestos que posee la mesa
		public function arrayDatos($columna){
			//matriz que contiene todos los datos de cada mesa
			$matriz = $this->matrizDatos();
			$tamano = sizeof($matriz);
			//array que va a contener los datos de la columna seleccionada
			$arraycol = array();
			//se llena el array con los datos de la matriz y la columna perteneciente
			for($i=0;$i<$tamano;$i++){
				$arraycol[] = $matriz[$i][$columna];
			}

			return $arraycol;
		}
	} 
