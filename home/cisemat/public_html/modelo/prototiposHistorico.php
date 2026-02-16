<?php
    /** 
    * Este modulo realiza la consulta de todos los Carteles de todos los congresos
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";

    $tituloPonencia="";
    $idPonencia="";
    $idTipoPonencia="";
    $categoriaPonencia="";
    $idUsuarioEvalua="";

    //Hace la consulta de los trabajos disponibles en el congreso actual para autor
    $consPrototiposHistorico = "SELECT * FROM ponencia
    INNER JOIN prototipo ON ponencia.id_ponencia=prototipo.id_ponencia
    INNER JOIN categoria ON ponencia.id_categoria=categoria.id_categoria
    INNER JOIN tipo_ponencia ON ponencia.id_tipo_ponencia=tipo_ponencia.id_tipo_ponencia
    WHERE ponencia.id_tipo_ponencia='4'
    ORDER BY ponencia.id_ponencia;";
    $resPrototiposHistorico = mysqli_query($conexion, $consPrototiposHistorico);

?>