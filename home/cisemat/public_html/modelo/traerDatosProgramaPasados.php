<?php

require "conexion.php";
require "traerCongresosPasados.php";

//Hace la consulta de los trabajos disponibles en el congreso PASADO para autor
$consTrabajosRegistrados = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso'";
$resTrabajosRegistrados = mysqli_query($conexion, $consTrabajosRegistrados); 

?> 