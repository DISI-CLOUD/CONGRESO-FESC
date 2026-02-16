<div class="container mt-5 mb-5 ">
    <div class="row row-centrar ">
        <div class="centrico col-md-4 text-center texto-sm border border-success 
        p-2 border-opacity-10 rounded d-sm-block col-sm-6">
            <div class="div p-4" style="font-size: 22px;">
                <h4 style="font-size: 36px;">Mesa de ayuda virtual </h4> <br>
                <a href="https://cuaieed-unam.zoom.us/j/83260121188">Mesa de ayuda virtual (zoom) </a>
                <br>
                <br>
                <p>Horario de atención 8 de mayo  08:30 a 1:30 y 17:00 a 18:00</p>
                <br>
                <p>Horario de atención 9 de mayo  08:30 a 1:30 </p>
                <br><br>
                <h4 style="font-size: 36px;">Fechas importantes</h4> <br>
                
                <?php

                /*
                    //Fecha del congreso
                    $id_evento = 13;
                    $sql = "SELECT fecha_congreso_inicio FROM fecha_congreso WHERE id_evento = $id_evento AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = $id_evento)";
                    $sql2 = "SELECT fecha_congreso_fin FROM fecha_congreso WHERE id_evento = $id_evento AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = $id_evento)";
                    $result = $conexion->query($sql);
                    $result2 = $conexion->query($sql2);
                    $row = $result->fetch_assoc();
                    $row2 = $result2->fetch_assoc();
                    $fecha = new DateTime($row["fecha_congreso_inicio"]);
                    $fecha2 = new DateTime($row2["fecha_congreso_fin"]);
                    $locale = 'es_ES'; // Establece la configuración regional en español

                    $dateFormatter = new IntlDateFormatter(
                        $locale,
                        IntlDateFormatter::FULL, // Estilo completo de fecha y hora
                        IntlDateFormatter::FULL, // Estilo completo de fecha y hora
                        'UTC', // Zona horaria
                        IntlDateFormatter::GREGORIAN
                    );

                    $dateFormatter2 = new IntlDateFormatter(
                        $locale,
                        IntlDateFormatter::FULL, // Estilo completo de fecha y hora
                        IntlDateFormatter::FULL, // Estilo completo de fecha y hora
                        'UTC', // Zona horaria
                        IntlDateFormatter::GREGORIAN
                    );

                    $dateFormatter->setPattern("d 'de' MMMM");  // Define el patrón de formato
                    $dateFormatter2->setPattern("d 'de' MMMM 'de' y"); // Define el patrón de formato

                    $fecha_formateada = $dateFormatter->format($fecha);
                    $fecha_formateada2 = $dateFormatter2->format($fecha2);

                    echo $fecha_formateada . " y " . $fecha_formateada2;
                    //------------------------------------------------------------------------------
                    */

                $id_eventos = array(); // Array que almacena los eventos, se actualiza si es que se introduce uno nuevo 

                $limite_post = 2; // Numero de fechas proximas a mostrar

                $sql_eventos = "SELECT * FROM evento WHERE id_evento > 0";

                //llenado del array de eventos
                $resultado = $conexion->query($sql_eventos);
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        $id_eventos[] = $row['id_evento'];
                    }
                }

                $id_list = implode(',', $id_eventos);

                $sql = "SELECT fc.*, e.*, fc.fecha_congreso_inicio as fecha_inicio, fc.fecha_congreso_fin as fecha_congreso_fin,
                    e.descripcion_evento as descripcion_evento
                    FROM fecha_congreso as fc
                    JOIN evento as e ON fc.id_evento = e.id_evento
                    WHERE fc.id_evento IN ($id_list)
                    AND fc.id_congreso = (
                    SELECT MAX(id_congreso) 
                    FROM fecha_congreso
                    WHERE id_evento IN ($id_list)
                    )
                    ORDER BY fc.fecha_congreso_inicio ASC";

                $result = $conexion->query($sql);

                $meses = array(
                    1 => 'enero',
                    2 => 'febrero',
                    3 => 'marzo',
                    4 => 'abril',
                    5 => 'mayo',
                    6 => 'junio',
                    7 => 'julio',
                    8 => 'agosto',
                    9 => 'septiembre',
                    10 => 'octubre',
                    11 => 'noviembre',
                    12 => 'diciembre'
                );

                $fecha_c = date('Y-m-d');

                $contador = 0;

                if ($result->num_rows > 0) {
                    // Output de los datos usando un bucle while
                    while ($row = $result->fetch_assoc()) {

                        $fecha_i = $row["fecha_inicio"];

                        $fecha_f = $row["fecha_congreso_fin"];


                        //Selecciona la fecha más cercana
                        if (strtotime($fecha_c) <= strtotime($fecha_f)) {

                            $contador = $contador + 1;


                            $d_evento = $row["descripcion_evento"];

                            $f_i_ = new DateTime($fecha_i);
                            $f_f_ = new DateTime($fecha_f);



                            if ($f_i_->format('m') == $f_f_->format('m') && $f_i_->format('Y') == $f_f_->format('Y')) {
                                $formatted_date1 = date("j", strtotime($fecha_i));
                                $formatted_date2 = date("j", strtotime($fecha_f));

                                $month = $meses[date("n", strtotime($fecha_i))];

                                $y = date("Y", strtotime($fecha_i));

                                $date_range = $formatted_date1 . " al " . $formatted_date2 . " de " . $month . ' del ' . $y;
                            } else {

                                $formatted_date1 = date("j", strtotime($fecha_i));
                                $formatted_date2 = date("j", strtotime($fecha_f));

                                $month = $meses[date("n", strtotime($fecha_i))];
                                $month_ = $meses[date("n", strtotime($fecha_f))];

                                $y = date("Y", strtotime($fecha_i));
                                $y_ = date("Y", strtotime($fecha_f));

                                $date_range = $formatted_date1 . " de " . $month . ' del ' . $y . " al " . $formatted_date2 . " de " . $month_ . ' del ' . $y_;
                            }

                            echo '<hr><b>' . ucfirst(mb_strtolower($d_evento)) . '</b><br><br><em>' . $date_range . '</em><br><br>';

                            if ($contador >= $limite_post) {
                                break;
                            }
                        }
                    }
                }
                //Si no hay fechas cercanas, mostrara que no hay eventos programados.
                else {
                    echo "Sin eventos programados!";
                }

                ?>

            </div>
            <hr>
            <div class="d-grid gap-2" style="margin-top: 20px;">
                <?php // Traer color automatizado
                $valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
                $color = mysqli_query($conexion, $valorColor);
                $rowColor = $color->fetch_assoc();
                $colorHex = $rowColor['color_congreso'];
                ?>
                <a href="../../components/actividadesFechas/fechas.php">
                    <button class="btn btn-style shadow mt-4 mb-4 px-5" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Ver Fechas</button></a>

                <a href="../../src/convocatoria/XVII.pdf" target="_blank">
                    <button class="btn btn-style shadow p-2 mb-4 px-5" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Ver Convocatoria</button></a>

                <a href="../../components/subirResumen/subirResumen.php">
                    <button class="btn btn-style shadow px-5 p-2 mb-4" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Registrar Ponencia</button></a>

                <hr>
                <h3 style="font-size: 24px;">Memorias</h4>
                

                <a href="https://matematicasfesc.cuautitlan.unam.mx/Memorias/onceavo/" target="_blank">
                    <button class="btn btn-style shadow px-5 p-2 mb-2" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Onceavo Congreso</button></a>

                <a href="https://matematicasfesc.cuautitlan.unam.mx/Memorias/Congreso13/" target="_blank">
                    <button class="btn btn-style shadow px-5 p-2 mb-2" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Decimotercer Congreso</button></a>

                <a href="https://matematicasfesc.cuautitlan.unam.mx/Memorias/Congreso14/" target="_blank">
                    <button class="btn btn-style shadow px-5 p-2 mb-2" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Decimocuarto Congreso</button></a>

                <a href="https://matematicasfesc.cuautitlan.unam.mx/Memorias/Congreso15/" target="_blank">
		    <button class="btn btn-style shadow px-5 p-2 mb-4" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Decimoquinto Congreso</button></a>

		<a href="https://matematicasfesc.cuautitlan.unam.mx/Memorias/Congreso16/" target="_blank">
                    <button class="btn btn-style shadow px-5 p-2 mb-4" type="button" style="background-color: <?php echo $colorHex; ?>!important;">Decimosexto Congreso</button></a>

            </div>
        </div>
        <div class="mx-auto mt-4 col-md-8  d-sm-block col-sm-6 d-lg-block 
        col-lg-6 d-xs-block col-sm-auto d-xs-block col-xs-6">
            <?php // Traer imagen de la BD
            $imagenSQL = "SELECT cartel_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
            $traerIMG = mysqli_query($conexion, $imagenSQL);
            $rowImagen = $traerIMG->fetch_assoc();
            $rutaIMG = $rowImagen['cartel_congreso'];
            $rutaFinal = str_replace("../", "./", $rutaIMG);
            ?>
            <embed src="<?php echo $rutaFinal; ?>" alt="" width="600" height="800" class=" p-0 img-ajustar rounded cartel mx-auto" >
            <!--img src="<?php echo $rutaFinal; ?>" class=" p-0 img-ajustar rounded cartel mx-auto" alt="" max-width="600" max-height="800"></img-->

        </div>
    </div>
</div>
