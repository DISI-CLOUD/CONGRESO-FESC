<?php
    /** 
    * Este modulo realiza la comprobación de la fecha para subir resumenes.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    require "traerCongresoActual.php";
    //Fecha actual
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('y-m-d');


    //Trae las fechas del congreso de recepcion de resumen
    $consFechaResumen="SELECT * FROM `fecha_congreso` WHERE 
    '$fechaActual' BETWEEN fecha_congreso_inicio AND fecha_congreso_fin AND id_congreso='$idCongreso' AND id_evento='2'";
    $resFechaResumen = mysqli_query($conexion, $consFechaResumen);


?>