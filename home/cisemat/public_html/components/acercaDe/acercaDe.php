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
    <title>Acerca De</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./acerca.css">


</head>

<body>
    <header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>

    <section style="margin-top: 200px;">
        <div class="container mt-5 mb-5">
            <h2 class="mb-3">Acerca De</h2>
            <div class="div">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="5000">
                            <img src="../../src/foto1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="../../src/foto2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../../src/foto3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div><!--fin del carrusel-->
            <div class="row mt-5">
                <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12">
                    <h4>Créditos</h4>
                    <span class="lista fw-semibold">Esta página fue desarrollada por:</span>
                    <table class="table table-striped">
                        <thead class="categorias">
                            <tr>
                                <th class="nombre py-2" scope="col">Nombre</th>
                                <th class="correo py-2" scope="col">Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="nombre py-2" scope="row">Rubio García Alison Michelle</td>
                                <td class="correo py-2">allyssonrg@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row ">Sánchez Campos Magda Marina</td>
                                <td class="correo py-2">marinacampos1125@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row">Tejeda Araujo Carlos Alfredo</td>
                                <td class="correo py-2">tejedaaraujoc@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row ">Vargas Ledesma Marco Antonio</td>
                                <td class="correo py-2">mvargas750@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="lista fw-semibold">Esta página recibió mantenimiento por:</span>
                    <table class="table table-striped">
                        <thead class="categorias">
                            <tr>
                                <th class="nombre py-2" scope="col">Nombre</th>
                                <th class="correo py-2" scope="col">Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="nombre py-2" scope="row">Antonio García Cesar Eduardo</td>
                                <td class="correo py-2">cesareduardoag09@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row ">Espitia Gutiérrez Alberto Ataim</td>
                                <td class="correo py-2">aliyati3001@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row">García Rojas Kevin</td>
                                <td class="correo py-2">vinke-ggz@hotmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row ">Hernández Carmona Leonardo</td>
                                <td class="correo py-2">leonardo.hdzc777@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row">Juárez Aguayo Leonardo Samuel</td>
                                <td class="correo py-2">hlsammja@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row ">Leaños Medina Ricardo</td>
                                <td class="correo py-2">ricardoleanosmedina@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row">Lin Jayme Ernesto</td>
                                <td class="correo py-2">jaymelinbr@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row ">Moreno Aguirre Sofia</td>
                                <td class="correo py-2">theapexsite@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row">Rivera Villanueva Bruno Iván</td>
                                <td class="correo py-2">brunorivera105@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row ">López Sánchez Hugo Yair</td>
                                <td class="correo py-2">hugoyair.lopez.sanchez@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="nombre py-2" scope="row">López Martínez Héctor</td>
                                <td class="correo py-2">hectorml002@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12">
                    <div class="row p-3 border rounded">
                        <div class="col-xl-5 col-lg-5 d-md-block col-md-12 d-sm-block col-sm-12 text-center">
                            <img src="../../src/logoFESC.png" alt="logo FESC" height="240px" width="190px" class="">
                        </div>
                        <?php
                        $year = date("Y");
                        ?>
                        <div class="col-xl-7 col-lg-7 d-md-block col-md-12 d-sm-block col-sm-12 p-4 ">
                            <p class=" aviso "><strong>Facultad de Estudios Superiores Cuautitlán / México <?php echo $year; ?>.</strong><br>Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección
                                electrónica. De otra forma requiere permiso previo por escrito de la institución.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-1">
                <?php
                require_once('../../Layouts/maps.php');
                ?>
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
