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

///contenido del correro electronico y configuracion de la cuenta 
/// para envio de correo
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Subject = "Evaluacion de propuesta";

//mensaje en html 
$mail->MsgHTML("Le informamos con agrado que el Comité Evaluador ha evaluado el RESUMEN de su trabajo y éste ha sido <b>ACEPTADO</b> 
	            para formar parte del Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas.<br><br>
	            Para que sea programada su ponencia es necesario realizar el extenso, cartel o video de su taller y subirlo al sitio del congreso, por ningún motivo se reciben trabajos por otro medio que no sea el sitio del evento.
                <br><br>
                En caso de no subir su trabajo no podrá ser programada su ponencia<br>
                Alumnos de educación media, media superior y superior que participan en las ponencias orales, carteles o talleres no podran ser expositores o ponentes.<br>

				<br>Se adjunta en éste correo la carta de aceptacion de su trabajo.<br><br>
				Esperamos contar con su participación<br>
				Atentamente: El comite organizador ");
//direccon de envio
$mail->AddAddress ($emailAutor);
if(count($coautores)!=0){
    for ($i=0; $i <=count($coautores)-1; $i++) { 
    $nombresCoautor=$coautores[$i]["nombres"];
    $apellidosCoautor=$coautores[$i]["apellidos"];
    $emailCoautor=$coautores[$i]["email"];

    $mail->AddAddress ($emailCoautor,'coautor'.$i);
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
enviarWhatsapp($_tel, "Tu resumen $idPonencia fue ACEPTADO por el Comité Evaluador de CISEMAT.");
$rutaPdf = realpath(__DIR__ . '/../../../cartas/resumen/' . $idPonencia . '.pdf');
if ($rutaPdf) enviarWhatsappPdf($_tel, $rutaPdf, "Carta de aceptación resumen $idPonencia");
if(count($coautores)!=0){
    for ($i=0; $i <=count($coautores)-1; $i++) {
        $_telC = traerTelefonoPorEmail($coautores[$i]["email"], $conexion);
        enviarWhatsapp($_telC, "El resumen $idPonencia en el que participas como coautor fue ACEPTADO por el Comité Evaluador de CISEMAT.");
        if ($rutaPdf) enviarWhatsappPdf($_telC, $rutaPdf, "Carta de aceptación resumen $idPonencia");
    }
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
$mail2->Subject = "Confirmación de evaluación del RESUMEN";

//mensaje en html 
$mail2->MsgHTML("Estimado evaluador. <br><br>Le informamos que la evaluacion del RESUMEN<b> " . $idPonencia . " </b>ha sido exitosa con el estado de<b> " . $evaluacionResumen . "</b>. <br><br>
	            
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

$_telEval = traerTelefonoPorEmail($correoEvaluador, $conexion);
enviarWhatsapp($_telEval, "Evaluación del resumen $idPonencia registrada exitosamente con estado: $evaluacionResumen. Gracias por su apoyo.");

?>
