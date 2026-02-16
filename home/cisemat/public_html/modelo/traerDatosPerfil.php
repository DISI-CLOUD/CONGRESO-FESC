<?php
    /** 
    *******************************************************************************************************
    * Guarda los datos del perfil a través de la Session para rellenar el perfil
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    *******************************************************************************************************
    **/ 

    //Para que no inicie sesion 2 veces
    require "conexion.php";

    $idUsuario=$_SESSION["id"];

    $datosPerfilUsuario = "SELECT * FROM usuario WHERE id_usuario = '$idUsuario'";
    $res = mysqli_query($conexion, $datosPerfilUsuario);
    
    //Traemos las variables de la base de datos.
    $fetch = mysqli_fetch_assoc($res); //Asocia la consulta a una variable para acceder a los campos.
    //Asocia la consulta a una variable para acceder a la foto del usuario.

    /*
    $_SESSION["nombres"]=$fetch['nombres_usuario'];
    $_SESSION["apellidos"]=$fetch['apellidos_usuario'];
    $_SESSION["rfc"]=$fetch['rfc_usuario'];
    $_SESSION["email"]=$fetch['email_usuario'];
    $_SESSION["telefono"]=$fetch['telefono_usuario'];
    */
    $nombresUsuario=$fetch['nombres_usuario'];
    $apellidosUsuario=$fetch['apellidos_usuario'];
    $rfcUsuario=$fetch['rfc_usuario'];
    $emailUsuario=$fetch['email_usuario'];
    $telefonoUsuario=$fetch['telefono_usuario'];
    $_SESSION["email"]=$fetch['email_usuario'];



?>