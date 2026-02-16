<?php
    require "../../modelo/conexion.php";
    require "../../modelo/traerCongresoActual.php";

    $idPonencia=$_GET['id'];
    if($idPonencia==''){
        print "<script>window.location='/cbb/index.php';</script>";
    
    }
    //Trae los datos especificos de la ponencia
    $consPonencia = "SELECT * FROM ponencia WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
    $resPonencia = mysqli_query($conexion, $consPonencia);
    $fetchPonencia=mysqli_fetch_assoc($resPonencia);

    $tituloPonencia= $fetchPonencia['titulo_ponencia']; 


    $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
//echo "<br>Layouts/DetalleResumen : ".$consUsuarioRevisionPonencia."<br>";

    $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
    $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
    //Campos de la revision
    $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
    $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
    $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
    $idRevision=$fetchUsuarioRevisionPonencia['id_revision'];
    $comentarioGeneral=$fetchUsuarioRevisionPonencia['descripcion_general_revision'];

    //Accede a los comentarios de la rubrica
    $consRubrica="SELECT * FROM revision_punto_evaluar WHERE id_revision='$idRevision'";
    $resRubrica=mysqli_query($conexion,$consRubrica);


?>

<div class="container">
    <span class="subtitulos mt-5">Titulo</span><hr>
    <span class="titulo mt-3 mb-5"><?php echo $tituloPonencia; ?></span><!--Nombre de la ponencia-->
    <?php
    
    ?>
    
    <div class="container mt-4"><!--contenedor de las referencias-->
        <?php
            if($descripcionRevisionPonencia!='RESUMEN'){
        ?>
        <span class="subtitulos mt-5 mb-4">No Cumple con</span>
        <ul>

        
        <?php
            if(mysqli_num_rows($resRubrica)>0){
                while ($fetchRubrica=mysqli_fetch_assoc($resRubrica)) {
                    $idPuntoEvaluar=$fetchRubrica['id_punto_evaluar'];
                    $comentarioPunto=$fetchRubrica['comentario_punto_evaluar'];
                    //Accede a los al punto en conreto de la rubrica
                    $consPunto="SELECT * FROM punto_evaluar WHERE id_punto_evaluar='$idPuntoEvaluar'";
                    $resPunto=mysqli_query($conexion,$consPunto);
                    $fetchPunto=mysqli_fetch_assoc($resPunto);
                    $descripcionPuntoEvaluar=$fetchPunto['descripcion_punto_evaluar'];
                    $idPuntoEvaluar=$fetchPunto['id_punto_evaluar'];
                    $estadoPuntoEvaluar=$fetchRubrica['estado_punto_evaluar'];
                    if($estadoPuntoEvaluar=="NO"){
                
        ?>
        
            <li><p class="resumen">PUNTO A EVALUAR</p></li>
            <ul  style="list-style: none;">
                <li><p class="resumen"><?php echo $idPuntoEvaluar.".- ";  echo $descripcionPuntoEvaluar; ?></p></li>
                <p class="resumen text-danger">COMENTARIO: <?php  echo $comentarioPunto; ?></p>
            </ul>
            
        <?php
                    }
                }
            }else{
                ?>
                <p class="resumen">NO HAY COMENTARIOS DISPONIBLES.</p>
                <?php
            }
        ?>
        </ul>
        <?php
        }
    ?>
    </div>
    <span class="subtitulos mt-4">Comentario General</span>
    <div class="container mt-4"><!--contenedor de las referencias--> 
        <ul> 
            <?php
                if($comentarioGeneral!=''){

                
            ?>
                <p class="resumen"><?php echo $comentarioGeneral; ?></p> 
            <?php
                }else{
            ?>
                <p class="resumen">NO HAY COMENTARIOS DISPONIBLES.</p> 
            <?php
            }
            ?>  
        </ul>
    </div>
    
    <div class="row mt-4">
        <div class="d-flex justify-content-start">
            <input type="button" class="btn-azul mt-5 ps-5 pe-5" Value="Regresar" onClick="history.go(-1);">
        </div>
    </div>
</div>