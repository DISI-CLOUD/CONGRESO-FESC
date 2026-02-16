<?php
    /** 
    * Este modulo realiza las consultas para los reportes de trabajos de administrador
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    require "traerCongresoActual.php";

    //Hace la consulta de los trabajos disponibles en el congreso
    $consTrabajosRegistrados = "SELECT * FROM ponencia 
    INNER JOIN tipo_ponencia ON ponencia.id_tipo_ponencia=tipo_ponencia.id_tipo_ponencia
    INNER JOIN categoria ON ponencia.id_categoria=categoria.id_categoria
    WHERE ponencia.id_congreso='$idCongreso' ORDER BY SUBSTRING(id_ponencia, 4, 2) ASC, SUBSTRING(id_ponencia, -3) ASC;";
    $resTrabajosRegistrados = mysqli_query($conexion, $consTrabajosRegistrados);


?>