<?php 
    /** 
    * Este modulo realiza la consulta del congreso más reciente, es decir, el que tenga mayor 
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    //Trae el congreso más reciente
    $consIdEvaluadorFinal="SELECT id_usuario FROM funcion_usuario
    WHERE id_funcion='23' AND estado_funcion='ON';";
    $resIdEvaluadorFinal = mysqli_query($conexion, $consIdEvaluadorFinal);
    $fetchIdEvaluadorFinal = mysqli_fetch_assoc($resIdEvaluadorFinal);
    $idEvaluadorFinal=$fetchIdEvaluadorFinal['id_usuario'];
?>  