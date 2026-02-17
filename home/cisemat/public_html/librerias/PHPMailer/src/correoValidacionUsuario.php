<?php

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\PHPException;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'traerCorreoCongreso.php';

//configuracion de la clase phpmailer para envio de correo utilizando
//SMT 
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$email = $correoCongreso;
$mail->Username = $email;
$mail->Password = $hashContra;

///contenifdo del correro electronico y configuracion de la cuenta 
/// para envio de correo
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Verificación de correo electronico";
//$mail->AltBody = "Te confirmamos que hemos recibido tu resumen ";

//mensaje en html 
//<img src="/cbb/src/Banner-Oficial.jpg">
$mail->MsgHTML("

                <h1>Bienvenido(a) " . $nombres . " " . $apellidos . "<br></h1>
                <br>
                <h2>Se ha creado tu cuenta de forma exitosa, tu forma de 
                ingreso sera ingresando el siguiente codigo: <br></h2>
                
                <h2><b>" . $hash . "</b></h2> <br>
                
                <h2>Atentamente:<br><br>
                El Comite Organizador del Evento
                <br>
                Por mi Raza Hablará el Espíritu</h2>

                ");
//direccon de envio
$mail->AddAddress($correoElectronico);

$mail->IsHTML(true);

$mail->CharSet = 'UTF-8';

if (!$mail->Send()) {
    //si hay un error en el envio de correo se informa

    echo "Error: " . $mail->ErrorInfo;
} else {
    $usuarioNuevo = 1;
    session_start();
    $_SESSION['usuarioNuevo'] = $usuarioNuevo;
    $info = "Se ha registrado con exito, revise su bandeja de entrada para validar su correo electronico";
}

require_once __DIR__ . '/../../whatsapp/enviarWhatsapp.php';
$_tel = traerTelefonoPorEmail($correoElectronico, $conexion);
enviarWhatsapp($_tel, "Hola $nombres, verifica tu cuenta CISEMAT con el código: $hash");
