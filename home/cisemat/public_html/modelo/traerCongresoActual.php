<?php 
    /** 
    * Este modulo realiza la consulta del congreso más reciente, es decir, el que tenga mayor 
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    //Trae el congreso más reciente
    $consCongreso="SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
    $resCongreso = mysqli_query($conexion, $consCongreso);
    $fetchCongreso = mysqli_fetch_assoc($resCongreso);
    $idCongreso=$fetchCongreso['id_congreso'];
    $rutaProvisional =$fetchCongreso['logo_congreso'];
    $correoActual = $fetchCongreso['correo_congreso'];
?>  
