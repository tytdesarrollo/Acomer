<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$request = Yii::$app->request;	

  session_start();
	
	
?>

<script src="/Acomer/web/js/jquery.min.js"></script>



<script type="text/javascript">
    
  var url = 'http://localhost:8000/Acomer/web/index.php?r=site%2Fplaza';
  //url actual
  var urlActual = window.location.href;
  //posicion de los parametros
  var posParams = urlActual.search("%2F");
  //parametros de la url
  var urlParams = urlActual.substring(0,posParams+3);

  console.log(urlParams);



</script>











