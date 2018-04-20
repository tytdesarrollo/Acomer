<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;
	use app\models\SpMesasFactura;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$fn_menus = new SpMesasFactura;
    $datosMenus = $fn_menus->procedimiento10(1);

    

	
?>












