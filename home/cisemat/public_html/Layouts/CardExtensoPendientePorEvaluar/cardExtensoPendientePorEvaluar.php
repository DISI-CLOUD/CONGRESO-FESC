<?php
    require "../../modelo/extensosFinalesAsignados.php";
    while($fetchExtensosFinalesPendientes=mysqli_fetch_assoc($resExtensosFinalesAsignados)){
        $tituloPonencia=$fetchExtensosFinalesPendientes['titulo_ponencia'];
        $idPonencia=$fetchExtensosFinalesPendientes['id_ponencia'];
        $idTipoPonencia=$fetchExtensosFinalesPendientes['id_tipo_ponencia'];
        $idUsuarioEvalua=$fetchExtensosFinalesPendientes['id_usuario_evalua'];
        $idUsuarioRegistra=$fetchExtensosFinalesPendientes['id_usuario_registra'];
        $categoriaPonencia=$fetchExtensosFinalesPendientes['categoria'];
        $tipoPonencia=$fetchExtensosFinalesPendientes['categoria_ponencia'];
        //Verificacion de la revision más actual.
        $consEvaluadorRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
        INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
        WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
//echo "<br> cardExtensoPendientePorEvaluar : ".$consEvaluadorRevisionPonencia."<br>";        
        $resEvaluadorRevisionPonencia = mysqli_query($conexion, $consEvaluadorRevisionPonencia);
        $fetchEvaluadorRevisionPonencia = mysqli_fetch_assoc($resEvaluadorRevisionPonencia);
        //Campos de la revision
        $estadoRevisionPonencia=$fetchEvaluadorRevisionPonencia['estatus_revision'];
        $descripcionRevisionPonencia=$fetchEvaluadorRevisionPonencia['descripcion_revision'];
        $fechaRevisionPonencia=$fetchEvaluadorRevisionPonencia['fecha_revision'];
        //Da formato de fecha
        $date = date_create($fechaRevisionPonencia);
        $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");
        if(($estadoRevisionPonencia=='F' && $descripcionRevisionPonencia='EXTENSO REVISION FINAL')||($estadoRevisionPonencia=='' && $descripcionRevisionPonencia=='EXTENSO REVISION FINAL')||($estadoRevisionPonencia=='NULL' && $descripcionRevisionPonencia=='EXTENSO REVISION FINAL')){

?>
<div class="cardPendientePorEvaluar  div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
<div class="card mb-3 ps-4 pe-4" >
    <div class="container mt-3"> 
    <div class="card-header header-azul"><!--Elemento de la cabecera de la card de la ponencia-->
        
        <div class="row header-ponencia ms-2 me-2" >
            <div class="col-xl-2 col-lg-2 d-none d-lg-block m-2 circulo-tipo-azul" id="circulo-tipo">
            <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
            </div>
            <div class="col-xl-10 col-lg-10 d-md-block col-md-12 col-sm-12  m-0">
                <span class="text-start badge span-ponencia text-wrap" id="">Pendiente por Evaluar</span>
                <span class="text-start badge span-ponencia text-wrap" id=""><?php echo $fechaRevisionPonenciaFormato ?></span>
            </div>
            
        </div>
        
    </div>
    </div>
    <div class="card-body">
        <h5 class="card-title mb-2" id="TituloTrabajo"><?php echo $tituloPonencia; ?></h5><!--Titulo de la Ponencia-->
        <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
        <div class="row mt-4">
            <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12"><!--TIPO DE TRABAJO-->
                <p class="card-text mb-1">Ponencia</p>
                <div class="divTipoPonencia mb-3 col-10">
                    <span class="tipoPonencia" id="tipoPonencia"><?php echo $tipoPonencia; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mb-4 col-xl-10 col-lg-10 col-md-10 d-sm-block col-sm-12"><!--CATEGORIA DEL TRABAJO-->
                <p class="card-text mb-1">Categoria</p>
                <div class=" ">
                    <span class="tipoPonencia" id="tipoPonencia"><?php echo $categoriaPonencia; ?></span>
                </div>
            </div>
        </div> 
        <p class="card-text mb-1 mt-3">Etapa</p>
        <span class="card-title text-uppercase mb-3" id=""><?php echo $descripcionRevisionPonencia; ?></span><!--Etapa en la que se encuentra el trabajo-->
        <div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha2" class="card-title">Evaluar</span><a href="../../components/EvaluarTrabajos/evaluarExtenso.php?id=<?php echo $idPonencia; ?>"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>
        </div>
    </div>
</div>
<?php
        }
    }
?>
