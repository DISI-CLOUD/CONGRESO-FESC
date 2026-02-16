<?php
if (isset($_POST["submit2"])) {
    $nombre_archivo = $_FILES["nuevo_archivo2"]["name"];
    $tipo_archivo = $_FILES["nuevo_archivo2"]["type"];
    $tamano_archivo = $_FILES["nuevo_archivo2"]["size"];
    $temp_archivo = $_FILES["nuevo_archivo2"]["tmp_name"];
    $archivo_a_reemplazar = $_POST["archivo_a_reemplazar2"]; // Nombre del archivo a reemplazar

    // Inicializa un mensaje vacío
    $mensaje = "";

    // Verificar si es un archivo PDF o Word
    if (($tipo_archivo == "application/pdf" || $tipo_archivo == "application/msword" || $tipo_archivo == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") && $tamano_archivo < 5242880) {
        $carpeta_destino = "../../src/GuiasYPlantillas/";
        $ruta_archivo = $carpeta_destino . $archivo_a_reemplazar; // Ruta del archivo a reemplazar

        // Verificar si el archivo ya existe
        if (file_exists($ruta_archivo)) {
            // Eliminar el archivo existente antes de reemplazarlo
            unlink($ruta_archivo);
        }

        // Mover el nuevo archivo a la carpeta de destino
        if (move_uploaded_file($temp_archivo, $ruta_archivo)) {
            $mensaje = "El archivo se ha subido y reemplazado correctamente.";
        } else {
            $mensaje = "Hubo un error al subir el archivo.";
        }
    } else {
        $mensaje = "El archivo debe ser un PDF o un documento Word (DOC o DOCX) y no debe exceder los 5MB de tamaño.";
    }

    // Almacenar el mensaje en una variable de sesión
    session_start();
    $_SESSION['mensaje'] = $mensaje;

    // Redirigir de nuevo a la página del primer código
    header("Location: ayudaPlantillas.php");
    exit;
}
?>
