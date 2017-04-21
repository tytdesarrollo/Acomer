<?php

namespace app\models;
use Yii;
use yii\base\Model;

class Ldap extends Model{	
	
    public function directorioactivo()
    {

// VARIABLES USUARIO Y CONTRASEÑA
//$usuario = "v.bello";
//$clave = "TYTcali2016";  
	$usuario =  Yii::$app->request->get('usuario');
	$clave = Yii::$app->request->get('clave');

	// DATOS PARA DIRECTORIO ACTIVO
	$directorio01 = "talentos";
	$dominio01 = "local";
	
	//parametro para habilitar el directorio activo, si es "true" esta habilitado y omite base de datos, si es "false" pasa a validar con base de datos
	$directorioactivo = "false";

// DIRECCION PARA CONEXION DIRECTORIO ACTIVO
	@$ldapconn = ldap_connect("192.168.0.195")
    or die("No se pudo conectar con el servidor LDAP.");

	if ($ldapconn) {

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); 
	ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
	   
// CADENA PARA CONEXION DEL DIRECTORIO ACTIVO
    @$ldapbind = ldap_bind($ldapconn, $usuario."@".$directorio01.".".$dominio01, $clave);
    
//VALIDA USUARIO Y CONTRASEÑA FUERON RECIBIDOS
	if(isset($usuario) || isset($clave)){
			
// INGRESA A BUSCAR EL USUARIO EN EL DIRECTORIO ACTIVO
    if ($ldapbind) {
	   
		$buscar = "(&(samaccountname=".$usuario.") (objectClass=user)(objectCategory=person) )"; 

		$sr = ldap_search($ldapconn, "dc=$directorio01, dc=$dominio01", $buscar);
		$info = ldap_get_entries($ldapconn, $sr);
		
		$cedula=strtolower($info[0]['mail'][0]);		
						
					}else{
					$errorldap = "Credenciales invalidas, por favor revisa tu usuario y contraseña.";					
					}
			}
			}else{
			$errorldap =  "No se recibieron los datos de usuario y contraseña, intenta de nuevo.";
		}
		
		return $ldapcon = array(@$cedula,@$errorldap,@$directorioactivo);
		
	}
}	
?>