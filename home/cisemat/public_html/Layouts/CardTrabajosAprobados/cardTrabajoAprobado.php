<?php
//Trabajo aprobado del Autor
require "../../modelo/trabajosRegistrados.php";
    

    while($fetchTrabajosRegistrados = mysqli_fetch_assoc($resTrabajosRegistrados)){
        $tituloPonencia=$fetchTrabajosRegistrados['titulo_ponencia'];
        $idPonencia=$fetchTrabajosRegistrados['id_ponencia'];
        $idTipoPonencia=$fetchTrabajosRegistrados['id_tipo_ponencia'];
        $idUsuarioEvalua=$fetchTrabajosRegistrados['id_usuario_evalua'];
        $videoPonencia=$fetchTrabajosRegistrados['video_ponencia'];

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

//echo "<br> cardTrabajoAprobado ".$consUsuarioRevisiones."<br>";                        

            $resUsuarioRevisiones = mysqli_query($conexion, $consUsuarioRevisiones);
            $fetchUsuarioRevisiones = mysqli_fetch_assoc($resUsuarioRevisiones);
            if($fetchUsuarioRevisiones){
                $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso' )";
//echo "<br> cardTrabajoAprobado ".$consUsuarioRevisionPonencia."<br>";                        
                $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                //Campos de la revision
                $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                //Da formato de fecha
                $date = date_create($fechaRevisionPonencia);
                $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");

                if($estadoRevisionPonencia=='A'){
                    //Consulta la categoria de la ponencia
                    $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                    $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                    $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                    $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];  
                    //Consulta al autor
                    if($descripcionRevisionPonencia=='CARTEL'){
                        //Ruta busca cartel
                        $consRutaCartel = "SELECT cartel FROM cartel
                        WHERE id_ponencia='$idPonencia';";
                        $resRutaCartel = mysqli_query($conexion, $consRutaCartel);
                        $fetchRutaCartel=mysqli_fetch_assoc($resRutaCartel);
                        $rutaCartel=$fetchRutaCartel['cartel'];
                    }
                
?>
    <div class="cardTrabajoAprobado div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
    <div class="card mb-3 ps-4 pe-4" >
        <div class="container mt-3">
        <div class="card-header header-verde"><!--Elemento de la cabecera de la card de la ponencia-->
            
            <div class="row header-ponencia ms-2 me-2" >
                <div class="d-none d-sm-none d-sm-block d-none d-md-none d-lg-block col-lg-2 col-xl-2  m-2 circulo-tipo" >
                <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xl-5 m-0"><span class="text-start badge span-ponencia text-wrap" id="">Trabajo Aprobado</span></div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xl-5 m-0"><span class="text-start badge span-ponencia text-wrap" id=""><?php echo $fechaRevisionPonenciaFormato ?></span></div>
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
            <span class="card-title" ><?php echo $nombreEvaluador ?></span>
                -->
            <div class="mt-3 mb-3"><span class="card-text">La ponencia ha sido evaluada APROBADA.</span></div>
            
            <p class="card-text mb-1">Etapa</p>
            <span class="card-title text-uppercase " ><?php echo $descripcionRevisionPonencia ?></span><!--Etapa en la que se encuentra el trabajo-->
            <?php
            if($descripcionRevisionPonencia=='CARTEL' && $rutaCartel!=''){
                ?>
                    <p class="card-text mb-1 mt-3">Cartel</p>
                    <span class="card-title text-uppercase " ><a target='blank' href="<?php echo $rutaCartel; ?>">Ver cartel</a></span><!--Etapa en la que se encuentra el trabajo-->
                <?php
            }
            ?>


            <div class="row mt-4 pb-2">
                <div class="col-2 d-flex justify-content-end"><img src="../../src/question.png" class="imgQuestion" alt=""></div>
                <div class="col-10"><span class="textoAdvertencia">No puede eliminar la ponencia ya que tiene asignado un evaluador</span></div>
            </div>
            <?php
            //if(($descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $videoPonencia=='') || ($descripcionRevisionPonencia=='RESUMEN' && $videoPonencia=='' && $idTipoPonencia=='2')){
            if(($descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $videoPonencia=='') || ($descripcionRevisionPonencia=='RESUMEN' && $estadoRevisionPonencia=='A' && $idTipoPonencia=='2')){
            ?>
            <div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title">Siguiente Paso</span><a href="../../components/siguientePaso/siguientePaso.php?id=<?php echo $idPonencia ?>"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>
            <?php
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
//Trabajo aprobado del Coautor
  

    while($fetchTrabajosRegistradosCoautor = mysqli_fetch_assoc($resTrabajosRegistradosCoautor)){
        $tituloPonencia=$fetchTrabajosRegistradosCoautor['titulo_ponencia'];
        $idTipoPonencia=$fetchTrabajosRegistradosCoautor['id_tipo_ponencia'];
        $idUsuarioEvalua=$fetchTrabajosRegistradosCoautor['id_usuario_evalua'];
        $idPonencia=$fetchTrabajosRegistradosCoautor['id_ponencia'];

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
            if(mysqli_num_rows($resUsuarioRevisiones) > 0){
                $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
                
                $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                //Campos de la revision
                $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                //Da formato de fecha
                $date = date_create($fechaRevisionPonencia);
                $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");                
                if($estadoRevisionPonencia=='A'){
                //Consulta la categoria de la ponencia
                $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];  
                
?>
    <div class="cardTrabajoAprobado div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
    <div class="card mb-3 ps-4 pe-4" >
        <div class="container mt-3">
        <div class="card-header header-verde"><!--Elemento de la cabecera de la card de la ponencia-->
            
            <div class="row header-ponencia ms-2 me-2" >
                <div class="d-none d-sm-none d-sm-block d-none d-md-none d-lg-block col-lg-2 col-xl-2  m-2 circulo-tipo" >
                <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xl-5 m-0"><span class="text-start badge span-ponencia text-wrap" id="">Trabajo Aprobado</span></div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xl-5 m-0"><span class="text-start badge span-ponencia text-wrap" id=""><?php echo $fechaRevisionPonenciaFormato ?></span> </div>
            </div>
            
        </div>
        </div>
        <div class="card-body">
            <h5 class="card-title" ><?php echo $tituloPonencia ?></h5><!--Titulo de la Ponencia-->
            <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
            <p class="card-text mb-1">Ponencia</p>
            <div class="divTipoPonencia mb-3">
                <span class="tipoPonencia" id="tipoPonencia"><?php echo $categoriaPonencia ?></span>
            </div>
            <!--
            <p class="card-text mb-1">Evaluador Asignado</p>
            <span class="card-title" ><?php echo $nombreEvaluador ?></span>
                -->
            <div class="mt-3 mb-3"><span class="card-text">La ponencia ha sido evaluada APROBADA.</span></div>
            <p class="card-text mb-1">Etapa</p>
            <span class="card-title text-uppercase " ><?php echo $descripcionRevisionPonencia ?></span><!--Etapa en la que se encuentra el trabajo-->    
            <!--
            <div class="d-grid gap-2 mt-4">
                    <button href="../../cartas/resumen/<?php echo $idPonencia ?>.pdf" class="btn-card p-1">Descargar Carta</button>
            </div>
                -->
            <div class="row mt-4 pb-2">
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
