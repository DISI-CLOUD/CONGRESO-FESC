<?php 
    /** 
    * Este modulo realiza el registro de las nuevas cuentas.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    *         Marco Vargas mvargas750@gmail.com
    **/  

    //Cierra la sesión si quieres crear una cuenta
    session_start();
    session_unset();
    session_destroy();

    //Inicia la sesión
    session_start();
    require "conexion.php";
    $nombres = "";
    $apellidos = "";
    $correoElectronico = "";
    $rfc = "";
    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    $password=rand(0,100000);

    //Si el usuario pulso el boton registrate
    if(isset($_POST['registrate'])){
        
        $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
        $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
        $correoElectronico = mysqli_real_escape_string($conexion, $_POST['correoElectronico']);
        $rfc = mysqli_real_escape_string($conexion, $_POST['rfc']);
        $fechaActual=date("y-m-d h:i:s");
        $caracteres_permitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud = 5;
        $hash = substr(str_shuffle($caracteres_permitidos), 0, $longitud); // Se genera codigo de 5 digitos al azar

        //Verifica si existe un correo ya registrado y le menciona un error.
        $verificarCorreo = "SELECT * FROM usuario WHERE email_usuario = '$correoElectronico'";
        $res = mysqli_query($conexion, $verificarCorreo);
        if(mysqli_num_rows($res) > 0){
            $errores['email_usuario'] = "¡Este correo ya ha sido registrado!";
        }

        //Verifica si existe un rfc ya registrado y le menciona un error.
        $verificarRFC = "SELECT * FROM usuario WHERE rfc_usuario = '$rfc'";
        $resRFC = mysqli_query($conexion, $verificarRFC);
        if(mysqli_num_rows($resRFC) > 0){
            $errores['rfc_usuario'] = "¡Este RFC ya ha sido registrado!";
        }
        
        //Si no hay errores ejecuta el registro.
        if(count($errores) === 0){
            $fotoUsuarioDefault="../../src/fotos_usuarios/picProfileNull.png";
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $insertarUsuario = "INSERT INTO usuario (nombres_usuario, apellidos_usuario, email_usuario, rfc_usuario, fecha_registro_usuario,contrasena_usuario,foto_usuario, hash_usuario)
                            values('$nombres', '$apellidos', '$correoElectronico', '$rfc', '$fechaActual','$encpass','$fotoUsuarioDefault','$hash')";
            $data_check = mysqli_query($conexion, $insertarUsuario);
        
            //Busca el email del usuario para el id
            $consIdUsuario="SELECT * FROM usuario WHERE email_usuario='$correoElectronico'";
            $resIdUsuario=mysqli_query($conexion,$consIdUsuario);
            $fetchIdUsuario=mysqli_fetch_assoc($resIdUsuario);
            $idUsuario=$fetchIdUsuario['id_usuario'];
            //Inserta sus trabajos por defecto
            $insertarTrabajosRegistrar = "INSERT INTO trabajos_registrar(cartel_trabajos_registrar, ponencia_trabajos_registrar, taller_trabajos_registrar, prototipo_trabajos_registrar, id_usuario, maximo_trabajos_registrar) VALUES ('2','3','1','1','$idUsuario','5')";
            $consTrabajosRegistrar = mysqli_query($conexion, $insertarTrabajosRegistrar);

            //Datos Academicos

            //insert en la tabla de semblanza
            $insertarSemblanza = "INSERT INTO semblanza (id_usuario)
            values('$idUsuario')";
            $resSemblanza = mysqli_query($conexion, $insertarSemblanza); 

            //Trayectoria Laboral
            $consTrayectoria = "INSERT INTO trayectoria_laboral(id_trayectoria_laboral) VALUE('$idUsuario')";
            $resTrayectoria = mysqli_query($conexion, $consTrayectoria); 

            $consTrayectoriausuario="UPDATE usuario  SET id_trayectoria_laboral='$idUsuario' WHERE id_usuario='$idUsuario'";
            $resTrayectoriaLaboral = mysqli_query($conexion, $consTrayectoriausuario);
            
            //Da privilegios de Usuario Normal
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',11,'ON')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);

            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',12,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',13,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',14,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',15,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',20,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',21,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',22,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',31,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',41,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',42,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',43,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',44,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',51,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);
            
            $consPrivilegiosUN="INSERT INTO funcion_usuario (id_usuario, id_funcion, estado_funcion) VALUE ('$idUsuario',52,'OFF')";
            $resPrivilegiosUN=mysqli_query($conexion,$consPrivilegiosUN);

            if($data_check){
                
                
                require '../../librerias/PHPMailer/src/correoValidacionUsuario.php';

                //Muestra si el registro fue exitoso y lo muestra en información.
                $_SESSION['info'] = $info;
                header('Location: ../../components/recuperarContrasena/verificacion.php');
                
            }else{
                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
            }
        }

    }
?>
