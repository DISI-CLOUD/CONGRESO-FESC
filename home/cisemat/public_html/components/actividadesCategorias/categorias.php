<?php

/** 
 *******************************************************************************************************
 * Apartado que muestra las categorias del actual congreso.
 * Cualquier duda o sugerencia:
 * @author Magda Marina Sanchez Campos marinacampos1125@gmail.com 
 *******************************************************************************************************
 **/
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
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./categorias.css">

</head>

<body>
    <header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>
    <section>
        <div class="container-fluid mt-5 mb-5">
            <div style="margin-top: 200px;" class="row">
                <div class="mx-auto">
                    <div class="container mb-5">
                        <h2 class="mb-4">Categorías para ponencias</h2><!--------TITULO INTERNO------------>
                        <table class="table table-striped">
                            <thead class="categorias">
                                <?php
                                require "../../modelo/conexion.php";
                                ?>
                                <tr style="background-color: <?php echo $colorHex; ?>;">
                                    <th class="edicion" scope="col">Edición</th>
                                    <th class="categoria" scope="col">Categoría</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                /*trae el ultimo congreso*/
                                $consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
                                $resCongreso = mysqli_query($conexion, $consCongreso);
                                while ($fetchCongreso = mysqli_fetch_assoc($resCongreso)) {
                                    $idCongreso = $fetchCongreso['id_congreso'];
                                    /*trae las categorias del actual congreso*/
                                    $consCategoria = "SELECT * FROM categoria WHERE id_congreso=$idCongreso";
                                    $resCategoria = mysqli_query($conexion, $consCategoria);
                                    while ($fetchCategoria = mysqli_fetch_assoc($resCategoria)) {
                                        $nombreCategoria = $fetchCategoria['categoria'];
                                ?>
                                        <tr>

                                            <th class="edicion" scope="row"><?php echo $idCongreso; ?></th>
                                            <td class="categoria"><?php echo $nombreCategoria; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--fin del carrusel-->
        </div>
        <section>
            <?php
            require_once('../../Layouts/maps.php');
            ?>
        </section>
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
