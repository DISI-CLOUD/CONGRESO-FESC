<?php
session_start();
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    echo "<script>alert('Acceso inválido.'); window.location.href='../../components/inicioSesion/sesion.php';</script>";
    exit;
}

require_once "../../modelo/conexion.php";
require_once "../../modelo/privilegiosUsuario.php";
include "../../modelo/traerLogo1.php";
include "../../modelo/traerLogo2.php";
include "../../modelo/traerCartel.php";
include "../../modelo/traerNombre.php";

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
            <link rel="stylesheet" href="../../Layouts/CrearCongreso/crearCongreso.css">
            <link rel="stylesheet" href="../../components/cambiarDiseño/cambiarDiseño.css">
            <link rel="stylesheet" href="../paginaPrincipal/paginaPrincipal.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha384-fbnYnJt1BfFj/tKuWELG5S7tv+20a2OvEgduPJi1d0zDAtMDodhQKgX8hKfQIP3z" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
        </head>

        <body>
            <header>
                <?php
                require_once('../../Layouts/nav.php');
                ?>
                </header>
                <div class="container-fluid contenido">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                            <?php
                            require_once('../../Layouts/sidebar.php');
                            ?>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                            <div class="container">
                                <h2 class="mt-5 mb-3">Administrar Diseño</h2>

                                <div class="texto-modulo">
                                    <h3 class="texto-dorado">Cambiar Diseño de la Página Principal del Congreso</h3>
                                </div>
                                <!-- Comienzo modulo Diseño del Congreso -->
                                <div class="cuadricula">
                                    <!-- Color del Banner -->
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?> !important;">Color del Banner</h4>
                                    </div>
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?> !important;">Actualizar Color del Banner</h4>
                                    </div>
                                    <div class="elemento-cuadicula colores-antes bd">
                                        <div class="contenido-colores">
                                            <?php
                                            $colorAnterior = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
                                            $queryColor = mysqli_query($conexion, $colorAnterior);
                                            $rowColor = $queryColor->fetch_assoc();
                                            $color1 = $rowColor["color_congreso"];
                                            ?>
                                            <form>
                                                <label for="color" class="textoCuadricula">Color anterior:</label><br>
                                                <input type="color" id="color" name="color" class="colorInput" value="<?php echo $color1; ?>" disabled>
                                            </form>
                                            <!-- Script Debajo del Footer -->
                                            <div id="muestraColor"></div>
                                            <div id="valorHexadecimal" class="textoCuadricula"></div>
                                        </div>
                                    </div>

                                    <div class="elemento-cuadicula">
                                        <div class="contenido-colores">
                                            <form method="post" action="../../modelo/actualizarRecursos/actualizarColor.php">
                                                <label for="color2" class="textoCuadricula">Color Nuevo:</label><br>
                                                <input type="color" id="color2" name="color2" class="colorInput" required><br><br>
                                                <div id="muestraColor2"></div>
                                                <div id="valorHexadecimal2" class="textoCuadricula"></div>
                                                <input type="submit" value="Actualizar" class="boton-dsg boton-dsg--amarillo" style="border: none; max-width: 200px; font-size: 20px; margin-top: 15px;">
                                            </form>
                                            <!-- Script Debajo del Footer -->
                                        </div>
                                    </div>

                                    <!-- Nombre del Longreso -->

                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?> !important;">Nombre del Congreso</h4>
                                    </div>
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Actualizar Nombre del congreso</h4>
                                    </div>
                                    <div class="elemento-cuadricula bd contenido-flex nombre-antes">
                                        <h5>
                                            <p><?php echo $rutaTXT; ?></p>
                                        </h5>
                                    </div>
                                    <div class="elemento-cuadricula">
                                        <form action="../../modelo/actualizarRecursosCongreso4.php" method="post">
                                            <label for="nombreC" class="nombreTitulo">Nuevo Nombre</label><br>
                                            <textarea name="nombre" id="nombreC" class="nombreCongreso" required></textarea> <!-- Script Uppercase debajo -->
                                            <input type="submit" value="Guardar" class="btn btn-primary" style="width: 80%; margin-bottom: 20px; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none; color: white !important;">
                                        </form>
                                    </div>

                                    <!-- Logos del Congreso -->

                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Logos</h4>
                                    </div>
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Actualizar Logos</h4>
                                    </div>
                                    <div class="elemento-cuadricula bd logos-cuadricula grid-logos">
                                        <div class="bloque">
                                            <img src="<?php echo $rutaProvisional; ?>" width="80%" style="border-radius: 10px">
                                            <label style="font-size: 20px; font-weight: bold;">Logo Congreso Actual</label>
                                        </div>
                                        <div class="bloque">
                                            <img src="../<?php echo $rutaIMG6; ?>" width="80%" style="border-radius: 10px">
                                            <label style="font-size: 20px; font-weight: bold;">Logo Departamento Matemáticas</label>
                                        </div>
                                    </div>
                                    <div class="elemento-cuadricula logos-cuadricula grid-logos-botones">
                                        <div class="bloque bd">
                                            <label style="font-size: 20px; font-weight: bold;">Logo Congreso Actual</label>
                                            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseSesion" aria-expanded="false" aria-controls="collapseSesion" class="btn btn-primary" type="button" style="width: 80%; margin: 30px 0; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none;">Cambiar</button>
                                            <div class="collapse" id="collapseSesion">
                                                <div class="card card-body">
                                                    <form action="../../modelo/actualizarRecursosCongreso.php" method="post" enctype="multipart/form-data">
                                                        <input type="file" name="logo1" class="form-control" required>
                                                        <input type="submit" value="Guardar" class="m-auto w-100 btn btn-sm btn-outline-warning">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bloque">
                                            <label style="font-size: 20px; font-weight: bold;">Logo Departamento Matemáticas</label>
                                            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseAccount" aria-expanded="false" aria-controls="collapseAccount" class="btn btn-primary" type="button" style="width: 80%; margin: 30px 0; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none;">Cambiar</button>
                                            <div class="collapse" id="collapseAccount">
                                                <div class="card card-body">
                                                    <form action="../../modelo/actualizarRecursosCongreso2.php" method="post" enctype="multipart/form-data">
                                                        <input type="file" name="logo2" class="form-control" required>
                                                        <input type="submit" value="Guardar" class="m-auto w-100 btn btn-sm btn-outline-warning">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cartel o Poster del congreso -->

                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Cartel</h4>
                                    </div>
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Actualizar Cartel</h4>
                                    </div>
                                    <div class="elemento-cuadricula bd contenedor-cartel imagen-logo grid-cartel">
                                        <img src="../<?php echo $rutaIMG7; ?>" width="254" height="360" alt="cartel" style="border-radius: 10px">
                                    </div>

                                    <div class="elemento-cuadricula">
                                        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapsePassword" aria-expanded="false" aria-controls="collapsePassword" class="btn btn-primary" type="button" style="width: 80%; margin: 30px 0; background-color: #ebc961; font-size: 20px; font-weight: 600; border: none;">Cambiar</button>
                                        <div class="collapse" id="collapsePassword">
                                            <div class="card card-body">
                                                <form action="../../modelo/actualizarRecursosCongreso3.php" method="post" enctype="multipart/form-data">
                                                    <input type="file" name="cartel" class="form-control" required>
                                                    <input type="submit" value="Guardar" class="m-auto w-100 btn btn-sm btn-outline-warning">
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Banner -->

                                    <div class="elemento-cuadricula banner-titulo">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Actualizar Banner</h4>
                                    </div>
                                    <div class="elemento-cuadricula banner-imagen">
                                        <p><b></b>Banner:</p>
                                        <?php // Traer imagen de la BD
                                        $imagenSQL = "SELECT banner_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
                                        $traerIMG = mysqli_query($conexion, $imagenSQL);
                                        $rowImagen = $traerIMG->fetch_assoc();
                                        $rutaIMG = $rowImagen['banner_congreso'];
                                        if ($rutaIMG == "") {
                                            echo '<script>alert("Error, el archivo seleccionado no es una imagen o es muy pesado.");</script>';
                                        }
                                        ?>
                                        <img src="<?php echo $rutaIMG; ?>" width="80%" alt="Imagen Cartel no disponible" style="border-radius: 10px">
                                        <form method="post" enctype="multipart/form-data" action="../../modelo/actualizarRecursos/actualizarBanner.php"> <!-- flex botones-banner -->
                                            <div class="banner-botones">
                                                <input type="file" name="bannerIMG" class="form-control" style="max-width: 400px;" required>
                                                <input type="submit" value="Actualizar" class="boton-dsg boton-dsg--amarillo" style="border: none; max-width: 200px; font-size: 20px;">
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Patrocinadores del Congreso -->

                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Patrocinadores</h4>
                                    </div>
                                    <div class="elemento-cuadricula">
                                        <h4 style="background-color: <?php echo $colorHex; ?>!important;">Actualizar Patrocinadores</h4>
                                    </div>
                                    <div class="elemento-cuadricula bd pat-anterior carrusel"> <!-- Carrusel -->
                                        <!-- Slider main container -->
                                        <div class="swiper">
                                            <!-- Additional required wrapper -->
                                            <div class="swiper-wrapper">
                                                <!-- Slides -->
                                                <div class="swiper-slide">
                                                    <?php // Traer imagen de la BD
                                                    $imagenSQL1 = "SELECT pat1 FROM recursos_pagprin WHERE idRecurso = '1'";
                                                    $traerIMG1 = mysqli_query($conexion, $imagenSQL1);
                                                    $rowImagen1 = $traerIMG1->fetch_assoc();
                                                    $rutaIMG1 = $rowImagen1['pat1'];
                                                    ?>
                                                    <img src="<?php echo $rutaIMG1; ?>" alt="Patrocinador 1">
                                                </div>
                                                <div class="swiper-slide">
                                                    <?php // Traer imagen de la BD
                                                    $imagenSQL2 = "SELECT pat2 FROM recursos_pagprin WHERE idRecurso = '1'";
                                                    $traerIMG2 = mysqli_query($conexion, $imagenSQL2);
                                                    $rowImagen2 = $traerIMG2->fetch_assoc();
                                                    $rutaIMG2 = $rowImagen2['pat2'];
                                                    ?>
                                                    <img src="<?php echo $rutaIMG2; ?>" alt="Patrocinador 2">
                                                </div>
                                                <div class="swiper-slide">
                                                    <?php // Traer imagen de la BD
                                                    $imagenSQL3 = "SELECT pat3 FROM recursos_pagprin WHERE idRecurso = '1'";
                                                    $traerIMG3 = mysqli_query($conexion, $imagenSQL3);
                                                    $rowImagen3 = $traerIMG3->fetch_assoc();
                                                    $rutaIMG3 = $rowImagen3['pat3'];
                                                    ?>
                                                    <img src="<?php echo $rutaIMG3; ?>" alt="Patrocinador 3">
                                                </div>
                                                <div class="swiper-slide">
                                                    <?php // Traer imagen de la BD
                                                    $imagenSQL4 = "SELECT pat4 FROM recursos_pagprin WHERE idRecurso = '1'";
                                                    $traerIMG4 = mysqli_query($conexion, $imagenSQL4);
                                                    $rowImagen4 = $traerIMG4->fetch_assoc();
                                                    $rutaIMG4 = $rowImagen4['pat4'];
                                                    ?>
                                                    <img src="<?php echo $rutaIMG4; ?>" alt="Patrocinador 4">
                                                </div>
                                                <div class="swiper-slide">
                                                    <?php // Traer imagen de la BD
                                                    $imagenSQL5 = "SELECT pat5 FROM recursos_pagprin WHERE idRecurso = '1'";
                                                    $traerIMG5 = mysqli_query($conexion, $imagenSQL5);
                                                    $rowImagen5 = $traerIMG5->fetch_assoc();
                                                    $rutaIMG5 = $rowImagen5['pat5'];
                                                    ?>
                                                    <img src="<?php echo $rutaIMG5; ?>" alt="Patrocinador 5">
                                                </div>
                                            </div>
                                            <!-- If we need pagination -->
                                            <div class="swiper-pagination"></div>

                                            <!-- If we need navigation buttons -->
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>

                                        </div>
                                    </div>
                                    <div class="elemento-cuadricula patrocinadores">
                                        <p>Se pueden seleccionar un máximo de 5 imágenes.</p>
                                        <form method="post" action="../../modelo/actualizarRecursos/actualizarPatrocinadores.php" enctype="multipart/form-data">
                                            <div class="campo-pat">
                                                <label for="pat1">Seleccionar Patrocinador 1:</label>
                                                <input type="file" name="pat1" class="form-control" style="max-width: 400px;" required>
                                            </div>
                                            <div class="campo-pat">
                                                <label for="pat1">Seleccionar Patrocinador 2:</label>
                                                <input type="file" name="pat2" class="form-control" style="max-width: 400px;" required>
                                            </div>
                                            <div class="campo-pat">
                                                <label for="pat1">Seleccionar Patrocinador 3:</label>
                                                <input type="file" name="pat3" class="form-control" style="max-width: 400px;" required>
                                            </div>
                                            <div class="campo-pat">
                                                <label for="pat1">Seleccionar Patrocinador 4:</label>
                                                <input type="file" name="pat4" class="form-control" style="max-width: 400px;" required>
                                            </div>
                                            <div class="campo-pat">
                                                <label for="pat1">Seleccionar Patrocinador 5:</label>
                                                <input type="file" name="pat5" class="form-control" style="max-width: 400px;" required>
                                            </div>
                                            <input type="submit" value="Actualizar" class="boton-dsg boton-dsg--amarillo" style="border: none; max-width: 200px; font-size: 20px;">
                                        </form>
                                    </div>
                                </div> <!-- Cuadricula diseño -->
                            </div>
                        </div>
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
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
                <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
                <!-- Scripts para la paleta de colores -->

                <script>
                    //Paleta Color Anterior
                    const colorInput = document.getElementById('color');
                    const muestraColor = document.getElementById('muestraColor');
                    const valorColor = document.getElementById('valorHexadecimal');

                    colorInput.addEventListener('input', function() {
                        const colorSeleccionado = this.value;
                        muestraColor.style.backgroundColor = this.value;

                        const colorHex = colorSeleccionado.slice(1).toUpperCase();
                        valorHexadecimal.innerHTML = `Valor Hexadecimal: #${colorHex}`;
                    });
                </script>
                <script>
                    //Paleta Nuevo Color
                    const colorInput2 = document.getElementById('color2');
                    const muestraColor2 = document.getElementById('muestraColor2');
                    const valorColor2 = document.getElementById('valorHexadecimal2');

                    colorInput2.addEventListener('input', function() {
                        const colorSeleccionado2 = this.value;
                        muestraColor2.style.backgroundColor = this.value;

                        const colorHex2 = colorSeleccionado2.slice(1).toUpperCase();
                        valorHexadecimal2.innerHTML = `Valor Hexadecimal: #${colorHex2}`;
                    });
                </script>

                <!-- Script para textarea del nombre del congreso en mayusculas -->

                <script>
                    const textarea = document.getElementById('nombreC');

                    textarea.addEventListener('input', function() {
                        this.value = this.value.toUpperCase();
                    });
                </script>

                <!-- Script para el carrusel de patrocinadores-->
                <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
                <script>
                    const swiper = new Swiper('.swiper', {
                        // Optional parameters
                        direction: 'horizontal',

                        loop: true,

                        // If we need pagination
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },

                        // Navigation arrows
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },

                        // And if we need scrollbar
                        scrollbar: {
                            el: '.swiper-scrollbar',
                        },
                    });
                </script>
        </body>

        </html>
<?php }
}
?>
