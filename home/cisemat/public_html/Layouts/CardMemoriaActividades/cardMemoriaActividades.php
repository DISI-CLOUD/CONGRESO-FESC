
<?php
require "../../modelo/conexion.php";
require "../../modelo/traerCongresosPasados.php";
require "../../modelo/traerCongresoActual.php";
$idCongreso=$_GET['id'];
//consulta que trae el id del congreso y el logo

    //INNER JOIN
    $consFechasCongreso = "SELECT * FROM congreso 
    INNER JOIN fecha_congreso ON congreso.id_congreso = fecha_congreso.id_congreso 
    WHERE fecha_congreso.id_evento = 13 
    AND fecha_congreso.id_congreso='$idCongreso'";
    $resFechaCongreso = mysqli_query($conexion, $consFechasCongreso );
    $fetchFechaCongreso  = mysqli_fetch_assoc($resFechaCongreso);
    $fechaCongresoFin=$fetchFechaCongreso['fecha_congreso_fin'];
    $fechaCongresoInicio=$fetchFechaCongreso['fecha_congreso_inicio'];
    //Fecha en español
    //Da formato de fecha
    $date = date_create($fechaCongresoInicio);
    $date2 = date_create($fechaCongresoFin);
    //Obtiene el numero del mes
    $fechaCongresoInicioMes=date_format($date,"m");
    $fechaCongresoFinMes=date_format($date2,"m");
    //Obtiene el numero del dia
    $fechaCongresoInicioDia=date_format($date,"d");
    $fechaCongresoFinDia=date_format($date2,"d");
    //
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fechaCongresoInicioFormato=$fechaCongresoInicioDia." ".$meses[date($fechaCongresoInicioMes)-1];
    $fechaCongresoFinFormato=$fechaCongresoFinDia." ".$meses[date($fechaCongresoFinMes)-1];
?>


<!--CARD PARA MOSTRAR LAS ACTIVIDADES DE LA MEMORIA DE CADA CONGRESO-->
<div class="div col-xl-12 col-lg-12 col-md-12 d-sm-block col-sm-12 mb-3">
    <div class="card ">
        <div class="card-body m-2">
            <div class="row p-1">
                <div class="col-xl-10 col-lg-10 col-md-9 d-sm-block col-sm-12 mb-3 card-head rounded">
                    <!--Numero de edicion del congreso-->
                    <p class="mt-3 p-title" id="edicion">EDICION <?php echo $idCongreso; ?></p>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 d-sm-block col-sm-12">
                    <!--Logo del congreso-->
                <img src="<?php echo $logoCongreso; ?>" alt="XIV Congreso" class="logo" height= "70px"  width= "80px">
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-9 d-sm-block col-sm-12 mt-3 mb-3">
                    <span class="span-congreso">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
                </div>
            </div>
                <!--Fecha del congreso-->
                <span class="span-fecha"><?php echo $fechaCongresoInicioFormato.' y '.$fechaCongresoFinFormato; ?></span>
            <div class="col-xl-4 col-lg-4 col-md-5 d-sm-block col-sm-6 p-1 mt-3 mb-3 text-center rounded" style="background-color: #FEF0CB;">
                <i class="fab fa-laravel "></i>
                <span class=" fw-semibold span-actividades ">Actividades</span>
            </div>

            <div class="row mb-5">
                <!--tabla que muestra las ponencias presentadas y aprobadas en ese congreso-->
                <div class="table-responsive">
                <table class="table table-striped" >
                <thead class="table-head">
                    <tr>
                        <th scope="col" class=" titulo-tabla">Titulo</th>
                        <th scope="col" class=" autor">Autores</th>
                        <th scope="col" class=" ponencia">Tipo Ponencia</th>
                    </tr>
                </thead>
                <tbody>
                    <tr> 
                        
                        <?php
                        require "../../modelo/traerDatosProgramaPasados.php";
                            while($fetchTrabajosRegistrados=mysqli_fetch_assoc($resTrabajosRegistrados)){
                                $tituloPonencia=$fetchTrabajosRegistrados['titulo_ponencia'];
                                $idUsuarioEvalua=$fetchTrabajosRegistrados['id_usuario_evalua'];
                                $idPonencia=$fetchTrabajosRegistrados['id_ponencia'];
                                $idTipoPonencia=$fetchTrabajosRegistrados['id_tipo_ponencia'];
                                
                                $idAutor=$fetchTrabajosRegistrados['id_usuario_registra'];
                                
                                if($idUsuarioEvalua!=""){  
                                    //Verifica que tenga revisiones
                                    $consUsuarioRevisiones = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia'";
                                
                                    $resUsuarioRevisiones = mysqli_query($conexion, $consUsuarioRevisiones);
                                    $fetchUsuarioRevisiones = mysqli_fetch_assoc($resUsuarioRevisiones);
                                    if($fetchUsuarioRevisiones){
                                        $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                        INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                        WHERE usuario_revision_ponencia.id_ponencia='$idPonencia')";
                                        
                                        $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                                        $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                                        //Campos de la revision
                                        $estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
                                        $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                        
                                        
                                        if(($idTipoPonencia=='3' && $estadoRevisionPonencia='A' && $descripcionRevisionPonencia=='RESUMEN') || ($estadoRevisionPonencia=='A' && ($descripcionRevisionPonencia=='EXTENSO'|| $descripcionRevisionPonencia=='CARTEL'))){
                                        //Consulta la categoria de la ponencia
                                        $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                                        $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                                        $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                                        $categoriaPonencia=$fetchTipoPonencia['categoria_ponencia']; 
                                        
                                        //Consulta al autor 
                                        //Hace la consulta de los autores de la ponencia
                                        $consAutor = "SELECT * FROM usuario WHERE id_usuario='$idAutor'";
                                        $resAutor = mysqli_query($conexion, $consAutor);
                                        $fetchAutor = mysqli_fetch_assoc($resAutor);
                                        $nombreAutor=$fetchAutor['nombres_usuario'];
                                        $apellidosAutor=$fetchAutor['apellidos_usuario'];
                                        $nombreCompletoAutor= $nombreAutor. " " .$apellidosAutor;
                                        
                                        //colabora ponencia
                                        $consCoautor = "SELECT * FROM usuario_colabora_ponencia_18012024 WHERE id_ponencia='$idPonencia'";
                                        $resCoautor = mysqli_query($conexion, $consCoautor);
                                    if(mysqli_num_rows($resCoautor)>0){
                                        //juntar los nombres de autores y coautores
                                        while($fetchCoautor = mysqli_fetch_assoc($resCoautor)){

                                        $idCoautor=$fetchCoautor['id_usuario'];
                                        $consNombreCoautor = "SELECT * FROM usuario WHERE id_usuario='$idCoautor'";
                                        $resNombreCoautor = mysqli_query($conexion, $consNombreCoautor);
                                        $fetchNombreCoautor = mysqli_fetch_assoc($resNombreCoautor);
                                        $nombreCoautor=$fetchNombreCoautor['nombres_usuario'];
                                        $apellidosCoautor=$fetchNombreCoautor['apellidos_usuario'];
                                        $nombreCompletoCoautor= $nombreCoautor. " " .$apellidosCoautor;
                                        $nombreAutores= $nombreCompletoAutor. ", " .$nombreCompletoCoautor ;
                                        }
                                    }
                                    
                        ?>
                        <th scope="row"><?php echo $tituloPonencia ?></th>
                        <td><?php  if(mysqli_num_rows($resCoautor)>0){
                            echo $nombreAutores;    
                                } else{
                                        echo $nombreCompletoAutor;
                                }  ?></td>
                        <td><?php echo $categoriaPonencia ?></td>
                        </tr>
                        <?php
                            }
                                } 
                                
                            }
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
</div>
