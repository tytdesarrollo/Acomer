<?php

namespace app\models;
use Yii;
use yii\base\Model;
use app\models\TwPcIdentity;


class AsignaForm extends Model
{   
    public $clave;
    public $nuevaclave;

    public function rules()
    {
        return [
			[['clave', 'nuevaclave'], 'required', 'message' => 'Escribe tu clave, es requerida'],							
			
			['clave', 'match', 'pattern' => "/^.{3,15}$/", 'message' => 'Mínimo 3 y máximo 15 caracteres'],
            ['nuevaclave', 'compare', 'compareAttribute' => 'clave', 'message' => 'Las contraseñas no coinciden'],
        ];
    }
	
	public function attributeLabels(){
		
		return [		
		"clave"=>"Nueva contraseña",
		"nuevaclave"=>"Confirma contraseña",
		];
	}
	
	
}