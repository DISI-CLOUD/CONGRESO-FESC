<?php

//En caso de que el autor tenga ponencias
require "../../modelo/trabajosRegistrados.php";
    

    while($fetchTrabajosRegistrados = mysqli_fetch_assoc($resTrabajosRegistrados)){
        $tituloPonencia=$fetchTrabajosRegistrados['titulo_ponencia'];
        $idPonencia=$fetchTrabajosRegistrados['id_ponencia'];
        $idTipoPonencia=$fetchTrabajosRegistrados['id_tipo_ponencia'];
        $idUsuarioEvalua=$fetchTrabajosRegistrados['id_usuario_evalua'];

        //Verificacion de la revision más actual.
        /*
        Esta consulta verifica la revision más reciente y la muestra
        
        SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                                     INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                                     WHERE usuario_revision_ponencia.id_ponencia=3);
        */
        if($idUsuarioEvalua!=""){  
            //Trae el nombre del evaluador
            //Consulta evaluadores
            $consEvaluadores = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
            $resEvaluadores = mysqli_query($conexion, $consEvaluadores);
            $fetchEvaluadores = mysqli_fetch_assoc($resEvaluadores);
            $nombreEvaluador=$fetchEvaluadores['nombres_usuario'];
            //Verifica que tenga revisiones
            $consUsuarioRevisiones = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
            $resUsuarioRevisiones = mysqli_query($conexion, $consUsuarioRevisiones);
            $fetchUsuarioRevisiones = mysqli_fetch_assoc($resUsuarioRevisiones);
            //Consulta la categoria de la ponencia
            $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
            $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
            $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
            $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];  
            //Consulta si tiene registro de revision pero no estatus de aprobado o rechazado
            if(mysqli_num_rows($resUsuarioRevisiones)>0){
                $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso' )";
//echo "<br>Layout/CardEvaluaPendiente/CardTrabajoPendiente - ".$consUsuarioRevisionPonencia."<br>";
                $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                //Campos de la revision
                $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                //Da formato de fecha
                $date = date_create($fechaRevisionPonencia);
                $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");
                //Verifica que tenga Revision pero que no haya sido calificada
                if(($estadoRevisionPonencia=='' || $estadoRevisionPonencia=='F') || ($estadoRevisionPonencia=='NULL')){
                
?>  
<div class="cardPendientePorEvaluar  div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
    <div class="card mb-3 ps-4 pe-4" >
        <div class="container mt-3">
            <div class="card-header header-azul"><!--Elemento de la cabecera de la card de la ponencia-->
                <div class="row header-ponencia ms-2 me-2" >
                    <div class="d-none d-sm-none d-sm-block d-none d-md-none d-lg-block col-lg-2 col-xl-2 m-2 circulo-tipo-azul" id="circulo-tipo-azul">
                    <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
                    </div>
                    <div class="col-lg-10 d-md-block col-md-12 col-sm-12 col-xl-10 m-0">
                        <span class="text-start badge span-ponencia text-wrap" id="">En Proceso de Evaluacion</span>
                        <span class="text-start badge span-ponencia text-wrap" id=""><?php echo $fechaRevisionPonenciaFormato ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title" ><?php echo $tituloPonencia ?></h5><!--Titulo de la Ponencia-->
            <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
            <p class="card-text mb-1">Ponencia</p>
            <div class="divTipoPonencia mb-3">
                <span class="tipoPonencia" ><?php echo $categoriaPonencia ?></span>
            </div>
            <!--
            <p class="card-text mb-1">Evaluador Asignado</p>
            <span class="card-title" id="evaluadorAsignado"><?php echo $nombreEvaluador ?></span>
            -->
            <p class="card-text mt-3 mb-1">Etapa</p>
            <span class="card-title text-uppercase " ><?php echo $descripcionRevisionPonencia; ?></span><!--Etapa en la que se encuentra el trabajo-->
            <div class="mt-3 mb-3"><span class="card-text">Trabajo en proceso de Evaluacion</span></div>
                <div class="col-12 d-flex">
                    <img src="../../src/question.png" class="imgQuestion" alt="">
                    <div class="col-10 ms-2"><span class="textoAdvertencia">No puede eliminar la ponencia ya que tiene asignado un evaluador</span></div>
                </div>
            </div>
        </div>
    </div>


<?php
                }
            }
        }  
    }
?>

<?php
//En caso de que sea couator y tenga ponencias
    

    while($fetchTrabajosRegistradosCoautor = mysqli_fetch_assoc($resTrabajosRegistradosCoautor)){
        $tituloPonencia=$fetchTrabajosRegistradosCoautor['titulo_ponencia'];
        $idPonencia=$fetchTrabajosRegistradosCoautor['id_ponencia'];
        $idTipoPonencia=$fetchTrabajosRegistradosCoautor['id_tipo_ponencia'];
        $idUsuarioEvalua=$fetchTrabajosRegistradosCoautor['id_usuario_evalua'];

        //Verificacion de la revision más actual.
        /*
        Esta consulta verifica la revision más reciente y la muestra
        
        SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                                     INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                                     WHERE usuario_revision_ponencia.id_ponencia=3);
        */
        if($idUsuarioEvalua!=""){  
            //Trae el nombre del evaluador
            //Consulta evaluadores
            $consEvaluadores = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
            $resEvaluadores = mysqli_query($conexion, $consEvaluadores);
            $fetchEvaluadores = mysqli_fetch_assoc($resEvaluadores);
            $nombreEvaluador=$fetchEvaluadores['nombres_usuario'];
            //Verifica que tenga revisiones
            $consUsuarioRevisiones = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia'";
            
            $resUsuarioRevisiones = mysqli_query($conexion, $consUsuarioRevisiones);
            $fetchUsuarioRevisiones = mysqli_fetch_assoc($resUsuarioRevisiones);
            //Consulta la categoria de la ponencia
            $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
            $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
            $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
            $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];  
            //Consulta si tiene registro de revision pero no estatus de aprobado o rechazado
            if(mysqli_num_rows($resUsuarioRevisiones)>0){
                $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia')";

                $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                //Campos de la revision
                $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                //Da formato de fecha
                $date = date_create($fechaRevisionPonencia);
                $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");
                //Verifica que tenga Revision pero que no haya sido calificada
                if($estadoRevisionPonencia=='' || $estadoRevisionPonencia=='F'){
                
?>
<div class="cardPendientePorEvaluar  div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
<div class="card mb-3 ps-4 pe-4" >
    <div class="container mt-3">
    <div class="card-header header-azul"><!--Elemento de la cabecera de la card de la ponencia-->
        <div class="row header-ponencia ms-2 me-2" >
            <div class="d-none d-sm-none d-sm-block d-none d-md-none d-lg-block col-lg-2 col-xl-2 m-2 circulo-tipo-azul" id="circulo-tipo-azul">
            <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
            </div>
            <div class="col-lg-10 d-md-block col-md-12 col-sm-12 col-xl-10 m-0">
                <span class="text-start badge span-ponencia text-wrap" id="">En Proceso de Evaluacion</span>
                <span class="text-start badge span-ponencia text-wrap" id=""><?php echo $fechaRevisionPonenciaFormato ?></span>
            </div>
        </div>
        
    </div>
    </div>
    <div class="card-body">
        <h5 class="card-title" ><?php echo $tituloPonencia ?></h5><!--Titulo de la Ponencia-->
        <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
        <p class="card-text mb-1">Ponencia</p>
        <div class="divTipoPonencia mb-3">
            <span class="tipoPonencia" ><?php echo $categoriaPonencia ?></span>
        </div>
        <!--
        <p class="card-text mb-1">Evaluador Asignado</p>
        <span class="card-title" ><?php echo $nombreEvaluador ?></span>
                -->
        <p class="card-text mt-3 mb-1">Etapa</p>
        <span class="card-title text-uppercase " ><?php echo $descripcionRevisionPonencia; ?></span><!--Etapa en la que se encuentra el trabajo-->
        <div class="mt-3 mb-3"><span class="card-text">Trabajo en proceso de Evaluacion</span></div>
        
            
        <div class="row mt-3 ">
            <div class="col-2 d-flex justify-content-end"><img src="../../src/question.png" class="imgQuestion" alt=""></div>
            <div class="col-10"><span class="textoAdvertencia">No puede eliminar la ponencia ya que tiene asignado un evaluador</span></div>
        </div>
    </div>
</div>
</div>

<?php
                }
            }
        }
    }
?>
<script src="trabajo.js"></script>
