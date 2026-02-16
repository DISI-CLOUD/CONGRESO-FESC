<?php
    /** 
    * Este modulo realiza la actualización del perfil general, que es correo, nombre, apellidos, número
    * telefónico, RFC, y la foto de usuario.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/  
    //Para que no inicie sesion 2 veces
    require "conexion.php";
    require "traerDatosPerfil.php";
    $nombres = "";
    $apellidos = "";
    $rfc = "";
    $telefono = "";
    $correoElectronico = "";
    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    $_SESSION['info']=""; //Muestra la informacion exitosa y los muestra

    //Si el usuario pulso el boton Guardar Datos generales
    if(!empty($_POST['botonGuardar'])){
        //Si el usuario ha cambiado los datos de lo contrario no actualiza
        if($_POST['nombres']!=$nombresUsuario||$_POST['apellidos']!=$apellidosUsuario||$_POST['telefono']!=$telefonoUsuario||$_POST['rfc']!=$rfcUsuario){
            //Muestra si el registro fue exitoso y lo muestra en información.
            $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
            $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
            $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
            $rfc = mysqli_real_escape_string($conexion, $_POST['rfc']);
            ///*
            //Si no hay errores ejecuta el registro.
            if(count($errores) === 0){
                $actualizarUsuario = "UPDATE usuario SET nombres_usuario='$nombres',apellidos_usuario='$apellidos',rfc_usuario='$rfc',telefono_usuario='$telefono' WHERE id_usuario='$_SESSION[id]'";
                $data_check = mysqli_query($conexion, $actualizarUsuario);
            
                if($data_check){
                    //Muestra si el registro fue exitoso y lo muestra en información.
                    $info = "Se han actualizado tus datos.";
                    $_SESSION['info'] = $info;
                    //Vuelve a traer los datos del usuario para mostrarlos en el formulario
                    include("../../modelo/traerDatosPerfil.php");
                }else{
                    $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                }
            }
            
        }else{
            $errores['actualizar-datos-general'] = "¡No has cambiado ningún dato!";
        }
    }


    //Si el usuario pulso el boton de GuardarCorreo
    if(!empty($_POST['botonGuardarCorreo'])){
        //Si el usuario ha cambiado los datos de lo contrario no actualiza
        if($_POST['correoElectronico']!=$emailUsuario){
            
            //Muestra si el registro fue exitoso y lo muestra en información.
            $correoElectronico = mysqli_real_escape_string($conexion, $_POST['correoElectronico']);
            //Si no hay errores ejecuta el registro.
            if(count($errores) === 0){
                $actualizarUsuarioCorreo = "UPDATE usuario SET email_usuario='$correoElectronico' WHERE id_usuario='$_SESSION[id]'";
                $data_check = mysqli_query($conexion, $actualizarUsuarioCorreo);
            
                if($data_check){
                    //Muestra si el registro fue exitoso y lo muestra en información.
                    $info = "Se ha actualizado tu correo electrónico.";
                    $_SESSION['info'] = $info;
                    //Vuelve a traer los datos del usuario para mostrarlos en el formulario
                    include("../../modelo/traerDatosPerfil.php");
                }else{
                    $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                }
            }
        }else{
            $errores['actualizar-datos-general'] = "¡No has cambiado ningún dato!";
        }
    }

    //Si el usuario pulsó el boton de Guardar Imagen
    if(!empty($_POST['botonGuardarFoto'])){
        //Solo acepta formato de imágen
        if($_FILES["inputFotoPerfil"]["type"]=="image/png" || $_FILES["inputFotoPerfil"]["type"]=="image/jpeg"){
            //Rutas
            $ruta="../../src/fotos_usuarios/";
            $fichero=$ruta.basename($_FILES["inputFotoPerfil"]["name"]);
            //Mueve el fichero al servidor
            $nombreImagen="foto_perfil_usuario_".$_SESSION["id"].".jpg";
            $rutaImagen=$ruta.$nombreImagen;
            if(move_uploaded_file($_FILES["inputFotoPerfil"]["tmp_name"],$rutaImagen)){
                if(count($errores) === 0){
                    $actualizarFotoUsuario = "UPDATE usuario SET foto_usuario='../../src/fotos_usuarios/$nombreImagen' WHERE id_usuario='$_SESSION[id]'";
                    $data_check = mysqli_query($conexion, $actualizarFotoUsuario);
                    if($data_check){
                        //Muestra si el registro fue exitoso y lo muestra en información.
                        $info = "Se ha actualizado tu foto de perfil.";
                        $_SESSION['info'] = $info;
                        $_SESSION['foto'] = $rutaImagen;
                        //Vuelve a traer los datos del usuario para mostrarlos en el formulario
                        include("../../modelo/traerDatosPerfil.php");
                    }else{
                        $errores['db-error'] = "Fallo mientras intentaba hacer el subir la foto en la Base.";
                    }
                }
            }else{
                $errores['db-error'] = "Fallo mientras intentaba subir el fichero.";
            }
        }else{
            $errores['usuario-error'] = "¡Sube una imágen en formato válido!";
        }
    }

    //Si el usuario pulso el boton de eliminar foto
    if(!empty($_POST['botonEliminarFoto'])){
        
        //Si no hay errores ejecuta el registro.
        $rutaImagen="../../src/fotos_usuarios/picProfileNull.png"; 
        if(count($errores) === 0){
            $actualizarFotoUsuario = "UPDATE usuario SET foto_usuario='$rutaImagen' WHERE id_usuario='$_SESSION[id]'";
            $data_check = mysqli_query($conexion, $actualizarFotoUsuario);
            
            if($data_check){
                //Muestra si el registro fue exitoso y lo muestra en información.
                $info = "Se ha eliminado tu foto de perfil.";
                $_SESSION['info'] = $info;
                $_SESSION['foto'] = $rutaImagen;
                //Vuelve a traer los datos del usuario para mostrarlos en el formulario
                include("../../modelo/traerDatosPerfil.php");
            }else{
                $errores['db-error'] = "Fallo mientras intentaba eliminar la foto en la Base.";
            }
        }
    }

        /*
        $correoElectronico = mysqli_real_escape_string($conexion, $_POST['correoElectronico']);
        //Si no hay errores ejecuta el registro.
        if(count($errores) === 0){
            $actualizarUsuarioCorreo = "UPDATE usuario SET email_usuario='$correoElectronico' WHERE id_usuario='$_SESSION[id]'";
            $data_check = mysqli_query($conexion, $actualizarUsuarioCorreo);

        if($data_check){
            //Muestra si el registro fue exitoso y lo muestra en información.
            $info = "Se han actualizado tu correo electrónico.";
            $_SESSION['info'] = $info;
            //Vuelve a traer los datos del usuario para mostrarlos en el formulario
            include("../../modelo/traerDatosPerfil.php");
        }else{
            $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
        }
        
    }*/
           
?>
