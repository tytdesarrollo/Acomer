<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
use PDO;
use yii\base\Model;

class TwPcIdentity extends Model{	
	
    public function procedimiento()
    {

	$usuario =  Yii::$app->request->get('usuario');
	$clave = Yii::$app->request->get('clave');
	$operacion = Yii::$app->request->get('operacion');
	$key_act = Yii::$app->request->get('tokenreset');

	// OPERACION L CONSULTA
	// OPERACION C INSERT
	// OPERACION U UPDATE olvidaste contraseña
	// OPERACION T VALIDA TOKEN
	// OPERACION F CREA PASS POR PRIMERA VEZ
	
  $ID_LOGIN= $usuario;
  $IN_PASS= $clave;
  $OPERACION= $operacion;
  $KEY_ACT= $key_act;
  $EMPLOYEE_ID= '';
  $OUTPUT= '';
  $MESSAGE= '';
  
  //LOS BEGIN DEL PROCEDIMIENTO ALMACENADO NO DEBEN CONTENER ESPACIOS ENTRE VARIABLES :, TENERLOS GENERA UN ERROR AL MOMENTO DE ENVIAR PETICIONES AL SERVIDOR
  
		$rows = Yii::$app->telmovil->createCommand("BEGIN TW_PC_IDENTITY (:ID_LOGIN,:IN_PASS,:OPERACION,:KEY_ACT,:EMPLOYEE_ID,:OUTPUT,:MESSAGE); END;");

$rows->bindParam(":ID_LOGIN", $ID_LOGIN, PDO::PARAM_STR);
$rows->bindParam(":IN_PASS", $IN_PASS, PDO::PARAM_STR);
$rows->bindParam(":OPERACION", $OPERACION, PDO::PARAM_STR);
$rows->bindParam(":KEY_ACT", $KEY_ACT, PDO::PARAM_STR);
$rows->bindParam(":EMPLOYEE_ID", $EMPLOYEE_ID, PDO::PARAM_INT,200);
$rows->bindParam(":OUTPUT", $OUTPUT, PDO::PARAM_INT,200);
$rows->bindParam(":MESSAGE", $MESSAGE, PDO::PARAM_STR,200);


$rows->execute();

return $twpcidentity = array($EMPLOYEE_ID,$OUTPUT,$MESSAGE);

	}
	
}