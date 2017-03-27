<?php
namespace app\models;

use Yii;
use yii\base\model;

class FormAlumnos extends model{
	
	public $id_alumno;
	public $nombre;
	public $apellidos;
	public $clase;
	public $nota_final;
	
	public function rules(){
		
		return [
		["id_alumno", "integer", "message" => "Id incorrecto"],
		["nombre", "required", "message" => "Campo requerido"],
		["nombre", "match", "pattern" => "/^[a-zαινσϊρ\s]+$/i", "message" =>"solo se aceptan letras"],
		["nombre", "match", "pattern" => "/^.{3,50}$/", "message" => "minimo 3 maximo 50 caracteres"],
		["apellidos", "required", "message" => "Campo requerido"],
		["apellidos", "match", "pattern" => "/^[a-zαινσϊρ\s]+$/i", "message" => "Solo se aceptan letras"],
		["apellidos", "match", "pattern" => "/^.{3,80}$/", "message" => "Minimo 3 maximo 80 caracteres"],
		["clase", "required", "message" => "Campo requerido"],
		["clase", "integer", "message" => "Solo numeros enteros"],
		["nota_final", "required", "message" => "Campo requerido"],
		["nota_final", "number", "message" => "Solo numeros"]
		
		];
		
	}
	
}

?>