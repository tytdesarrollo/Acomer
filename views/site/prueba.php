<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;
	use app\models\SpMenusPlaza;

	AppAsset::register($this);

	$this->title = 'Acomer';

	
	$fn_menus = new SpMenusPlaza();
	$platos_data = $fn_menus->procedimiento()[3];   


    $platos = array();   
    for($i=0 ; $i <= count($platos_data)-1 ; $i++){
        array_push($platos, $platos_data[$i]["NOMBRE"]);
    }    

    var_dump($platos);
?>










