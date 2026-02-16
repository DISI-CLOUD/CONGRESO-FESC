<?php
    /** 
    *******************************************************************************************************
    * Este modulo consulta los datos academicos para rellenarlos en los modulos donde se muestra.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    *******************************************************************************************************
    **/ 

    require "conexion.php";

    $datosAcademicos = "SELECT * FROM nivel_academico";
    $resDatosAcademicos = mysqli_query($conexion, $datosAcademicos);

    $datosAcademicosUsuario = "SELECT * FROM usuario WHERE id_usuario='$_SESSION[id]'";
    $res2 = mysqli_query($conexion, $datosAcademicosUsuario);

    $fetch2 = mysqli_fetch_assoc($res2);

    $nivelAcademicoUsuario=$fetch2['id_nivel_academico'];



?>