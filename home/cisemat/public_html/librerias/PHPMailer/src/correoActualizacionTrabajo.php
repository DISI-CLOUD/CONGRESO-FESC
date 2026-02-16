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
$email = $consCongreso;
$mail->Username = $email;
$mail->Password = $hashContra;

// Obtener la fecha actual
$fechaActual = date('Y-m-d');

// Contenido del correo electrónico y configuración de la cuenta para envío de correo
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Modificación de trabajo: " . $titulo;
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

// Dirección de envío y cuerpo del correo
$mail->AddAddress($_SESSION['correoElectronico']);
$mail->Body = '
    <h1>Modificación de trabajo</h1>
    <br>
    <p>Estimado(a) autor(a),</p>
    <p>Le informamos que el trabajo titulado "'.$titulo.'" ha sido modificado.</p>
    <p>Fecha de modificación: '.$fechaActual.'</p>
    <br>
    <p>Atentamente,</p>
    <p>El Comité Organizador del Congreso Internacional de Matemáticas</p>';

// Envío del correo electrónico
if (!$mail->Send()) {
    // Si hay un error en el envío de correo, se muestra un mensaje de error
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Correo enviado exitosamente.";
}
