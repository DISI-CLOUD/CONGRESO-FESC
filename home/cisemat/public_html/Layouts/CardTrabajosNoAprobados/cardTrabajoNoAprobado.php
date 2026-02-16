<?php
//Si tiene ponencias como Autor
require "../../modelo/trabajosRegistrados.php";
//Restriccion de la fecha de correcion de resumen
require "../../modelo/fechasCorreccionResumen.php";
//require "traerCongresoActual.php";
    

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
            if($fetchUsuarioRevisiones){
                $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";

//echo "<br>1 - Viene de cardTrabajoNoAprobado ".$consUsuarioRevisionPonencia."<br>";

                $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                //Campos de la revision
                $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                //Da formato de fecha
                $date = date_create($fechaRevisionPonencia);
                $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");

                if($estadoRevisionPonencia=='R' || ($descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $estadoRevisionPonencia=='FR')){
                //Consulta la categoria de la ponencia
                $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];  
                //Consulta al autor
                
?>

<div class="cardTrabajoNoAprobado div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
<div class="card mb-3 ps-4 pe-4" >
    <div class="container mt-3">
    <div class="card-header header-rojo"><!--Elemento de la cabecera de la card de la ponencia-->
        
        <div class="row header-ponencia ms-2 me-2" >
            <div class="d-none d-sm-none d-sm-block d-none d-md-none d-lg-block col-lg-2 col-xl-2 m-2 circulo-tipo-rojo" id="circulo-tipo">
            <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
            </div>
            <div class="col-lg-5 d-md-block col-md-12 col-sm-12 col-xl-6 m-0"><span class="text-start badge span-ponencia text-wrap" id="">Trabajo No Aprobado</span></div>
            <div class="col-lg-5 d-md-block col-md-12 col-sm-12 col-xl-4 m-0"><span class="text-start badge span-ponencia text-wrap" id="">
                <?php echo "Revisado : ".$fechaRevisionPonenciaFormato ?></span> </div>
        </div>
        
    </div>
    </div>
    <div class="card-body">
        <h5 class="card-title" id="TituloTrabajo"><?php echo $tituloPonencia ?></h5><!--Titulo de la Ponencia-->
        <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
        <p class="card-text mb-1">Ponencia</p>
        <div class="divTipoPonencia mb-3">
            <span class="tipoPonencia" id="tipoPonencia"><?php echo $categoriaPonencia ?></span>
        </div>
        <!--
        <p class="card-text mb-1">Evaluador Asignado</p>
        <span class="card-title" id="evaluadorAsignado"><?php echo $nombreEvaluador; ?></span>
                -->
        <div class="mt-3 mb-3"><span class="card-text">La ponencia ha sido evaluada y NO APROBADA, solo el autor puede realizar ajustes a la propuesta</span></div>
        <p class="card-text mb-1">Etapa</p>
            <span class="card-title text-uppercase " id=""><?php echo $descripcionRevisionPonencia ?></span><!--Etapa en la que se encuentra el trabajo-->
        <p class="card-text mb-2 mt-3">Observaciones</p>
            <div class="d-grid gap-2">
                <a href="../../components/VisualizacionResumen/visualizacionObservaciones.php?id=<?php echo $idPonencia ?>"><button class="btn-card col-xl-6 col-lg-6 col-md-10 col-sm-12">Ver Detalles</button></a>
            </div>
        <div class="row mt-3 ">
            <div class="col-2 d-flex justify-content-end"><img src="../../src/question.png" class="imgQuestion" alt=""></div>
            <div class="col-10"><span class="textoAdvertencia">No puede eliminar la ponencia ya que tiene asignado un evaluador</span></div>
        </div>
        <?php
            if($descripcionRevisionPonencia=='EXTENSO' || $descripcionRevisionPonencia=='EXTENSO REVISION FINAL' || $descripcionRevisionPonencia=='CARTEL'){
        ?>
            <div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title">Modificar</span><a href="../../components/siguientePaso/siguientePaso.php?id=<?php echo $idPonencia ?>"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>
        
        <?php
            }else{
               
                if(mysqli_num_rows($resFechaCorrecionResumen)>0){

                
                ?>
                <div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title">Modificar</span><a href="../../components/ModificarResumen/ModificaResumen.php?id=<?php echo $idPonencia; ?>"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>
                <?php
                }else{
                    ?>
                    <div class="row mt-3 ">
                        <div class="col-2 d-flex justify-content-end"><img src="../../src/question.png" class="imgQuestion" alt=""></div>
                        <div class="col-10"><span class="textoAdvertencia">Revisa las fechas para la correción de resumenes.</span></div>
                    </div>
                    <?php
                }
            }
        ?>
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
//Si tiene ponencias como coautor
    

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
            $consUsuarioRevisiones = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
            
            $resUsuarioRevisiones = mysqli_query($conexion, $consUsuarioRevisiones);
            $fetchUsuarioRevisiones = mysqli_fetch_assoc($resUsuarioRevisiones);
            if($fetchUsuarioRevisiones){
                $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
//echo "<br>2 - Viene de cardTrabajoNoAprobado ".$consUsuarioRevisionPonencia."<br>";
                $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                //Campos de la revision
                $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                //Da formato de fecha
                $date = date_create($fechaRevisionPonencia);
                $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");                
                if($estadoRevisionPonencia=='R' || ($descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $estadoRevisionPonencia=='FR')){
                //Consulta la categoria de la ponencia
                $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];  
                //Consulta al autor
                
?>

<div class="cardTrabajoNoAprobado div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
<div class="card mb-3 ps-4 pe-4" >
    <div class="container mt-3">
    <div class="card-header header-rojo"><!--Elemento de la cabecera de la card de la ponencia-->
        
        <div class="row header-ponencia ms-2 me-2" >
            <div class="d-none d-sm-none d-sm-block d-none d-md-none d-lg-block col-lg-2 col-xl-2 m-2 circulo-tipo-rojo" id="circulo-tipo">
            <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
            </div>
            <div class="col-lg-5 d-md-block col-md-12 col-sm-12 col-xl-6 m-0"><span class="text-start badge span-ponencia text-wrap" id="">Trabajo No Aprobado</span></div>
            <div class="col-lg-5 d-md-block col-md-12 col-sm-12 col-xl-4 m-0"><span class="text-start badge span-ponencia text-wrap" id=""><?php echo $fechaRevisionPonenciaFormato ?></span> </div>
        </div>
        
    </div>
    </div>
    <div class="card-body">
        <h5 class="card-title" id="TituloTrabajo"><?php echo $tituloPonencia ?></h5><!--Titulo de la Ponencia-->
        <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
        <p class="card-text mb-1">Ponencia</p>
        <div class="divTipoPonencia mb-3">
            <span class="tipoPonencia" ><?php echo $categoriaPonencia ?></span>
        </div>
        <!--
        <p class="card-text mb-1">Evaluador Asignado</p>
        <span class="card-title" ><?php echo $nombreEvaluador; ?></span>
                -->
        <div class="mt-3 mb-3"><span class="card-text">La ponencia ha sido evaluada y NO APROBADA, solo el autor puede realizar ajustes a la propuesta</span></div>
        <p class="card-text mb-1">Etapa</p>
            <span class="card-title text-uppercase " ><?php echo $descripcionRevisionPonencia ?></span><!--Etapa en la que se encuentra el trabajo-->
        <p class="card-text mb-2 mt-3">Observaciones</p>
            <div class="d-grid gap-2">
                <a href="../../components/VisualizacionResumen/visualizacionObservaciones.php?id=<?php echo $idPonencia ?>"><button class="btn-card p-1">Ver Detalles</button></a>
            </div>
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
