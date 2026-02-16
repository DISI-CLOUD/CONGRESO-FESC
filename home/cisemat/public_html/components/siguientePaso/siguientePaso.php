<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}
require "../../modelo/conexion.php";
require "../../modelo/traerCongresoActual.php";

$idPonencia = $_GET['id'];
if ($idPonencia == '') {
    print "<script>window.location='../../index.php';</script>";
}

//Consulta su tipo de ponencia para subir Extenso o Cartel
$consTipoPonencia = "SELECT * FROM ponencia WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";

echo "<br>componentes/Siguiente Paso - Congreso : ".$consPonencia."<br>";

$resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
$fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);

$idTipoPonencia = $fetchTipoPonencia['id_tipo_ponencia'];

//Consulta las revisiones más recientes de la ponencia para saber que subirá
$consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
    INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
    WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";

//echo "<br> Viene de siguiente paso : ".$consUsuarioRevisionPonencia."<br>";

$resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
$fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
//Campos de la revision
$estadoRevisionPonencia = $fetchUsuarioRevisionPonencia['estatus_revision'];
$descripcionRevisionPonencia = $fetchUsuarioRevisionPonencia['descripcion_revision'];
$fechaRevisionPonencia = $fetchUsuarioRevisionPonencia['fecha_revision'];


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
    <title>Trabajos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./subirArchivo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
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
                <div class="container">
                    <?php
                    require "../../modelo/siguientePaso.php";
                    ?>
                    <form method="POST" class="" enctype="multipart/form-data">
                        <?php
                        if (($descripcionRevisionPonencia == 'RESUMEN' && $estadoRevisionPonencia == 'A') || ($descripcionRevisionPonencia == 'EXTENSO' && $estadoRevisionPonencia == 'R') || ($descripcionRevisionPonencia == 'CARTEL' && $estadoRevisionPonencia == 'R') || ($descripcionRevisionPonencia == 'EXTENSO REVISION FINAL' && $estadoRevisionPonencia == 'FR')) {
                            switch ($idTipoPonencia) {
                                case '1':
                        ?>
                                    <h2 class="mt-5 mb-3">Subir Cartel</h2>
                                    <hr>
                                    <!-------------------------------------------------------------------------------------------->
                                    <!-------------------------CONTAINER QUE SE MUESTRA CUANDO EL USUARIO SUBE UN CARTEL---------->
                                    <div class="containerSubirArchivo" id="containerSubirArchivo">
                                        <div class="row mt-4">
                                            <div class="col-xl-6 col-lg-6 col-md-6 d-md-block col-md-12 col-sm-12 col-xs-12  mt-3">
                                                <input type="file" class="form-control" name="inputCartel" id="inputCartel" accept="image/jpeg,image/jpg">
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-3 d-md-inline-block col-md-6 col-sm-12 col-xs-12 mt-3">
                                                <div class="d-grid gap-2">
                                                    <input name="subirCartel" class="btn-azul" type="submit" value="Subir Cartel">
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-3 d-md-inline-block col-md-6 col-sm-12 col-xs-12 mt-3">
                                                <div class="d-grid gap-2">
                                                    <input name="cancelar" class="btn-cancelar " type="submit" value="Cancelar">
                                                </div>
                                            </div>
                                            <div class="col-xl-7 col-lg-7 col-md-7 col-xs-12 d-sm-block mt-3">
                                                <img src="../../src/question.png" class="imgQuestion " alt="">
                                                <span class="text ">Solo puedes subir un archivo con un peso maximo de 10 mb y en formato JPG.</span>
                                            </div>
                                            <div class="mt-3">
                                                <?php
                                                if (strlen($_SESSION['info']) > 1) {
                                                ?>
                                                    <div id="informacionExito" class="alert alert-success text-center">
                                                        <?php echo $_SESSION['info']; ?>
                                                        <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if (count($errores) > 0) {
                                                ?>
                                                    <div id="informacionError" class="alert alert-danger text-center">
                                                        <?php
                                                        foreach ($errores as $showerror) {
                                                            echo $showerror;
                                                        }
                                                        ?>
                                                        <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="container-fluid p-5 mt-5 mb-5 d-none d-md-block"></div>
                            <div class="container-fluid p-1 mt-2 mb-2 d-none d-md-block"></div>
                            <div class="container-fluid p-5 mt-5 mb-5"></div>
                            <!----------------------------------------------------------------------------------------------->
                        <?php
                            break;
                                case '2':
                        ?>
                                <h2 class="mt-5 mb-3">Subir Extenso</h2>
                                <hr>
                                <?php
                                    //Restriccion de la fecha de correcion de resumen
                                    require "../../modelo/fechasRecepcionExtensos.php";
                                    if (mysqli_num_rows($resFechaRecepcionExtenso) > 0) {
                                ?>
                    <!-------------------------------------------------------------------------------------------->
                    <!-------------------------CONTAINER QUE SE MUESTRA CUANDO EL USUARIO SUBE UN EXTENSO---------->
                    <div class="containerSubirArchivo" id="containerSubirArchivo">
                        <div class="row mt-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 d-md-block col-md-12 col-sm-12 col-xs-12  mt-3">
                                <input type="file" class="form-control" name="inputExtenso" id="inputExtenso" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 d-md-inline-block col-md-6 col-sm-12 col-xs-12 mt-3">
                                <div class="d-grid gap-2">
                                    <input name="subirPonencia" class="btn-azul" type="submit" value="Subir Extenso">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 d-md-inline-block col-md-6 col-sm-12 col-xs-12 mt-3">
                                <div class="d-grid gap-2">
                                    <input name="cancelar" class="btn-cancelar " type="submit" value="Cancelar">
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-7 col-xs-12 d-sm-block mt-3">
                                <img src="../../src/question.png" class="imgQuestion " alt="">
                                <span class="text ">Solo puedes subir un archivo con un peso maximo de 10 mb y en formato .docx (Wordx)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <?php
                                        if (strlen($_SESSION['info']) > 1) {
                        ?>
                            <div id="informacionExito" class="alert alert-success text-center">
                                <?php echo $_SESSION['info']; ?>
                                <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
                            </div>

                        <?php
                                        }
                        ?>
                        <?php
                                        if (count($errores) > 0) {
                        ?>
                            <div id="informacionError" class="alert alert-danger text-center">
                                <?php
                                            foreach ($errores as $showerror) {
                                                echo $showerror;
                                            }
                                ?>
                                <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
                            </div>
                        <?php
                                        }
                        ?>
                    </div>
            </div>
            <div class="container-fluid p-5 mt-5 mb-5 d-none d-md-block"></div>
            <div class="container-fluid p-2 mt-5 mb-5 d-none d-md-block"></div>
            <div class="container-fluid p-5 mt-5 mb-5"></div>
            <!----------------------------------------------------------------------------------------------->
        <?php
                                    } 
                                    else {
        ?>
            <!--------------ESTE CONTENEDOR SE MUESTRA CUANDO EL USUARIO NO TIENE PONENCIAS ASIGNADAS--------->
            <div class=" containerSinR " id="containerSinR">
                <span class="texto-trabajo mb-3">Revisa las fechas de recepción de extensos</span>
                <h1 class="mt-5">Aún no es la fecha para<br> subir extensos de trabajos.</h1>
                <a href="../actividadesFechas/fechas.php">Ver fechas</a>
            </div>
<?php

                                    }
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                        }

                        if (($descripcionRevisionPonencia == 'EXTENSO' && $estadoRevisionPonencia == 'A') || ($descripcionRevisionPonencia == 'RESUMEN' && $idTipoPonencia == '3' && $estadoRevisionPonencia == 'A') || ($descripcionRevisionPonencia == 'CARTEL' && $idTipoPonencia == '1' && $estadoRevisionPonencia == 'A') || ($descripcionRevisionPonencia == 'RESUMEN' && $idTipoPonencia == '4' && $estadoRevisionPonencia == 'A') || ($descripcionRevisionPonencia == 'EXTENSO REVISION FINAL' && $estadoRevisionPonencia == 'A')) {
?>
<!----------------------------------------------------------------------------------------------->
<h2 class="mt-5 mb-3">Link de Video</h2>
<hr>
<!-------------------------------------------------------------------------------------------->
<?php
                            //Restriccion de la fecha fechas videos
                            require "../../modelo/fechasRecepcionVideos.php";
                            if (mysqli_num_rows($resFechaRecepcionVideos) > 0) {
?>
    <!--
    <div class="containerSubirArchivo mb-5" id="containerSubirArchivo">
        <span class="card-text"><strong>Google Drive</strong></span>
        <div class="row mt-4">
            <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 col-xs-12">
                <input type="text" name="inputLinkVideo" class="form-control mb-3" placeholder="Copia y pega tu link de Google Drive aqui">
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 d-sm-block col-sm-12 col-xs-12">
                <div class="d-grid">
                    <input name="subirVideo" class="btn-azul" type="submit" value="Agregar">
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>
    -->
    <div class="containerSubirArchivo mb-5" id="containerSubirArchivo">
        <span class="card-text"><strong>Por favor sigue las indicaciones de la carta de extenso aceptado enviado al correo.</strong></span>
        
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 col-xs-12">
                <div class="mt-4 d-flex align-self-end">
                    <img src="../../src/question.png" class="imgQuestion me-2" alt="">
                    <span class="span-textos ">Revisa las Especificaciones del video antes de enviar el link</span>
                </div>
            </div>
            <div class="col-6"></div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 col-xs-12 d-grid">
                <a href="../../components/GuiasYPlantillas/guias.php"><button type="button" class="btn-azul">Especificaciones de video</button></a>
            </div>
        </div>
        <div class="mt-3">
            <?php
                                if (strlen($_SESSION['info']) > 1) {
            ?>
                <div id="informacionExito" class="alert alert-success text-center">
                    <?php echo $_SESSION['info']; ?><a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
                </div>
            <?php
                                }
            ?>
            <?php
                                if (count($errores) > 0) {
            ?>
                <div id="informacionError" class="alert alert-danger text-center">
                    <?php
                                    foreach ($errores as $showerror) {
                                        echo $showerror;
                                    }
                    ?>
                    <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
                </div>
            <?php
                                }
            ?>
        </div>
    </div>
    <div class="container-fluid p-4 mt-5 mb-5 d-none d-md-block"></div>
    <div class="container-fluid p-5 mt-5 mb-5"></div>
    <!----------------------------------------------------------------------------------------------->
<?php
                            } else {
?>
    <!--------------ESTE CONTENEDOR SE MUESTRA CUANDO EL USUARIO NO TIENE PONENCIAS ASIGNADAS--------->
    <div class=" containerSinR " id="containerSinR">
        <span class="texto-trabajo mb-3">Revisa las fechas de recepción de videos</span>
        <h1 class="mt-5">Aún no es la fecha para<br> subir videos de trabajos.</h1>
        <a href="../actividadesFechas/fechas.php">Ver fechas</a>
    </div>
<?php
                            }
                        }
?>

</form>
        </div>
    </div>
    </div>
    </div>



    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>
