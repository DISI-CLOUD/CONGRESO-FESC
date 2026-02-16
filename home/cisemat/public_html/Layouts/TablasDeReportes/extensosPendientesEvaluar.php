<div id="extensosPendientesEvaluar" class="scroll table-responsive border border-success border-opacity-10 rounded pt-2 px-2 pb-5 mt-4" style="max-height: 800px;">
    <?php
    //En caso de que el autor tenga ponencias
    require "../../modelo/trabajosReportes.php";

    ?>
    <table class="table">
        <tr class="head-table">
            <th scope="col">#</th>
            <th scope="col">Id Ponencia</th>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Correo Autor</th>
            <th scope="col">Descripción revisión</th>
            <th scope="col">Estatus revisión</th>
            <th scope="col">Fecha</th>
            <th scope="col">Evaluador</th>
            <th scope="col">Correo del Evaluador</th>
        </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($ejecucionTMPPendienteEvaluar) > 0) {
                $contador=0; 
                while ($fetchPonenciasRegistradas = mysqli_fetch_assoc($ejecucionTMPPendienteEvaluar)) {
                    $idPonencia = $fetchPonenciasRegistradas['id_ponencia'];
                    $tituloPonencia = $fetchPonenciasRegistradas['titulo_ponencia'];
                    $nombrePonente = $fetchPonenciasRegistradas['ponente'];
                    $emailPonente = $fetchPonenciasRegistradas['email_usuario'];
                    $descRevision = $fetchPonenciasRegistradas['descripcion_revision'];
                    $estatusRev = $fetchPonenciasRegistradas['estatus_revision'];
                    $fechaRegistroPonencia = $fetchPonenciasRegistradas['fecha'];
                    //Da formato de fecha
                    $date = date_create($fechaRegistroPonencia);
                    $fechaRegistroPonenciaFormato = date_format($date, "Y/m/d H:i");
                    $nombreEvaluador = $fetchPonenciasRegistradas['Evaluador'];
                    $emailEvaluador = $fetchPonenciasRegistradas['correo_evaluador'];
                    $contador=$contador+1;
            ?>
                    <tr>
                        <td class="text-wrap text-uppercase"><?php echo $contador; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $idPonencia; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $tituloPonencia; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $nombrePonente; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $emailPonente; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $descRevision; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $estatusRev; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $fechaRegistroPonenciaFormato; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $nombreEvaluador; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $emailEvaluador; ?></td>
                    </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="9"><h5 class="text-center">No se encontraron trabajos pendientes por evaluar en la etapa <b>' . $etapaTrabajo . '</b></h5></td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>