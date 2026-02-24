<?php
/**
 * Normaliza un número telefónico para envío por WhatsApp.
 * - Elimina caracteres no numéricos (espacios, guiones, paréntesis, +)
 * - Si tiene código de país 52 (México) lo quita para dejar solo 10 dígitos
 * - Valida que el resultado sean exactamente 10 dígitos
 * @param string $telefono  Número en cualquier formato
 * @return string  Número limpio de 10 dígitos, o cadena vacía si es inválido
 */
function normalizarTelefono($telefono) {
    $limpio = preg_replace('/[^0-9]/', '', $telefono);

    // Si viene con código de país México (52) + 10 dígitos = 12 dígitos
    if (strlen($limpio) === 12 && str_starts_with($limpio, '52')) {
        $limpio = substr($limpio, 2);
    }
    // Si viene con 521 (formato antiguo) + 10 dígitos = 13 dígitos
    if (strlen($limpio) === 13 && str_starts_with($limpio, '521')) {
        $limpio = substr($limpio, 3);
    }

    // Debe ser exactamente 10 dígitos
    if (strlen($limpio) !== 10) {
        return '';
    }

    // Validar que el número empiece con un código de área válido (2-9)
    if ($limpio[0] === '0' || $limpio[0] === '1') {
        return '';
    }

    return $limpio;
}

/**
 * Obtiene el correo de contacto del congreso actual desde la BD.
 * Usa caché estático para ejecutar la consulta solo una vez por request.
 * @return string  Correo de contacto, o cadena vacía si no se puede obtener.
 */
function traerCorreoContactoCongreso() {
    static $correo = null;
    if ($correo !== null) return $correo;
    global $conexion;
    if (!$conexion) return '';
    $res = mysqli_query($conexion, "SELECT correo_congreso FROM congreso ORDER BY id_congreso DESC LIMIT 1");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        $correo = strtolower($row['correo_congreso'] ?? '');
    }
    return $correo ?? '';
}

/**
 * Genera el pie de mensaje de WhatsApp con el correo de contacto del congreso actual.
 * @return string
 */
function generarPieMensajeWA() {
    $correo = traerCorreoContactoCongreso();
    $contacto = $correo ? $correo : 'el correo del Congreso';
    return "\n\n_Este número es solo para notificaciones. En caso de tener una duda, sugerencia u opinión acerca del Congreso contacta a través del siguiente medio: {$contacto}_";
}

/**
 * Envía un mensaje de WhatsApp vía el microservicio Baileys.
 * @param string $telefono  Número telefónico (se normaliza automáticamente)
 * @param string $mensaje   Texto del mensaje
 */
function enviarWhatsapp($telefono, $mensaje) {
    $telefono = normalizarTelefono($telefono);
    if (empty($telefono)) return;
    $url = 'http://localhost:3001/send';
    $data = json_encode(['telefono' => $telefono, 'mensaje' => $mensaje . generarPieMensajeWA()]);
    $ctx = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-Type: application/json',
            'content' => $data,
            'timeout' => 5,
            'ignore_errors' => true,
        ]
    ]);
    @file_get_contents($url, false, $ctx);
}

/**
 * Envía un PDF por WhatsApp vía el microservicio Baileys.
 * @param string $telefono   Número a 10 dígitos
 * @param string $rutaPdf    Ruta absoluta al archivo PDF
 * @param string $mensaje    Caption/mensaje que acompaña al PDF
 */
function enviarWhatsappPdf($telefono, $rutaPdf, $mensaje = '') {
    $telefono = normalizarTelefono($telefono);
    if (empty($telefono) || empty($rutaPdf)) return;
    $url = 'http://localhost:3001/send-pdf';
    $data = json_encode(['telefono' => $telefono, 'ruta' => $rutaPdf, 'mensaje' => $mensaje . generarPieMensajeWA()]);
    $ctx = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-Type: application/json',
            'content' => $data,
            'timeout' => 10,
            'ignore_errors' => true,
        ]
    ]);
    @file_get_contents($url, false, $ctx);
}

/**
 * Busca el teléfono de un usuario por su email en la BD.
 * @param string $email
 * @param mysqli $conexion
 * @return string  Teléfono o cadena vacía si no existe
 */
function traerTelefonoPorEmail($email, $conexion) {
    $emailSafe = mysqli_real_escape_string($conexion, $email);
    $res = mysqli_query($conexion, "SELECT telefono_usuario FROM usuario WHERE email_usuario='$emailSafe' LIMIT 1");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        return $row['telefono_usuario'] ?? '';
    }
    return '';
}
?>
