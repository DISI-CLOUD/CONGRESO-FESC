<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../conexion.php";
require "../../librerias/PHPMailer/src/Exception.php";
require "../../librerias/PHPMailer/src/PHPMailer.php";
require "../../librerias/PHPMailer/src/SMTP.php";
require "../../librerias/PHPMailer/src/traerCorreoCongreso.php";

// Configuración de la clase PHPMailer para el envío de correo utilizando SMTP
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$email= $correoCongreso;
$mail->Username = $email;
$mail->Password = $hashContra;
$mensaje = '';

// Obtener ID de la ponencia a eliminar
$idPonencia = $_GET['id'];
echo "</p> id_Ponencia = ".$idPonencia."</p>";

// Consulta para obtener el id_congreso
$consultaCongreso = "SELECT max(id_congreso) AS id_congreso FROM congreso";
$resultadoCongreso = mysqli_query($conexion, $consultaCongreso);
$fetchCongreso = mysqli_fetch_assoc($resultadoCongreso);
$idCongreso = $fetchCongreso['id_congreso'];
echo "<p>idCongreso = ".$idCongreso."</p>";

// Consulta para obtener id_usuario del autor
$consultaAutor = "SELECT id_usuario_registra FROM ponencia WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
$resultadoAutor = mysqli_query($conexion, $consultaAutor);
echo "<p>resultado autor = ".$consultaAutor."</p>";
$resultadoAutor1 = mysqli_query($conexion, $consultaAutor);
$fetchAutor = mysqli_fetch_assoc($resultadoAutor1);
$idAutorClave = $fetchAutor['id_usuario_registra'];

echo "<p>idAutorClave = ".$idAutorClave."</p>";

if ($filaAutor = mysqli_fetch_assoc($resultadoAutor)) {
    $idUsuarioAutor = $filaAutor['id_usuario_registra'];
    
    // Consulta para obtener email_usuario del autor
    $consultaEmailAutor = "SELECT email_usuario FROM usuario WHERE id_usuario='$idUsuarioAutor'";
    $resultadoEmailAutor = mysqli_query($conexion, $consultaEmailAutor);
    
    if ($filaEmailAutor = mysqli_fetch_assoc($resultadoEmailAutor)) {
        $autorEmail = $filaEmailAutor['email_usuario'];
    }
}

/* --------------------------------------------  Consultas para describir los datos de la ponencia -------------------------------------- */
$consultaPonencia = "SELECT * FROM ponencia WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
$fetchPonencia = mysqli_query($conexion, $consultaPonencia);
$datosPonencia = mysqli_fetch_assoc($fetchPonencia);

// Traer el nombre de la ponencia
$nombrePonencia = $datosPonencia['titulo_ponencia'];

echo "<p>nombrePonencia = ".$nombrePonencia."</p>";

// Taer el tipo de ponencia
$tPonencia = $datosPonencia['id_tipo_ponencia'];
$tipoP = "SELECT categoria_ponencia FROM tipo_ponencia WHERE id_tipo_Ponencia = '$tPonencia'";
$tipoPon =  mysqli_query($conexion, $tipoP);
$PonRow = mysqli_fetch_assoc($tipoPon);
$tipoPonencia = $PonRow['categoria_ponencia'];

// Traer categoria de ponencia
$cPonencia = $datosPonencia['id_categoria'];
$categoriaP = "SELECT * FROM categoria WHERE id_categoria = '$cPonencia'";
$categoriaPon =  mysqli_query($conexion, $categoriaP);
$PonRow2 = mysqli_fetch_assoc($categoriaPon);
$categoriaPonencia = $PonRow2['categoria'];

// Traer nombre autor
$claveAutor = mysqli_fetch_assoc($resultadoAutor);
$nAutor = "SELECT * FROM usuario WHERE id_usuario = '$idAutorClave'";
$autorDatos = mysqli_query($conexion, $nAutor);
$rowAutor = mysqli_fetch_assoc($autorDatos);
$nombresAutor = $rowAutor['nombres_usuario'];
$apellidosAutor = $rowAutor['apellidos_usuario'];
$nombreFAutor = $nombresAutor . " " . $apellidosAutor;

// Consulta para obtener id_usuario de coautores
$consultaCoautores = "SELECT id_usuario FROM usuario_colabora_ponencia_18012024 WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
echo "</p>".$consultaCoautores."</p>";
$resultadoCoautores = mysqli_query($conexion, $consultaCoautores);

$coautoresEmails = array();
while ($filaCoautor = mysqli_fetch_assoc($resultadoCoautores)) {
    $idUsuarioCoautor = $filaCoautor['id_usuario'];
    
    // Consulta para obtener email_usuario de coautor
    $consultaEmailCoautor = "SELECT email_usuario FROM usuario WHERE id_usuario='$idUsuarioCoautor'";
    $resultadoEmailCoautor = mysqli_query($conexion, $consultaEmailCoautor);
    
    if ($filaEmailCoautor = mysqli_fetch_assoc($resultadoEmailCoautor)) {
        $coautoresEmails[] = $filaEmailCoautor['email_usuario'];
    }
}

// Traer nombre coautores con su correo
$nombreCoautores = array();
foreach($coautoresEmails as $emailDestinatario) {
    $traerNombre = "SELECT nombres_usuario, apellidos_usuario FROM usuario WHERE email_usuario = '$emailDestinatario'";
    $resultadoTraerNombre = mysqli_query($conexion, $traerNombre);
    $fetchCoautores = mysqli_fetch_assoc($resultadoTraerNombre);
    $nombreCoautor = $fetchCoautores['nombres_usuario'];
    $apellidoCoautor = $fetchCoautores['apellidos_usuario'];
    $nombreFCoautor = $nombreCoautor . " " . $apellidoCoautor;
    $nombreCoautores[] = $nombreFCoautor;
}

// Consulta para obtener el título de la ponencia
$consultaTitulo = "SELECT titulo_ponencia FROM ponencia WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
$resultadoTitulo = mysqli_query($conexion, $consultaTitulo);
$titulo = "";

if ($filaTitulo = mysqli_fetch_assoc($resultadoTitulo)) {
    $titulo = $filaTitulo['titulo_ponencia'];
}

echo "</p> Titulo = ".$titulo."</p>";

// Envío de correos electrónicos al autor y coautores
$mail->addAddress($autorEmail); // Agregar al autor

// Envío de correos electrónicos a los coautores
/*
if (!empty($coautoresEmails)) {
    foreach ($coautoresEmails as $destinatario) {
        $mail->addAddress($destinatario);
    }
}
*/
$mensaje .= "Se ha eliminado un trabajo. <b>La eliminación</b> de un trabajo presentado para el Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas con sede en la Facultad de Estudios Superiores Cuautitlán <b>fue exitósa.</b><br><br>";

$mensaje .= "Los detalles del trabajo eliminado se describen a continuación: <ul>";
$mensaje .= "<li><b>Tipo: </b>" . $tipoPonencia . "</li>";
$mensaje .= "<li><b>Categoría: </b>" . $categoriaPonencia . "</li>";
$mensaje .= "<li><b>Clave del trabajo: </b>" . $idPonencia . "</li>";
$mensaje .= "<li><b>Titulo: </b>" . $nombrePonencia . "</li>";
$mensaje .= "<li><b>Autor: </b>" . $nombreFAutor . "</li>";
$mensaje .= "</ul>";

if(!empty($nombreCoautores)){
    if(count($nombreCoautores) > 1){
        $txt = "Con los Coautores:<ul>";
    }
    else{
        $txt = "Con el Coautor:<ul>";
    }
    $mensaje .= "<br>" . $txt;
    // Imprimir coautores
    foreach($nombreCoautores as $nombreC){
        $mensaje .= "<li>" . $nombreC . "</li>";
    }
    $mensaje .= "</ul><br>";
}
        
$mensaje .= "Fecha: " . date('Y-m-d') . "<br><br>";
$mensaje .= "Atentamente,<br><br>";
$mensaje .= "El Comité Organizador del Evento<br>";
$mensaje .= "Por mi Raza Hablará el Espíritu";

$mail->Body = $mensaje;
$mail->Subject = "Se ha eliminado el trabajo " . $nombrePonencia;
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->From = $email;
$mail->FromName = "CISEMAT";
$mail->Send();
$mail->ClearAddresses();


if (isset($_GET['id'])) {
    $idPonencia = $_GET['id'];
    $consBorrarPonenciaColabora = "DELETE FROM usuario_colabora_ponencia_18012024 WHERE id_ponencia='$idPonencia'  and id_congreso='$idCongreso'";
    $consBorrarOral = "DELETE FROM oral WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
    $consBorrarPonencia = "DELETE FROM ponencia WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
    
    //echo "</p> Borrar Ponencia usuario_colabora_ponencia_18012024 = ".$consBorrarPonenciaColabora."</p>";
    //echo "</p> Borrar Ponencia de ponencia = ".$consBorrarPonencia."</p>";

    $resBorrarUsuarioColaboraPonencia = mysqli_query($conexion, $consBorrarPonenciaColabora);
    $resBorrarOral = mysqli_query($conexion, $consBorrarOral);
    $resBorrarPonencia = mysqli_query($conexion, $consBorrarPonencia);

    if ($resBorrarPonencia) {
        // La ponencia se eliminó correctamente
        echo "La ponencia se eliminó correctamente.";
    } else {
        // Error al eliminar la ponencia
        echo "Error al eliminar la ponencia: " . mysqli_error($conexion);
    }
} else {
    // No se proporcionó un ID válido
    echo "ID de ponencia no válido.";
}

$info = "<script>alert(\" Eliminacíón de trabajo exitoso. Se ha enviado un correo electrónico al autor y coautores.\");window.location='../../components/TrabajosRegistrados/trabajosRegistrados.php';</script>";
echo $info;
?>
