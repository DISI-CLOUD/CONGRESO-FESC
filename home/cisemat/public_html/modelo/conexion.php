<?php 
//Conexion con la base de datos.
//echo "Llegue conexion";
$user = "congreso16";
$pass = "<%DbCongress_2023>";
$db = "congreso2023";
$conexion = mysqli_connect("localhost","$user","$pass","$db");
mysqli_set_charset($conexion, "utf8mb4");

?>
