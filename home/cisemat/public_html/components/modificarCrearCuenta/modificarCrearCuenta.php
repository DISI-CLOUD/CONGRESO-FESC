<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();

if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    echo "<script>alert('Acceso inválido.'); window.location.href='../../components/inicioSesion/sesion.php';</script>";
    exit;
}

require_once "../../modelo/conexion.php";
require_once "../../modelo/privilegiosUsuario.php";

// Traer color automatizado
$valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$color = mysqli_query($conexion, $valorColor);
$rowColor = $color->fetch_assoc();
$colorHex = $rowColor['color_congreso'];

$estadoPrivilegio = []; // Un arreglo que guarda los estados del privilegio
$cont2 = 0; // Para recorrer las posiciones del segundo arreglo

$consPrivilegiosEstado = "SELECT * FROM funcion_usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexion, $consPrivilegiosEstado);
mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
mysqli_stmt_execute($stmt);
$resPrivilegiosEstado = mysqli_stmt_get_result($stmt);

while ($row2 = mysqli_fetch_array($resPrivilegiosEstado)) {
    $estadoPrivilegio[$cont2] = $row2['estado_funcion'];
    $cont2++;
}

$_SESSION['estadoPrivilegio'] = $estadoPrivilegio;

$var_exito = '';
$var_error = '';

foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
    if ($valor == 44 && $estado == 'ON') {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <link rel="shortcut icon" href="../../favicon.png">
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Congreso</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">
            <link rel="stylesheet" href="../../Layouts/CrearCongreso/crearCongreso.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
                integrity="sha384-fbnYnJt1BfFj/tKuWELG5S7tv+20a2OvEgduPJi1d0zDAtMDodhQKgX8hKfQIP3z" crossorigin="anonymous">
        </head>
        <style>
            /* Estilo para Colores de los botones */
            .btn-warning {
                background-color: goldenrod;
            }

            .border-primary {
                color: steelblue;
            }
        </style>

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
                            <!--<h2 class="mt-5 mb-3">Administrar Diseño</h2>-->
                            <?php
                            include "../../modelo/cambiarFotosCrearCuenta.php";
                            include "../../modelo/borrarFotosCrearCuenta.php";


                            echo $var_exito;
                            echo $var_error;

                            ?>
                        </div>
                        <div class="mt-5 mb-3">
                            <h2 class="mt-5 mb-3">Administrar Diseño</h2>
                            <hr style="border: 1px solid #000;">
                            <h4>
                                <div style="color: rgb(234, 190, 63);">Crear Cuenta<i></i></div>
                            </h4>

                            <main>
                                <div class=" p-4 row row-cols-1 row-cols-md-3 mb-3 text-center">
                                    <div class="col">
                                        <div class="card mb-4 rounded-3 shadow-sm" style="border-color: <?php echo $colorHex; ?>;">
                                            <div class="card-header py-3" style="background-color: <?php echo $colorHex; ?> !important; border-color: <?php echo $colorHex; ?>;">
                                                <h4 class="my-0 fw-normal text-white">Inicio de Sesión</h4>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                $sql = $conexion->query("SELECT ruta FROM imagenescrearcuenta WHERE id_imagen = 1");
                                                $rutaSn = $sql->fetch_object();
                                                $ruta=$rutaSn->ruta;            
                                                if($ruta == ""){
                                                    $default="../../src/ImgCrearCuenta/defaultScreen.jpg";
                                                    $ruta=$default;
                                                }
                                                ?>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <img src="<?= $ruta ?>" width="167" height="259"
                                                        style="width: 215px; height: 320px; object-fit: cover; border-top-left-radius: 14px; border-top-right-radius: 14px; border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                                                </ul>
                                                <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseSesion"
                                                    aria-expanded="false" aria-controls="collapseSesion"
                                                    class="w-100 btn btn-lg" style="background-color: <?php echo $colorHex; ?> !important; color: #FFF;">Cambiar</button>
                                                <div class="collapse" id="collapseSesion">
                                                    <div class="card card-body">

                                                        <label for="formFileSm" class="form-label">Selecciona la nueva
                                                            imagen</label>
                                                        <form method="post" enctype="multipart/form-data">
                                                            <input class="form-control form-control-sm" id="formFileSesion"
                                                                type="file" accept="image/*" name="unamIS">
                                                            <br>
                                                            <input type="submit" name="saveSn"
                                                                class="m-auto w-100 btn btn-sm btn-outline-warning"
                                                                value="Guardar">
                                                        </form>
                                                    </div>
                                                </div>

                                                <form method="post"> <input type="submit" name="deleteSn"
                                                    class="m-auto w-100 btn btn-lg btn-warning" value="Eliminar">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card mb-4 rounded-3 shadow-sm" style="border-color: <?php echo $colorHex; ?>;">
                                            <div class="card-header py-3 text-bg-primary" style="background-color: <?php echo $colorHex; ?> !important; border-color: <?php echo $colorHex; ?>;">
                                                <h4 class="my-0 fw-normal text-white">Crear Cuenta</h4>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                $sql = $conexion->query("SELECT ruta FROM imagenescrearcuenta WHERE id_imagen = 2");
                                                $rutaAccount = $sql->fetch_object();
                                                $rutaAc=$rutaAccount->ruta;            
                                                if($rutaAc == ""){
                                                    $default="../../src/ImgCrearCuenta/defaultScreen.jpg";
                                                    $rutaAc=$default;
                                                }
                                                ?>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <img src="<?= $rutaAc ?>" width="167" height="259"
                                                        style="width: 215px; height: 320px; object-fit: cover; border-top-left-radius: 14px; border-top-right-radius: 14px; border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                                                </ul>
                                                <button type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseAccount" aria-expanded="false"
                                                    aria-controls="collapseAccount"
                                                    class="w-100 btn btn-lg" style="background-color: <?php echo $colorHex; ?> !important; color: #FFF;">Cambiar</button>
                                                <div class="collapse" id="collapseAccount">
                                                    <div class="card card-body">
                                                        <label for="formFileSm" class="form-label">Selecciona la nueva
                                                            imagen</label>
                                                        <form method="post" enctype="multipart/form-data">
                                                            <input class="form-control form-control-sm" id="formFileAccount"
                                                                type="file" accept="image/*" name="imgCuenta">
                                                            <br>
                                                            <input type="submit" name="saveAccount"
                                                                class="m-auto w-100 btn btn-sm btn-outline-warning"
                                                                value="Guardar">
                                                        </form>
                                                    </div>
                                                </div>
                                                <form method="post"> <input type="submit" name="deleteAc"
                                                    class="m-auto w-100 btn btn-lg btn-warning" value="Eliminar">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card mb-4 rounded-3 shadow-sm" style="border-color: <?php echo $colorHex; ?>;">
                                            <div class="card-header py-3 text-bg-primary" style="background-color: <?php echo $colorHex; ?> !important; border-color: <?php echo $colorHex; ?>;">
                                                <h4 class="my-0 fw-normal text-white">Contraseña</h4>
                                            </div>
                                            <div class="card-body">
                                            <?php
                                                $sql = $conexion->query("SELECT ruta FROM imagenescrearcuenta WHERE id_imagen = 3");
                                                $rutaPass = $sql->fetch_object();
                                                $rutaP=$rutaPass->ruta; 
                                                if($rutaP == ""){
                                                    $default="../../src/ImgCrearCuenta/defaultScreen.jpg";
                                                    $rutaP=$default;
                                                }
                                                ?>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <img src="<?= $rutaP ?>"
                                                        width="167" height="259"
                                                        style="width: 215px; height: 320px; object-fit: cover; border-top-left-radius: 14px; border-top-right-radius: 14px; border-bottom-right-radius: 14px; border-bottom-left-radius: 14px;">
                                                </ul>
                                                <button type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsePassword" aria-expanded="false"
                                                    aria-controls="collapsePassword"
                                                    class="w-100 btn btn-lg" style="background-color: <?php echo $colorHex; ?> !important; color: #FFF;">Cambiar</button>
                                                <div class="collapse" id="collapsePassword">
                                                    <div class="card card-body">
                                                    <form method="post" enctype="multipart/form-data">
                                                            <input class="form-control form-control-sm" id="formFileAPassword"
                                                                type="file" accept="image/*" name="unamRC">
                                                            <br>
                                                            <input type="submit" name="saveImgPAss"
                                                                class="m-auto w-100 btn btn-sm btn-outline-warning"
                                                                value="Guardar">
                                                        </form>
                                                    </div>
                                                </div>
                                                <form method="post"> <input type="submit" name="deletePass"
                                                    class="m-auto w-100 btn btn-lg btn-warning" value="Eliminar">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </main>

                        </div>
                    </div>
                </div><!--col-10-->
            </div>
            </div>
            <footer>
                <?php
                require_once('../../Layouts/footer.php');
                ?>
            </footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
                crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
        </body>

        </html>
    <?php }
}


?>
