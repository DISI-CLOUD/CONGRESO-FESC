<?php
require "conexion.php";

    $consMemoria = "SELECT * FROM memoria WHERE id_congreso='$idCongreso'";
    $resMemoria = mysqli_query($conexion, $consMemoria);
    $fetchMemoria  = mysqli_fetch_assoc($resMemoria);
    

   
    
?>
