<?php
$errores = array();
$_SESSION['info'] = "";

if (isset($_POST['subirComprobante'])) {
    $tamanio = 10000; // Tamaño máximo permitido en kilobytes

    if (isset($_FILES['capturaVoucher']) && ($_FILES['capturaVoucher']['type'] == 'image/jpeg')) {
        // Rutas
        $ruta = "../../src/comprobantes_pago/";
        $nombreArchivo = "Comprobante_pago_usuario_" . $_SESSION['id'] . '_' . $_FILES['capturaVoucher']['name'];
        $rutaCompleta = $ruta . $nombreArchivo;

        if ($_FILES['capturaVoucher']['size'] < ($tamanio * 1024)) {
            if (move_uploaded_file($_FILES['capturaVoucher']['tmp_name'], $rutaCompleta)) {
                $info = "Se ha subido el comprobante.";
                $_SESSION['info'] = $info;

                // Actualizar la tabla de pago con la ruta del comprobante
                $subirComprobante = "UPDATE pago SET imagen_pago = '$rutaCompleta' WHERE id_usuario = '$_SESSION[id]'";
                $data_check = mysqli_query($conexion, $subirComprobante);
            } else {
                $errores['db-error'] = "¡Error al subir el documento!";
            }
        } else {
            $errores['db-error'] = "¡Error al subir el documento! El peso supera el límite permitido.";
        }
    } else {
        $errores['db-error'] = "¡Error al subir el documento! Solo se admiten imágenes con formato JPEG.";
    }
}
?>

<?php
// Mostrar mensajes de error y éxito
function mostrarMensaje($mensaje, $tipo = 'success')
{
    echo '<div class="alert alert-' . $tipo . ' alert-dismissible fade show mt-3" role="alert">';
    echo $mensaje;
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
}
?>

<!-- Mostrar mensajes de error y éxito -->
<?php
if (isset($errores['db-error'])) {
    mostrarMensaje($errores['db-error'], 'danger');
}

if (!empty($_SESSION['info'])) {
    mostrarMensaje($_SESSION['info']);
    $_SESSION['info'] = ""; // Limpiar el mensaje después de mostrarlo
    echo '<script type="text/javascript">window.location.reload();</script>';
}


?>