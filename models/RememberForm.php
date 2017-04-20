<?php

namespace app\models;
use Yii;
use yii\base\Model;

class RememberForm extends Model
{
    public $cedula;

    public function rules()
    {
        return [
			
			["cedula", "required", "message"=>"Escribe tu cedula, es requerido"],
			["cedula", "match", "pattern"=>"/^.{3,20}$/", "message"=>"Minimo 3 y maximo 20 caracteres"],
			["cedula", "match", "pattern"=>"/^[0-9]+$/i", "message"=>"Solo se aceptan números"]		
        ];
    }
	
	public function attributeLabels(){
		
		return [
		"cedula"=>"Escribe tu cédula",
		];
	}


	
}
