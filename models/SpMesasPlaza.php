<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class SpMesasPlaza extends Model{		

		public function procedimiento($c1){
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];		
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//cursor que recibira los datos de las mesas
			$cursor_mesas;
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_MESAS(:c1,:cursor); END;");
			//inicializa el cursor pasa como parametro
			$cursor_mesas = oci_new_cursor($conexion);
			//se pasan los parametros del procedimiento 
			oci_bind_by_name($stid, ":c1", $c1, 13);
			oci_bind_by_name($stid, 'cursor',$cursor_mesas,-1, OCI_B_CURSOR);
			//se ejecuta el procidimiento 
			oci_execute($stid);
			oci_execute($cursor_mesas,OCI_DEFAULT);
			//se extrae los datos del cursor en un array
			oci_fetch_all($cursor_mesas, $cursor);
			//retona el array de datos
			return $cursor;
		}

		public function procedimiento2(){
			//$c1: codigo del container 1 
			//$c2: codigo del container 2
			//$c3: codigo del container 3
			//$c4: codigo del container 4
			//$c5: nombre del container 1 
			//$c6: nombre del container 2
			//$c7: nombre del container 3
			//$c8: nombre del container 4
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_CODIGO_CONTAINERS(:c1,:c2,:c3,:c4,:c5,:c6,:c7,:c8); END;");
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 13);
			oci_bind_by_name($stid, ":c2", $c2, 13);
			oci_bind_by_name($stid, ":c3", $c3, 13);
			oci_bind_by_name($stid, ":c4", $c4, 13);
			oci_bind_by_name($stid, ":c5", $c5, 100);
			oci_bind_by_name($stid, ":c6", $c6, 100);
			oci_bind_by_name($stid, ":c7", $c7, 100);
			oci_bind_by_name($stid, ":c8", $c8, 100);
			//se ejecuta el procidimiento 
			oci_execute($stid);

			return array($c1, $c2, $c3, $c4, $c5, $c6, $c7 ,$c8);

		}

		public function procedimiento3($c1,$c2,$c3,$c4){
			//$c1: puestos del pedido ARRAY
			//$C2: platos del pedido ARRAY
			//$c3: codigo del pedido
			//$c4: codigo del container
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_ENTREGAR_PEDIDO_MESA(:c1,:c2,:c3,:c4); END;");
			//pasa los parametros del proceimiento
			oci_bind_array_by_name($stid, ":c1", $c1, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c2", $c2, 100, -1, SQLT_CHR);			
			oci_bind_array_by_name($stid, ":c3", $c3, 100, -1, SQLT_CHR);
			oci_bind_array_by_name($stid, ":c4", $c4, 100, -1, SQLT_CHR);		
			//se ejecuta el procidimiento 
			oci_execute($stid);
		}

		public function procedimiento4($c1){
			//$c1: numero de reserva
			//
			//dsn de la conexion a la base de datos
			$db = Yii::$app->params['awadb'];
			$usuario = Yii::$app->params['usuario'];
			$contrasena = Yii::$app->params['password'];		
			//establece la conexion con la bese de dato AWA
			$conexion = oci_connect($usuario, $contrasena, $db, 'AL32UTF8');						
			//se hace el llamado al procedimietno que trae la informacion de las mesas
			$stid = oci_parse($conexion,"BEGIN PKG_ACOMER_PROCEDURES.SP_ACOMER_VALIDAR_RESERVA(:c1); END;");
			//pasa los parametros del proceimiento
			oci_bind_by_name($stid, ":c1", $c1, 10);
			//se ejecuta el procidimiento 
			oci_execute($stid);

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
