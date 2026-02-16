<?php
//En caso de que el evaluador tenga ponencias evaluadas y aprobadas
require "../../modelo/trabajosAsignados.php";

while($fetchPonenciasPendientesEvaluador=mysqli_fetch_assoc($resPonenciasPendientesEvaluador)){
    $tituloPonencia=$fetchPonenciasPendientesEvaluador['titulo_ponencia'];
    $idPonencia=$fetchPonenciasPendientesEvaluador['id_ponencia'];
    $idTipoPonencia=$fetchPonenciasPendientesEvaluador['id_tipo_ponencia'];
    $idUsuarioEvalua=$fetchPonenciasPendientesEvaluador['id_usuario_evalua'];
    $idUsuarioRegistra=$fetchPonenciasPendientesEvaluador['id_usuario_registra'];
    $idCategoria=$fetchPonenciasPendientesEvaluador['id_categoria'];
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

    //Consulta el tipo de la ponencia
    $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
    $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
    $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
    $tipoPonencia=$fetchTipoPonencia['categoria_ponencia'];  
    //Consulta la categoria de la ponencia
    $consCategoriaPonencia = "SELECT * FROM categoria WHERE id_categoria='$idCategoria'";
    $resCategoriaPonencia = mysqli_query($conexion, $consCategoriaPonencia);
    $fetchCategoriaPonencia = mysqli_fetch_assoc($resCategoriaPonencia);
    $categoriaPonencia=$fetchCategoriaPonencia['categoria'];  
    //Verificacion de la revision más actual.
    $consEvaluadorRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
    INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
    WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='17')";
//echo "<br> Consulta 1".$consEvaluadorRevisionPonencia."<br>";

    $resEvaluadorRevisionPonencia = mysqli_query($conexion, $consEvaluadorRevisionPonencia);
    $fetchEvaluadorRevisionPonencia = mysqli_fetch_assoc($resEvaluadorRevisionPonencia);
    //Campos de la revision
    $estadoRevisionPonencia=$fetchEvaluadorRevisionPonencia['estatus_revision'];
    $descripcionRevisionPonencia=$fetchEvaluadorRevisionPonencia['descripcion_revision'];
    $fechaRevisionPonencia=$fetchEvaluadorRevisionPonencia['fecha_revision'];
    //Da formato de fecha
    $date = date_create($fechaRevisionPonencia);
    $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");
    //Verifica que tenga Revision pero que no haya sido calificada    
    if(($descripcionRevisionPonencia=='RESUMEN' && $estadoRevisionPonencia=='R') || ($descripcionRevisionPonencia=='EXTENSO' && $estadoRevisionPonencia=='R') || ($descripcionRevisionPonencia=='CARTEL' && $estadoRevisionPonencia=='R') || ($descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $estadoRevisionPonencia=='FR')){

   

?>

<div class="cardTrabajoEvaluadoRechazado  div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
<div class="card mb-3 ps-4 pe-4" > 
    <div class="container mt-3">
    <div class="card-header header-rojo"><!--Elemento de la cabecera de la card de la ponencia-->
        
        <div class="row header-ponencia ms-2 me-2" >
            <div class="col-xl-2 col-lg-2 d-none d-lg-block m-2 circulo-tipo-rojo" id="circulo-tipo">
            <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
            </div>
            <div class="col-lg-5 d-md-block col-md-12 d-sm-block col-sm-12 col-xl-6 m-0"><span class="text-start badge span-ponencia text-wrap" id="">Evaluada el</span></div>
            <div class="col-lg-5 d-md-block col-md-12 d-sm-block col-sm-12 col-xl-4 m-0"><span class="text-start badge span-ponencia text-wrap" id=""><?php echo $fechaRevisionPonenciaFormato ?></span> </div>
        </div>
        
    </div> 
    </div>
    <div class="card-body mb-4">
        <h5 class="card-title mb-2" id="TituloTrabajo"><?php echo $tituloPonencia ?></h5><!--Titulo de la Ponencia-->
        <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
        <div class="row mt-4 mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12"><!--TIPO DE TRABAJO-->
                <p class="card-text mb-1">Ponencia</p>
                <div class="divTipoPonencia mb-3 col-10">
                    <span class="tipoPonencia" id="tipoPonencia"><?php echo $tipoPonencia ?></span>
                </div>
            </div>
            <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 d-sm-block col-sm-12 d-xs-block col-xs-12"><!--CATEGORIA DEL TRABAJO-->
            <p class="card-text mb-1">Categoria</p>
                <div class=" mb-3 col-xl-10 col-lg-10 col-md-10 d-sm-block col-sm-12">
                    <span class="" id="tipoPonencia"><?php echo $categoriaPonencia ?></span>
                </div>
            </div> 
            </div>
        </div>
        
        <!--AUTOR DEL TRABAJO-->
        <!--Nombre del autor
        <p class="card-text mb-1">Autor</p>
        <span class="card-title" id=""><?php echo $nombreAutorFormato ?></span>-->
        <p class="card-text mb-1 mt-3">Etapa</p>
        <span class="card-title text-uppercase " id=""><?php echo $descripcionRevisionPonencia ?></span><!--Etapa en la que se encuentra el trabajo-->
    </div>
</div>
</div>

<?php
    }

}

?>
