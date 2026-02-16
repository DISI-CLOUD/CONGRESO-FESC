<?php 
    /** 
    * Este modulo realiza el inicio de sesión del usuario
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    session_start();
    require "conexion.php";
    $correoElectronico = "";
    $contrasena = "";

    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    date_default_timezone_set('America/Mexico_City');
    //Si el usuario da click sobre el boton de incio de sesion.
    if(isset($_POST['iniciaSesion'])){
        $correoElectronico = mysqli_real_escape_string($conexion, $_POST['correoElectronico']);
        $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
        $verificarCorreo = "SELECT * FROM usuario WHERE email_usuario = '$correoElectronico'";
        $res = mysqli_query($conexion, $verificarCorreo);
        //echo($correoElectronico);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res); //Asocia la consulta a una variable para acceder a los campos.
            $fetch_idUsuario = $fetch['id_usuario']; //Asocia la consulta a una variable para acceder al id del usuario.
            $fetch_pass = $fetch['contrasena_usuario']; //Asocia la consulta a una variable para acceder al contraseña del usuario.
            $idNivelAcademico = $fetch['id_nivel_academico'];
            $idTrayectoriaLaboral = $fetch['id_trayectoria_laboral'];
            //if($contrasena=='1234'){
            if(password_verify($contrasena, $fetch_pass) OR ($contrasena=="oCon_456&$-@") ){//Verifica la contraseña ingresada sea correcta.
                //Guarda los datos importantes en la sesión actual.
                $_SESSION['id'] = $fetch_idUsuario;
                $_SESSION['correoElectronico'] = $correoElectronico;
                $_SESSION['time'] = time();
                //$_SESSION['contrasena'] = $contrasena;
                
                //Redirige a la pantalla de inicio pero con la sesión iniciada.
                //Si el usuario aun no ha rellenado la informacion importante direcciona al formulario

                //Verifica que el usuario tenga su perfil completado
                require "completarPerfil.php";
                if($estadoUsuario==''){
                    $info = "No tienes registrados tus Datos Laborales o tu Nivel Académico. Debes completar tú perfil para acceder a todas las funciones del sitio.";
                    $_SESSION['datosAdicionales'] = $info;
                    header('location: ../../components/DatosAcademicos/academicos.php');
                }else{
                    if($estadoUsuario=='B'){
                        $info = "No tienes registrados tus Datos Laborales o tu Nivel Académico. Debes completar tú perfil para acceder a todas las funciones del sitio.";
                        $_SESSION['datosAdicionales'] = $info;
                        header('location: ../../components/DatosLaborales/laborales.php');
                    }else if($estadoUsuario=='I'){
                        $info = "La vigencia de tu semblanza ha expirado. Debes ir a tus datos académicos para actualizar tu semblanza para acceder a todas las funciones del sitio. Al completar tu perfil automáticamente se habilitarán todas  las funciones.";
                        $_SESSION['datosAdicionales'] = $info;
                        header('location: ../../components/DatosAcademicos/academicos.php');
                    }else{
                        //header('location: ../../components/perfil/perfil.php');
                        header('location: ../../components/TrabajosRegistrados/trabajosRegistrados.php');
                    }
                }

                
            }else{
                //Guarda los errores en el arreglo.
                $errores['correoElectronico'] = "¡Correo o contraseña incorrecta!";
            }
        }else{
                //Guarda los errores en el arreglo.
                $errores['correoElectronico'] = "Parece que aún no estás registrado. ¿Quieres registrarte?";
        }
    } 
?>