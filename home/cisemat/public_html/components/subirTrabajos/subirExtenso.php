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
                    <h2 class="mt-5 mb-3">Subir Extenso</h2>
                    <hr>
                    <!-------------------------------------------------------------------------------------------->
                    <!-------------------------CONTAINER QUE SE MUESTRA CUANDO EL USUARIO SUBE UN ARCHIVO EXTENSO---------->
                    <div class="containerSubirArchivo" id="containerSubirArchivo">

                        <div class="row d-inline-flex ">
                            <div class="col-xl-5 col-lg-5 col-md-5 col-xs-12 d-sm-block">
                                <label class=" btn-Subir-Archivo custom-file-upload pt-2 pb-2 px-5 mt-2">
                                    <input type="file" />Seleccionar archivo
                                </label>
                            </div>

                            <div class="col-xl-7 col-lg-7 col-md-7 col-xs-12 d-sm-block mt-3">
                                <img src="../../src/question.png" class="imgQuestion " alt="">
                                <span class="text ">Solo puedes subir un archivo con un peso maximo de N mb y en formato PDF</span>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 d-md-block col-md-12 col-sm-12 col-xs-12  mt-3 border border-success border-opacity-10 rounded">
                                <span class="card-text">Nombre del archivo</span>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 d-md-inline-block col-md-6 col-sm-12 col-xs-12 mt-3">
                                <div class="d-grid gap-2">
                                    <button class="btn-azul">Subir Extenso</button>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3 d-md-inline-block col-md-6 col-sm-12 col-xs-12 mt-3">
                                <div class="d-grid gap-2">
                                    <input class="btn-cancelar " type="submit" value="Cancelar" onClick="history.go(-1);">
                                </div>
                            </div>

                            <!----------ALERTS----------->
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                Hubo un error al subir el archivo Intenta mas tarde
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                El archivo se subio correctamente
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <!-------------------->
                        </div>
                        <!----------------------------------------------------------------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-5 mt-5 mb-5"></div>
    <div class="container-fluid p-5 mt-5 mb-5 "></div>


    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>