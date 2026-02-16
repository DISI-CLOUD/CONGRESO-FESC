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

if($siguientePaso==1){
  $letrero="EXTENSO : ".$idPonencia ;
}

$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Solicitud de revisión de trabajo - Congreso matemáticas ".$letrero;

//mensaje en html 
$mail->MsgHTML("<h4>Estimado evaluador :<br> <br>
                Le informamos que existe un trabajo en el sitio del congreso de matemáticas que requiere
                ser evaluado por usted (Si ya lo evaluó, favor de omitir este correo), esto es debido a que usted es miembro del comité de evaluación 
                del 'Congreso internacional sobre la enseñanza y aplicación de las matemáticas', a celebrarse en 
                la FES Cuautitlán.<br><br>
                Puede verificar sus asignaciones iniciando sesión en la página del congreso.
                <br><br>
                Me despido de usted esperando contar con su apoyo para realizar la evaluación de manera oportuna.
                <br><br>Atentamente: <br><br>
                El comité organizador
</h4>");
//direccion de envio

$mail->AddAddress ($emailEvaluador);


$mail->IsHTML(true);

$mail->CharSet = 'UTF-8';

if(!$mail->Send()) {
  //si hay un error en el envio de correo se informa
  echo "Error: " . $mail->ErrorInfo;
  
}
?>
