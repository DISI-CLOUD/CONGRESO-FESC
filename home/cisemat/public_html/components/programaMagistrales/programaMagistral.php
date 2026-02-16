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
    <link rel="stylesheet" href="./programaMagistral.css">


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
                    <div class="container mb-5">
                        <h2 class="mb-3">Ponencias Magistrales</h2><!--------TITULO INTERNO------------>
                        <div class="row card-alert rounded p-2 mt-4 col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
                            <span class="text-center">Programacion sujeta a cambios</span>
                        </div>

                        <div class="row mt-4">
                            <?php
                            require "../../modelo/traerCongresoActual.php";
                            $magistral = "SELECT * FROM conferencia_magistral WHERE id_congreso='$idCongreso'";
                            $resMagistral = mysqli_query($conexion, $magistral);
                            while ($fetchMagistrales = mysqli_fetch_assoc($resMagistral)) {
                                $tituloMagistral = $fetchMagistrales['titulo_conferencia_magistral'];
                                $idMagistral = $fetchMagistrales['id_conferencia_magistral'];
                                $institucionConferencia = $fetchMagistrales['institucion_conferencia_magistral'];
                                $magistral = "SELECT * FROM conferencia_magistral_autor WHERE id_conferencia_magistral='$idMagistral'";
                                $resIdAutor = mysqli_query($conexion, $magistral);
                                $fetchIdAutor = mysqli_fetch_assoc($resIdAutor);
                                $idAutor = $fetchIdAutor['id_autor'];
                                $Autor = "SELECT * FROM autor WHERE id_autor= '$idAutor'";
                                $resAutor = mysqli_query($conexion, $Autor);
                                $fetchAutor = mysqli_fetch_assoc($resAutor);
                                $nombreAutor = $fetchAutor['nombres_autor'];
                                $apellidosAutor = $fetchAutor['apellidos_autor'];
                                $fotoAutor = $fetchAutor['foto_autor'];

                            ?>
                                <div class="col-xl-5 col-lg-5 col-md-12 d-sm-block col-sm-12 mb-3">
                                    <div class="row">
                                        <div class="col-xxl-6 col-xl-6 col-lg-5 col-md-5 d-sm-block col-sm-12 mb-3" style="text-align: center;">
                                            <img src="<?php echo $fotoAutor ?>" class="rounded-circle" alt="Foto de Perfil" width="180" height="180"><!-----------Foto Perfil Ponente------------>
                                        </div>
                                        <div class="col-xxl-6 col-xl-6 col-lg-7 col-md-7 d-sm-block col-sm-12 ">
                                            <span class="span-nombre text-capitalize"> <?php echo $nombreAutor . " " . $apellidosAutor ?></span><br>
                                            <span class="span-titulo text-capitalize">"<?php echo $tituloMagistral ?>"</span><br>
                                            <span class="span-institucion text-capitalize"><?php echo $institucionConferencia ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>


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
