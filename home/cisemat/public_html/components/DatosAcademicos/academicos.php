<?php

/** 
 *******************************************************************************************************
 * Apartado donde guardas la trayectoria academica del usuario, modulo de semblanza 
 * Cualquier duda o sugerencia:
 * @author Alison Michelle Rubio Garcia allyssonrg@gmail.com,  Marina Sanchez, Carlos Tejeda Araujo.
 *******************************************************************************************************
 **/

session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}

require '../../modelo/completarPerfil.php';

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
    <title>Mis datos académicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./academicos.css">

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
                require "../../modelo/traerDatosAcademicos.php";
                require "../../modelo/actualizarDatosAcademicos.php";
                require '../../modelo/completarPerfil.php';
                //Verifica que el usuario tenga su perfil completado

                if ($estadoUsuario == '') {
                    $info = "Completa tus datos académicos seleccionando la preparación que tienes y subiendo una semblanza. <br><b>Es necesario que completes todos los datos (datos académicos y laborales) para poder subir un trabajo.</b>";
                    $_SESSION['datosAdicionales'] = $info;
                } else if ($estadoUsuario == 'I') {
                    $info = "La vigencia de tu semblanza ha expirado. Debes ir a tus datos académicos para actualizar tu semblanza para acceder a todas las funciones del sitio. Al completar tu perfil automáticamente se habilitarán todas  las funciones.";
                    $_SESSION['datosAdicionales'] = $info;
                } else {
                    $info = '';
                    $_SESSION['datosAdicionales'] = $info;
                }

                ?>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                <div class="container">
                    <?php
                    if($estadoUsuario==''){
                    ?>
                    <div class="my-5 d-flex justify-content align-items-center">
                        <span class="h1 text-secondary"><u>Registro 3/4</u></span>
                        <img id="rfcInformacion" style="cursor: pointer; width: 25px; height: 25px;" class="mx-3 rfcInformacion viewPassword imagenQuestion" src="../../src/question.png" alt="" data-toggle="tooltip" data-placement="right" title="El registro consta de 4 pasos, te encuentras en el 3/4, registrar tus datos academicos.">
                    </div>
                    <?php
                    }
                    ?>
                    <h2 class="my-5 "><span class="text-danger">*</span> Mis datos académicos</h2>
                    <span class="mt-1 mb-3 texto-academicos">Estudios y logros</span><br>
                    <?php

                    if (strlen($_SESSION['datosAdicionales']) > 1) {
                    ?>
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Completar registro</h4>
                            <p>Aún no has completado tu perfil.</p>
                            <hr>
                            <p class="mb-0"><?php echo $_SESSION['datosAdicionales']; ?></p>
                            <!--<a href="../DatosLaborales/laborales.php"> Datos Laborales</a>-->
                        </div>
                    <?php
                    }
                    ?>
                   <span class="mt-1 mb-3 texto-academicos"> <span class="text-danger">*</span> Nivel académico</span>

                    <div class="row mt-3 ">
                        <div class="col-lg-6 col-md-6">
                            <?php
                            require '../../modelo/completarPerfil.php';
                            if (strlen($_SESSION['info']) > 1) {
                            ?>
                                <div id="informacionExito" class="alert alert-success text-center">
                                    <?php echo $_SESSION['info']; ?>
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
                                </div>
                            <?php
                            }else{?>
                               <div id="informacionExito" class="alert alert-success text-center">
                                    <?php echo $_SESSION['info']; ?> Se han actualizado tus datos académicos 
                                </div>     
                            <?php
                            }
                            ?>

                            <form method="POST">
                                <select id="selectNivelAcademico" name="selectNivelAcademico" class="form-select texto-academicos fw-semibold" aria-label="Default select example">
                                    <option disabled>Selecciona una opción</option>
                                    <?php

                                    while ($fetch = mysqli_fetch_assoc($resDatosAcademicos)) {
                                        $idNivelAcademico = $fetch["id_nivel_academico"];
                                        $nivelAcademico = $fetch["nivel_academico"];
                                        if ($nivelAcademicoUsuario == $idNivelAcademico) {

                                    ?>
                                            <option selected value="<?php echo $idNivelAcademico ?>" id="<?php echo $idNivelAcademico ?>" name="<?php echo $idNivelAcademico ?>"><?php echo $nivelAcademico ?></option>
                                        <?php } else {
                                        ?>
                                            <option value="<?php echo $idNivelAcademico ?>" id="<?php echo $idNivelAcademico ?>" name="<?php echo $idNivelAcademico ?>"><?php echo $nivelAcademico ?></option>
                                    <?php
                                        }
                                    }

                                    ?>
                                </select>
                                <input class="btn btn-style-chico shadow mt-3" type="submit" name="botonGuardarDatosAcademicos" id="botonGuardarDatosAcademicos" value="Guardar">
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-6 d-none d-sm-block">
                        </div>
                    </div>
                    <div class="row mt-3 ">
                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-6 col-md-6 d-none d-sm-block">
                        </div>
                    </div>
                    <h3 class="mt-4 mb-3"><span class="text-danger">*</span> Semblanza</h3>
                    <div class="row mt-3 ">
                        <div class="col-lg-6">
                            <span class="texto-academicos">Este resumen se mostrará como presentación para cada panelista, asegúrate de incluir: logros académicos, laborales, participaciones en congresos anteriores y estudios complementarios.</span><br><br>
                            <span class="texto-academicos">Debera subirlo en formato PDF con fuente Arial 12</span>

                            <div class="row mt-3">
                                <div class="col-lg-7 mb-2">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="d-grid gap-2">
                                            <input type="file" class="form-control" name="inputSemblanza" id="inputSemblanza">


                                        </div>


                                        <div class="col-lg-5 d-grid gap-2 mt-3">
                                            <input id="subirSemblanza" name="subirSemblanza" class="btn btn-style-chico shadow p-1" type="submit" value="Subir" onclick='location.reload();'>
                                        </div>

                                    </form>


                                </div>
                                <div class="row mt-2 mt-4">
                                    <div class="col-5">
                                        <div class="d-grid gap-2">

                                            <!--  <input class="btn btn-rojo shadow p-2" type="submit" value="Subir" id="subirSemblanzaArchivo" name="subirSemblanzaArchivo">-->
                                        </div>
                                    </div>
                                    <div class="col-7">

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 d-none d-sm-block">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>


<script>
    /*
    //Valida que no se reenvie el formulario
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    */
</script>