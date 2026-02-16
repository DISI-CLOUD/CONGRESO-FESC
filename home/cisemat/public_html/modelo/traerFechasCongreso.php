<?php
    /** 
    *******************************************************************************************************
    * Este modulo trae todas las fechas del congreso.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    *******************************************************************************************************
    **/ 

    require "traerCongresoActual.php";

    $fechasCongreso=array();

    $consFechasCongreso="SELECT * FROM `fecha_congreso` WHERE id_congreso='$idCongreso' ORDER BY id_evento";
    $resFechasCongreso = mysqli_query($conexion, $consFechasCongreso);
    
    $i=1;
    while($fetchFechasCongreso=mysqli_fetch_assoc($resFechasCongreso)){
        $fechasCongreso[$i]['fechaInicio']=$fetchFechasCongreso['fecha_congreso_inicio'];
        $fechasCongreso[$i]['fechaFin']=$fetchFechasCongreso['fecha_congreso_fin'];
        $i=$i+1;
    }

?>