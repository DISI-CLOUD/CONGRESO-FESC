<?php
/** 
*******************************************************************************************************
* Apartado se actualiza los nuevos recursos del congreso (color, nombre, logos, poster, banner, patrocinadores)
* Cualquier duda o sugerencia:
* @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com y Jayme Ernesto Lin jaymelinbr@gmail.com
*******************************************************************************************************
**/ 
require 'conexion.php';
$imagenSQL7 = "SELECT cartel_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$traerIMG7 = mysqli_query($conexion, $imagenSQL7);
$rowImagen7 = $traerIMG7->fetch_assoc();
$rutaIMG7 = $rowImagen7['cartel_congreso'];
?>