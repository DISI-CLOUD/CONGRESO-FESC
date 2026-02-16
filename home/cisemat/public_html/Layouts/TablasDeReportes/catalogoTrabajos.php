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
            <th scope="col">Evaluador</th>
            <th scope="col">Correo del Evaluador</th>
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

            ?>
                    <tr>
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
                if ($etapaTrabajo == 'EXTENSO') {
                    echo '<td colspan="9"><h5 class="text-center">No se encontraron trabajos aceptados en la etapa <b>' . $etapaTrabajo . '.</b><br><br>Los extensos ACEPTADOS pasan automaticamente a la etapa EXTENSOS FINALES pendientes por evaluar.</h5></td>';
                } else {
                    echo '<td colspan="9"><h5 class="text-center">No se encontraron trabajos aceptados en la etapa <b>' . $etapaTrabajo . '</b></h5></td>';
                }
            }
            ?>

        </tbody>
    </table>
</div>
