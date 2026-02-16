<?php
require "conexion.php";
require "traerCongresoActual.php";

    /** 
    *******************************************************************************************************
    * Consulta las restricciones del numero de trabajos asignadas al usuario
    *******************************************************************************************************
    No afecta por edición de congreso, aquí puedes incrementar la cantidad de trabajos que puede registrar el usuario
*/
    $consRestriccionTrabajos = "SELECT * FROM trabajos_registrar WHERE id_usuario='$_SESSION[id]'";
    $resRestriccionTrabajos = mysqli_query($conexion, $consRestriccionTrabajos);
    $fetchRestriccionTrabajos = mysqli_fetch_assoc($resRestriccionTrabajos);
    $restriccionCartel=$fetchRestriccionTrabajos['cartel_trabajos_registrar']; 
    $restriccionPonencia=$fetchRestriccionTrabajos['ponencia_trabajos_registrar']; 
    $restriccionTaller=$fetchRestriccionTrabajos['taller_trabajos_registrar']; 
    $restriccionMesa=$fetchRestriccionTrabajos['mesa_redonda_trabajos_registrar']; 
    $restriccionPrototipo=$fetchRestriccionTrabajos['prototipo_trabajos_registrar'];
    $limiteDePonenciasTotales=$fetchRestriccionTrabajos['maximo_trabajos_registrar'];

?>