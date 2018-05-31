<?php
	require_once('../phpmailer/class.phpmailer.php');
	require_once('../phpmailer/class.smtp.php');

	$correo = new PHPMailer();

	$correo->IsSMTP();
	$correo->SMTPAuth = true;
	$correo->SMTPSecure = 'tls';
	$correo->Host = "smtp.gmail.com";
	$correo->Username = "desarrollo1@afqsas.com";
	$correo->Password = "awaafqsas";
	$correo->Port = 25;

	//if(isset($_POST['enviar'])){				// Guardamos en variables los datos enviados
		$nombre = 'tUCHO';
		$email = 'pruebassitemasucc@gmail.com';
		$telefono = '856';
		$mensaje ='probando';
		
		// echo $nombre.'-'.$email.'-'.$telefono.'-'.$mensaje.'- Archivos '.$nombre_archivo.'   '.$tipo_archivo.'   '.$tamano_archivo;
		
		$correo->From = "desarrollo1@afqsas.com"; // Desde donde enviamos (Para mostrar)
		$correo->SetFrom($email, $nombre);
		$correo->AddAddress("carlitosa03@gmail.com", "Arte Cocinas"); 
		$correo->IsHTML(true);
		$correo->Subject = "Cotizacion para ".$nombre; //Asunto
		//Cuerpo del Mensaje
		$correo->MsgHTML("Hola mi nombre es ".$nombre." y estoy interesado en: ".$mensaje." <br><br> Mis datos de contacto son: <br> telefono: ".$telefono.
		" <br> correo electronico: ".$email.". <br><br><br> Muchas Gracias");
		
		// $correo->SMTPDebug = 2;
		
		$correo->Send();
	//}