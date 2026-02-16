<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'traerCorreoCongreso.php';

// Configuración de la clase PHPMailer para el envío de correo utilizando SMTP
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$email = $correoCongreso;
$mail->Username = $email;
$mail->Password = $hashContra;

// Contenido del correo electrónico y configuración de la cuenta para envío de correo
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Registro de pago rechazado";
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$email2 = '';
$mensaje = '';
$coautoresCadena = '';


// Verificar si el usuario ha iniciado sesión y configurar $_SESSION['correoElectronico']
// ...
// Construcción del mensaje del correo
// if ($_SESSION['correoElectronico'] !== $email2) {
    // Enviar correo al autor principal
    $mail->AddAddress($email_usuario);
    $mensaje .= "Estimado participante del Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas con sede en la Facultad de Estudios Superiores Cuautitlán, le informamos que la validación de su pago ha sido RECHAZADA, por favor ponerse en contacto al correo altamira@unam.mx para recibir indicaciones y validar su pago.<br><br>

        La participación en el congreso y la emisión de las constancias esta sujeta a la validadción del pago. <br><br>";

   

    
    $mensaje .= "Fecha: " . date('Y-m-d') . "<br><br>";
    $mensaje .= "Atte.<br>";
    $mensaje .= "El Comité Organizador del Evento<br>";
    $mensaje .= "Por mi Raza Hablará el Espíritu";
    $mail->Body = $mensaje;
    $mail->Send();
    $mail->ClearAddresses(); // Limpiar las direcciones para el siguiente destinatario
//}


?>
