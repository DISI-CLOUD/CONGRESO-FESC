<?php
    /** 
    * Este modulo realiza la comprobación de la fecha para la evaluación de resumenes.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    require "traerCongresoActual.php";
    //Fecha actual
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('Y-m-d');


    //Trae las fechas del congreso de recepcion de resumen
    $consFechaEvaluacionResumen="SELECT * FROM `fecha_congreso` WHERE 
    '$fechaActual' BETWEEN fecha_congreso_inicio AND fecha_congreso_fin AND id_congreso='$idCongreso' AND id_evento='3'";
    //echo "<br>".$consFechaEvaluacionResumen."<br>";
    $resFechaEvaluacionResumen = mysqli_query($conexion, $consFechaEvaluacionResumen);


?>