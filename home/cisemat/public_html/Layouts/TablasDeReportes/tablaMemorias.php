<div id="tablaMemorias" class="scroll table-responsive border border-success border-opacity-10 rounded pt-2 px-2 pb-5 mt-4" style="max-height: 1000px;">
    <?php
    //En caso de que el autor tenga ponencias
    require "../../modelo/traerTrabajosMemorias.php";
  
    $totalColumnas = mysqli_num_rows($trabajosFinales);
    echo "<h5>Se muestran todos los trabajos en extenso revison final que han sido aprobados.</h5>";
    echo "<h5>Total de trabajos: {$totalColumnas}</h5>";
    ?>
    <!-- <button id="botonDescargarTodo" class="btn btn-success text-uppercase mb-3">Descargar Todo</button> -->
    <table class="table">
        <tr class="head-table">
            <th scope="col">Id Ponencia</th>
             <th scope="col">Congreso</th>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Correo Autor</th>
            <th scope="col">Descargar Semblanza</th>
            <th scope="col">Descargar trabajo</th>
        </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($trabajosFinales) > 0) {
                while ($fetchPonenciasRegistradas = mysqli_fetch_assoc($trabajosFinales)) {
                    $idPonencia = $fetchPonenciasRegistradas['id_ponencia'];
                    $tituloPonencia = $fetchPonenciasRegistradas['titulo_ponencia'];
                    $nombrePonente = $fetchPonenciasRegistradas['Autor'];
                    $emailPonente = $fetchPonenciasRegistradas['email_usuario'];
                    $estatusRev = $fetchPonenciasRegistradas['estatus_revision'];
                    if ($estatusRev = 'A') {
                        $estatusRev = 'APROBADO';
                    }
                    $descargasemblanza = $fetchPonenciasRegistradas['semblanza'];
                    $descargaPonencia = $fetchPonenciasRegistradas['extenso_oral'];
            ?>
                    <tr>
                        <td class="text-wrap text-uppercase"><?php echo $idPonencia; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $idCongreso; ?></td> 
                        <td class="text-wrap text-uppercase"><?php echo $tituloPonencia; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $nombrePonente; ?></td>
                        <td class="text-wrap text-uppercase"><?php echo $emailPonente; ?></td>
                        <!--td class="text-wrap text-uppercase"><?php echo $estatusRev; ?></td-->
                        <td class="text-wrap text-uppercase">
                            <a id="boton-<?php echo $idPonencia; ?>" class="btn btn-secondary mt-3" href="<?php echo $descargasemblanza; ?>" target="_blank">Semblanza</a>
                        </td>
                        <td class="text-wrap text-uppercase">
                            <a id="boton-<?php echo $idPonencia; ?>" class="btn btn-secondary mt-3" href="<?php echo $descargaPonencia; ?>">Extenso</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo '<td colspan="9"><h5 class="text-center">No se encontraron extensos en revision final para descargar</h5></td>';
            }
            ?>
        </tbody>
    </table>
</div>