<?php
require "conexion.php";
require "traerCongresoActual.php";

    /** 
    *******************************************************************************************************
    *******************************************************************************************************
    **/
    /** 
    *******************************************************************************************************
    * Consultas para la generación de códigos de trabajos
    *******************************************************************************************************
    **/ 
    //Consulta el número de carteles del congreso

    
    // $consNumeroCartelesCongreso = "SELECT MAX(id_ponencia) AS max_id FROM ponencia WHERE substring(id_ponencia, 4, 2) = 'CA' AND id_congreso='$idCongreso'";
    $consNumeroCartelesCongreso = "SELECT id_ponencia FROM ponencia WHERE id_congreso = '$idCongreso' AND substring(id_ponencia, 4, 2) = 'CA' ORDER BY CAST(RIGHT(id_ponencia, 3) AS SIGNED) DESC LIMIT 1;";
    $resNumeroCartelesCongreso = mysqli_query($conexion, $consNumeroCartelesCongreso);
    if (mysqli_num_rows($resNumeroCartelesCongreso) > 0) {
        $fetchNumeroCartelesCongreso = mysqli_fetch_assoc($resNumeroCartelesCongreso);
        $idPonenciaCartel = $fetchNumeroCartelesCongreso['id_ponencia'];
    } else {
        $idPonenciaCartel = 'CASM000';
    }
    $numeroCartelesCongreso = (int)substr("$idPonenciaCartel", 7) + 1;
    
    //Consulta el número de ponencias orales del congreso
    
    // $consNumeroPonenciasCongreso = "SELECT MAX(id_ponencia) AS max_id FROM ponencia WHERE substring(id_ponencia, 4, 2) = 'PO' AND id_congreso='$idCongreso'";
    $consNumeroPonenciasCongreso = "SELECT id_ponencia FROM ponencia WHERE id_congreso = '$idCongreso' AND substring(id_ponencia, 4, 2) = 'PO' ORDER BY CAST(RIGHT(id_ponencia, 3) AS SIGNED) DESC LIMIT 1;";
    $resNumeroPonenciasCongreso = mysqli_query($conexion, $consNumeroPonenciasCongreso);
    if (mysqli_num_rows($resNumeroPonenciasCongreso) > 0) {
        $fetchNumeroPonenciasCongreso = mysqli_fetch_assoc($resNumeroPonenciasCongreso);
        $idPonenciaOral = $fetchNumeroPonenciasCongreso['id_ponencia'];
    } else {
        $idPonenciaOral = 'POSM000';
    }
    $numeroPonenciasCongreso = (int)substr("$idPonenciaOral", 7) + 1;
    
    //Consulta el número de talleres del congreso

    // $consNumeroTalleresCongreso = "SELECT MAX(id_ponencia) AS max_id FROM ponencia WHERE substring(id_ponencia, 4, 2) = 'TA' AND id_congreso='$idCongreso'";
    $consNumeroTalleresCongreso = "SELECT id_ponencia FROM ponencia WHERE id_congreso = '$idCongreso' AND substring(id_ponencia, 4, 2) = 'TA' ORDER BY CAST(RIGHT(id_ponencia, 3) AS SIGNED) DESC LIMIT 1;";
    $resNumeroTalleresCongreso = mysqli_query($conexion, $consNumeroTalleresCongreso);
    if (mysqli_num_rows($resNumeroTalleresCongreso) > 0) {
        $fetchNumeroTalleresCongreso = mysqli_fetch_assoc($resNumeroTalleresCongreso);
        $idPonenciaTaller = $fetchNumeroTalleresCongreso['id_ponencia'];
    } else {
        $idPonenciaTaller = 'TASM000';
    }
    $numeroTalleresCongreso = (int)substr("$idPonenciaTaller", 7) + 1;
   
    //Consulta el número de prototipos del congreso

    // $consNumeroPrototiposCongreso = "SELECT MAX(id_ponencia) AS max_id FROM ponencia WHERE substring(id_ponencia, 4, 2) = 'PR' AND id_congreso='$idCongreso'";
    $consNumeroPrototiposCongreso = "SELECT id_ponencia FROM ponencia WHERE id_congreso = '$idCongreso' AND substring(id_ponencia, 4, 2) = 'PR' ORDER BY CAST(RIGHT(id_ponencia, 3) AS SIGNED) DESC LIMIT 1;";
    $resNumeroPrototiposCongreso = mysqli_query($conexion, $consNumeroPrototiposCongreso);
    if (mysqli_num_rows($resNumeroPrototiposCongreso) > 0) {
        $fetchNumeroPrototiposCongreso = mysqli_fetch_assoc($resNumeroPrototiposCongreso);
        $idPonenciaPrototipo = $fetchNumeroPrototiposCongreso['id_ponencia'];
    } else {
        $idPonenciaPrototipo = 'PRSM000';
    }
    $numeroPrototiposCongreso = (int)substr("$idPonenciaPrototipo", 7) + 1;
    /** 
    *******************************************************************************************************
    *******************************************************************************************************
    **/    

?>
