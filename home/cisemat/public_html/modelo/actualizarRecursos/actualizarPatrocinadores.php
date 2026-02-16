<?php
/** 
****************************************************************************************************************
* Apartado se actualiza los nuevos recursos del congreso (color, nombre, logos, poster, banner, patrocinadores)
* Cualquier duda o sugerencia:
* @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com y Jayme Ernesto Lin jaymelinbr@gmail.com
****************************************************************************************************************
**/

/* ---------------------------------- ACTUALIZAR PATROCINADORES DEL CONGRESO ----------------------------------------- */

require '../conexion.php';

    $imagenPat1 = ''; // Guardar espacio vacio si no hay una imagen
    $imagenPat2 = ''; // Guardar espacio vacio si no hay una imagen
    $imagenPat3 = ''; // Guardar espacio vacio si no hay una imagen
    $imagenPat4 = ''; // Guardar espacio vacio si no hay una imagen
    $imagenPat5 = ''; // Guardar espacio vacio si no hay una imagen

    // Codigo para Patrocinador 1
    if (isset($_FILES["pat1"])){ // Recibir archivo con $_FILES y verfica que no este vacio el input
        $file1 = $_FILES["pat1"]; // Información del archivo

        $nombre1 = $file1["name"];
        $tipo1 = $file1["type"];
        $contenedorIMG1 = $file1["tmp_name"]; // Variable donde se almacena temporarlmente el archivo
        $size1 = $file1["size"];
        $dimensionIMG1 = getimagesize($contenedorIMG1);
        $width1 = $dimensionIMG1[0];
        $height1 = $dimensionIMG1[1];
        $carpeta1 = "../../src/ImgPagPrincipal/"; // Ruta de almacenamiento en la carpeta

        // Validamos los parámetros de arriba en un if
        if ($tipo1 != 'image/jpg' && $tipo1 != 'image/JPG' && $tipo1 != 'image/jpeg' && $tipo1 != 'image/png' && $tipo1 != 'image/webm') {
            echo '<script>alert("Error, el archivo seleccionado no es una imagen.");</script>';
        } else if ($size1 > 8*1024*1024) {
            echo "<script>alert('La imagen pesa mas de 8 Mb.');</script>";
        } else {
            // Almacenar imagen en la carpeta
            $src1 = $carpeta1.$nombre1;
            move_uploaded_file($contenedorIMG1, $src1);
            // Ruta de la imagen para la BD
            $imagenPat1 = "../../src/ImgPagPrincipal/".$nombre1;
        }
    }

    // Codigo para Patrocinador 2
    if (isset($_FILES["pat2"])){ // Recibir archivo con $_FILES y verfica que no este vacio el input
        $file2 = $_FILES["pat2"]; // Información del archivo

        $nombre2 = $file2["name"];
        $tipo2 = $file2["type"];
        $contenedorIMG2 = $file2["tmp_name"]; // Variable donde se almacena temporarlmente el archivo
        $size2 = $file2["size"];
        $dimensionIMG2 = getimagesize($contenedorIMG2);
        $width2 = $dimensionIMG2[0];
        $height2 = $dimensionIMG2[1];
        $carpeta2 = "../../src/ImgPagPrincipal/"; // Ruta de almacenamiento en la carpeta

        // Validamos los parámetros de arriba en un if
        if ($tipo2 != 'image/jpg' && $tipo2 != 'image/JPG' && $tipo2 != 'image/jpeg' && $tipo2 != 'image/png' && $tipo2 != 'image/webm') {
            echo '<script>alert("Error, el archivo seleccionado no es una imagen.");</script>';
        } else if ($size2 > 8*1024*1024) {
            echo "<script>alert('La imagen pesa mas de 8 Mb.');</script>";
        } else {
            // Almacenar imagen en la carpeta
            $src2 = $carpeta2.$nombre2;
            move_uploaded_file($contenedorIMG2, $src2);
            // Ruta de la imagen para la BD
            $imagenPat2 = "../../src/ImgPagPrincipal/".$nombre2;
        }
    }

    // Codigo para Patrocinador 3
    if (isset($_FILES["pat3"])){ // Recibir archivo con $_FILES y verfica que no este vacio el input
        $file3 = $_FILES["pat3"]; // Información del archivo

        $nombre3 = $file3["name"];
        $tipo3 = $file3["type"];
        $contenedorIMG3 = $file3["tmp_name"]; // Variable donde se almacena temporarlmente el archivo
        $size3 = $file3["size"];
        $dimensionIMG3 = getimagesize($contenedorIMG3);
        $width3 = $dimensionIMG3[0];
        $height3 = $dimensionIMG3[1];
        $carpeta3 = "../../src/ImgPagPrincipal/"; // Ruta de almacenamiento en la carpeta

        // Validamos los parámetros de arriba en un if
        if ($tipo3 != 'image/jpg' && $tipo3 != 'image/JPG' && $tipo3 != 'image/jpeg' && $tipo3 != 'image/png' && $tipo3 != 'image/webm') {
            echo '<script>alert("Error, el archivo seleccionado no es una imagen.");</script>';
        } else if ($size3 > 8*1024*1024) {
            echo "<script>alert('La imagen pesa mas de 8 Mb.');</script>";
        } else {
            // Almacenar imagen en la carpeta
            $src3 = $carpeta3.$nombre3;
            move_uploaded_file($contenedorIMG3, $src3);
            // Ruta de la imagen para la BD
            $imagenPat3 = "../../src/ImgPagPrincipal/".$nombre3;
        }
    }

    // Codigo para Patrocinador 4
    if (isset($_FILES["pat4"])){ // Recibir archivo con $_FILES y verfica que no este vacio el input
        $file4 = $_FILES["pat4"]; // Información del archivo

        $nombre4 = $file4["name"];
        $tipo4 = $file4["type"];
        $contenedorIMG4 = $file4["tmp_name"]; // Variable donde se almacena temporarlmente el archivo
        $size4 = $file4["size"];
        $dimensionIMG4 = getimagesize($contenedorIMG4);
        $width4 = $dimensionIMG4[0];
        $height4 = $dimensionIMG4[1];
        $carpeta4 = "../../src/ImgPagPrincipal/"; // Ruta de almacenamiento en la carpeta

        // Validamos los parámetros de arriba en un if
        if ($tipo4 != 'image/jpg' && $tipo4 != 'image/JPG' && $tipo4 != 'image/jpeg' && $tipo4 != 'image/png' && $tipo4 != 'image/webm') {
            echo '<script>alert("Error, el archivo seleccionado no es una imagen.");</script>';
        } else if ($size4 > 8*1024*1024) {
            echo "<script>alert('La imagen pesa mas de 8 Mb.');</script>";
        } else {
            // Almacenar imagen en la carpeta
            $src4 = $carpeta4.$nombre4;
            move_uploaded_file($contenedorIMG4, $src4);
            // Ruta de la imagen para la BD
            $imagenPat4 = "../../src/ImgPagPrincipal/".$nombre4;
        }
    }

    // Codigo para Patrocinador 5
    if (isset($_FILES["pat5"])){ // Recibir archivo con $_FILES y verfica que no este vacio el input
        $file5 = $_FILES["pat5"]; // Información del archivo

        $nombre5 = $file5["name"];
        $tipo5 = $file5["type"];
        $contenedorIMG5 = $file5["tmp_name"]; // Variable donde se almacena temporarlmente el archivo
        $size5 = $file5["size"];
        $dimensionIMG5 = getimagesize($contenedorIMG5);
        $width5 = $dimensionIMG5[0];
        $height5 = $dimensionIMG5[1];
        $carpeta5 = "../../src/ImgPagPrincipal/"; // Ruta de almacenamiento en la carpeta

        // Validamos los parámetros de arriba en un if
        if ($tipo5 != 'image/jpg' && $tipo5 != 'image/JPG' && $tipo5 != 'image/jpeg' && $tipo5 != 'image/png' && $tipo5 != 'image/webm') {
            echo '<script>alert("Error, el archivo seleccionado no es una imagen.");</script>';
        } else if ($size5 > 8*1024*1024) {
            echo "<script>alert('La imagen pesa mas de 8 Mb.');</script>";
        } else {
            // Almacenar imagen en la carpeta
            $src5 = $carpeta5.$nombre5;
            move_uploaded_file($contenedorIMG5, $src5);
            // Ruta de la imagen para la BD
            $imagenPat5 = "../../src/ImgPagPrincipal/".$nombre5;
        }
    }

    // Almacenar ruta de la imagen en la BD Query
    $query1 = mysqli_query($conexion, "UPDATE recursos_pagprin SET pat1 = '$imagenPat1'");
    $query2 = mysqli_query($conexion, "UPDATE recursos_pagprin SET pat2 = '$imagenPat2'");
    $query3 = mysqli_query($conexion, "UPDATE recursos_pagprin SET pat3 = '$imagenPat3'");
    $query4 = mysqli_query($conexion, "UPDATE recursos_pagprin SET pat4 = '$imagenPat4'");
    $query5 = mysqli_query($conexion, "UPDATE recursos_pagprin SET pat5 = '$imagenPat5'");
    header('location: ../../components/paginaPrincipal/paginaPrincipal.php');
?>
