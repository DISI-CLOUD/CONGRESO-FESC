<?php
/** 
*******************************************************************************************************
* Apartado se actualiza los nuevos recursos del congreso (color, nombre, logos, poster, banner, patrocinadores)
* Cualquier duda o sugerencia:
* @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com y Jayme Ernesto Lin jaymelinbr@gmail.com
*******************************************************************************************************
**/ 
require 'conexion.php';

$nombreCongreso = $_POST["nombre"];

$sql = mysqli_query($conexion, "UPDATE recursos_pagprin SET nombre_congreso = '$nombreCongreso'");
header('location: ../components/paginaPrincipal/paginaPrincipal.php');
?>
