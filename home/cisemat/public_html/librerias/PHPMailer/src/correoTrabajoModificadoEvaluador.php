<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


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

// Obtener la fecha actual
$fechaActual = date('Y-m-d');

// Contenido del correo electrónico y configuración de la cuenta para envío de correo
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Actualización de trabajo: " . $tituloPonencia;
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

// Dirección de envío y cuerpo del correo
$mail->AddAddress($evaluadorEmail);
$mail->Body = '
    <h1>Actualización de trabajo</h1>
    <br>
    <p>Estimado(a) evaluador(a),</p>
    <p>Le informamos que la ponencia '.$tituloPonencia.' que tiene asignada ha sido actualizada por el autor el dia: '.$fechaActual.'</p>
    Puede verificar sus asignaciones iniciando sesión en la página del congreso.
                <br><br>
                Me despido de usted esperando contar con su apoyo para realizar la evaluación de manera oportuna.
    <br>
    <p>Atentamente,</p>
    <p>El Comité Organizador del Congreso Internacional de Matemáticas</p>';

// Envío del correo electrónico
if (!$mail->Send()) {
    // Si hay un error en el envío de correo, se muestra un mensaje de error
    echo "Error: " . $mail->ErrorInfo;
} 
