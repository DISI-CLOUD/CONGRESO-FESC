<?php
/** 
*******************************************************************************************************
* Apartado se actualiza la nueva contraseña del usuario y verifica que ingrese la nueva correctamente
* Cualquier duda o sugerencia:
* @author Alison Michelle Rubio Garcia allyssonrg@gmail.com
*******************************************************************************************************
**/ 


require "conexion.php";

$errores = array(); //Es un arreglo que guarda todos los errores y los muestra
$_SESSION['info']=""; 

$idUsuario=$_SESSION["id"];


if(!empty($_POST['confirmar'])){

    $consultaIdUsuario = "SELECT * FROM usuario WHERE id_usuario = '$idUsuario'";
    $consultaIdUsuarioRes = mysqli_query($conexion, $consultaIdUsuario);
    $fetchUsuario = mysqli_fetch_assoc($consultaIdUsuarioRes); 
    $contrasenaUsuario=$fetchUsuario['contrasena_usuario'];

    $contrasenaInput=mysqli_real_escape_string($conexion,$_POST['contrasenaActual']);

    if(password_verify($contrasenaInput,$contrasenaUsuario)){ //comprara los parametros 

        $contrasenaNuevaUno=mysqli_real_escape_string($conexion,$_POST['contrasenaUno']);
        $contrasenaNuevaDos=mysqli_real_escape_string($conexion,$_POST['contrasenaDos']);

       
        if($contrasenaNuevaUno==$contrasenaNuevaDos){
            $encpass = password_hash($contrasenaNuevaUno, PASSWORD_BCRYPT);
            $consActualizaContrasena="UPDATE usuario SET contrasena_usuario='$encpass' WHERE id_usuario='$idUsuario'";
            $data_check = mysqli_query($conexion, $consActualizaContrasena);
            if($data_check){
                //Muestra si el registro fue exitoso y lo muestra en información.
                $info = "Se ha actualizado tu nueva contraseña.";
                $_SESSION['info'] = $info;
                      
        }

        }else{
            $errores['db-error'] = "Fallo las contraseñas no coinciden.";
        }



    }else{
        $errores['db-error'] = "Fallo contraseña incorrecta.";
    }

}






?>


