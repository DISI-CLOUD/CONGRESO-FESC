<div class="historialEvaluador mt-5 d-sm-none d-md-block d-none d-sm-block " >
    <h2>Mi Historial </h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col-xl-3 col-lg-3 col-md-3 ">Titulo</th>
        <th scope="col-xl-2 col-lg-2 col-md-2  ">Tipo</th>
        <th scope="col-xl-1 col-lg-1 col-md-1 ">Congreso</th>
        <th scope="col-xl-2 col-lg-2 col-md-2 ">Etapa</th>
        <th scope="col-xl-2 col-lg-2 col-md-2 ">Estatus</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php
        //En caso de que el evaluador tenga ponencias evaluadas y aprobadas
        require "../../modelo/trabajosAsignados.php";

        while($fetchPonenciasPendientesEvaluador=mysqli_fetch_assoc($resPonenciasEvaluadorHistorial)){
            $tituloPonencia=$fetchPonenciasPendientesEvaluador['titulo_ponencia'];
            $idPonencia=$fetchPonenciasPendientesEvaluador['id_ponencia'];
            $idTipoPonencia=$fetchPonenciasPendientesEvaluador['id_tipo_ponencia'];
            $idUsuarioEvalua=$fetchPonenciasPendientesEvaluador['id_usuario_evalua'];
            $idUsuarioRegistra=$fetchPonenciasPendientesEvaluador['id_usuario_registra'];
            $idCategoria=$fetchPonenciasPendientesEvaluador['id_categoria'];
            $videoPonencia=$fetchPonenciasPendientesEvaluador['video_ponencia'];
            $idCongreso=$fetchPonenciasPendientesEvaluador['id_congreso'];

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
            WHERE usuario_revision_ponencia.id_ponencia='$idPonencia')";

//echo "<br> Layouts/historialEvaluador ".$consEvaluadorRevisionPonencia."<br>";

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
            //if(($descripcionRevisionPonencia=='RESUMEN' && $estadoRevisionPonencia=='A') || ($descripcionRevisionPonencia=='EXTENSO' && $estadoRevisionPonencia=='A') || ($descripcionRevisionPonencia=='CARTEL' && $estadoRevisionPonencia=='A')){
            //Consulta al autor    
            if($estadoRevisionPonencia==''){
                $estadoRevisionPonencia='PENDIENTE DE EVALUAR';    
            }

            //***************************PONENCIAS ORALES*************************************************************//
            //Si el se le ha rechazado el resumen al usuario
            if($estadoRevisionPonencia=='R' && $descripcionRevisionPonencia=='RESUMEN'){
                $estadoRevisionPonencia='RECHAZADO';    
                $descripcionRevisionPonencia='RESUMEN';
            }
            //Si el usuario no ha subido su extenso 
            if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='RESUMEN'){
                $estadoRevisionPonencia='APROBADO';    
                $descripcionRevisionPonencia='RESUMEN';
            }                            
            //Si el usuario ya ha subido su extenso y ha sido rechazado
            if($estadoRevisionPonencia=='R' && $descripcionRevisionPonencia=='EXTENSO' && $videoPonencia==''){
                $estadoRevisionPonencia='RECHAZADO';    
                $descripcionRevisionPonencia='EXTENSO';
            }
            //Si el usuario esta en revision final y no ha sido revisado
            if($estadoRevisionPonencia=='F' && $descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $videoPonencia==''){
                $estadoRevisionPonencia='PENDIENTE A EVALUAR';    
                $descripcionRevisionPonencia='EXTENSO REVISION FINAL';
            }
            //Si el usuario se rechazo su extenso final 
            if($estadoRevisionPonencia=='FR' && $descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $videoPonencia==''){
                $estadoRevisionPonencia='RECHAZADO';    
                $descripcionRevisionPonencia='EXTENSO REVISION FINAL';
            }
            //Si el usuario aprobo su extenso y no subió video
            if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $videoPonencia==''){
                $estadoRevisionPonencia='VIDEO PENDIENTE POR SUBIR';    
                $descripcionRevisionPonencia='EXTENSO REVISION FINAL';
            }                     
            //Si el usuario aprobo su extenso y termino el proceso
            if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='EXTENSO REVISION FINAL' && $videoPonencia!=''){
                $estadoRevisionPonencia='FINALIZADO';    
                $descripcionRevisionPonencia='EXTENSO REVISION FINAL';
            } 
            //***************************CARTELES*************************************************************//
            //Si el se le ha rechazado el resumen al usuario
            if($estadoRevisionPonencia=='R' && $descripcionRevisionPonencia=='RESUMEN'){
                $estadoRevisionPonencia='RECHAZADO';    
                $descripcionRevisionPonencia='RESUMEN';
            }
            //Si el usuario ya subio subio el cartel pero el video no
            if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='CARTEL' && $videoPonencia==''){
                $estadoRevisionPonencia='VIDEO PENDIENTE POR SUBIR';    
                $descripcionRevisionPonencia='CARTEL';
            }
            //Si el usuario ya subio su cartel
            if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='CARTEL' && $videoPonencia!=''){
                $estadoRevisionPonencia='FINALIZADO';    
                $descripcionRevisionPonencia='CARTEL';
            }
            //***************************TALLER*************************************************************//
            //Si el usuario aprobo su extenso y no subió video
            if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='RESUMEN' && $videoPonencia==''){
                $estadoRevisionPonencia='VIDEO PENDIENTE POR SUBIR';    
                $descripcionRevisionPonencia='RESUMEN';
            }

            //Si el usuario aprobo su CARTEL y termino el proceso
            if($estadoRevisionPonencia=='A' && $descripcionRevisionPonencia=='RESUMEN' && $videoPonencia!=''){
                $estadoRevisionPonencia='FINALIZADO';    
                $descripcionRevisionPonencia='RESUMEN';
            }   
        

        ?>

            <th scope="col-xl-3 col-lg-3 col-md-3 " class="fw-light"><?php echo $tituloPonencia; ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light"><?php echo $tipoPonencia; ?></th>
            <th scope="col-xl-1 col-lg-1 col-md-1 " class="fw-light"><?php echo $idCongreso; ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light"><?php echo $descripcionRevisionPonencia; ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light"><?php echo $estadoRevisionPonencia; ?></th>
        </tr>
        <?php
           // }

        }

?>
    </tbody>
</table>
</div>
<div class="container-fluid p-5 mt-5 mb-5 d-none d-md-block"></div>


<script src="trabajosAsignados.js"></script>