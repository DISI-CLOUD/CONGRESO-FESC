<?php

/** 
 ****************************************************************************************************************
 * Apartado se actualiza los ndatoss del congreso (modalidad, correo y contraseña)
 * Cualquier duda o sugerencia:
 * @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com
 ****************************************************************************************************************
 **/

require 'conexion.php';

// Traer ultimo congreso a actualizar
$consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
$resCongreso = mysqli_query($conexion, $consCongreso);
$fetchCongreso = mysqli_fetch_assoc($resCongreso);
// Traer usuario y contraseña
$idCongreso = $fetchCongreso['id_congreso'];

// Traer datos del form
$modalidad = $_POST["modalidadCongreso"];
$correo = $_POST["inputMail"];
$contra = $_POST["inputPass"];

if (!empty($_POST["actModalidad"])) {
    $query = mysqli_query($conexion, "UPDATE congreso SET modalidad_congreso = '$modalidad' WHERE id_congreso = '$idCongreso'");
}

if (!empty($_POST["actCorreo"])) {
    $query = mysqli_query($conexion, "UPDATE congreso SET correo_congreso = '$correo', contra_congreso = '$contra' WHERE id_congreso = '$idCongreso'");
}

header('location: ../components/nuevoCongreso/registrarCongreso.php');

?>