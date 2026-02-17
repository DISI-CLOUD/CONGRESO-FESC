<?php

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\PHPException;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//configuracion de la clase phpmailer para envio de correo utilizando
//SMT 
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$email= 'congresomatematicas15@gmail.com';
$mail->Username = $email;
$mail->Password = "rsdxrhmuwdcovefj";

///contenifdo del correro electronico y configuracion de la cuenta 
/// para envio de correo
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Evaluación resumen";

//mensaje en html 
$mail->MsgHTML("Le informamos que el Comité Evaluador ha evaluado el resumen de su propuesta de ponencia<br> 
                determinando que debe corregirse en uno o mas aspectos.<br>
				        <br>El documento PDF adjunto en éste correo contiene las observaciones y comentarios del Comité sobre éstos aspectos que deberá 
                corregir en su trabajo, para ser sometido a una nueva evaluación y pueda subirlo nuevamente.<br>
                Atentamente:<br><br>
                El comite evaluador.");
//direccion de envio


$mail->AddAddress($emailAutor);
if(count($coautores)!=0){
  for ($i=0; $i <=count($coautores)-1; $i++) { 
  $nombresCoautor=$coautores[$i]["nombres"];
  $apellidosCoautor=$coautores[$i]["apellidos"];
  $emailCoautor=$coautores[$i]["email"];

  $mail->AddCC ($emailCoautor,'coautor '.$i);
  //$pdf -> Ln(1);
}
}
///agregar pdf solo utilizar menos de 3megas 
//ya que de lo contrario el archivo se puede corromper
$mail->AddAttachment('../../cartas/resumen/'.$idPonencia.'.pdf' , $idPonencia.'.pdf');
$mail->IsHTML(true);

$mail->CharSet = 'UTF-8';

if(!$mail->Send()) {
  //si hay un error en el envio de correo se informa
  echo "Error: " . $mail->ErrorInfo;
}

require_once __DIR__ . '/../../whatsapp/enviarWhatsapp.php';
$_tel = traerTelefonoPorEmail($emailAutor, $conexion);
enviarWhatsapp($_tel, "Tu resumen $idPonencia requiere correcciones. Revisa tu email para más detalles.");
if(count($coautores)!=0){
    for ($i=0; $i <=count($coautores)-1; $i++) {
        $_telC = traerTelefonoPorEmail($coautores[$i]["email"], $conexion);
        enviarWhatsapp($_telC, "El resumen $idPonencia en el que participas requiere correcciones. Revisa el email del autor.");
    }
}

?>
