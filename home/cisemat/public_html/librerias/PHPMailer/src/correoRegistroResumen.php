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
$mail->Subject = "Registro de trabajo exitoso";
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$email2 = '';
$mensaje = '';
$coautoresCadena = '';


// Verificar si el usuario ha iniciado sesión y configurar $_SESSION['correoElectronico']
// ...
// Construcción del mensaje del correo
if ($_SESSION['correoElectronico'] !== $email2) {
    // Enviar correo al autor principal
    $mail->addAddress($_SESSION['correoElectronico']);
    $mensaje .= "Registro de trabajo exitoso. Has sido registrado como AUTOR en un trabajo presentado para el Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas con sede en la Facultad de Estudios Superiores Cuautitlán.<br><br>";

    $mensaje .= "Los detalles del trabajo se describen a continuación: <ul>";
    $mensaje .= "<li><b>Tipo: </b>" . $tipoPonencia . "</li>";
    $mensaje .= "<li><b>Categoría: </b>" . $nombreCategoria . "</li>";
    $mensaje .= "<li><b>Clave del trabajo: </b>" . $idPonencia . "</li>";
    $mensaje .= "<li><b>Titulo: </b>" . $titulo . "</li>";
    $mensaje .= "<li><b>Autor: </b>" . $nombreAutor . "</li>";
    $mensaje .= "</ul>";

    if(!empty($coautores)){
        if(count($coautores) > 1){
            $txt = "Con los Coautores:";
        }
        else{
            $txt = "Con el Coautor:";
        }
        $mensaje .= "<br>" . $txt;
        // Nombre de Coautores
        foreach ($coautores as $coautor) {
            $nombreCoautor = $coautor['nombres'].' '.$coautor['apellidos'];
            $coautoresCadena .= "<li>" . $nombreCoautor . "</li>";
        }
        $coautoresCadena .= "</ul><br>";
        $mensaje .= $coautoresCadena;
    }
    
    $mensaje .= "Fecha: " . date('Y-m-d') . "<br><br>";
    $mensaje .= "Atentamente,<br><br>";
    $mensaje .= "El Comité Organizador del Evento<br>";
    $mensaje .= "Por mi Raza Hablará el Espíritu";
    $mail->Body = $mensaje;
    $mail->Send();
    $mail->ClearAddresses(); // Limpiar las direcciones para el siguiente destinatario

    require_once __DIR__ . '/../../whatsapp/enviarWhatsapp.php';
    $_tel = traerTelefonoPorEmail($_SESSION['correoElectronico'], $conexion);
    enviarWhatsapp($_tel, "Tu trabajo '$titulo' (clave: $idPonencia) fue registrado en CISEMAT.");
}

$mensaje = "Registro de trabajo exitoso. Has sido registrado como COAUTOR en un trabajo presentado para el Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas con sede en la Facultad de Estudios Superiores Cuautitlán.<br><br>";

$mensaje .= "Los detalles del trabajo se describen a continuación: <ul>";
$mensaje .= "<li><b>Tipo: </b>" . $tipoPonencia . "</li>";
$mensaje .= "<li><b>Categoría: </b>" . $nombreCategoria . "</li>";
$mensaje .= "<li><b>Clave del trabajo: </b>" . $idPonencia . "</li>";
$mensaje .= "<li><b>Titulo: </b>" . $titulo . "</li>";
$mensaje .= "<li><b>Autor: </b>" . $nombreAutor . "</li>";
$mensaje .= "</ul>";

if(!empty($coautores)){
    if(count($coautores) > 1){
        $txt = "Con los Coautores:<ul>";
    }
    else{
        $txt = "Con el Coautor:<ul>";
    }
    $mensaje .= "<br>" . $txt;
    // Imprimir coautores
    foreach($coautores as $coautor){
        $nombreCoautor = $coautor['nombres'].' '.$coautor['apellidos'];
        $mensaje .= "<li>" . $nombreCoautor . "</li>";
    }
    $mensaje .= "</ul><br>";
}

$mensaje .= "Fecha: " . date('Y-m-d') . "<br><br>";
$mensaje .= "Atentamente,<br><br>";
$mensaje .= "El Comité Organizador del Evento<br>";
$mensaje .= "Por mi Raza Hablará el Espíritu";

// Direcciones de envío
$destinatarios = array($_SESSION['correoElectronico']); // Agrega al autor

if (!empty($coautores)) {
    foreach ($coautores as $coautor) {
        $destinatarios[] = $coautor['correoElectronico']; // Agrega a los coautores si existen
    }
}

// Envío del correo electrónico a todos los destinatarios
foreach ($destinatarios as $destinatario) {
    if ($destinatario !== $_SESSION['correoElectronico']) {
        $mail->addAddress($destinatario);
        $mail->Body = $mensaje;
        $mail->Send();
        $mail->ClearAddresses(); // Limpiar las direcciones para el siguiente destinatario
        $_tel = traerTelefonoPorEmail($destinatario, $conexion);
        enviarWhatsapp($_tel, "Tu trabajo '$titulo' (clave: $idPonencia) fue registrado en CISEMAT como coautor.");
    }
}

$info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a su dirección (" . $_SESSION['correoElectronico'] . ") y a la de los coautores (si existen) con la información del registro.";
echo $info;
?>
