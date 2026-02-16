<?php
/** 
    * Este modulo realiza el registro de las nuevas cuentas.
    * Cualquier duda o sugerencia:
    * @author Marco Vargas mvargas750@gmail.com
    **/ 
require '../../modelo/conexion.php';
$errores = array();
session_start();

if(isset($_POST['restablecerContrasena'])){

    $correoElectronico=$_POST["correoElectronico"];
    $caracteres_permitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = 5;
    $hash = substr(str_shuffle($caracteres_permitidos), 0, $longitud); // Se genera codigo de 5 digitos al azar

    $consUsuario="SELECT * FROM usuario WHERE email_usuario = '$correoElectronico'";
    $resUsuario=mysqli_query($conexion,$consUsuario);
    $fetchUsuario=mysqli_fetch_assoc($resUsuario);
    $nombres=$fetchUsuario['nombres_usuario'];
    $apellidos=$fetchUsuario['apellidos_usuario'];
    $id_usuario=$fetchUsuario['id_usuario'];

    if($resUsuario){

        $nuevoCodigo="UPDATE usuario SET hash_usuario='$hash' WHERE id_usuario='$id_usuario'";
        $estCodigo=mysqli_query($conexion,$nuevoCodigo);
                        
        require '../../librerias/PHPMailer/src/correoRecuperacionContrasena.php';
        $info='Se ha enviado el correo de recuperación.';
        //Muestra si el registro fue exitoso y lo muestra en información.
        $_SESSION['info'] = $info;
        header('Location: ../../components/recuperarContrasena/verificacion.php');
        
    }else{
        $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
    }
}
?>    