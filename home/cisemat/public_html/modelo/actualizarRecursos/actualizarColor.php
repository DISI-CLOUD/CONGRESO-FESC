<?php
/** 
****************************************************************************************************************
* Apartado se actualiza los nuevos recursos del congreso (color, nombre, logos, poster, banner, patrocinadores)
* Cualquier duda o sugerencia:
* @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com y Jayme Ernesto Lin jaymelinbr@gmail.com
****************************************************************************************************************
**/

/* ---------------------------------- ACTUALIZAR PATROCINADORES DEL CONGRESO ----------------------------------------- */

require "../conexion.php";

$colorCongreso = $_POST["color2"];

$sql = mysqli_query($conexion, "UPDATE recursos_pagprin SET color_congreso = '$colorCongreso'");
header('location: ../../components/paginaPrincipal/paginaPrincipal.php');

?>