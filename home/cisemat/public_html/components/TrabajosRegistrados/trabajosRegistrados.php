<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}
$_SESSION['info'] = "";
$array = array();
$_SESSION['error'] = $array;

//$_SESSION['trabajoSeleccionado'];
//Reseteo del numero de ediciones
$_SESSION['numEdiciones'] = 0;
$_SESSION['coautores'] = "";
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
    <link rel="stylesheet" href="./trabajo.css">
    <link rel="stylesheet" href="../../Layouts/NavbarYPestaña/pestaña.css">
    <link rel="stylesheet" href="../../Layouts/CardTrabajosAprobados/trabajoAprobado.css">
    <link rel="stylesheet" href="../../Layouts/CardTrabajosNoAprobados/trabajoNoAprobado.css">
    <link rel="stylesheet" href="../../Layouts/CardTrabajoSinEvaluador/trabajoSinEva.css">
    <link rel="stylesheet" href="../../Layouts/CardEvaluaPendiente/trabajoPendiente.css">


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
                    <h2 class="mt-5 mb-3">Trabajos Registrados</h2>
                    <?php
                    //Si el usuario tiene ponencias registradas y si no tiene
                    require "../../modelo/trabajosRegistrados.php";
                    if (mysqli_num_rows($resTrabajosRegistrados) > 0 || mysqli_num_rows($resTrabajosRegistradosCoautor) > 0) {
                    ?>
                        <!-------------------------------------------------------------------------------------------->
                        <!-------------------------CONTAINER QUE SE MUESTRA CUANDO EL PONENTE TIENE REGISTROS---------->
                        <div class="containerConR" id="containerConR">
                            <section>
                                <?php 
                                /* No tiene Querys mysql son funciones js*/
                                 require_once('../../Layouts/NavbarYPestaña/navbarYPestaña.php');
                                ?>
                            </section>
                            <div class="row">
                                <div class=""></div>
                                <?php
                                require_once('../../Layouts/CardTrabajosAprobados/cardTrabajoAprobado.php');
                                ?>
                                <?php
                                require_once('../../Layouts/CardTrabajosNoAprobados/cardTrabajoNoAprobado.php');
                                ?>

                                <?php
                                require_once('../../Layouts/CardTrabajoSinEvaluador/cardTrabajoSinEva.php');
                                ?>
                                <?php
                                require_once('../../Layouts/CardEvaluaPendiente/cardTrabajoPendiente.php');
                                ?>
                                <!--------------ESTE CONTENEDOR SE MUESTRA CUANDO EL USUARIO NO TIENE REGISTROS--------->
                                <div class="row mt-4">
                                    <p id="infoNoMasTrabajos" class="mt-5 text-center lead ">Ya no tienes más trabajos por el momento.</p>
                                </div>

                            </div>
                            <div class="container-fluid p-2 mt-5 mb-5  d-none d-md-block"></div>
                        <?php
                    } else {
                        ?>
                            <!--------------ESTE CONTENEDOR SE MUESTRA CUANDO EL USUARIO NO TIENE REGISTROS--------->
                            <div class=" containerSinR " id="containerSinR">
                                <span class="texto-trabajo mb-3">Ve tus participaciones del congreso</span>
                                <h1 class="mt-5">Aun no tienes trabajos<br> del congreso actual</h1>

                                <div class="row">
                                    <div class="col-sm-4 mt-5">
                                        <div class="col-lg-5 d-grid gap-2 mt-5 mb-5">
                                            <a href="../../components/subirResumen/subirResumen.php" class="btn btn-style-chico shadow p-1 MT-4">Participa</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="container-fluid p-4 mt-5 mb-5  d-none d-md-block"></div>
                            <div class="container-fluid p-4 mt-5 mb-5"></div>
                        <?php
                    }
                        ?>
                        <!----------------------------------------------------------------------------------------------->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <?php
            require_once('../../Layouts/footer.php');
            ?>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script defer src="./trabajo.js"></script>
        <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>
