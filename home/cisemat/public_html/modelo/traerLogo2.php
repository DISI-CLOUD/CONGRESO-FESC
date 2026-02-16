<?php
/** 
*******************************************************************************************************
* Apartado se actualiza los nuevos recursos del congreso (color, nombre, logos, poster, banner, patrocinadores)
* Cualquier duda o sugerencia:
* @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com y Jayme Ernesto Lin jaymelinbr@gmail.com
*******************************************************************************************************
**/ 
require 'conexion.php';
$imagenSQL6 = "SELECT logo2_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$traerIMG6 = mysqli_query($conexion, $imagenSQL6);
$rowImagen6 = $traerIMG6->fetch_assoc();
$rutaIMG6 = $rowImagen6['logo2_congreso'];
?>