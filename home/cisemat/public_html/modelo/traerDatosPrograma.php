<?php

require "conexion.php";
require "traerCongresoActual.php";
$consTrabajosRegistrados = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso'";
//Hace la consulta de los trabajos disponibles en el congreso actual para autor
//SELECT * FROM ponencia WHERE id_congreso='16' AND id_usuario_evalua is not null;
// En las siguinetes lineas se extraen los diterentes tipos de trabajos registrados 
// CA = CARTELES   PR = PROTOTIPOS |       SE = SIN EVALUADOR
// PO = PONENCIAS                  |       CE = CON EVALUADOR
// TA = TALLERES                   |
$consCARegistradosSE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is null AND substring(id_ponencia, 4, 2) = 'CA' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC"; //
$consCARegistradosCE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is not null AND substring(id_ponencia, 4, 2) = 'CA' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC";
$consPORegistradosSE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is null AND substring(id_ponencia, 4, 2) = 'PO' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC";
$consPORegistradosCE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is not null AND substring(id_ponencia, 4, 2) = 'PO' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC";
$consTARegistradosSE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is null AND substring(id_ponencia, 4, 2) = 'TA' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC";
$consTARegistradosCE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is not null AND substring(id_ponencia, 4, 2) = 'TA' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC";
$consPRRegistradosSE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is null AND substring(id_ponencia, 4, 2) = 'PR' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC";
$consPRRegistradosCE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is not null AND substring(id_ponencia, 4, 2) = 'PR' ORDER BY CAST(SUBSTRING(id_ponencia, -3) AS UNSIGNED) ASC";

$consTrabajosTotCE = "SELECT * FROM ponencia WHERE id_congreso='$idCongreso' AND id_usuario_evalua is not null ORDER BY SUBSTRING(id_ponencia, 4, 2) ASC, SUBSTRING(id_ponencia, -3) ASC";

$resTrabajosRegistrados = mysqli_query($conexion, $consTrabajosRegistrados);
$resTrabajosTotCE = mysqli_query($conexion, $consTrabajosTotCE);

$resCAregisSE = mysqli_query($conexion, $consCARegistradosSE);
$resCAregisCE = mysqli_query($conexion, $consCARegistradosCE);

$resPOregisSE = mysqli_query($conexion, $consPORegistradosSE);
$resPOregisCE = mysqli_query($conexion, $consPORegistradosCE);

$resTAregisSE = mysqli_query($conexion, $consTARegistradosSE);
$resTAregisCE = mysqli_query($conexion, $consTARegistradosCE);

$resPRregisSE = mysqli_query($conexion, $consPRRegistradosSE);
$resPRregisCE = mysqli_query($conexion, $consPRRegistradosCE);
?>
 