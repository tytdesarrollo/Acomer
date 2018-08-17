<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;
	use app\models\SpMenusPlaza;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$c1 = 'ERMINO MEDIO,SIN CEBOLLA*_SIN VINAGRETA,';
	$c2 = explode(',',$c1);

	var_dump($c2);
	
	
?>








