<?php

//Si es autor de una ponencia
require "../../modelo/trabajosRegistrados.php";
    

    while($fetchTrabajosRegistrados = mysqli_fetch_assoc($resTrabajosRegistrados)){
        $tituloPonencia=$fetchTrabajosRegistrados['titulo_ponencia'];
        $idTipoPonencia=$fetchTrabajosRegistrados['id_tipo_ponencia'];
        $idUsuarioEvalua=$fetchTrabajosRegistrados['id_usuario_evalua'];
        $idPonencia=$fetchTrabajosRegistrados['id_ponencia'];

        if($idUsuarioEvalua==""){
        //Consulta la categoria de la ponencia
        $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
        $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
        $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
        $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];
        
?>
<div class="cardTrabajoSinEvaluador div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
<div class="card mb-3 ps-4 pe-4" >
    <div class="container mt-3">
    <div class="card-header header-amarillo"><!--Elemento de la cabecera de la card de la ponencia-->
        
        <div class="row header-ponencia ms-2 me-2" >
            <div class="d-none d-sm-block d-md-none d-lg-block col-lg-2 col-xl-2 m-2 circulo-tipo-amarillo" id="circulo-tipo">
            <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xl-10 m-0"><span class="text-start badge span-ponencia text-wrap" id="">Sin Evaluador Asignado</span></div>
            
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
        <p class="card-text mb-1">Etapa</p>
        <span class="card-title text-uppercase " >RESUMEN</span><!--Etapa en la que se encuentra el trabajo-->
        <div class="row mt-3 mb-5">
            <div class="col-2 d-flex justify-content-end"><img src="../../src/question.png" class="imgQuestion" alt=""></div>
            <div class="col-10"><span class="textoAdvertencia">La ponencia no tiene un evaluador asignado
            En el momento en que se asigne un evaluador ya no podra eliminar el trabajo.
            </span>
            </div>
        </div>
            <div class="d-grid gap-2">
            <a href="../../modelo/ponencias/eliminarPonencia.php?id=<?php echo $idPonencia; ?>"><button onclick="confirmar(event)" class="col-xl-6 col-lg-6 col-md-10  col-sm-12 btn-card ">Eliminar Trabajo</button></a>
            </div>
            <div class="d-grid gap-2 mt-4">
            <a href="../../components/ModificarResumen/ModificaResumen.php?id=<?php echo $idPonencia; ?>"><button class="btn-card col-xl-6 col-lg-6 col-md-10 col-sm-12">Modificar Trabajo</button></a>
            </div>
        
        <div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title">Ver Trabajo</span><a target="_blank" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>
    </div>
</div>
</div>

<?php
        }
    }
?>


<?php
//Si es coautor de una ponencia

    

    while($fetchTrabajosRegistradosCoautor = mysqli_fetch_assoc($resTrabajosRegistradosCoautor)){
        $tituloPonencia=$fetchTrabajosRegistradosCoautor['titulo_ponencia'];
        $idTipoPonencia=$fetchTrabajosRegistradosCoautor['id_tipo_ponencia'];
        $idUsuarioEvalua=$fetchTrabajosRegistradosCoautor['id_usuario_evalua'];
        $idPonencia=$fetchTrabajosRegistradosCoautor['id_ponencia'];

        if($idUsuarioEvalua==""){
        //Consulta la categoria de la ponencia
        $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
        $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
        $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
        $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];
        
?>
<div class="cardTrabajoSinEvaluador div mt-5 col-lg-6 col-md-6 col-xl-6 col-sm-12">
<div class="card mb-3 ps-4 pe-4" >
    <div class="container mt-3">
    <div class="card-header header-amarillo"><!--Elemento de la cabecera de la card de la ponencia-->
        
        <div class="row header-ponencia ms-2 me-2" >
            <div class="d-none d-sm-block d-md-none d-lg-block col-lg-2 col-xl-2 m-2 circulo-tipo-amarillo" id="circulo-tipo">
            <!--circulo que se pinta dependiendo si es aceptada la ponencia-->
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xl-10 m-0"><span class="text-start badge span-ponencia text-wrap" id="">Sin Evaluador Asignado</span></div>
            
        </div>
        
    </div>
    </div>
    <div class="card-body">
        <h5 class="card-title" ><?php echo $tituloPonencia ?></h5><!--Titulo de la Ponencia-->
        <h5 class="card-title" ><?php echo $idPonencia ?></h5><!--ID de la Ponencia-->
        <p class="card-text mb-1">Ponencia</p>
        <div class="divTipoPonencia mb-5">
            <span class="tipoPonencia" ><?php echo $categoriaPonencia ?></span>
        </div>
        <p class="card-text mb-1">Etapa</p>
        <span class="card-title text-uppercase " >RESUMEN</span><!--Etapa en la que se encuentra el trabajo-->
        <div class="row mt-3 mb-5">
            <div class="col-2 d-flex justify-content-end"><img src="../../src/question.png" class="imgQuestion" alt=""></div>
            <div class="col-10"><span class="textoAdvertencia">La ponencia no tiene un evaluador asignado
            En el momento en que se asigne un evaluador ya no podra eliminar el trabajo.
            </span>
            </div>
        </div>        
        <div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title">Ver Trabajo</span><a target="_blank" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>
    </div>
</div>
</div>



<?php
        }
    }
?>

<script src="trabajo.js"></script>
<script src="../../Layouts/CardTrabajoSinEvaluador/cardTrabajoSinEva.js"></script>
