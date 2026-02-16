<?php
//include '../../../modelo/conexion.php';
// Trae el congreso más reciente
$consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
$resCongreso = mysqli_query($conexion, $consCongreso);
$fetchCongreso = mysqli_fetch_assoc($resCongreso);

// Traer usuario y contraseña
$correoCongreso = $fetchCongreso['correo_congreso'];
?>
