<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$request = Yii::$app->request;

	
?>

<script type="text/javascript">

	formatoMoneda('12540230'); 

	function formatoNumerico(valor){
		var caracter;
		//valor que se retorna
		var valorFinal = '';

		for(var i=0 ; i<valor.length ; i++){						
			
			caracter = valor.charAt(i);

			if(caracter != "."){
				valorFinal = valorFinal + caracter;
			}
			
		}		

		console.log(valorFinal);
		
		
	}

	function formatoMoneda(valor){
		//valor que se retorna
		var valorFinal1 = '';
		var valorFinal2 = '';

		//
		var contadorPos = 1;

		for(var i=valor.length-1 ; i>=0 ; i--){						
			if(contadorPos == 3 && i != 0){
				valorFinal1 = valorFinal1 + valor.charAt(i) + '.';
				contadorPos = 1;
			}else{
				valorFinal1 = valorFinal1 + valor.charAt(i);
				contadorPos++;
			}			
		}		

		for(var i=valorFinal1.length ; i>=0 ; i--){
			valorFinal2 = valorFinal2 + valorFinal1.charAt(i);
		}

	
		console.log(valorFinal2); 
	}
</script>

