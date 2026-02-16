<?php

/** 
 ****************************************************************************************************************
 * Apartado que convierte el logo del congreso en un icono de 32 x 32 para la imagen de cada página
 * Cualquier duda o sugerencia:
 * @author Ricardo Leaños Medina ricardoleanosmedina@gmail.com
 ****************************************************************************************************************
 **/

require 'conexion.php';

// Ruta de la imagen original
$rutaSQL = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
$ejecrutaSQL = mysqli_query($conexion, $rutaSQL);
$rowCongreso = mysqli_fetch_assoc($ejecrutaSQL);
$rutaLogo = $rowCongreso['logo_congreso'];
$rutaImagenOriginal = str_replace("../../", "../", $rutaLogo);

// Obtener las dimensiones originales de la imagen
list($ancho_original, $alto_original) = getimagesize($rutaImagenOriginal);

// Definir el nuevo tamaño
$nuevo_ancho = 32;
$nuevo_alto = 32;

// Crear una imagen en blanco con el nuevo tamaño
$imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

// Cargar la imagen original (corregir la línea siguiente)
$imagen_original = imagecreatefromjpeg($rutaImagenOriginal);

// Redimensionar la imagen original a la nueva imagen
imagecopyresized($imagen_nueva, $imagen_original, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);

// Guardar la imagen redimensionada
$rutaLogoManiulada = "../src/logos_congresos/iconoIcon.jpg";
imagejpeg($imagen_nueva, $rutaLogoManiulada);

// Liberar memoria
imagedestroy($imagen_original); // Corregir esta línea
imagedestroy($imagen_nueva);


?>