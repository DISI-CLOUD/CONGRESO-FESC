<?php

require "conexion.php";

$consUsuarios="SELECT id_usuario, rfc_usuario, nombres_usuario, apellidos_usuario FROM usuario";
$resUsuario=mysqli_query($conexion,$consUsuarios);

$rolSel = '';
$rol_funcion = '';

$errores = array(); //Es un arreglo que guarda todos los errores y los muestra
$_SESSION['info']=''; //Muestra la informacion exitosa y los muestra

if(!empty($_POST['actualizar'])){
    if(!empty($_POST['buscador'])){
        $idUsuarioSel=$_POST['buscador'];
        $rol_funcion=$_POST['Privilegios'];
        if($rol_funcion=='roles'){
            if(!empty($_POST['rol'])){
                $rolSel=$_POST['rol'];
                switch($rolSel){
                    case 'usuarioNormal':
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=11";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=12";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=13";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=14";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=15";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=20";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=21";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=22";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=31";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=41";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=42";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=43";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=44";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=51";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=52";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    if($enviar){
                        $info = "Se ha asignado el rol exitosamente.";
                        $_SESSION['info'] = $info;
                    }else{
                        $errores['db-error'] = "No se ha podido asignar el rol.";
                    }
                    break;
                    case 'memorias':
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=11";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=12";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=13";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=14";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=15";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=20";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=21";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=22";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=31";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=41";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=42";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=43";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=44";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=51";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=52";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    if($enviar){
                        $info = "Se ha asignado el rol exitosamente.";
                        $_SESSION['info'] = $info;
                    }else{
                        $errores['db-error'] = "No se ha podido asignar el rol.";
                    }
                    break;
                    case 'evaluador':
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=11";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=12";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=13";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=14";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=15";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=20";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=21";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=22";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=31";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=41";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=42";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=43";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=44";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=51";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=52";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizarAsignaciones = "INSERT INTO evaluador(id_usuario, numero_ponencias) VALUES ('$idUsuarioSel','3')"; 
                    $data_check = mysqli_query($conexion, $actualizarAsignaciones);
                    if($enviar){
                        $info = "Se ha asignado el rol exitosamente.";
                        $_SESSION['info'] = $info;
                    }else{
                        $errores['db-error'] = "No se ha podido asignar el rol.";
                    }
                    break;
                    case 'administrador2':
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=11";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=12";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=13";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=14";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=15";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=20";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=21";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=22";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=31";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=41";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=42";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=43";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=44";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=51";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=52";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    if($enviar){
                        $info = "Se ha asignado el rol exitosamente.";
                        $_SESSION['info'] = $info;
                    }else{
                        $errores['db-error'] = "No se ha podido asignar el rol.";
                    }
                    break;
                    case 'administrador1':
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=11";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=12";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=13";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=14";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=15";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=20";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=21";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=22";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=31";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=41";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=42";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=43";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=44";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=51";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=52";
                    $enviar=mysqli_query($conexion,$actualizaRol);
                    $actualizarAsignaciones = "INSERT INTO evaluador(id_usuario, numero_ponencias) VALUES ('$idUsuarioSel','3')"; 
                    $data_check = mysqli_query($conexion, $actualizarAsignaciones);
                    if($enviar){
                        $info = "Se ha asignado el rol exitosamente.";
                        $_SESSION['info'] = $info;
                    }else{
                        $errores['db-error'] = "No se ha podido asignar el rol.";
                    }
                    break;
                }
            }else{
                $rolSel='';
            }
        }
        if($rol_funcion=='funcion'){
            if(!empty($_POST['11'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=11";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=11";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['12'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=12";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=12";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['13'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=13";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=13";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['14'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=14";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=14";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['15'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=15";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=15";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['20'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=20";
                $enviar=mysqli_query($conexion,$actualizaRol);
                $actualizarAsignaciones = "INSERT INTO evaluador(id_usuario, numero_ponencias) VALUES ('$idUsuarioSel','3')"; 
                $data_check = mysqli_query($conexion, $actualizarAsignaciones);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=20";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['21'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=21";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=21";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['22'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=22";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=22";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['31'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=31";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=31";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['41'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=41";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=41";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['42'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=42";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=42";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['43'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=43";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=43";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['44'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=44";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=44";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['51'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=51";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=51";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if(!empty($_POST['52'])){
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='ON' WHERE id_usuario='$idUsuarioSel' AND id_funcion=52";
                $enviar=mysqli_query($conexion,$actualizaRol);
            }else{
                $actualizaRol="UPDATE funcion_usuario SET estado_funcion='OFF' WHERE id_usuario='$idUsuarioSel' AND id_funcion=52";
                $enviar=mysqli_query($conexion,$actualizaRol);      
            }
            if($enviar){
                $info = "Se han actualizado las funciones con exito.";
                $_SESSION['info'] = $info;
            }else{
                $errores['db-error'] = "No se han podido actualizar las funciones.";
            }
  
        }
    }else{
        $errores['db-error'] = "No se ha seleccionado ningun usuario";
    }
}

?>