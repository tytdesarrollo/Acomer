<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Gen0011 extends ActiveRecord{
	
	public static function getDb(){
		
		return Yii::$app->usrawa;
	}
	
	public static function tableName(){
	
		return "USR_AWA.GEN0011";
	}
	
}

