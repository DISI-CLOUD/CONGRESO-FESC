<?php

require ('../../modelo/conexion.php');

$imagenSQL6 = "SELECT banner_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$traerIMG6 = mysqli_query($conexion, $imagenSQL6);
$rowImagen6 = $traerIMG6->fetch_assoc();
$logo = $rowImagen6['banner_congreso'];

?>
