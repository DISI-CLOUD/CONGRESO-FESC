<div id="catalogoTrabajos" class=" table-responsive border border-success border-opacity-10 rounded pt-2 px-2 pb-5 mt-4 scroll" style="max-height: 800px;">
<!-- <button class="btn btn-style block px-4 my-2 mx-2" onclick="exportTableToExcel('tableCatalogo', 'Catalogo')" disabled>Descargar Excel</button> -->
<?php
    //En caso de que el autor tenga ponencias
    require "../../modelo/trabajosReportes.php";
//echo "Sali de trabajosReportes.php";
    echo '<h5>Catálogo de todos los trabajos presentados en el congreso</h5>';
?>
<table class="table">
        <tr class="head-table">
            <th scope="col">Id Ponencia</th>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Correo Autor</th>
            <th scope="col">Descripción revisión</th>
            <th scope="col">Estatus revisión</th>
            <th scope="col">Fecha</th>
            <th scope="col">Recordatorio</th>
            <th scope="col">Evaluador</th>
            <th scope="col">Correo del Evaluador</th>
            <th scope="col">Video Ponencia</th>
        </tr>
        </thead>
        <tbody>
            <?php
            
          //echo "Numero de ponencias : ".$numrowCatalogo2;
            if ($numrowCatalogo2 > 0) {
                while ($fetchPonenciasRegistradas = mysqli_fetch_assoc($queryCatalogo2)) {

                    $idPonencia = $fetchPonenciasRegistradas['id_ponencia'];
                    $tituloPonencia = $fetchPonenciasRegistradas['titulo_ponencia'];
                    $nombrePonente = $fetchPonenciasRegistradas['ponente'];
                    $emailPonente = $fetchPonenciasRegistradas['email_usuario'];
                    if ($fetchPonenciasRegistradas['descripcion_revision'])
                      $descRevision = $fetchPonenciasRegistradas['descripcion_revision'];
                    else
                      $descRevision = "Sin evaluador";
                    $estatusRev = $fetchPonenciasRegistradas['estatus_revision'];
                    $fechaRegistroPonencia = $fetchPonenciasRegistradas['fecha'];
                    //Da formato de fecha
                    $date = date_create($fechaRegistroPonencia);
                    $fechaRegistroPonenciaFormato = date_format($date, "Y/m/d H:i");

                    if ($fetchPonenciasRegistradas['Evaluador'])
                      $nombreEvaluador = $fetchPonenciasRegistradas['Evaluador'];    
                    else    
                      $nombreEvaluador = "Sin evaluador";
                    $emailEvaluador = $fetchPonenciasRegistradas['correo_evaluador'];
                    $videoPonencia = $fetchPonenciasRegistradas['video_ponencia'];

            ?>
                    <tr>
                        <td class="text-wrap text-uppercase"><?php echo $idPonencia; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $tituloPonencia; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $nombrePonente; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $emailPonente; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $descRevision; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $estatusRev; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $fechaRegistroPonenciaFormato; ?></td>
                        <td class="text-wrap text-center">
                            <?php if ($nombreEvaluador !== "Sin evaluador" && (empty($estatusRev) || $estatusRev === 'F')) { ?>
                                <button class="btn btn-warning btn-sm btn-recordatorio"
                                    data-id="<?php echo htmlspecialchars($idPonencia); ?>"
                                    data-titulo="<?php echo htmlspecialchars($tituloPonencia); ?>"
                                    data-ponente="<?php echo htmlspecialchars($nombrePonente); ?>"
                                    data-evaluador="<?php echo htmlspecialchars($nombreEvaluador); ?>"
                                    data-email="<?php echo htmlspecialchars($emailEvaluador); ?>">
                                    Enviar recordatorio
                                </button>
                            <?php } else { echo '-'; } ?>
                        </td>
                        <td class="text-wrap text-uppercase"><?php echo $nombreEvaluador; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $emailEvaluador; ?></td>
                        <td class="text-wrap"><?php if (!empty($videoPonencia)) { echo '<a href="' . htmlspecialchars($videoPonencia) . '" target="_blank">' . htmlspecialchars($videoPonencia) . '</a>'; } else { echo 'Sin video'; } ?></td>
                    </tr>
            <?php
                }
            } else {
                if ($etapaTrabajo == 'EXTENSO') {
                    echo '<td colspan="11"><h5 class="text-center">No se encontraron trabajos aceptados en la etapa <b>' . $etapaTrabajo . '.</b><br><br>Los extensos ACEPTADOS pasan automaticamente a la etapa EXTENSOS FINALES pendientes por evaluar.</h5></td>';
                } else {
                    echo '<td colspan="11"><h5 class="text-center">No se encontraron trabajos aceptados en la etapa <b>' . $etapaTrabajo . '</b></h5></td>';
                }
            }
            ?>

        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.btn-recordatorio').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var button = this;
        var datos = new FormData();
        datos.append('idPonencia', button.dataset.id);
        datos.append('tituloPonencia', button.dataset.titulo);
        datos.append('nombrePonente', button.dataset.ponente);
        datos.append('nombreEvaluador', button.dataset.evaluador);
        datos.append('emailEvaluador', button.dataset.email);

        button.disabled = true;
        button.textContent = 'Enviando...';

        fetch('../../modelo/enviarRecordatorioEvaluador.php', {
            method: 'POST',
            body: datos
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.success) {
                button.disabled = false;
                button.textContent = 'Volver a enviar';
                button.classList.remove('btn-warning');
                button.classList.add('btn-success');
                alert(data.message);
            } else {
                button.disabled = false;
                button.textContent = 'Enviar recordatorio';
                alert('Error: ' + data.message);
            }
        })
        .catch(function(error) {
            button.disabled = false;
            button.textContent = 'Enviar recordatorio';
            alert('Error al enviar el correo');
        });
    });
});
</script>
