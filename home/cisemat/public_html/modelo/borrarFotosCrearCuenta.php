<?php
/*
 * Este módulo realiza la eliminación de las imágenes de los formularios Iniciar Sesión, Registro y cambio de contraseña
 * Cualquier duda o sugerencia:
 * Autor: Kevin García Rojas - vinke-ggz@hotmail.com - +525536656792
 */

//$_SERVER['DOCUMENT_ROOT'] . "\\req2";



//----------------------------------------------------Borrar foto del formulario Iniciar Sesión-----------------------------------------------------------------------------------
$var_exito = '';
$var_error = '';
if (!empty($_POST["deleteSn"])) {
    require "conexion.php"; // Incluye el archivo de conexión

    // Obtenemos el directorio donde se almacena la imagen actual
    $query = mysqli_query($conexion, "SELECT directorio FROM imagenescrearcuenta WHERE id_imagen = 1");
    $directorioImagen = mysqli_fetch_assoc($query)['directorio'];

    // Eliminar la imagen utilizando unlink
    if (file_exists($directorioImagen) && unlink($directorioImagen)) {
        // La imagen se ha eliminado correctamente
        // Actualizamos las columnas `directorio` y `ruta` a NULL
        $updateQuery = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET directorio = NULL, ruta = NULL WHERE id_imagen = 1");

        if ($updateQuery) {
            $var_exito = '<div class="alert alert-success m-1 mt-5" role="alert">La imagen se ha eliminado correctamente.</div>';
        } else {
            $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al actualizar las columnas en la base de datos: ' . mysqli_error($conexion) . '</div>';
        }
    } else {
        $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al eliminar la imagen.</div>';
    }
}

?>

<?php

//----------------------------------------------------Borrar foto del formulario Crear Cuenta-----------------------------------------------------------------------------------
$var_exito = '';
$var_error = '';
if (!empty($_POST["deleteAc"])) {
    require "conexion.php"; // Incluye el archivo de conexión

    // Obtenemos el directorio donde se almacena la imagen actual
    $query = mysqli_query($conexion, "SELECT directorio FROM imagenescrearcuenta WHERE id_imagen = 2");
    $directorioImagenAc = mysqli_fetch_assoc($query)['directorio'];

    // Eliminar la imagen utilizando unlink
    if (file_exists($directorioImagenAc) && unlink($directorioImagenAc)) {
        // La imagen se ha eliminado correctamente
        // Actualizamos las columnas `directorio` y `ruta` a NULL
        $updateQuery = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET directorio = NULL, ruta = NULL WHERE id_imagen = 2");

        if ($updateQuery) {
            $var_exito = '<div class="alert alert-success m-1 mt-5" role="alert">La imagen se ha eliminado correctamente.</div>';
        } else {
            $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al actualizar las columnas en la base de datos: ' . mysqli_error($conexion) . '</div>';
        }
    } else {
        $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al eliminar la imagen.</div>';
    }
}

?>

<?php

//----------------------------------------------------Borrar foto del formulario Contraseña-----------------------------------------------------------------------------------
$var_exito = '';
$var_error = '';
if (!empty($_POST["deletePass"])) {
    require "conexion.php"; // Incluye el archivo de conexión

    // Obtenemos el directorio donde se almacena la imagen actual
    $query = mysqli_query($conexion, "SELECT directorio FROM imagenescrearcuenta WHERE id_imagen = 3");
    $directorioImagenPass = mysqli_fetch_assoc($query)['directorio'];

    // Eliminar la imagen utilizando unlink
    if (file_exists($directorioImagenPass) && unlink($directorioImagenPass)) {
        // La imagen se ha eliminado correctamente
        // Actualizamos las columnas `directorio` y `ruta` a NULL
        $updateQuery = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET directorio = NULL, ruta = NULL WHERE id_imagen = 3");

        if ($updateQuery) {
            $var_exito = '<div class="alert alert-success m-1 mt-5" role="alert">La imagen se ha eliminado correctamente.</div>';
        } else {
            $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al actualizar las columnas en la base de datos: ' . mysqli_error($conexion) . '</div>';
        }
    } else {
        $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al eliminar la imagen.</div>';
    }
}

?>

