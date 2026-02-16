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
    <title>Costos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./cuotas.css">

</head>

<body>
    <header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->
        <?php
        require_once('../../Layouts/nav.php');
        require '../../modelo/traerCostos.php';
        ?>
    </header>
    <section style="margin-top: 250px;">
        <div class="container mt-5 mb-5"><!----------CONTENEDOR PRINCIPAL----------->
            <div class="row p-2">
                <div class="col-sm col-lg-6 col-md-6">

                    <h2 class="mb-3 text-center">Costos individuales en pesos mexicanos</h2><!--------TITULO INTERNO------------>
                    <!-----------DATOS DE CUOTAS AL CONGRESO------------>
                    <?php

                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <div class="col-sm col-md-12 col-lg-12 px-3 pt-2 mt-3">
                            <div class="card-body-cuotas rounded text-center py-2"><?php echo $row['Tipo']; //Asigna el nombre
                                                                                    ?></div>
                            <div class="row m-1">
                                <div class="col mt-2">
                                    <p class="pt py-2 text-center">Cuota en pesos mexicanos</p>
                                </div>
                                <div class="col mt-3">
                                    <span class="cuotas text-center border border-success p-2 border-opacity-10 rounded">$<?php echo $row['Costo']; //Asigna el nombre
                                                                                                                            ?>.00</span>
                                </div>
                            </div>
                            <div class="row m-1">
                                <i class="fa fa-question-circle" style="font-size: 30px;" aria-hidden="true">
                                    <p class="subtitulo py-2"><?php echo $row['Descripcion']; //Asigna el nombre
                                                                ?></p>
                                </i>

                            </div>
                        </div>
                    <?php }
                    mysqli_free_result($res); ?>

                </div>
                <div class="col-sm col-lg-6 col-md-6 px-5">
                    <h2 class="text-center">¿Cómo realizo el pago?</h2>
                    <p class="fs-5">Solicitar una ficha referenciada al correo altamira@unam.mx, para realizar el pago bancario, especificando el monto a pagar. En caso de requerir factura se deberán enviar sus datos fiscales al mismo correo electrónico.</p>
                    <p class="fs-5"><span class="fw-bold">Nota: </span>solamente se facturará depósitos del mes corriente.</p>
                    <p class="fs-5">Para pagos en el plantel, se pueden realizar directamente en el área de cajas con la orden de pago en cajas.</p>
                    <?php // Traer color automatizado
                    $valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
                    $color = mysqli_query($conexion, $valorColor);
                    $rowColor = $color->fetch_assoc();
                    $colorHex = $rowColor['color_congreso'];
                    ?>
                    <a href="../../components/asistenciaPago/pagos.php">
                    <button class="btn btn-style shadow mt-4 mb-4 px-5" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Generar ficha</button></a>
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