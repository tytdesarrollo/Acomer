<?php 

namespace app\models;
use Yii;
use yii\base\model;


class ValidarFormulario extends model{
	
	public $nombre;
	public $email;
	
	public function rules(){
		
		return [
	["nombre", "required", "message"=>"campo requerido"],
	["nombre", "match", "pattern"=>"/^.{3,50}$/", "message"=>"minimo 3 y maximo 50 caracteres"],
	["nombre", "match", "pattern"=>"/^[0-9a-z]+$/i", "message"=>"solo se aceptan letras y numeros"],
	["email", "required", "message"=>"campo requerido"],
	["email", "match", "pattern"=>"/^.{5,80}$/", "message"=>"minimos de 5 a 80 caracteres"],
	["email", "email", "message"=>"formato no valido"],
		
		];
	}
	
	public function attributeLabels(){
		
		return [
		"nombre"=>"Nombre:",
		"email"=>"Email:"
		];
	}
	
}