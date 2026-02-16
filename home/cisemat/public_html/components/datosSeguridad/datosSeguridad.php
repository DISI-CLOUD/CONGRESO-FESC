<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}

require "../../modelo/cambiarDatosSeguridad.php";
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
    <title>Mis datos de seguridad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./seguridad.css">
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

                    <h2 class="mt-5 mb-4">Cambiar Contraseña</h2>
                    <span class="texto-seguridad fw-semibold">Contraseñas y ajustes de privacidad</span>
                    <div class="container mt-4"></div>
                    <?php
                    if (strlen($_SESSION['info']) > 1) {
                    ?>
                        <div id="informacionExito" class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errores) > 0) {
                    ?>
                        <div id="informacionError" class="alert alert-danger text-center">
                            <?php
                            foreach ($errores as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form method='POST' class="mb-5">

                        <!---CONTRASEÑA-------->
                        <div class="row mt-3 texto-seguridad">
                            <label for="" class="form-label">Contraseña actual</label>
                            <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 mb-1">
                                <input type="password" class="form-control pas" id="" name='contrasenaActual' required>

                            </div>

                        </div>
                        <!---CONTENEDOR QUE SE MUESTRA CUANDO DESEAS CAMBIAR LA CONTRASEÑA -->
                        <div class="row  py-3 px-1 texto-seguridad">
                            <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 mb-1">
                                <label for="" class="form-label ">Nueva contraseña</label>
                                <input type="password" class="form-control pas" id="" placeholder="" name="contrasenaUno" required>
                            </div>
                        </div>
                        <div class="row py-3 px-1 texto-seguridad">
                            <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 mb-1">
                                <label for="" class="form-label ">Vuelve a escribir la contraseña</label>
                                <input type="password" class="form-control pas" id="" placeholder="" name="contrasenaDos" required>
                                <input type="submit" class="btn btn-style-chico px-5 p-2 mt-5" value='Confirmar' name='confirmar'>
                            </div>
                        </div>
                    </form>
                    <span class="texto-seguridad fw-semibold">Política de Privacidad y tratamiento de datos</span>
                </div>
            </div><!--container-->
        </div><!--col-10-->
    </div><!--row-->
    </div><!--fluid-->
    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>