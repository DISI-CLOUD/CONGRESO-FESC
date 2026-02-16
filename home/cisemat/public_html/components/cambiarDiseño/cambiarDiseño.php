<?php
session_start();
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    echo "<script>alert('Acceso inválido.'); window.location.href='../../components/inicioSesion/sesion.php';</script>";
    exit;
}
require_once "../../modelo/conexion.php";
require_once "../../modelo/privilegiosUsuario.php";

// Color automatico
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
foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
    if ($valor == 44 && $estado == 'ON') {
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
            <title>Congreso</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">
            <link rel="stylesheet" href="../../Layouts/CrearCongreso/crearCongreso.css">
            <link rel="stylesheet" href="../../components/cambiarDiseño/cambiarDiseño.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha384-fbnYnJt1BfFj/tKuWELG5S7tv+20a2OvEgduPJi1d0zDAtMDodhQKgX8hKfQIP3z" crossorigin="anonymous">
            <link rel="stylesheet" href="./disact.css">
            <style>

            </style>
        </head>

        <body>
            <!-- Cargar jQuery primero -->
            <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

            <!-- Luego, cargar Bootstrap 5 -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->
            
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
                            <h2 class="mt-5 mb-3">Administrar Diseño</h2>

                            <div class="texto-dorado">Modulo</div>
                            <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 mt-5 mb-5">
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    <!-------------PRIMER ITEM---------------------->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingUno">
                                            <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseUno" aria-expanded="true" aria-controls="panelsStayOpen-collapseUno">
                                                Pagina Principal
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseUno" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingUno">
                                            <div class="accordion-body Cuerpo-texto">
                                                <br>
                                                <ul class="list-style-type: square;">

                                                    <li class="Cuerpo-texto">Color del Banner</li>
                                                    <br>
                                                    <li class="Cuerpo-texto">Logos</li>
                                                    <br>
                                                    <li class="Cuerpo-texto">Nombre del Congreso</li>
                                                    <br>
                                                    <li class="Cuerpo-texto">Patrocinadores</li>
                                                </ul>
                                                <div>
                                                    <div class="d-flex boton-flex mt-4">
                                                        <a href="../paginaPrincipal/paginaPrincipal.php" class="botones_descarga center shadow py-2 px-4 mb-1 text-wrap btn text-btn" style="background-color: <?php echo $colorHex; ?>!important;">Modificar</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-------------SEGUNDO ITEM---------------------->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingDos">
                                            <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseDos" aria-expanded="true" aria-controls="panelsStayOpen-collapseDos">
                                                Registro
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseDos" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingUno">
                                            <div class="accordion-body Cuerpo-texto">
                                                <br>
                                                <ul class="list-style-type: square;">

                                                    <li class="Cuerpo-texto">Costos Individuales</li>
                                                </ul>
                                                <div>
                                                    <div class="d-flex boton-flex mt-4">
                                                        <a href="../CambiarCosto/cambiarCosto.php" class="botones_descarga  center shadow py-2 px-4 mb-1 text-wrap btn text-btn" style="background-color: <?php echo $colorHex; ?>!important;">Modificar</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-------------TERCER ITEM---------------------->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingTres">
                                            <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTres" aria-expanded="true" aria-controls="panelsStayOpen-collapseTres">
                                                Crear Cuenta
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseTres" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingUno">
                                            <div class="accordion-body Cuerpo-texto">
                                                <br>
                                                <ul class="list-style-type: square;">

                                                    <li class="Cuerpo-texto">Imagen de Login</li>
                                                    <br>
                                                    <li class="Cuerpo-texto">Imagen de Crear Cuenta</li>
                                                    <br>
                                                    <li class="Cuerpo-texto">Imagen de Olvide Contraseña</li>
                                                </ul>
                                                <div>
                                                    <div class="d-flex boton-flex mt-4">
                                                        <a href="../modificarCrearCuenta/modificarCrearCuenta.php" class="botones_descarga center shadow py-2 px-4 mb-1 text-wrap btn text-btn" style="background-color: <?php echo $colorHex; ?>!important;">Modificar</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-------------CUARTO ITEM---------------------->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingCuarto">
                                            <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseCuarto" aria-expanded="true" aria-controls="panelsStayOpen-collapseCuarto">
                                                Actividades
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseCuarto" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingUno">
                                            <div class="accordion-body Cuerpo-texto">
                                                <br>
                                                <ul class="list-style-type: square;">

                                                    <li class="Cuerpo-texto">Fechas del Congreso</li>
                                                </ul>
                                                <div>
                                                    <div class="d-flex boton-flex mt-4">
                                                        <a href="../DiseñoAct/menudisact.php" class="botones_descarga  center shadow py-2 px-4 mb-1 text-wrap btn text-btn" style="background-color: <?php echo $colorHex; ?>!important;">Modificar</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-------------QUINTO ITEM---------------------->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingQuinto">
                                            <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseQuinto" aria-expanded="true" aria-controls="panelsStayOpen-collapseQuinto">
                                                Ayuda
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseQuinto" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingQuinto">
                                            <div class="accordion-body Cuerpo-texto">
                                                <br>
                                                <ul class="list-style-type: square;">

                                                    <li class="Cuerpo-texto">Plantillas</li>
                                                </ul>
                                            </div>
                                            <div>
                                                <div class="d-flex boton-flex mt-4">
                                                    <a href="../../components/AyudaPlantillas/ayudaPlantillas.php" class="botones_descarga shadow py-2 px-4 mb-1 text-wrap btn text-btn" style="background-color: <?php echo $colorHex; ?>!important;">Modificar</a>
                                                </div>
                                            </div>
                                        </div>
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
<?php }
}
?>
