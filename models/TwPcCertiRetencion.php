<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class TwPcCertiRetencion extends Model{	
	
    public function procedimiento()
    {
// 35326177
// 52513735
	$usuario = '52513735';
	$año = '2014';
	$certificado = '';
	
  
		$rows = Yii::$app->telmovil->createCommand("BEGIN 
		TW_PC_CERT_INGRESOS1 ( :usuario, :año, :certificado);
		END;");

$rows->bindParam(":usuario", $usuario, PDO::PARAM_STR);
$rows->bindParam(":año", $año, PDO::PARAM_STR);
$rows->bindParam(":certificado", $certificado, PDO::PARAM_STR,20000);




$rows->execute();

return $TwPcCertiRetencion = array($certificado);

	}
	
}