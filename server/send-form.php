<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("America/Mexico_City");
?>
<?php
	//require 'connect.php'; <----- Activar hasta estar en el servidor y haber creado la base de datos
	require 'phpmailer/PHPMailerAutoload.php';
	require 'phpmailer/class.phpmailer.php';
	require 'phpmailer/class.smtp.php';

	$name=$_POST['nombre'];
	$email=$_POST['email'];
	$phone=$_POST['numero'];
	$message=$_POST['mensaje'];

	$template = file_get_contents('mail.html');
	$template = str_replace('%name%', $name, $template);
	$template = str_replace('%email%', $email, $template);
	$template = str_replace('%phone%', $phone, $template);
	$template = str_replace('%message%', $message, $template);
	
	
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com'; // <---- Servidor proveedor del servicio de emails
		$mail->SMTPAuth = true;
	
		$mail->Username = 'omar.castillo.rosales@gmail.com'; // <---- Email del cliente
		$mail->Password = 'omarcastillo1994'; // <---- Contraseña del email del cliente
		$mail->Port = 587; // <---- Puerto del servidor del servicio de emails
		$mail->SMTPSecure = 'tls'; // <---- Tipo de seguridad
		$mail->From = 'omar.castillo.rosales@gmail.com'; // <---- Email del cliente
		$mail->FromName = 'Nombre del cliente | Nuevo registro'; // <---- Cambiar el nombre del cliente
		$mail->addAddress('omar.castillo.rosales@gmail.com'); // <----- Email a donde llegaran los correos, si se quieren mas correos simplemente agregar otra linea como esta
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = 'Nuevo registro de contacto';
		$mail->Body = $template;

	if(!$mail->Send()) {
		header('Location: ../failure.html');
	} else{
		header('Location: ../index.html');
		// $sql = "INSERT INTO contacto_landing_ (`id`,`nombre`,`email`, `telefono`, `mensaje`, `created_at`) VALUES ('', '$name','$email','$phone','$message');";
		// $saveDB = mysqli_query($db, $sql);  Descomentar esta parte hasta tener la base de datos creada. Cambiar nombre solo de los campos necesarios.
	}
?>