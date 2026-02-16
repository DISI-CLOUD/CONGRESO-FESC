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
$mail->Subject = "Verificación de correo electrónico";
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

// Dirección de envío y cuerpo del correo
$mail->AddAddress($correoElectronico);
$mail->Body = '
    <h1>Bienvenido(a) ' . $nombres . ' ' . $apellidos . '</h1>
    <br>
    <h2>Has verificado con éxito tu cuenta. A partir de ahora podrás terminar tu registro en la página.</h2>
    <br>
    <h2>Atentamente:<br><br>
    El Comité Organizador del Evento<br>
    Por mi Raza Hablará el Espíritu</h2>';

// Envío del correo electrónico
if (!$mail->Send()) {
    // Si hay un error en el envío de correo, se muestra un mensaje de error
    echo "Error: " . $mail->ErrorInfo;
} else {
}
