<?php
    /** 
    * Este modulo realiza la consulta de todos los trabajos asignados y el hsitorial del evaluador en el congreso actual.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "traerCongresoActual.php";

    //Trae todas las ponencias que tiene asignado el evaluador en el congreso actual
    $idEvaluador=$_SESSION['id'];
    $consExtensosFinalesAprobados="SELECT * FROM ponencia p,oral o,tipo_ponencia t,categoria c 
                                   WHERE o.id_congreso='$idCongreso' AND
                                   o.id_usuario_evalua_final='$idEvaluador' AND 
                                   p.id_ponencia=o.id_ponencia AND
                                   p.id_congreso=o.id_congreso AND
                                   p.id_tipo_ponencia =t.id_tipo_ponencia AND
                                   p.id_categoria=c.id_categoria  ";
//echo "<br> modelo/extensosFinalesAprobados : ".$consExtensosFinalesAprobados."<br>";

    $resExtensosFinalesAprobados=mysqli_query($conexion,$consExtensosFinalesAprobados);
?>