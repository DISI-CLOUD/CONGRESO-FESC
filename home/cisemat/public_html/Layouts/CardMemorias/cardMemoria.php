
<?php
require "../../modelo/conexion.php";
require "../../modelo/traerCongresosPasados.php";
require "../../modelo/traerCongresoActual.php";

        while($fetchCongresoPasado = mysqli_fetch_assoc($resCongresosPasados)){
        $idCongresoPasado=$fetchCongresoPasado['id_congreso'];
        $logoCongreso=$fetchCongresoPasado['logo_congreso'];
        

    $consMemoria = "SELECT * FROM memoria WHERE id_congreso='$idCongresoPasado'";
    $resMemoria = mysqli_query($conexion, $consMemoria);
    $fetchMemoria  = mysqli_fetch_assoc($resMemoria);
    if(is_array($fetchMemoria )){
        $pdfMemoria = $fetchMemoria['pdf_memoria'];
    }
    if($idCongreso!=$idCongresoPasado){
?>  
<?php
    require "../../modelo/traerMemoria.php";
?>
<?php
    //INNER JOIN
    $consFechasCongreso = "SELECT * FROM congreso 
    INNER JOIN fecha_congreso ON congreso.id_congreso = fecha_congreso.id_congreso 
    WHERE fecha_congreso.id_evento = 13 
    AND fecha_congreso.id_congreso='$idCongresoPasado'";
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
<!-----------CARD CONGRESOS------------> 
<div class="div col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 mb-3">
<div class="card ">
    <div class="card-body m-2"><!--Cuerpo de la card-->
        <div class="row p-1">
            <div class="col-xl-10 col-lg-9 col-md-8 d-sm-block col-sm-12 mb-3 card-head rounded">
                <!--Numero de edicion del congreso-->
                <p class="mt-3 p-title" id="edicion">EDICION <?php echo $idCongresoPasado; ?></p>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 d-sm-block col-sm-12">
                <!--Logo del congreso-->
            <img src="<?php echo $logoCongreso; ?>" alt="XIV Congreso" class="logo" height= "70px"  width= "80px">
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 d-sm-block col-sm-12 mt-3 mb-3">
                <span class="span-congreso">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
            </div>
        </div>
        <!--Fecha del congreso-->
        <span class="span-fecha"><?php echo $fechaCongresoInicioFormato.' y '.$fechaCongresoFinFormato; ?></span>
        <div class="row mt-3">
            <div class="col-xl-4 col-lg-5 col-md-6 d-sm-block col-sm-12 p-2">
                <a class="btn fw-semibold" style="background-color: #CBE6FE;" href="../../components/programaMemoriasActividades/programaMemoriasActividades.php?id=<?php echo $idCongresoPasado; ?>" role="button">
                <i class="fab fa-laravel col-12"></i>Actividades</a>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 d-sm-block col-sm-12 p-2">
                <a class="btn py-3 px-4 fw-semibold" style="background-color: #CBE6FE;" href="../../components/programaMemoriasAcercade/programaMemoriasAcercade.php" role="button">
                <i class="fa fa-info col-12"></i>Acerca de</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <p class="card-text">
                <a href="<?php echo $pdfMemoria; ?>" target="_blank" class="enlace">DESCARGAR MEMORIA</a>
                </p>
            </div>
        </div>
    </div>
</div>
</div>
<?php
    }      
}
?>