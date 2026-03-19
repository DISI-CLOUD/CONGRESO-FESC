<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Acceso no autorizado"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
    exit;
}

header('Content-Type: application/json; charset=utf-8');

require_once "conexion.php";

$idPonencia = isset($_POST['idPonencia']) ? mysqli_real_escape_string($conexion, $_POST['idPonencia']) : '';
$tituloPonencia = isset($_POST['tituloPonencia']) ? $_POST['tituloPonencia'] : '';
$nombrePonente = isset($_POST['nombrePonente']) ? $_POST['nombrePonente'] : '';
$nombreEvaluador = isset($_POST['nombreEvaluador']) ? $_POST['nombreEvaluador'] : '';
$emailEvaluador = isset($_POST['emailEvaluador']) ? $_POST['emailEvaluador'] : '';

if (empty($idPonencia) || empty($emailEvaluador) || empty($nombreEvaluador)) {
    echo json_encode(["success" => false, "message" => "Faltan datos requeridos"]);
    exit;
}

ob_start();
require_once "../librerias/PHPMailer/src/correoRecordatorioEvaluador.php";
$output = ob_get_clean();

if (strpos($output, "Error:") !== false) {
    echo json_encode(["success" => false, "message" => $output]);
} else {
    echo json_encode(["success" => true, "message" => "Correo de recordatorio enviado a " . $emailEvaluador]);
}
?>
