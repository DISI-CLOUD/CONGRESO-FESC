<?php
    /** 
    *******************************************************************************************************
    * Este modulo consulta la foto del usuario para mostrarlo en los demás apartados donde se requiera
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    *******************************************************************************************************
    **/ 

    require "conexion.php";

    $idUsuario=$_SESSION["id"];

    $rutaFotoUsuario = "SELECT * FROM usuario WHERE id_usuario = '$idUsuario'";
    $res = mysqli_query($conexion, $rutaFotoUsuario);
    //Traemos las variables de la base de datos.
    $fetch = mysqli_fetch_assoc($res); //Asocia la consulta a una variable para acceder a los campos.
    $fetch_fotoUsuario = $fetch['foto_usuario']; //Asocia la consulta a una variable para acceder a la foto del usuario.
    $_SESSION["foto"]=$fetch_fotoUsuario;
?>