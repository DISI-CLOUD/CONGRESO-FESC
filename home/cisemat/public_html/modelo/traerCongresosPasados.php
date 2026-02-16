<?php
require "conexion.php";
    //Trae los congresos anteriores
    $congresosPasados = "SELECT * FROM congreso ORDER BY id_congreso DESC";
    $resCongresosPasados = mysqli_query($conexion, $congresosPasados);
?>     