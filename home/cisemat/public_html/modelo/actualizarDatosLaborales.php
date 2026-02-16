<?php
/** 
*******************************************************************************************************
* Valida la infomacion de trayectoria laboral y actualiza en las tablas
* Cualquier duda o sugerencia:
* @author Alison Michelle Rubio Garcia allyssonrg@gmail.com
*******************************************************************************************************
**/ 


require "conexion.php";
$errores = array(); //Es un arreglo que guarda todos los errores y los muestra
$_SESSION['info']=""; //Muestra la informacion exitosa y los muestra
if(!empty($_POST["botonSubir"])){
    $pais=$_POST["country"];
    //echo $pais;
//Si no hay errores ejecuta el registro.
   $estado = $_POST["city"];
    $institucion = $_POST["institucion"];
   // $institucion=$_POST["institucion"];
   // echo $estado;
     
    if(count($errores) === 0){
        $actualizarDatosLaborales = "UPDATE trayectoria_laboral SET id_pais_trayectoria_laboral='$pais' WHERE id_trayectoria_laboral='$_SESSION[id]'";
        $actualizarDatosLaborales1 = "UPDATE trayectoria_laboral SET id_estado_trayectoria_laboral='$estado' WHERE id_trayectoria_laboral='$_SESSION[id]'";
        $actualizarDatosLaborales2 = "UPDATE trayectoria_laboral SET id_institucion_trayectoria_laboral='$institucion' WHERE id_trayectoria_laboral='$_SESSION[id]'";
        $data_check = mysqli_query($conexion, $actualizarDatosLaborales);
        $data_check1 = mysqli_query($conexion, $actualizarDatosLaborales1);
        $data_check2 = mysqli_query($conexion, $actualizarDatosLaborales2);
        if($data_check){
            //Muestra si el registro fue exitoso y lo muestra en información.
            $info = "Se han actualizado tus datos laborales.";
            $_SESSION['info'] = $info;
            //Vuelve a traer los datos del usuario para mostrarlos en el formulario
           // include("../../modelo/traerTrayectoriaLaboral.php");
            
        }else{
            $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
        }
        if($data_check1){
            //Muestra si el registro fue exitoso y lo muestra en información.
            $info = "Se han actualizado tus datos laborales.";
            $_SESSION['info'] = $info;
            //Vuelve a traer los datos del usuario para mostrarlos en el formulario  
            //include("../../modelo/traerTrayectoriaLaboral.php"); 
        }else{
            $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
        }
        if($data_check2){
            //Muestra si el registro fue exitoso y lo muestra en información.
            $info = "Se han actualizado tus datos academicos.";
            $_SESSION['info'] = $info;
            //Vuelve a traer los datos del usuario para mostrarlos en el formulario
         
            
        }else{
            $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
        }
        require "completarPerfil.php";
        require "completarPerfil.php";
        if($estadoUsuario=='A'){
            $info = "¡Felicitaciones, has completado tu registro! Puedes subir trabajos, asistir a ponencias y modificar tu perfil.";
            $_SESSION['info'] = $info;
        }
      
    }
}

   
?>