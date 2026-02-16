<?php
session_start();
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    echo "<script>alert('Acceso inválido.'); window.location.href='../../components/inicioSesion/sesion.php';</script>";
    exit;
}

require_once "../../modelo/conexion.php";
require_once "../../modelo/privilegiosUsuario.php";
require "../../modelo/traerCongresoActual.php";

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
    if ($valor == 31 && $estado == 'ON') {
        require "../../modelo/modificarPagos.php";
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
            <title>Registro de pagos</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">
            <link rel="stylesheet" href="../../Layouts/NavbarYPestaña/pestaña.css">
            <link rel="stylesheet" href="./admin.css">

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

            <form method="POST">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                            <?php
                            require_once('../../Layouts/sidebar.php');
                            ?>

                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                            <div class="container">
                                <h2 class="mt-5 mb-5">Registros de pago</h2>

                                <?php
                                if (strlen($_SESSION['info']) > 1) {
                                    // Mostrar mensaje de éxito
                                    ?>
                                    <div id="informacionExito"
                                        class="alert alert-success alert-dismissible fade show text-center my-3" role="alert">
                                        <?php echo $_SESSION['info']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php
                                }

                                if (count($errores) > 0) {
                                    // Mostrar errores
                                    ?>
                                    <div id="informacionError"
                                        class="alert alert-danger alert-dismissible fade show text-center my-3" role="alert">
                                        <?php
                                        foreach ($errores as $showerror) {
                                            echo $showerror;
                                        }
                                        ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php
                                }
                                ?>

                                <!-- Tabla de registros -->
                                <div
                                    class="scroll mt-5 pt-2 px-2 pb-5 border border-success border-opacity-10 rounded table-responsive">
                                    <table class="table">
                                        <thead class="table-cabecera">
                                            <tr class="categorias">
                                                <th class="cInicial py-2" scope="col">#</th>
                                                <th class="columnas py-2" scope="col">Nombres</th>
                                                <th class="columnas py-2" scope="col">Apellidos</th>
                                                <th class="columnas py-2" scope="col">Asistencia Solicitada</th>
                                                 <th class="columnas py-2" scope="col">Participación</th>
                                                <th class="columnas py-2" scope="col">Monto</th>
                                                <th class="columnas py-2" scope="col">Estatus</th>
                                                <th class="columnas py-2" scope="col">Fecha de solicitud</th>
                                                <th class="cFinal py-2" scope="col">Vaucher</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require "../../modelo/traerRegistrosPagos.php";
                                            while ($idPago = mysqli_fetch_assoc($resDatosPago)) {
                                                // Iterar por cada fila de la tabla
                                                ?>
                                                <tr id="<?php echo $idPago['id_pago']; ?>">
                                                    <?php
                                            }
                                            ?>
                                                <?php
                                                require "../../modelo/traerRegistrosPagos.php";
                                                while ($fetchDatosPago = mysqli_fetch_assoc($resDatosPago)) {
                                                    // Obtener los datos de cada fila
                                                    $idPago = $fetchDatosPago['id_pago'];
                                                    $idUsuarioPago = $fetchDatosPago['id_usuario'];
                                                    $idTipoAsistencia = $fetchDatosPago['id_tipo_asistencia'];
                                                    $estatus = $fetchDatosPago['estatus_pago'];
                                                    $fechaSolicitud = $fetchDatosPago['fecha_pago'];
                                                    $vaucher = $fetchDatosPago['imagen_pago'];
                                                    $esPonente = $fetchDatosPago['ponente'];

                                                    // Obtener nombres del usuario
                                                    $consNombresUsuario = "SELECT * FROM usuario WHERE id_usuario = ?";
                                                    $stmtNombresUsuario = mysqli_prepare($conexion, $consNombresUsuario);
                                                    mysqli_stmt_bind_param($stmtNombresUsuario, "i", $idUsuarioPago);
                                                    mysqli_stmt_execute($stmtNombresUsuario);
                                                    $resNombresUsuario = mysqli_stmt_get_result($stmtNombresUsuario);
                                                    $fetchNombresUsuario = mysqli_fetch_assoc($resNombresUsuario);
                                                    $nombres = htmlspecialchars($fetchNombresUsuario['nombres_usuario']);
                                                    $apellidos = htmlspecialchars($fetchNombresUsuario['apellidos_usuario']);

                                                    // Obtener tipo de asistencia
                                                    $conTipoAsistencia = "SELECT * FROM costo WHERE idCosto = ? AND id_congreso = $idCongreso";
                                                    $stmtTipoAsistencia = mysqli_prepare($conexion, $conTipoAsistencia);
                                                    mysqli_stmt_bind_param($stmtTipoAsistencia, "i", $idTipoAsistencia);
                                                    mysqli_stmt_execute($stmtTipoAsistencia);
                                                    $resTipoAsistencia = mysqli_stmt_get_result($stmtTipoAsistencia);
                                                    $fetchTipoAsistencia = mysqli_fetch_assoc($resTipoAsistencia);
                                                    $asistencia = htmlspecialchars($fetchTipoAsistencia['Tipo']);
                                                    $monto = htmlspecialchars($fetchTipoAsistencia['Costo']);
                                                    ?>

                                                    <th class="cInicial" scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="<?php echo $idPago ?>" id="<?php echo $idPago ?>"
                                                                name="checkbox[]">
                                                        </div>
                                                    </th>
                                                    <td class="columnas">
                                                        <?php echo $nombres ?>
                                                    </td>
                                                    <td class="columnas">
                                                        <?php echo $apellidos ?>
                                                    </td>
                                                    <td class="columnas">
                                                        <?php echo $asistencia ?>
                                                    </td>
                                                    <td class="columnas">
                                                         <?php
                                                        if (!empty($esPonente)) {
                                                           echo "Es ponente";
                                                        } else {
                                                            echo "Asistente";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="columnas">$
                                                        <?php echo $monto ?>.00
                                                    </td>
                                                    <td class="columnas">
                                                        <?php echo $estatus ?>
                                                    </td>
                                                    <td class="columnas">
                                                        <?php echo $fechaSolicitud ?>
                                                    </td>
                                                    <td class="cFinal">
                                                        <?php
                                                        if (!empty($vaucher)) {
                                                            ?>
                                                            <a href="<?php echo htmlspecialchars($vaucher) ?>" target="_blank">Ver
                                                                Voucher</a>
                                                            <?php
                                                        } else {
                                                            echo "Esperando archivo";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="container">
                                    <h4 class="mt-4">Validar pago</h4><br>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="asistencia" class="form-label ti">Validar el tipo de asistencia</label>
                                            <select class="form-select" id="asistencia" name="asistencia" required>
                                                <option disabled selected>Selecciona una opción</option>
                                                <?php
                                                // Obtener los datos de las categorías
                                                $tipoAsistenciaPago = "SELECT * FROM costo where id_congreso = $idCongreso";
                                                $res2 = mysqli_query($conexion, $tipoAsistenciaPago);
                                                while ($fetch2 = mysqli_fetch_assoc($res2)) {
                                                    $idTipoAsistenciaPago = $fetch2["idCosto"];
                                                    $tipoAsistenciaPago = $fetch2["Tipo"];
                                                    $costoAsistenciaPago = $fetch2["Costo"];
                                                    ?>
                                                    <option value="<?php echo $idTipoAsistenciaPago; ?>">
                                                        <?php echo $tipoAsistenciaPago; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="submit" name="validarPago" class="btn btn-style block px-5 mt-3"
                                                value="Validar">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="submit" name="contactarUsuario" class="btn btn-style block px-5 mt-3"
                                                value="Contactar">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="submit" name="rechazarPago" class="btn btn-style block px-5 mt-3"
                                                value="Rechazar">
                                        </div>
                                    </div>
                                </div>
                            </div><!--container-->
                        </div><!--col-10-->
                    </div><!--row-->
                </div><!--fluid-->
            </form>

            <footer>
                <?php
                require_once('../../Layouts/footer.php');
                ?>
            </footer>




            <script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
                crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
        </body>

        </html>
        <?php
    }
}
?>