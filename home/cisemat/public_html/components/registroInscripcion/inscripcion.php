<?php
session_start();
require "../../modelo/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./inscripcion.css">


</head>

<body>
    <header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>
    <section style="margin-top: 200px;">
        <div class="container-fluid mt-5 mb-5"><!----------CONTENEDOR PRINCIPAL----------->
            <div class="row p-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <h2 class="mb-3">Inscripción al Congreso</h2><!--------TITULO INTERNO------------>
                        <!-----------DATOS DE INSCRIPCION AL CONGRESO------------>
                        <h5 class=" mb-3">La inscripción es individual y el pago incluye:</h5>
                        <ul class="fa-ul lista-texto">
                            <li class="lista-texto"><i class="fa-li fa fa-square me-2" style="color: #C5B268;"></i>Constancia de asistencia al congreso<br></li>
                            <li class="lista-texto"><i class="fa-li fa fa-square me-2" style="color: #C5B268;"></i>Constancia de participación como ponente (oral o cartel o taller en su caso)<br></li>
                            <li class="lista-texto"><i class="fa-li fa fa-square me-2" style="color: #C5B268;"></i>Constancia de publicación de artículo en las memorias del Congreso con ISSN (sólo extensos aceptados)<br></li>
                            <li class="lista-texto"><i class="fa-li fa fa-square me-2" style="color: #C5B268;"></i>Constancia de participación en taller (en su caso)<br></li>
                            <li class="lista-texto"><i class="fa-li fa fa-square me-2" style="color: #C5B268;"></i>Constancia de ganador en el concurso de carteles (en el caso de que haya resultado como ganador)<br></li>
                            <li class="lista-texto"><i class="fa-li fa fa-square me-2" style="color: #C5B268;"></i>Constancia de exposicion de prototipo o proyecto (en su caso)<br></li>
                        </ul>
                        <div class="mb-3">
                            <span style="font-family: 'Montserrat'; font-size: 20px; color: #C5B268; font-weight:600;">
                                La publicación de memorias se realizará en el sitio del Congreso 4 semanas después de terminado el evento.</span>
                        </div>
                        <div class="row m-4">
                            <div class="col-sm-1">
                                <i class="fa fa-exclamation-triangle" style="color:#3B3D4D; font-size:48px; vertical-align:center;"></i>
                            </div>
                            <div class="col-sm">
                                <h3>Para solicitar constancia de asistencia al congreso<br> se deberá asistir y participar en minimo 3 ponencias orales virtuales.</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <?php
                    require_once('../../Layouts/maps.php');
                    ?>
                </section>
            </div>
        </div>
    </section>
    <footer><!-----------CONTENEDOR PIE DE PAGINA------------>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>
