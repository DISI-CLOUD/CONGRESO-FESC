<div class="table-responsive mt-5 mb-5 pt-3 ">
    <h4 class="mt-5">Mi Historial como Autor</h4>
    <table class="table">
    <thead>
        <tr>
        <th scope="col-xl-3 col-lg-3 col-md-3 ">Nombre</th>
        <th scope="col-xl-2 col-lg-2 col-md-2  ">Tipo</th>
        <th scope="col-xl-1 col-lg-1 col-md-1 ">Congreso</th>
        <th scope="col-xl-2 col-lg-2 col-md-2 ">Etapa</th>
        <th scope="col-xl-2 col-lg-2 col-md-2 ">Estatus</th>
        <th scope="col-xl-2 col-lg-2 col-md-2 ">Fecha</th>
        <th scope="col-xl-2 col-lg-2 col-md-2  ">Constancia</th>
        </tr>
    </thead>
    <tbody>
        <?php
            //Trabajos del Autor
            require "../../modelo/trabajosRegistrados.php";
                

                while($fetchTrabajosRegistradosHistorial = mysqli_fetch_assoc($resTrabajosRegistradosHistorial)){
                    $tituloPonencia=$fetchTrabajosRegistradosHistorial['titulo_ponencia'];
                    $idPonencia=$fetchTrabajosRegistradosHistorial['id_ponencia'];
                    $idTipoPonencia=$fetchTrabajosRegistradosHistorial['id_tipo_ponencia'];
                    $idUsuarioEvalua=$fetchTrabajosRegistradosHistorial['id_usuario_evalua'];
                    $idCongreso=$fetchTrabajosRegistradosHistorial['id_congreso'];
                    $videoPonencia=$fetchTrabajosRegistradosHistorial['video_ponencia'];
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
//echo "<br> Layouts/historialTrabajosAutor ".$consUsuarioRevisionPonencia."<br>";
                            $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                            $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                            //Campos de la revision
                            $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                            $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                            $fechaRevisionPonencia=$fetchUsuarioRevisionPonencia['fecha_revision'];
                            //Da formato de fecha
                            $date = date_create($fechaRevisionPonencia);
                            $fechaRevisionPonenciaFormato=date_format($date,"Y/m/d H:i");
                            //Consulta la categoria de la ponencia
                            $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                            $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                            $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                            $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia'];  
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
        <tr>
            <th scope="col-xl-3 col-lg-3 col-md-3 " class="fw-light"><?php echo $tituloPonencia ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light"><?php echo $categoriaPonencia ?></th>
            <th scope="col-xl-1 col-lg-1 col-md-1 " class="fw-light"><?php echo $idCongreso ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light"><?php echo $descripcionRevisionPonencia ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light"><?php echo $estadoRevisionPonencia ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light"><?php echo $fechaRevisionPonenciaFormato ?></th>
            <th scope="col-xl-2 col-lg-2 col-md-2 " class="fw-light">Constancia</th>
        </tr>
            <?php
                        }
                    }
                }
            ?>
    </tbody>
</table>
</div>

