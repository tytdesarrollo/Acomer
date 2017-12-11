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
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<p>
  <span>Move the mouse over the div.</span>
  <span>&nbsp;</span>
</p>
<div></div>
 
<script>
	var fecha1 = new Date();
	var horaIn = fecha1.getHours();
	var minIn  = fecha1.getMinutes();

	$("div").mousemove(function(event){
		var fecha3 = new Date();
		horaIn = fecha3.getHours();
		minIn  = fecha3.getMinutes();
	});

	function cerrarSesion(){ 
		var fecha2 = new Date();
		var horaAc = fecha2.getHours();
		var minAc  = fecha2.getMinutes();		
		
		if(((minAc-minIn)+(60*(horaAc-horaIn)))>1){
			console.log("cerrando session");
		}
		

	}setInterval(cerrarSesion,1000);
</script>






