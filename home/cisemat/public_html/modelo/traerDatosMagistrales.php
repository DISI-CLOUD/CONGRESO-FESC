<?php
    require "conexion.php";
    require "traerCongresoActual.php";

    $magistral = "SELECT * FROM conferencia_magistral WHERE id_congreso='$idCongreso'";
    $resMagistral = mysqli_query($conexion,$magistral);
?>