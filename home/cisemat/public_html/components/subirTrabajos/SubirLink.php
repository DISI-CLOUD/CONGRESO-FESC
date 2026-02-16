<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}
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
    <title>Trabajos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./subirArchivo.css">

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
                    <h2 class="mt-5 mb-3">Link de Video</h2>
                    <hr>
                    <!-------------------------------------------------------------------------------------------->

                    <div class="containerSubirArchivo mb-5" id="containerSubirArchivo">
                        <span class="card-text"><strong>Google Drive</strong></span>
                        <div class="row mt-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 col-xs-12">
                                <input type="text" class="form-control mb-3" placeholder="Copia y pega tu link de Google Drive aqui">
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-4 d-sm-block col-sm-12 col-xs-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn-azul mb-3">Agregar</button>
                                </div>
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 col-xs-12">
                                <div class="mt-4 d-flex align-self-end">
                                    <img src="../../src/question.png" class="imgQuestion me-2" alt="">
                                    <span class="span-textos ">Revisa las Especificaciones del video antes de agregar el link</span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 col-xs-12 d-grid">
                                <button type="button" class="btn-azul">Especificaciones de video</button>
                            </div>
                        </div>
                    </div>
                    <!----------------------------------------------------------------------------------------------->
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container-fluid p-5 mt-5 mb-5"></div>
    <div class="container-fluid p-5 mt-5 mb-5"></div>


    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>