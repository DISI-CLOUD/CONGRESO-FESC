<?php
session_start();
require "../../modelo/fechasResumen.php";
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}
$_SESSION['rfc'] = '';
$_SESSION['titulo_ponencia'] ='';
$_SESSION['id_categoria_ponencia'] ='1';
$_SESSION['resumen_ponencia'] ='';
$_SESSION['tipo_ponencia'] ='';
$_SESSION['referencia_ponencia']= '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../Layouts/Resumen/resumen.css">

</head>

<body>
    <header>
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                <?php
                require_once('../../Layouts/sidebar.php');
                ?>

            </div>
            <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                <div class="container pb-3">
                    <h2 class="mt-5 mb-3">Subir Trabajo</h2>
                    <?php 
                    $id_evento = 2;
                    $sql = "SELECT fecha_congreso_fin FROM fecha_congreso WHERE id_evento = $id_evento AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = $id_evento)";
                    $result = $conexion->query($sql);
                    $row = $result->fetch_assoc();
                    $fecha = new DateTime($row["fecha_congreso_fin"]);
                    $locale = 'es_ES'; // Establece la configuración regional en español
            
                    $dateFormatter = new IntlDateFormatter(
                        $locale,
                        IntlDateFormatter::FULL, // Estilo completo de fecha y hora
                        IntlDateFormatter::FULL, // Estilo completo de fecha y hora
                        'UTC', // Zona horaria
                        IntlDateFormatter::GREGORIAN
                    );
            
                    $dateFormatter->setPattern("EEEE d 'de' MMMM 'de' y"); // Define el patrón de formato
            
                    $fecha_formateada = $dateFormatter->format($fecha);
            
                    // Capitalizar la primera letra del día
                    $fecha_formateada1 = ucfirst($fecha_formateada);
                    ?>
                    <!--
                    <h5>El periodo de recepción de resumenes es hasta el <b>
                        <?//php echo $fecha_formateada1; ?>
                        </b>.</h5>
                     -->   
                    <?php
                    if (mysqli_num_rows($resFechaResumen) > 0) {
                        require_once('../../Layouts/Resumen/plantillaResumen.php');
                    } else {
                    ?>
                        <!--------------ESTE CONTENEDOR SE MUESTRA CUANDO EL USUARIO NO TIENE PONENCIAS ASIGNADAS--------->
                        
                        <div class=" containerSinR " id="containerSinR">
                            <span class="texto-trabajo mb-3">Revisa las fechas de recepción de resúmenes</span>
                            <h1 class="mt-5">Aún no es la fecha para<br> registrar resúmenes de trabajos.</h1>
                            <a href="../actividadesFechas/fechas.php">Ver fechas</a>
                        </div>
                        <div class="container-fluid p-5 mt-5 mb-5 d-none d-md-block"></div>
                        <div class="container-fluid p-5 mt-5 mb-5"></div>
                        
                        <!--
                        <div class=" containerSinR " id="containerSinR">
                            <span class="texto-trabajo mb-3">Disculpe las molestias, la recepcion de resumenes se encuentra en mantenimiento </span>
                            <h1 class="mt-5">Resumenes en mantenimiento<br> Favor de esperar e intentarlo mas tarde.</h1>
                            <a href="../actividadesFechas/fechas.php">Ver fechas</a>
                        </div>
                        <div class="container-fluid p-5 mt-5 mb-5 d-none d-md-block"></div>
                        <div class="container-fluid p-5 mt-5 mb-5"></div>
                        -->
                    <?php
                    }
                    ?>
                </div>
            </div><!--col-10-->
        </div>
    </div>
    <div class="row">

        <?php
        require_once('../../Layouts/footer.php');
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/typo-js@0.14.0/typo.js"></script>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script defer src="./subirTrabajo.js"></script>
    <script defer src="../../Layouts/Resumen/resumen.js"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
    <script src="subirResumen.js"></script>
</body>

</html>