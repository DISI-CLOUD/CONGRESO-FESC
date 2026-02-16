<?php
    require "../../modelo/conexion.php";
    $idPonencia=$_GET['id'];
    $visualizacion=$_GET['visualizacion'];


    if($idPonencia==''){
        print "<script>window.location='/cbb/index.php';</script>";
    
    }

    // Consulta para obtener el id_congreso
    $consultaCongreso = "SELECT max(id_congreso) AS id_congreso FROM congreso";
    $resultadoCongreso = mysqli_query($conexion, $consultaCongreso);
    $fetchCongreso = mysqli_fetch_assoc($resultadoCongreso);
    $idCongreso = $fetchCongreso['id_congreso'];

    //Trae los datos especificos de la ponencia
    $consPonencia = "SELECT * FROM ponencia WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
    $resPonencia = mysqli_query($conexion, $consPonencia);
    $fetchPonencia=mysqli_fetch_assoc($resPonencia);

    $tituloPonencia= $fetchPonencia['titulo_ponencia'];  
    $idCategoriaPonencia= $fetchPonencia['id_categoria'];
    $idTipoPonencia= $fetchPonencia['id_tipo_ponencia'];
    $idUsuarioRegistra= $fetchPonencia['id_usuario_registra'];
    //Trae los datos especificos de la categoria
    $consCategoria = "SELECT * FROM categoria WHERE id_categoria='$idCategoriaPonencia'";
    $resCategoria = mysqli_query($conexion, $consCategoria);
    $fetchCategoria=mysqli_fetch_assoc($resCategoria);
    $categoriaPonencia=$fetchCategoria['categoria'];
    //Trae los datos especificos del tipo ponencia
    $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
    $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
    $fetchTipoPonencia=mysqli_fetch_assoc($resTipoPonencia); 
    $tipoPonencia=$fetchTipoPonencia['categoria_ponencia'];
    //Consulta los datos del autor
    $consAutor="SELECT * FROM usuario WHERE id_usuario='$idUsuarioRegistra'";
    $resAutor=mysqli_query($conexion,$consAutor);
    $fetchAutor=mysqli_fetch_assoc($resAutor);
    $nombresAutor=$fetchAutor['nombres_usuario'];
    $apellidosAutor=$fetchAutor['apellidos_usuario'];
    //Selecciona solo el primer nombre y el primer apellido y lo junta
    $primerNombreAutor=strtok($nombresAutor," ");
    $primerApellidoAutor=strtok($apellidosAutor," ");
    $nombreAutorFormato=$primerNombreAutor." ".$primerApellidoAutor;
    //Trae los datos de coautores de la ponencia
    $consCoautores = "SELECT * FROM  usuario_colabora_ponencia_18012024 
    INNER JOIN usuario ON usuario_colabora_ponencia_18012024.id_usuario=usuario.id_usuario 
    WHERE usuario_colabora_ponencia_18012024.id_ponencia='$idPonencia' AND usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' ";

//echo "<br>Layouts/DetalleResumen : ".$consCoautores."<br>";

    $resCoautores = mysqli_query($conexion, $consCoautores);
    $coautoresFormato=".";
    $coautores=array();
    if(mysqli_num_rows($resCoautores)>0){
        $coautoresFormato=", ";
        $i=0;
        while($fetchCoautores = mysqli_fetch_assoc($resCoautores)){
            $coautores[$i]['nombres']=$fetchCoautores['nombres_usuario'];
            $coautores[$i]['apellidos']=$fetchCoautores['apellidos_usuario'];
            //Selecciona el primer nombre y primer apellido
            $primerNombreAutor=strtok($coautores[$i]['nombres']," ");
            $primerApellidoAutor=strtok($coautores[$i]['apellidos']," ");
            if(mysqli_num_rows($resCoautores)-1==$i){
                $coautoresFormato=$coautoresFormato.$primerNombreAutor." ".$primerApellidoAutor.".";
            }else{
                $coautoresFormato=$coautoresFormato.$primerNombreAutor." ".$primerApellidoAutor.", ";
            }
            
            $i=$i+1;
        }
    }
    //Contenido de la ponencia
    $resumenPonencia= $fetchPonencia['resumen_ponencia'];
    $referenciaPonencia=$fetchPonencia['referencia_ponencia'];

    

?>

<div class="container">
    <span class="subtitulos mt-5">Titulo</span><hr>
    <span class="titulo mt-3 mb-4"><?php echo $tituloPonencia; ?></span><!--Nombre de la ponencia-->
    <span class="subtitulos mb-3">Tipo de Ponencia</span>
    <span class=" categoria mb-3"><?php echo $tipoPonencia; ?></span><!--tipo de ponencia-->
    <span class="subtitulos mb-3">Categoria</span>
    <span class=" categoria mb-3"><?php echo $categoriaPonencia; ?></span><!--categoria de la ponencia-->
    <?php
    
    if($visualizacion!=2){
        ?>
        <span class="subtitulos mb-3">Autor(es)</span>
    <span class=" resumen mb-3"><?php echo $nombreAutorFormato.$coautoresFormato; ?></span><hr><!--Autor de la ponencia-->
        <?php
    }    
    ?>
    
    <span class="subtitulos mt-3">Resumen</span>
    <div class="container mt-3"><!--contenedor del resumen-->
        <p class="resumen"><?php echo $resumenPonencia; ?></p>
    </div>
    <span class="subtitulos mt-5">Referencias</span>
    <div class="container mt-3"><!--contenedor de las referencias-->
        <p class="resumen"><?php echo $referenciaPonencia; ?></p>
    </div>
    <div class="row mt-4">
        <div class="d-flex justify-content-start">
            <input type="button" class="btn-azul mt-5 ps-5 pe-5" Value="Cerrar" onClick="window.close()">
        </div>
    </div>
</div>