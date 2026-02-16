<?php
include '../../modelo/conexion.php';
include '../FormatoFechas/forfe2.php';

// traer color automatizado
$valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$color = mysqli_query($conexion, $valorColor);
$rowColor = $color->fetch_assoc();
$colorHex = $rowColor['color_congreso'];

$fechasIniciales = [];
$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_modificar"])) {
    for ($i = 2; $i <= 15; $i++) {
        $nuevaFechaInicio = $_POST["inicio$i"];
        $nuevaFechaFinal = $_POST["fin$i"];

        if (!empty($nuevaFechaInicio) && !empty($nuevaFechaFinal)) {
            $query = "UPDATE fecha_congreso SET fecha_congreso_inicio = ?, fecha_congreso_fin = ? WHERE id_evento = ? AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = ?)";
            if ($stmt = $conexion->prepare($query)) {
                if (!$stmt->bind_param("ssii", $nuevaFechaInicio, $nuevaFechaFinal, $i, $i) || !$stmt->execute()) {
                    $errorMessages[] = "Error en la actualización del evento $i: " . $stmt->error;
                }
            }
        } else {
            $errorMessages[] = "No has seleccionado fechas para actualizar el asunto del evento $i";
        }
    }

    // Retroceder en la página
    echo "<script>window.history.back();</script>";
    exit;
}

for ($i = 2; $i <= 15; $i++) {
    $id_evento = $i;
    $sql = "SELECT fecha_congreso_inicio, fecha_congreso_fin FROM fecha_congreso WHERE id_evento = $id_evento ORDER BY id_congreso DESC LIMIT 1";
    $result = $conexion->query($sql);
    $row = $result->fetch_assoc();
    $fechasIniciales[$id_evento] = $row;
}
?>


<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="container mb-5">
                <h2 class="mb-4">Administrar Diseño</h2>
                <h2 class="texto-dorado">Actividades</h2>
                <form method="POST">
                    <div class="table-responsive">
                        <table class="my-table table table-striped">
                            <thead>
                                <tr>
                                    <th class='fechas-header' scope="col" style="background-color: <?php echo $colorHex; ?>!important;">Fecha</th>
                                    <th class='asunto-header' scope="col" style="background-color: <?php echo $colorHex; ?>!important;"><strong>Asunto</strong></th>
                                    <th class='ff-header' scope="col" style="background-color: <?php echo $colorHex; ?>!important;">Fecha inicio</th>
                                    <th class='fi-header' scope="col" style="background-color: <?php echo $colorHex; ?>!important;">Fecha fin</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mostrarMensaje6a7 = $mostrarMensaje8a9 = $mostrarMensaje9a10 = false;

                                for ($i = 2; $i <= 15; $i++) {
                                    $id_evento = $i;
                                    $fecha_formateada = formatFechaEvento($id_evento, $conexion);
                                    $sql = "SELECT descripcion_evento FROM evento WHERE id_evento = $id_evento";
                                    $result = $conexion->query($sql);
                                    $row = $result->fetch_assoc();
                                    $descripcion_evento = $row["descripcion_evento"];
                                    $fechaInicioInicial = $fechasIniciales[$id_evento]['fecha_congreso_inicio'];
                                    $fechaFinInicial = $fechasIniciales[$id_evento]['fecha_congreso_fin'];

                                    if (!$mostrarMensaje6a7 && $i >= 6 && $i <= 7) {
                                        $mostrarMensaje6a7 = true;
                                        mostrarMensaje(5, $conexion);
                                    }

                                    if (!$mostrarMensaje8a9 && $i >= 10 && $i <= 11) {
                                        $mostrarMensaje8a9 = true;
                                        mostrarMensaje(9, $conexion);
                                    }

                                    if (!$mostrarMensaje9a10 && $i >= 11 && $i <= 12) {
                                        $mostrarMensaje9a10 = true;
                                        mostrarMensaje(10, $conexion);
                                    }


                                    echo "<th>$fecha_formateada</th>";
                                    echo "<td><strong>$descripcion_evento</strong></td>";
                                    echo "<td>";

                                    echo "<input name='inicio$i' type='date' placeholder='Nueva fecha de inicio' value='$fechaInicioInicial' disabled>";
                                    echo "</td>";
                                    echo "<td>";
                                    // Título en azul
                                    echo "<input name='fin$i'  type='date' placeholder='Nueva fecha final' value='$fechaFinInicial' disabled>";
                                    echo "</td>";
                                    echo "</tr>";
                                }

                                function mostrarMensaje($id_evento_mensaje, $conexion)
                                {
                                    echo "<tr class='table bg-danger'>";
                                    echo "<td class='importante' colspan='4'><i class='fa fa-exclamation-triangle me-3' aria-hidden='true'></i>Si su resumen no fue aprobado para el ";

                                    $sql = "SELECT fecha_congreso_fin FROM fecha_congreso WHERE id_evento = $id_evento_mensaje AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = $id_evento_mensaje)";
                                    $result = $conexion->query($sql);
                                    $row = $result->fetch_assoc();
                                    $fecha = new DateTime($row["fecha_congreso_fin"]);

                                    // Sumar 1 día a la fecha
                                    $fecha->modify('+1 day');

                                    $locale = 'es_ES';
                                    $dateFormatter = new IntlDateFormatter(
                                        $locale,
                                        IntlDateFormatter::FULL,
                                        IntlDateFormatter::FULL,
                                        'UTC',
                                        IntlDateFormatter::GREGORIAN
                                    );

                                    $dateFormatter->setPattern("EEEE d 'de' MMMM 'de' y");
                                    $fecha_formateada = $dateFormatter->format($fecha);

                                    echo $fecha_formateada;
                                    echo " quedará fuera del evento.</td>";
                                    echo "</tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <button type='button' class='btn' id='btnModificar' style="background-color: <?php echo $colorHex; ?>!important; color: #FFF;">Modificar</button>
                        <button type='submit' class='btn' style='display: none; background-color: <?php echo $colorHex; ?>!important; color: #FFF;' name='submit_modificar' id='btnActualizar'>Actualizar</button>
                        <button type='button' class='btn btn-secondary' style='display: none;' id='btnCancelar' onclick='location.reload();'>Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('btnModificar').addEventListener('click', function() {
        var inputs = document.querySelectorAll('input[type="date"]');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].removeAttribute('disabled');
        }
        document.getElementById('btnActualizar').style.display = 'inline-block';
        document.getElementById('btnCancelar').style.display = 'inline-block';
        document.getElementById('btnModificar').style.display = 'none';
    });
</script>
