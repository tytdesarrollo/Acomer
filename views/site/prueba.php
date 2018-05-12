<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;
	use app\models\SpAdministracion;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$fecha = getdate();
    $hoy = $fecha['mday']."/".$fecha['mon']."/".$fecha['year'];


    $admin = new SpAdministracion();
    $documentos = $admin->procedimiento1("10/05/2018");

    echo substr("asasasaase,",0,-1);

/*
  	for ($i=0 ; $i<count($documentos['NIT']) ; $i++) { 
  		echo $documentos['EMPRESA'][$i]."<br>";

  	}*/

    	
    
    

	
?>












