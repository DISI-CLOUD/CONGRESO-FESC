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
$mail->Subject = "Evaluación extenso";

//mensaje en html 
$mail->MsgHTML("Le informamos que el Comité Evaluador ha evaluado el extenso de su propuesta de ponencia<br> 
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
$mail->AddAttachment('../../cartas/extensos/'.$idPonencia.'.pdf' , $idPonencia.'.pdf');
$mail->IsHTML(true);

$mail->CharSet = 'UTF-8';

if(!$mail->Send()) {
  //si hay un error en el envio de correo se informa
  echo "Error: " . $mail->ErrorInfo;
}

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
$mail2->MsgHTML("Estimado evaluador. <br><br>Le informamos que la evaluacion del EXTENSO<b> " . $idPonencia . " </b>ha sido exitosa con el estado de <b>RECHAZADO</b>. <br><br>
	            
				Atentamente: El comite organizador ");
//direccon de envio
$mail2->AddAddress ($correoEvaluador);

///agregar pdf solo utilizar menos de 3megas 
//ya que de lo contrario el archivo se puede corromper
$mail2->IsHTML(true);

$mail2->CharSet = 'UTF-8';

if(!$mail2->Send()) {
//si hay un error en el envio de correo se informa

echo "Error: " . $mail2->ErrorInfo;
}
?>
