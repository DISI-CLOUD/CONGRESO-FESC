<?php

/** 
 *******************************************************************************************************
 * Apartado que muestra las ponencias magistrales del actual congreso.
 * Cualquier duda o sugerencia:
 * @author Magda Marina Sanchez Campos marinacampos1125@gmail.com 
 *******************************************************************************************************
 **/
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
    <link rel="stylesheet" href="../actividades.css">

</head>

<body>
    <header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>
    <section style="margin-top: 250px;">
        <div class="container-fluid mt-5 mb-5"><!----------CONTENEDOR PRINCIPAL----------->
            <div class="row p-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="container cuadricula2 mb-5">
                        <div class="row mt-4 cuadricula">
                            <h2 class="mb-3">Talleres</h2>
                            <p class="text-description">A través de los años en el Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas, invitamos a Congresistas especializados en el área de las matemáticas para impartir Talleres prácticos, en dos sesiones, para que puedan explicar la aplicación de las matemáticas, por medio de software específico y/o juegos.</p>
                            <p class="text-description">El objetivo principal de los talleres es que los asistentes desarrollen sus habilidades cognitivas y psicomotrices, de forma interactiva, participando y colaborando en las prácticas que se realizaran con aplicación de las matemáticas.</p>
                            <p class="text-description">Para lograr este propósito u objetivo los ponentes encargados de cada uno de los talleres de matemáticas se han dado a la tarea de solicitar materiales de apoyo o requerimientos para su desarrollo y aplicación.</p>
                            <p class="text-description">Dichos requerimientos y o materiales son como computadoras, software específico, (Maple, Mathematica, Geogebra. Excel, lenguajes de programación, etc…) ajedrez, dados de diferentes tamaños, dominó, diversos juegos de mesa, papelería (colores, crayones, marcadores, tijeras, plastilina, barro, hojas blancas y de colores, cartulinas, acuarelas, regletas, sogas, costales, aros de diferentes tamaños etc…), cubos, cuadrados, prismas, pirámides y demás figuras etc…, canchas deportivas , balones de futbol, voleibol, etc..</p>
                            <p class="text-description"><b>Coordinador de los talleres:<br>Mtro. Alejandro Valdez Santamaria.</b></p>
                            <p class="text-description"><b>Correo electrónico:<br>74valsan@gmail.com<br>30 de noviembre de 2023</b></p>
                            <?php 
                            $valorlogo = "SELECT logo_congreso FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
                            $logo = mysqli_query($conexion, $valorlogo);
                            $rowlogo = $logo->fetch_assoc();
                            $enlaceLogo = $rowlogo['logo_congreso'];
                            $rutaFinalLogo = $enlaceLogo;
                            ?>
                        </div>
                        <img class="img-logo" src="<?php echo $rutaFinalLogo; ?>" alt="Logo Congreso" width="250px" height="250px">
                    </div><!--cierre del contenedor principal-->
                </div><!--cierre del col-10-->
            </div><!--cierre del row principal-->

            <!--mapa-->
            <section>
                <?php
                require_once('../../Layouts/maps.php');
                ?>
            </section>
        </div><!--cierre del contenedor fluid-->
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
