<?php

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\PHPException;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'traerCorreoCongreso.php';

//configuracion de la clase phpmailer para envio de correo utilizando

// CORREO PARA EL EVALUADOR

$mail2 = new PHPMailer();
$mail2->IsSMTP();
$mail2->SMTPAuth = true;
$mail2->SMTPSecure = "ssl";
$mail2->Host = "smtp.gmail.com";
$mail2->Port = 465;
$email= $correoCongreso;
$mail2->Username = $email;
$mail2->Password = $hashContra;

///contenido del correro electronico y configuracion de la cuenta 
/// para envio de correo
$mail2->From = $email;
$mail2->FromName = "CISEMAT";
$mail2->Subject = "Confirmación de evaluación del EXTENSO";

//mensaje en html 
$mail2->MsgHTML("Estimado evaluador final. <br><br>Le informamos que la evaluacion del EXTENSO<b> " . $idPonencia . " </b> requiere de su visto bueno para continuar con el proceso de aceptación del trabajo. <br><br>
	            
				Atentamente: El comite organizador ");
//direccon de envio
$correoEvaluador="evaluadorcongreso@cuautitlan.unam.mx";
$mail2->AddAddress ("$correoEvaluador");

///agregar pdf solo utilizar menos de 3megas 
//ya que de lo contrario el archivo se puede corromper
$mail2->IsHTML(true);

$mail2->CharSet = 'UTF-8';

if(!$mail2->Send()) {
//si hay un error en el envio de correo se informa

echo "Error: " . $mail2->ErrorInfo;
}

require_once __DIR__ . '/../../whatsapp/enviarWhatsapp.php';
$_tel = traerTelefonoPorEmail($correoEvaluador, $conexion);
enviarWhatsapp($_tel, "El extenso $idPonencia requiere de su visto bueno para continuar con el proceso de aceptación. Inicie sesión en CISEMAT para revisarlo.");

?>
