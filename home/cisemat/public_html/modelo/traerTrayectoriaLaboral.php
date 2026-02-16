<?php

/** 
*******************************************************************************************************
* Apartado donde consultas para traer la informacion de la trayectoria laboral
* Cualquier duda o sugerencia:
* @author Alison Michelle Rubio Garcia allyssonrg@gmail.com
*******************************************************************************************************
**/ 

require "conexion.php";

$datosTrayectoriaLaboral = "SELECT * FROM institucion ORDER BY nombre_institucion";
$resTrayectoriaLaboral = mysqli_query($conexion, $datosTrayectoriaLaboral);

$consPais = "SELECT * FROM countries";
$resPais = mysqli_query($conexion, $consPais);

$consEstado = "SELECT * FROM cities";
$resEstado = mysqli_query($conexion, $consEstado);

// Consulta de la institucion del usuario
$considInstitucionUsuario = "SELECT * FROM usuario 
INNER JOIN trayectoria_laboral ON usuario.id_trayectoria_laboral = trayectoria_laboral.id_trayectoria_laboral
INNER JOIN institucion ON trayectoria_laboral.id_institucion_trayectoria_laboral = institucion.id_institucion WHERE id_usuario = ?";
$stmtidInstitucionUsuario = mysqli_prepare($conexion, $considInstitucionUsuario);
mysqli_stmt_bind_param($stmtidInstitucionUsuario, "i", $_SESSION['id']);
mysqli_stmt_execute($stmtidInstitucionUsuario);
$residInstitucionUsuario = mysqli_stmt_get_result($stmtidInstitucionUsuario);
$fetcIdinstitucionUsuario = mysqli_fetch_assoc($residInstitucionUsuario);

$idInstitucionUsuario = null;
if (!empty($fetcIdinstitucionUsuario)) {
    $idInstitucionUsuario = $fetcIdinstitucionUsuario['id_institucion'];
}

// Consulta del pais del usuario
$consPaisUsuario = "SELECT * FROM usuario 
INNER JOIN trayectoria_laboral ON usuario.id_trayectoria_laboral = trayectoria_laboral.id_trayectoria_laboral WHERE id_usuario = ?";
$stmtPaisUsuario = mysqli_prepare($conexion, $consPaisUsuario);
mysqli_stmt_bind_param($stmtPaisUsuario, "i", $_SESSION['id']);
mysqli_stmt_execute($stmtPaisUsuario);
$resIdPaisUsuario = mysqli_stmt_get_result($stmtPaisUsuario);
$fetcIdPaisUsuario = mysqli_fetch_assoc($resIdPaisUsuario);
$idPaisUsuario = $fetcIdPaisUsuario['id_pais_trayectoria_laboral'];

// Consulta del estado donde viene el usuario
$consEstadoUsuario = "SELECT * FROM usuario 
INNER JOIN trayectoria_laboral ON usuario.id_trayectoria_laboral = trayectoria_laboral.id_trayectoria_laboral
INNER JOIN cities ON trayectoria_laboral.id_estado_trayectoria_laboral = cities.id WHERE id_usuario = ?";
$stmtEstadoUsuario = mysqli_prepare($conexion, $consEstadoUsuario);
mysqli_stmt_bind_param($stmtEstadoUsuario, "i", $_SESSION['id']);
mysqli_stmt_execute($stmtEstadoUsuario);
$resIdEstado = mysqli_stmt_get_result($stmtEstadoUsuario);
$fetcIdEstadoUsuario = mysqli_fetch_assoc($resIdEstado);

$datosTrayectoriaUsuario = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmtDatosTrayectoriaUsuario = mysqli_prepare($conexion, $datosTrayectoriaUsuario);
mysqli_stmt_bind_param($stmtDatosTrayectoriaUsuario, "i", $_SESSION['id']);
mysqli_stmt_execute($stmtDatosTrayectoriaUsuario);
$res2 = mysqli_stmt_get_result($stmtDatosTrayectoriaUsuario);
$fetch2 = mysqli_fetch_assoc($res2);
$idTrayectoriaLaboralUsuario = $fetch2['id_trayectoria_laboral'];

$fetch2 = mysqli_fetch_assoc($res2);
?>
