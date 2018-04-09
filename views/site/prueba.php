<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;
	use app\models\SpMesasFactura;

	AppAsset::register($this);

	$this->title = 'Acomer';
	
		$fn_facturacion = new SpMesasFactura();
        $nombreCliente = $fn_facturacion->procedimiento8('1143265985');

        echo $nombreCliente; echo "<br>";
        
        echo (utf8_encode($nombreCliente));
?>











