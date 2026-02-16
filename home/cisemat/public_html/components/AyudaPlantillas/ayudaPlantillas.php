<?php
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
            <link rel="stylesheet" href="../../Layouts/guiasPlantillas/ayudaPlantillas.css">
            <link rel="stylesheet" href="../../components/cambiarDiseño/cambiarDiseño.css">
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
                            <h2 class="mt-5 mb-3">Administrar Diseño</h2>
                            <div class="texto-dorado">Ayuda</div><br>
                            <?php
                            // Mostrar mensaje si existe
                            if (isset($_SESSION['mensaje'])) {
                                echo '<div class="alert alert-info" role="alert">' . $_SESSION['mensaje'] . '</div>';
                                unset($_SESSION['mensaje']); // Limpiar el mensaje
                            }
                            ?>
                            <div class="cuadricula">
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?> !important;">Plantilla Actual Autores</h4>

                                        <div class="elemento-cuadricula bd contenedor-plantillasA1">
                                        <label style="font-size: 20px; font-weight: bold;">Guía para Autores</label>
                                        <br><br>
                                        <p>Este documento detalla el proceso para presentar un trabajo de ponencia con las especificaciones requeridas para su aprobación.</p>
                                        <div class="d-flex justify-content-center mt-4">
                                            <a href="../../src/GuiasYPlantillas/Guia_para_autores.pdf" target="_blank" class="btn btn-primary" style="width: 80%; margin: 30px 0; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none;">Descargar Guía</a>
                                        </div> 
                                        
                                
                                    </div>

                                    </div>
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?> !important;">Modificar Plantilla Autores</h4>


                                        <label style="font-size: 20px; font-weight: bold;">Guía para Autores</label>
                                        <div class="elemento-cuadricula ">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapsePassword" aria-expanded="false" aria-controls="collapsePassword" class="btn btn-primary" type="button" style="width: 80%; margin: 30px 0; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none;">Actualizar</button>
                                        <div class="collapse" id="collapsePassword">
                                            <div class="card card-body">
                                                <form action="procesar_archivo_autores.php" method="post" enctype="multipart/form-data">
                                                    <input type="file" name="nuevo_archivo1" class="form-control" >
                                                    <input type="hidden" name="archivo_a_reemplazar1" value="Guia_para_autores.pdf">
                                                    <input type="submit" name="submit1" value="Actualizar" class="m-auto w-100 btn btn-sm btn-outline-warning">
                                                </form>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    </div>

                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?> !important;">Plantilla Actual Extensos</h4>
                                        <div class="elemento-cuadricula bd contenedor-plantillasA1">
                                        <label style="font-size: 20px; font-weight: bold;">Plantilla para trabajos extensos</label>
                                        <br><br>
                                        <p>Los trabajos extensos deberán redactarse basándose en la plantilla de trabajos extensos. La única modalidad que requiere de un trabajo extenso es ponencia oral en formatos .doc o .docx Los archivos no deben exceder los (3 MB).</p>
                                        <div class="d-flex justify-content-center mt-4">
                                            <a href="../../src/GuiasYPlantillas/Plantilla_extenso.docx" target="_blank" class="btn btn-primary" style="width: 80%; margin: 30px 0; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none;">Descargar Plantilla</a>
                                        </div> 
                                
                                    </div>
                                    </div>
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?> !important;">Modificar Plantilla Extensos</h4>
                                        <label style="font-size: 20px; font-weight: bold;">Plantilla para trabajos extensos</label>
                                        <div class="elemento-cuadricula ">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseP" aria-expanded="false" aria-controls="collapseP" class="btn btn-primary" type="button" style="width: 80%; margin: 30px 0; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none;">Actualizar</button>
                                        <div class="collapse" id="collapseP">
                                            <div class="card card-body">
                                                <form action="procesar_archivo_extensos.php" method="post" enctype="multipart/form-data">
                                                    <input type="file" name="nuevo_archivo2" class="form-control" >
                                                    <input type="hidden" name="archivo_a_reemplazar2" value="Plantilla_extenso.docx">
                                                    <input type="submit" name="submit2" value="Actualizar" class="m-auto w-100 btn btn-sm btn-outline-warning">
                                                </form>
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
<?php
    }
}
?>
