<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class TwPcCertiLaborales extends Model{	
	
    public function procedimiento()
    {
	// 35326177  USUARIO: vladimir		CONTRASEÑA: TYTcali2016 
	// 52513735  USUARIO: ngaleano		CONTRASEÑA: TYTcali2016

	$usuario = '35326177';
	$tipo = '1';
	$destinatario = 'TELENTOS';
	$bloque = 'A';
	$salida = '';
	
  
		$rows = Yii::$app->telmovil->createCommand("BEGIN 
		TW_PC_CERT_LABORALES1 ( :usuario, :tipo, :destinatario, :bloque, :salida);
		END;");

$rows->bindParam(":usuario", $usuario, PDO::PARAM_STR);
$rows->bindParam(":tipo", $tipo, PDO::PARAM_STR);
$rows->bindParam(":destinatario", $destinatario, PDO::PARAM_STR);
$rows->bindParam(":bloque", $bloque, PDO::PARAM_STR);
$rows->bindParam(":salida", $salida, PDO::PARAM_INT,2000);



$rows->execute();

return $TwPcCertiLaborales = array($salida);

	}
	
}