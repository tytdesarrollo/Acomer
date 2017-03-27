<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class PrbUsuario extends Model{	
	
    public function procedimiento()
    {

  $VSALIDA= '';
  
  //LOS BEGIN DEL PROCEDIMIENTO ALMACENADO NO DEBEN CONTENER ESPACIOS ENTRE VARIABLES :, TENERLOS GENERA UN ERROR AL MOMENTO DE ENVIAR PETICIONES AL SERVIDOR
  
		$rows = Yii::$app->usrawa->createCommand("BEGIN PRBUSUARIO (:VSALIDA); END;");


$rows->bindParam(":VSALIDA", $VSALIDA, PDO::PARAM_STR,200);


$rows->execute();

return $prbusuario = array($VSALIDA);

	}
	
}