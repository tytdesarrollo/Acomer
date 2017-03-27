<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Empleados_basic extends ActiveRecord{
	
	public static function getDb(){
		
		return Yii::$app->telmovil;
	}
	
	public static function tableName(){
	
		return "TALENTOS.EMPLEADOS_BASIC";
	}
	
}

