<?php
/** 
****************************************************************************************************************
* Apartado se actualiza los nuevos recursos del congreso (color, nombre, logos, poster, banner, patrocinadores)
* Cualquier duda o sugerencia:
* @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com y Jayme Ernesto Lin jaymelinbr@gmail.com
****************************************************************************************************************
**/

/* ---------------------------------- ACTUALIZAR BANNER DEL CONGRESO ----------------------------------------- */

require '../conexion.php';

    $imagenBanner = ''; // Guardar espacio vacio si no hay una imagen
    if (isset($_FILES["bannerIMG"])){ // Recibir archivo con $_FILES y verfica que no este vacio el input
        $file = $_FILES["bannerIMG"]; // Información del archivo

        $nombre = $file["name"];
        $tipo = $file["type"];
        $contenedorIMG = $file["tmp_name"]; // Variable donde se almacena temporarlmente el archivo
        $size = $file["size"];
        $dimensionIMG = getimagesize($contenedorIMG);
        $width = $dimensionIMG[0];
        $height = $dimensionIMG[1];
        $carpeta = "../../src/ImgPagPrincipal/"; // Ruta de almacenamiento en la carpeta

        // Validamos los parámetros de arriba en un if
        if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/webm') {
            echo '<script>alert("Error, el archivo seleccionado no es una imagen.");</script>';
        } else if ($size > 8*1024*1024) {
            echo "<script>alert('La imagen pesa mas de 8 Mb.');</script>";
        } else {
            // Almacenar imagen en la carpeta
            $src = $carpeta.$nombre;
            move_uploaded_file($contenedorIMG, $src);
            // Ruta de la imagen para la BD
            $imagen = "../../src/ImgPagPrincipal/".$nombre;
        }
    }
    // Almacenar ruta de la imagen en la BD

    $query = mysqli_query($conexion, "UPDATE recursos_pagprin SET banner_congreso = '$imagen'");
    header('location: ../../components/paginaPrincipal/paginaPrincipal.php');
?>
