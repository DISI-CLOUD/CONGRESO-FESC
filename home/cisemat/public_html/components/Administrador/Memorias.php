<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}
require_once "../../modelo/privilegiosUsuario.php";

$estadoPrivilegio = []; // Un arreglo que guarda los estados del privilegio
$cont2 = 0; // Para recorrer las posiciones del segundo arreglo

$consPrivilegiosEstado = "SELECT * FROM funcion_usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexion, $consPrivilegiosEstado);
mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
mysqli_stmt_execute($stmt);
$resPrivilegiosEstado = mysqli_stmt_get_result($stmt);

while ($row2 = mysqli_fetch_array($resPrivilegiosEstado)) {
    $estadoPrivilegio[$cont2] = $row2['estado_funcion'];
    $cont2++;
}

$_SESSION['estadoPrivilegio'] = $estadoPrivilegio;

foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
    if ($valor == 43 && $estado == 'ON') {
?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <?php
            require_once('../../Layouts/iconoCongresoLink.php');
            ?>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reportes</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">
            <link rel="stylesheet" href="../../Layouts/NavbarYPestaña/pestaña.css">
            <link rel="stylesheet" href="./admin.css">
            <link rel="stylesheet" href="../../Layouts/TablasDeReportes/tablasReportes.css">
            <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
            <style>
                .boton-clic {
                    background-color: #6ECC55;
                    border: none;
                }
            </style>
        </head>

        <body>
            <!-- Cargar jQuery primero -->
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

            <!-- Luego, cargar Bootstrap 5 -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
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
                        <div class="container mb-5">
                            <h2 class="mt-5 mb-3">Descargar trabajos del congreso</h2>
                            <?php require "../../Layouts/TablasDeReportes/tablaMemorias.php"; ?>
                        </div>
                    </div><!--container-->
                </div><!--col-10-->
            </div><!--row-->
            </div><!--fluid-->

            <?php
            require_once('../../Layouts/footer.php');
            ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
            <script>
                var botonesDescarga = document.querySelectorAll('.btn-secondary');

                botonesDescarga.forEach(function(boton) {
                    boton.addEventListener('click', function() {
                        this.classList.add('boton-clic');
                    });
                });
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
        </body>

        </html>
<?php
    } // Cierre del if
} // Cierre del foreach
?>