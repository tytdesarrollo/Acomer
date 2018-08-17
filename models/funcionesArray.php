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
				if($puestos[$i] !== "0"){
					if($puestos[$i] <= 9){
						$puestosNew[$i] = "0".$puestos[$i];
					}else{
						$puestosNew[$i] = $puestos[$i];
					}
				}
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

		public function arrayAdjuntarDatosVisualizarFacx($array){			
			//array con los datos nuevos
			$arrayProducNew = array();
			$arrayUnidadNew = array();
			$array_ValorNew = array();
			$arrayValIvaNew = array();
			//
			$repetidor = 0;
			$posciones = array();
			//array con los dato antiguos
			$arrayProduc = $array['PRODUCTO'];
			$arrayUnidad = $array['UNIDAD'];
			$array_Valor = $array['VALOR'];
			$arrayValIva = $array['VALOR_IVA'];		
			//tamano del array que llega
			$tamano = sizeof($arrayProduc);
			//recorre el array
			for($i=0 ; $i<$tamano ; $i++){
					//echo $arrayProduc[$i]."<br>";
				for($j=0 ; $j<$tamano ; $j++){					
					// que no sea la misma posicion a comparar					
					if($i !== $j){												
						// si son iguales								
						if($arrayProduc[$i] === $arrayProduc[$j] && $arrayProduc[$i] !== 'YA_REPETIDO'){								
							//auemnta contador de repeticiones
							$repetidor++;					
							// agrega la posicion donde se repite
							array_push($posciones,$j);
							// =se eleimna esa posicion
							$arrayProduc[$j] = "YA_REPETIDO";
						}
					}
				}				

				//si el no tienen ningun repetido 
				if($repetidor === 0){			
					// si no es uno que ya se ha eliminado		
					if((strcmp($arrayProduc[$i],"YA_REPETIDO") !== 0)){
						//se agregan al array
						array_push($arrayProducNew, $arrayProduc[$i]);
						array_push($arrayUnidadNew, $arrayUnidad[$i]);
						array_push($array_ValorNew, $array_Valor[$i]);
						array_push($arrayValIvaNew, $arrayValIva[$i]);
					}
					
				}else{
					//variables que contienen el acumulado
					$agrupaUnidad = $arrayUnidad[$i];
					$agrupa_Valor = $array_Valor[$i];
					$agrupaValiva = $arrayValIva[$i];
					//calculan los valor agrupandolos
					for($k = 0 ; $k < count($posciones) ; $k++){
						$agrupaUnidad = $agrupaUnidad + $arrayUnidad[$posciones[$k]];
						$agrupa_Valor = $agrupa_Valor + $array_Valor[$posciones[$k]];
						$agrupaValiva = $agrupaValiva + $arrayValIva[$posciones[$k]];
					}
					// asignan los valores correspondientes
					array_push($arrayProducNew, $arrayProduc[$i]); 		 
					array_push($arrayUnidadNew, (string)($agrupaUnidad));
					array_push($array_ValorNew, (string)($agrupa_Valor));
					array_push($arrayValIvaNew, (string)($agrupaValiva));
				}

				//se elimina la posicion ya leida
				$arrayProduc[$i] = "YA_REPETIDO";
				
				//se reinicia el repetidor
				$repetidor = 0;
				//se reinicia las posiciones de los repeticioness
				$posciones = array();
			}

			$detalle = array(
                'PRODUCTO' => $arrayProducNew,
                'UNIDAD' => $arrayUnidadNew,
                'VALOR' => $array_ValorNew,
                'VALOR_IVA' => $arrayValIvaNew
            ); 

			return $detalle;
		}

		public function arrayAdjuntarDatosFacturarx($array){			
			//array con los datos nuevos
			$arrayProducNew = array();
			$arrayUnidadNew = array();
			$array_ValorNew = array();			
			//
			$repetidor = 0;
			$posciones = array();
			//array con los dato antiguos
			$arrayProduc = $array[0]['PRODES'];			
			$arrayUnidad = $array[0]['PEDUNI'];
			$array_Valor = $array[0]['PEDVALTUN'];			
			//tamano del array que llega
			$tamano = sizeof($arrayProduc);
			//recorre el array
			for($i=0 ; $i<$tamano ; $i++){
					//echo $arrayProduc[$i]."<br>";
				for($j=0 ; $j<$tamano ; $j++){					
					// que no sea la misma posicion a comparar					
					if($i !== $j){												
						// si son iguales								
						if($arrayProduc[$i] === $arrayProduc[$j] && $arrayProduc[$i] !== 'YA_REPETIDO'){								
							//auemnta contador de repeticiones
							$repetidor++;					
							// agrega la posicion donde se repite
							array_push($posciones,$j);
							// =se eleimna esa posicion
							$arrayProduc[$j] = "YA_REPETIDO";
						}
					}
				}				

				//si el no tienen ningun repetido 
				if($repetidor === 0){			
					// si no es uno que ya se ha eliminado		
					if((strcmp($arrayProduc[$i],"YA_REPETIDO") !== 0)){
						//se agregan al array
						array_push($arrayProducNew, $arrayProduc[$i]);
						array_push($arrayUnidadNew, $arrayUnidad[$i]);
						array_push($array_ValorNew, $array_Valor[$i]);
					}
					
				}else{
					//variables que contienen el acumulado
					$agrupaUnidad = $arrayUnidad[$i];
					$agrupa_Valor = $array_Valor[$i];
					//calculan los valor agrupandolos
					for($k = 0 ; $k < count($posciones) ; $k++){
						$agrupaUnidad = $agrupaUnidad + $arrayUnidad[$posciones[$k]];
						$agrupa_Valor = $agrupa_Valor + $array_Valor[$posciones[$k]];
					}
					// asignan los valores correspondientes
					array_push($arrayProducNew, $arrayProduc[$i]); 		 
					array_push($arrayUnidadNew, (string)($agrupaUnidad));
					array_push($array_ValorNew, (string)($agrupa_Valor));
				}

				//se elimina la posicion ya leida
				$arrayProduc[$i] = "YA_REPETIDO";
				
				//se reinicia el repetidor
				$repetidor = 0;
				//se reinicia las posiciones de los repeticioness
				$posciones = array();
			}

			$detalle[] = array(
                'PRODES' => $arrayProducNew,
                'PEDUNI' => $arrayUnidadNew,
                'PEDVALTUN' => $array_ValorNew                
            ); 

			return $detalle;
		}

		
	} 

