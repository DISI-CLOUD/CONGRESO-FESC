<?php
session_start();
require "../../modelo/conexion.php";
// Traer color automatizado
$valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$color = mysqli_query($conexion, $valorColor);
$rowColor = $color->fetch_assoc();
$colorHex = $rowColor['color_congreso'];
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
    <title>Concurso de Carteles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./concurso.css">

</head>

<body>
    <header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>
    <section style="margin-top: 250px;">
        <div class="container-fluid mt-5 mb-5">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <!-----------CARDS CONGRESO------------>
                    <div class="container col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <h2 class="mb-3">Concurso de Carteles</h2><!--------TITULO INTERNO------------>

                        <div class="row p-3">
                            <div class="col-xl-11 col-lg-11 col-md-11 d-sm-block col-sm-12 mb-3  rounded" style="background-color: #CBE6FE;">
                                <p class="mt-3 ms-3 titulo-congreso">XIV Edición</p>
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1 d-sm-block col-sm-12">
                                <img src="../../src/logos_congresos/XV.jpeg" alt="XV Congreso" height="70px" width="80px">
                            </div>
                        </div>
                        <span class="ms-3 span-congreso d-flex mb-3">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
                        <span class="ms-3 span-sub">4 y 5 de Mayo 2023</span>
                        <div class="row mt-5 mb-4">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-square" style="color: #C5B268;"></i> Se entregará constancia de "Asistencia al Congreso", cuando haya participado en las actividades del Congreso.<br></li>
                                <li><i class="fa-li fa fa-square" style="color: #C5B268;"></i> Se entregará constancia de "Presentación de cartel", cuando su resumen, cartel y vídeo hayan sido aceptados <br>por el comité organizador y estos hayan sido presentados en el evento.<br></li>
                                <li><i class="fa-li fa fa-square" style="color: #C5B268;"></i> Se entregarán constancias de ganadores a los tres primeros lugares que determine el comité evaluador.<br></li>
                            </ul>
                        </div>
                        <div class="row">
                            <span class="titulo-congreso ms-3">Ganadores XIII Edición</span>
                            <div class="container">
                                <table class="table w-100">
                                    <thead class="categorias">
                                        <tr style="background-color: <?php echo $colorHex; ?>;">
                                            <th class="titulo-tabla" scope="col">Título</th>
                                            <th class="autor" scope="col">Autores</th>
                                            <th class="premio" scope="col">Premio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="titulo-tabla" scope="row">"Estructura funcional, mediante modelado matemático, de la distribución geométrica para un medio de contención hídrico"</th>
                                            <td class="autor">Fernando Cuevas Villalobos, José Luz Hernández Castillo, José Juan Contreras Espinosa, Adela Huitrón González</td>
                                            <td class="premio"><a href="../../src/memorias/concurso_carteles/XV-1.pdf">1er Lugar</a></td>
                                        </tr>
                                        <tr class="table-warning">
                                            <th class="titulo-tabla" scope="row ">"Aplicación de experiencias del aprendizaje-servicio, utilizando la evaluación estadística"</th>
                                            <td class="autor-tabla">Gilberto Arroyo Paramo</td>
                                            <td class="premio"><a href="../../src/memorias/concurso_carteles/XV-2.pdf">2do Lugar</a></td>
                                        </tr>
                                        <tr>
                                            <th class="titulo-tabla" scope="row">"Simetría y descomposición par e impar de funciones definidas a tramos usando maple"</th>
                                            <td class="autor">Belem Hernández Morgado, José Luz Hernández Castillo, Pedro Ivan Ramirez Montes</td>
                                            <td class="premio"><a href="../../src/memorias/concurso_carteles/XV-3.pdf">3er Lugar</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <section>
                            <?php
                            require_once('../../Layouts/maps.php');
                            ?>
                        </section>
                    </div>
                </div>
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
