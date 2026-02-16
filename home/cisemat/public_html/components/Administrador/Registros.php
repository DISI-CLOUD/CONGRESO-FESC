<?php
session_start();
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    echo "<script>alert('Acceso inválido.'); window.location.href='../../components/inicioSesion/sesion.php';</script>";
    exit;
}

require_once "../../modelo/conexion.php";
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
            <title>Registros</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">
            <link rel="stylesheet" href="../../Layouts/NavbarYPestaña/pestaña.css">
            <link rel="stylesheet" href="./admin.css">

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
                            <h2 class="mt-5 mb-5">Registros</h2>
                            <!-------------------------------------------------------------------------------------------->
                            <!--Tabla de registros--->
                            <h3 class="mt-5 mb-5">Aun no se cuenta con registros de asistencia al Congreso</h3>
                            <div class="table-responsive mt-4 pt-2 px-2 pb-5 border border-success border-opacity-10 rounded col-xl-12 col-lg-12 col-md-12 scroll">
                                <table class="table scroll">
                                    <thead class="table-cabecera">
                                        <tr>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Apellidos</th>
                                            <th scope="col">Asistencia</th>
                                            <th scope="col">Congreso</th>
                                            <th scope="col">Ponencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /* Trae el último congreso */
                                        $consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
                                        $stmtCongreso = mysqli_prepare($conexion, $consCongreso);
                                        mysqli_stmt_execute($stmtCongreso);
                                        $resCongreso = mysqli_stmt_get_result($stmtCongreso);
                                        $fetchCongreso = mysqli_fetch_assoc($resCongreso);
                                        $idCongreso = $fetchCongreso['id_congreso'];
                                        mysqli_stmt_close($stmtCongreso);

                                        /* Trae datos del tipo de asistencia de los usuarios registrados */
                                        $consAsistencia = "SELECT usuario.nombres_usuario, usuario.apellidos_usuario, 
                                tipo_asistencia_usuario_ponencia.id_ponencia, tipo_asistencia.categoria_asistencia,
                                ponencia.titulo_ponencia 
                                FROM tipo_asistencia_usuario_ponencia 
                                INNER JOIN tipo_asistencia ON tipo_asistencia_usuario_ponencia.id_tipo_asistencia = tipo_asistencia.id_tipo_asistencia 
                                INNER JOIN usuario ON tipo_asistencia_usuario_ponencia.id_usuario = usuario.id_usuario
                                INNER JOIN ponencia ON tipo_asistencia_usuario_ponencia.id_ponencia = ponencia.id_ponencia";
                                        $stmtAsistencia = mysqli_prepare($conexion, $consAsistencia);
                                        mysqli_stmt_execute($stmtAsistencia);
                                        $resAsistencia = mysqli_stmt_get_result($stmtAsistencia);

                                        while ($fetchAsistencia = mysqli_fetch_assoc($resAsistencia)) {
                                            $nombresAsistente = htmlspecialchars($fetchAsistencia['nombres_usuario']);
                                            $apellidosAsistente = htmlspecialchars($fetchAsistencia['apellidos_usuario']);
                                            $tipoAsistencia = htmlspecialchars($fetchAsistencia['categoria_asistencia']);
                                            $tituloPonencia = htmlspecialchars($fetchAsistencia['titulo_ponencia']);
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $nombresAsistente ?></th>
                                                <td><?php echo $apellidosAsistente ?></td>
                                                <td><?php echo $tipoAsistencia ?></td>
                                                <td><?php echo $idCongreso ?></td>
                                                <td><?php echo $tituloPonencia ?></td>
                                            </tr>
                                        <?php
                                        }
                                        mysqli_stmt_close($stmtAsistencia);
                                        mysqli_close($conexion);
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <hr>




                            <!----------------------------------------------------------------------------------------------->
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
<?php
    } // Cierre del if
} // Cierre del foreach
?>