<?php
/**
 * Envía un mensaje de WhatsApp vía el microservicio Baileys.
 * @param string $telefono  Número a 10 dígitos (ej: 5548569471)
 * @param string $mensaje   Texto del mensaje
 */
function enviarWhatsapp($telefono, $mensaje) {
    if (empty($telefono)) return;
    $url = 'http://localhost:3001/send';
    $data = json_encode(['telefono' => $telefono, 'mensaje' => $mensaje]);
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
