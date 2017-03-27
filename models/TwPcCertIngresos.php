<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class TwPcCertIngresos extends Model{	

	
    public function procedimiento()
    {
		

	$cod_epl = Yii::$app->session['cedula'];
	$ano = Yii::$app->request->get('ano');
	//$ano = '2014';

	
  $CODIGO_EPL= $cod_epl;
  $ANO_FORMU= $ano;
  $BLOQUE1= '';
  $BLOQUE2= '';

  
		$rows = Yii::$app->telmovil->createCommand("BEGIN TW_PC_CERT_INGRESOS1 (:CODIGO_EPL,:ANO_FORMU,:BLOQUE1,:BLOQUE2);	END;");

$rows->bindParam(":CODIGO_EPL", $CODIGO_EPL, PDO::PARAM_STR);
$rows->bindParam(":ANO_FORMU", $ANO_FORMU, PDO::PARAM_STR);
$rows->bindParam(":BLOQUE1", $BLOQUE1, PDO::PARAM_STR,1000);
$rows->bindParam(":BLOQUE2", $BLOQUE2, PDO::PARAM_STR,1000);

$rows->execute();

return $twpccertingresos = array($BLOQUE1,$BLOQUE2);

	}	
}