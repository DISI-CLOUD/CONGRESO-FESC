<?php
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\PHPException;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'traerCorreoCongreso.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$email = $correoCongreso;
$mail->Username = $email;
$mail->Password = $hashContra;

$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Recordatorio de evaluación pendiente - " . $idPonencia;

$mail->MsgHTML("<h4>Estimado(a) " . $nombreEvaluador . ":<br><br>
                Por medio del presente, le recordamos que tiene pendiente la evaluación del siguiente trabajo
                registrado en el 'Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas' (CISEMAT):<br><br>
                <b>ID del trabajo:</b> " . $idPonencia . "<br>
                <b>Título:</b> " . $tituloPonencia . "<br>
                <b>Autor:</b> " . $nombrePonente . "<br><br>
                Le solicitamos amablemente realizar la evaluación a la brevedad posible,
                ingresando al sitio del congreso con sus credenciales.<br><br>
                Si ya realizó la evaluación de este trabajo, favor de hacer caso omiso a este correo.<br><br>
                Agradecemos de antemano su valioso apoyo y colaboración.<br><br>
                Atentamente:<br><br>
                El comité organizador
</h4>");

$mail->AddAddress($emailEvaluador);

$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';

if (!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
}
?>
