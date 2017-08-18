<?php 

	namespace app\models;
	use Yii;
	use yii\db\ActiveRecord;
	use yii\db\Command;
	use PDO;
	use yii\base\Model;

	Class funcionesArray extends Model{

		public function crearArray($datos){
			//array que se va a llenar 
			$arrayRetornar = Array();
			//cadena que entra y se va a estar modificando
			$cadena = $datos.',';
			//posicion de la coma
			$posComa = strpos($cadena,",");
			//valor que se estara insertando en el array
			$valorCadena;		

			while($posComa !== false){			
				// el valor va desde el primer caracter hasta el ultimo antes de la coma
				$valorCadena = substr($cadena, 0,$posComa);			
				// si la posicion de la coma es dferente de -1 llena el cursor
				if($posComa != false){				
					$arrayRetornar[] = $valorCadena;			
				}
				//se borra los datos que hay detras de la primer coma junto con ella 
				$cadena = substr($cadena, $posComa+1);
				
				// se busca la posicion de la siguiente coma 
				$posComa = strpos($cadena,",");
				
			}

			//retorno el array con los datos 
			return $arrayRetornar;
		}

		public function arrayNuevo($datos){
			//array que se retorna con los datos
			$arrayRetornar;

			foreach ($datos as $key) {
				if(empty($key)){
					// no hace nada
				}else{
					$arrayRetornar[] = $key;
				}
			}

			return $arrayRetornar;
		}

		public function arrayToChar($datos){
			//cadena que va tener los datos del array
			$char = "";
			// ciclo para rellenar la variable char
			foreach ($datos as $key) {
				//anida con los datos nuevos
				$char = $char . $key . ",";
			}
			//elimina la ultima coma
			$char = substr($char, 0,-1);
			//retorna el valor 
			return $char;
		}

		public function arrayTermino($tamano){
			//array del termino que se retorna
			$termino = array();
			//ciclo para llenado del array
			for($i=0 ; $i<$tamano ; $i++){
				//valor en la posicion 
				$termino[] = "";
			}
			//retorna
			return $termino;
		}

		public function arrayPuestos($puestos){
			//array con los puestos que se retorna
			$puestosNew = array();
			//ciclo para llenado del array
			for($i=0 ; $i<sizeof($puestos) ; $i++){
				//valor en la posicion 
				$puestosNew[$i] = "0".$puestos[$i];
			}
			//retorna
			return $puestosNew;
		}

		public function arrayPorPuesto($charpuesto, $charplatos, $charcantidad, $chartermino, $mesa){
			// mesa: 1 -- mesa principal 
			// mesa: 2 -- mesa secundaria 
			// 
			$clase = new funcionesArray();
			
			// convierto las cadenas de texto ingresadas en 
			$arrPuesto = $clase->crearArray($charpuesto);			
			$arrPlatos = $clase->crearArray($charplatos);
			$arrCantidad = $clase->crearArray($charcantidad);
			$arrTermino = $clase->arrayTermino($chartermino);

			// los array que se van a retornar
			$newPuesto = array();
			$newPlatos = array();
			$newCantidad = array();
			$newTermina = array();


			$prueba = 'nunca entro';
			//recorro el array que ingresa para hacer la seleccions
			for($i=0 ; $i<sizeof($arrPuesto) ; $i++){
				//para la mesa principal
				if($mesa === '1'){		
					// los puestos que tiene la mesa principal	    	
			        if ($arrPuesto[$i] === '1' or $arrPuesto[$i] === '2' or $arrPuesto[$i] === '6') {
					    $newPuesto[] = $arrPuesto[$i];
						$newPlatos[] = $arrPlatos[$i];
						$newCantidad[] = $arrCantidad[$i];
						$newTermina[] = $arrTermino[$i];
					}
				}else if($mesa === '2'){					
			    	// los puestos que tiene la mesa secundaria
			       	if ($arrPuesto[$i] === '3' or $arrPuesto[$i] === '4' or $arrPuesto[$i] === '5') {
					    $newPuesto[] = $arrPuesto[$i];
						$newPlatos[] = $arrPlatos[$i];
						$newCantidad[] = $arrCantidad[$i];
						$newTermina[] = $arrTermino[$i];
					}
				        
				}
			}

			return array($newPuesto,$newPlatos,$newCantidad,$newTermina);
			//return array($arrPuesto,$arrPlatos,$arrCantidad,$arrTermino);
			//return array($mesa);
		}		

		
	} 

