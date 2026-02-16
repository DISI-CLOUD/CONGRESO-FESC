<?php
function formatFechaEvento($id_evento, $conexion) {
    date_default_timezone_set('UTC'); 

    $sql_inicio = "SELECT fecha_congreso_inicio FROM fecha_congreso WHERE id_evento = $id_evento AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = $id_evento)";
    $sql_fin = "SELECT fecha_congreso_fin FROM fecha_congreso WHERE id_evento = $id_evento AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = $id_evento)";
    
    $result_inicio = $conexion->query($sql_inicio);
    $result_fin = $conexion->query($sql_fin);
    
    $row_inicio = $result_inicio->fetch_assoc();
    $row_fin = $result_fin->fetch_assoc();
    
    $fecha_inicio = new DateTime($row_inicio["fecha_congreso_inicio"]);
    $fecha_fin = new DateTime($row_fin["fecha_congreso_fin"]);

    $meses = array(
        'January' => 'enero',
        'February' => 'febrero',
        'March' => 'marzo',
        'April' => 'abril',
        'May' => 'mayo',
        'June' => 'junio',
        'July' => 'julio',
        'August' => 'agosto',
        'September' => 'septiembre',
        'October' => 'octubre',
        'November' => 'noviembre',
        'December' => 'diciembre'
    );
    
    $mes_inicio = $meses[$fecha_inicio->format('F')];
    $anio_inicio = $fecha_inicio->format('Y');
    
    $mes_fin = $meses[$fecha_fin->format('F')];
    $anio_fin = $fecha_fin->format('Y');

    $meses_distintos = $fecha_inicio->format('n') != $fecha_fin->format('n');

    $anios_distintos = $anio_inicio != $anio_fin;
    
    if ($meses_distintos) {
        $fecha_formateada = "Del " . $fecha_inicio->format('d') . " de " . $mes_inicio . " de ";
        if ($anios_distintos) {
            $fecha_formateada .= $anio_inicio . " al ";
        }
        $fecha_formateada .= $fecha_fin->format('d') . " de " . $mes_fin . " de " . $anio_fin;
    } else {
        $fecha_formateada = "Del " . $fecha_inicio->format('d') . " al " . $fecha_fin->format('d') . " de " . $mes_inicio . " de ";
        if ($anios_distintos) {
            $fecha_formateada .= $anio_inicio . " al " . $anio_fin;
        } else {
            $fecha_formateada .= $anio_inicio;
        }
    }
    return $fecha_formateada;
}
?>








