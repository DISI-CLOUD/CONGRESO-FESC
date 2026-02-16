<?php
//session_start();
require '../../modelo/conexion.php';
$errores = array();

if(isset($_POST['verificar'])){
    $hash=$_POST["codigoVerificaion"];
    $contrasena1=$_POST['contrasena'];
    $contrasena2=$_POST['verificarContrasena'];
    

    $consHash="SELECT * FROM usuario WHERE hash_usuario='$hash'";
    $resHash=mysqli_query($conexion,$consHash);

if(mysqli_num_rows($resHash)>0){
    if($contrasena1==$contrasena2){
        $fetchIdUsuario=mysqli_fetch_assoc($resHash);
        $id_usuario=$fetchIdUsuario['id_usuario'];

        $password=$contrasena1;
        $encpass = password_hash($password, PASSWORD_BCRYPT);

        $estContrasena="UPDATE usuario SET contrasena_usuario='$encpass' WHERE id_usuario='$id_usuario'";
        $estContrasena=mysqli_query($conexion,$estContrasena);
        $traerUsuario="SELECT * FROM usuario WHERE id_usuario='$id_usuario'";
        $resUsuario=mysqli_query($conexion,$traerUsuario);  
        $fetchUsuario=mysqli_fetch_assoc($resUsuario);
        $nombres=$fetchUsuario['nombres_usuario'];
        $apellidos=$fetchUsuario['apellidos_usuario'];
        $correoElectronico=$fetchUsuario['email_usuario'];
                if (isset($_SESSION['usuarioNuevo']) && $_SESSION['usuarioNuevo'] == 1) {
                    require '../../librerias/PHPMailer/src/correoVerificacionCuenta.php';
                    $usuarioNuevo = 0;
                }else {
                    require '../../librerias/PHPMailer/src/correoCambioContrasena.php';
                }
        

        $info="¡Tu cuenta se ha verificado con exito! Por favor inicia sesión";
        $_SESSION['info'] = $info;
        
        print "<script>alert(\".$info\");window.location='../../components/inicioSesion/sesion.php';</script>";

    }else{
        $errores['bd-error']="Fallo en verificar su cuenta, por favor verifica tus datos";
    }
}else{
    $errores['bd-error']="Fallo en verificar su cuenta, por favor verifica tus datos";
}

}

?>