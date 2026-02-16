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
    require 'traerCongresoActual.php';
    if(!empty($_SESSION["id"])){
        $idUsuario=$_SESSION["id"];
    }

    $consCongreso1="SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso)-1 FROM congreso);";
    $resCongreso1 = mysqli_query($conexion, $consCongreso1);
    $fetchCongreso1 = mysqli_fetch_assoc($resCongreso1);
    $idCongreso1=$fetchCongreso1['id_congreso'];

    $datosCosto = "SELECT * FROM costo WHERE id_congreso = ".$idCongreso."";
    $res = mysqli_query($conexion, $datosCosto);

if(mysqli_fetch_array($res)==0){
    $datosCosto1 = "SELECT * FROM costo WHERE id_congreso = ".$idCongreso1."";
    $res = mysqli_query($conexion, $datosCosto1);
}else{
  $res = mysqli_query($conexion, $datosCosto);
}
    
    
    //Traemos las variables de la base de datos.
    //$fetch = mysqli_fetch_assoc($res); //Asocia la consulta a una variable para acceder a los campos.
    //Asocia la consulta a una variable para acceder a la foto del usuario.

    /*
    $_SESSION["nombres"]=$fetch['nombres_usuario'];
    $_SESSION["apellidos"]=$fetch['apellidos_usuario'];
    $_SESSION["rfc"]=$fetch['rfc_usuario'];
    $_SESSION["email"]=$fetch['email_usuario'];
    $_SESSION["telefono"]=$fetch['telefono_usuario'];
    */
    /*$costo=$fetch['Costo'];
    $descripcion=$fetch['Descripcion'];
    */



?>
