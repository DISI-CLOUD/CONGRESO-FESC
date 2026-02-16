<?php
/*
 * Este módulo realiza la modificación de los formularios Iniciar Sesión, Registro y cambio de contraseña
 * Cualquier duda o sugerencia:
 * Autor: Kevin García Rojas - vinke-ggz@hotmail.com - +525536656792
 */

//$_SERVER['DOCUMENT_ROOT'] . "\\req2";



//----------------------------------------------------Cambio de foto del formulario Iniciar Sesión-----------------------------------------------------------------------------------
$var_exito = '';
$var_error = '';
if (!empty($_POST["saveSn"])) {
    if (isset($_FILES["unamIS"]) && !empty($_FILES["unamIS"])) {
        require "conexion.php"; // Incluye el archivo de conexión

        $imgSn = "";

        // Obtenemos la información del archivo
        $file = $_FILES["unamIS"];
        $name = "unamIS"; // Nombre de la imagen (puedes personalizarlo)
        $filetype = $file["type"];
        $temp_path = $file["tmp_name"];
        $size = $file["size"];

        $extension = '';

        if (strlen($file['type']) > 0) {
            $extension = explode("/", $file['type'])[1];
        }


        if ($extension == 'jpeg') {
            $extension = 'jpg';
        }elseif($extension == 'png') {
            $extension = 'jpg';
        }




        // Verificamos si el archivo es una imagen válida (jpg o png)


        if ($filetype != 'image/jpg' && $filetype != 'image/jpeg' && $filetype != 'image/png') {
            // echo "El archivo no es una imagen válida.";

            $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">El archivo no es una imagen válida.</div>';


        } else if ($size > 3 * 1024 * 1024) { // Verificamos el tamaño máximo (3MB)
           
            $var_error = '<div class="alert alert-warning m-1 mt-5" role="alert">El tamaño máximo permitido es de 3MB.</div>';

        } else {
            $folder = $_SERVER['DOCUMENT_ROOT'] . "../../src/ImgCrearCuenta/"; // Carpeta donde se almacenará la imagen

            // Creamos una ruta única para la imagen
            $src = $folder . $name . '.' . $extension;
            $pathImage ="";
            $pathImage ="../../src/ImgCrearCuenta/". $name . '.' . $extension;

            // Movemos el archivo a la carpeta de destino
            if (move_uploaded_file($temp_path, $src)) {

                
                // La imagen se ha subido correctamente, ahora actualizamos la ruta en la base de datos
                $query = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET directorio = '$src' WHERE id_imagen = 1");
                $query = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET ruta = '$pathImage' WHERE id_imagen = 1");

                if ($query) {
                    //echo "La imagen se ha subido y actualizado correctamente.";

                    $var_exito = '<div class="alert alert-success m-1 mt-5" role="alert">La imagen se ha subido y actualizado correctamente.</div>';

                    // Puedes redirigir al usuario o mostrar un mensaje de éxito aquí.
                } else {
                    //echo "Error al actualizar la ruta en la base de datos: " . mysqli_error($conexion);
                    $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al actualizar la ruta en la base de datos: ' . mysqli_error($conexion) . '</div>';
                }
            } else {
                //echo "Error al mover el archivo.";
                $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al mover el archivo.</div>';
            }
        }
    }
}
?>

<?php

//-----------------------------------------------------Cambio de foto del formulario Crear Cuenta-----------------------------------------------------------------------------------

$var_exito = '';
$var_error = '';
if (!empty($_POST["saveAccount"])) {
    if (isset($_FILES["imgCuenta"]) && !empty($_FILES["imgCuenta"])) {
        require "conexion.php"; // Incluye el archivo de conexión

        $imgAc = "";

        // Obtenemos la información del archivo
        $fileAc = $_FILES["imgCuenta"];
        $nameAc = "imgCuenta"; // Nombre de la imagen (puedes personalizarlo)
        $filetypeAc = $fileAc["type"];
        $temp_pathAc = $fileAc["tmp_name"];
        $sizeAc = $fileAc["size"];

        $extensionAc = '';

        if (strlen($fileAc['type']) > 0) {
            $extensionAc = explode("/", $fileAc['type'])[1];
        }


        if ($extensionAc == 'jpeg') {
            $extensionAc = 'jpg';
        }elseif($extensionAc == 'png') {
            $extensionAc = 'jpg';
        }




        // Verificamos si el archivo es una imagen válida (jpg o png)


        if ($filetypeAc != 'image/jpg' && $filetypeAc != 'image/jpeg' && $filetypeAc != 'image/png') {
            // echo "El archivo no es una imagen válida.";

            $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">El archivo no es una imagen válida.</div>';


        } else if ($sizeAc > 3 * 1024 * 1024) { // Verificamos el tamaño máximo (3MB)
           
            $var_error = '<div class="alert alert-warning m-1 mt-5" role="alert">El tamaño máximo permitido es de 3MB.</div>';

        } else {
            $folderAc = $_SERVER['DOCUMENT_ROOT'] . "../../src/ImgCrearCuenta/"; // Carpeta donde se almacenará la imagen

            // Creamos una ruta única para la imagen
            $srcAc = $folderAc . $nameAc . '.' . $extensionAc;
            $pathImageAc ="";
            $pathImageAc ="../../src/ImgCrearCuenta/". $nameAc . '.' . $extensionAc;
            

            // Movemos el archivo a la carpeta de destino
            if (move_uploaded_file($temp_pathAc, $srcAc)) {


                // La imagen se ha subido correctamente, ahora actualizamos la ruta en la base de datos
                $query = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET directorio = '$srcAc' WHERE id_imagen = 2");
                $query = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET ruta = '$pathImageAc' WHERE id_imagen = 2");

                if ($query) {
                    //echo "La imagen se ha subido y actualizado correctamente.";

                    $var_exito = '<div class="alert alert-success m-1 mt-5" role="alert">La imagen se ha subido y actualizado correctamente.</div>';

                    // Puedes redirigir al usuario o mostrar un mensaje de éxito aquí.
                } else {
                    //echo "Error al actualizar la ruta en la base de datos: " . mysqli_error($conexion);
                    $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al actualizar la ruta en la base de datos: ' . mysqli_error($conexion) . '</div>';
                }
            } else {
                //echo "Error al mover el archivo.";
                $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al mover el archivo.</div>';
            }
        }
    }
}
?>

<?php
//-----------------------------------------------------Cambio de foto del formulario Contraseña-----------------------------------------------------------------------------------


$var_exito = '';
$var_error = '';
if (!empty($_POST["saveImgPAss"])) {
    if (isset($_FILES["unamRC"]) && !empty($_FILES["unamRC"])) {
        require "conexion.php"; // Incluye el archivo de conexión

        $imgPass = "";

        // Obtenemos la información del archivo
        $filePass = $_FILES["unamRC"];
        $namePass = "unamRC"; // Nombre de la imagen (puedes personalizarlo)
        $filetypePass = $filePass["type"];
        $temp_pathPass = $filePass["tmp_name"];
        $sizePass = $filePass["size"];

        $extensionPass = '';

        if (strlen($filePass['type']) > 0) {
            $extensionPass = explode("/", $filePass['type'])[1];
        }


        if ($extensionPass == 'jpeg') {
            $extensionPass = 'jpg';
        }elseif($extensionPass == 'png') {
            $extensionPass = 'jpg';
        }




        // Verificamos si el archivo es una imagen válida (jpg o png)


        if ($filetypePass != 'image/jpg' && $filetypePass != 'image/jpeg' && $filetypePass != 'image/png') {
            // echo "El archivo no es una imagen válida.";

            $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">El archivo no es una imagen válida.</div>';


        } else if ($sizePass > 3 * 1024 * 1024) { // Verificamos el tamaño máximo (3MB)
           
            $var_error = '<div class="alert alert-warning m-1 mt-5" role="alert">El tamaño máximo permitido es de 3MB.</div>';

        } else {
            $folderPass = $_SERVER['DOCUMENT_ROOT'] . "../../src/ImgCrearCuenta/"; // Carpeta donde se almacenará la imagen

            // Creamos una ruta única para la imagen
            $srcPass = $folderPass . $namePass . '.' . $extensionPass;
            $pathImagePass ="";
            $pathImagePass ="../../src/ImgCrearCuenta/". $namePass . '.' . $extensionPass;
            

            // Movemos el archivo a la carpeta de destino
            if (move_uploaded_file($temp_pathPass, $srcPass)) {

                
                // La imagen se ha subido correctamente, ahora actualizamos la ruta en la base de datos

                $query = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET directorio = '$srcPass' WHERE id_imagen = 3");
                $query = mysqli_query($conexion, "UPDATE imagenescrearcuenta SET ruta = '$pathImagePass' WHERE id_imagen = 3");

                if ($query) {
                    //echo "La imagen se ha subido y actualizado correctamente.";

                    $var_exito = '<div class="alert alert-success m-1 mt-5" role="alert">La imagen se ha subido y actualizado correctamente.</div>';

                    // Puedes redirigir al usuario o mostrar un mensaje de éxito aquí.
                } else {
                    //echo "Error al actualizar la ruta en la base de datos: " . mysqli_error($conexion);
                    $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al actualizar la ruta en la base de datos: ' . mysqli_error($conexion) . '</div>';
                }
            } else {
                //echo "Error al mover el archivo.";
                $var_error = '<div class="alert alert-danger m-1 mt-5" role="alert">Error al mover el archivo.</div>';
            }
        }
    }
}
?>

