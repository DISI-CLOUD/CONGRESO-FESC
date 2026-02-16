<?php
$conex = mysqli_connect("localhost", "root", "", "bd_congreso_de_matematicas");
// $conex = mysqli_connect("localhost","id18125952_admin","p\0)-*%t~u-t(R86","id18125952_bd_congreso_de_matematicas");

date_default_timezone_set('America/Mexico_City');

require 'pruebaEmail.php';

if ($conex) {
    echo '<script>alert("todo correcto")</script>';
} else {
    echo '<script>alert("ha ocurrido un problema ")</script>';
}

crearCuenta($conex);

//metodo post para realizar la conexion con la base de datos con los id de los campos
// que sea menor a 1 significa que el campo esta vacio 

function crearCuenta($conex)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fechaActual = date("y-m-d h:i:s");
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correoElectronico = $_POST['correoElectronico'];
        $rfc = $_POST['rfc'];
        $consulta = "INSERT INTO usuario(nombres_usuario, apellidos_usuario, email_usuario, rfc_usuario,fecha_registro_usuario) VALUES ('$nombres','$apellidos','$correoElectronico','$rfc','$fechaActual')";
        $resultado = mysqli_query($conex, $consulta);

        if ($resultado) {
            echo '<script>alert("El Usuario ha sido registrado.")</script>';
            $caracteres_permitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longitud = 5;
            $hash = substr(str_shuffle($caracteres_permitidos), 0, $longitud);
            $password = rand(1000, 5000); //Se crea una contrasena random
            $validar = "UPDATE usuario SET contasena_usuario = '$password' , hash_usuario = '$hash' WHERE email_usuario = '$correoElectronico'";
            $respuesta = mysqli_query($conex, $validar);
            require "../../librerias/PHPMailer/src/correoValidacionUsuario.php";
        } else {
            echo '<script>alert("Ocurrió un error inesperado.")</script>';
        }

        /*
        if($consulta){
        echo '<script>alert("El Usuario ha sido registrado.")</script>';
        }else{
            echo '<script>alert("Ocurrió un error inesperado.")</script>';
        }
        */

        


        mysqli_close($conex);
    }
    header('Location: ../inicioSesion/sesion.html');
}
