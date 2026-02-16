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
$email= $correoCongreso;
$mail->Username = $email;
$mail->Password = $hashContra;

///contenifdo del correro electronico y configuracion de la cuenta 
/// para envio de correo
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Recuperación de contraseña";
//$mail->AltBody = "Te confirmamos que hemos recibido tu resumen ";

//mensaje en html 
//<img src="/cbb/src/Banner-Oficial.jpg">
$mail->MsgHTML("

                <h1>Hola ". $nombres. " ".$apellidos."<br></h1>
                <br>
                <h2>Lamentamos que hayas olvidado tu contraseña, para reestablecerla o crear una nueva, copia el siguiente codigo en la ventana de verificación <br></h2>
                
                <h2><b>".$hash."</b></h2> <br>
                
                <h2>Atentamente:<br><br>
                El Comite Organizador del Evento
                <br>
                Por mi Raza Hablará el Espíritu</h2>

                ");
//direccon de envio
$mail->AddAddress ($correoElectronico);

$mail->IsHTML(true);

$mail->CharSet = 'UTF-8';

if(!$mail->Send()) {
//si hay un error en el envio de correo se informa

echo "Error: " . $mail->ErrorInfo;
} else {
    $info= "Se ha registrado con exito, revise su bandeja de entrada para validar su correo electronico";
}

?>
