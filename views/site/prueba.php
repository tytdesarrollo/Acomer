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
<br><br><br><br><br>


<script type="text/javascript">
	swal({
	  title: "Sweet!",
	  text: "Here's a custom image.",
	  imageUrl: "images/thumbs-up.jpg"
	});
</script>

