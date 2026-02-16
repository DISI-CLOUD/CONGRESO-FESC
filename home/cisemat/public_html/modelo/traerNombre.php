<?php
/** 
*******************************************************************************************************
* Apartado se actualiza los nuevos recursos del congreso (color, nombre, logos, poster, banner, patrocinadores)
* Cualquier duda o sugerencia:
* @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com y Jayme Ernesto Lin jaymelinbr@gmail.com
*******************************************************************************************************
**/ 
require 'conexion.php';
$nombreSQL = "SELECT nombre_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$traerTXT = mysqli_query($conexion, $nombreSQL);
$rowNombre = $traerTXT->fetch_assoc();
$rutaTXT = $rowNombre['nombre_congreso'];
?>