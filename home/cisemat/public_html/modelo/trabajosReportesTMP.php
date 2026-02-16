<?php
require "conexion.php";
//require "traerCongresoActual.php";
require '../../modelo/traerCongresoActual.php';

$nombreTabla = 'tmp';

$nombreTablaEscapada = mysqli_real_escape_string($conexion, $nombreTabla);

$consulta = "SELECT 1 FROM information_schema.tables WHERE table_name = '$nombreTablaEscapada'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    mysqli_query($conexion, "DROP TABLE $nombreTablaEscapada");
}


//echo "<br>id_congreso".$idCongreso."<br>";

/*$tablaTemporal2 = "
CREATE TABLE tmp2
SELECT ur.id_ponencia,
    max(r.fecha_revision) as fecha_revision
FROM usuario_revision_ponencia ur, revision r
WHERE ur.id_revision_ponencia=r.id_revision 
 AND ur.id_congreso='$idCongreso'
 GROUP BY ur.id_ponencia 
 ORDER BY r.fecha_revision";
*/

/*
 $tablaTemporal2 = "
CREATE TABLE tmp2
 select substring(id_revision, 5, 10)as id_ponencia, max(fecha_revision) as fecha_revision 
 from revision where substring(id_revision, 16, 2)='$idCongreso' group by id_ponencia";
*/

//query ivan nc

 
$tablaTemporal2 = "
 CREATE TABLE tmp2
 select id_ponencia, 
        max(fecha_revision) as fecha_revision 
 from 
 (select *
    from revision
    where id_revision in (select id_revision_ponencia 
                            from usuario_revision_ponencia urp 
                            where urp.id_congreso ='$idCongreso'))as datos
 inner join usuario_revision_ponencia urp on datos.id_revision =urp.id_revision_ponencia 
 group by id_ponencia order by id_ponencia";




//echo "<br>tablaTemporal2".$tablaTemporal2."<br>";


$borratmp2="DROP TABLE IF EXISTS tmp2";
//echo "<br>modelo/trabajosResportesTMP.php borrar tmp2 : ".$borratmp2."<br>";
mysqli_query($conexion,$borratmp2);

//echo "<br>modelo/trabajosResportesTMP.php tmp2 : ".$tablaTemporal2."<br>";
mysqli_query($conexion, $tablaTemporal2);

/*
$tablaTemporal3 = "
CREATE TABLE tmp3
SELECT ur.id_congreso,ur.id_ponencia,ur.id_usuario_evalua,r.*
FROM tmp2 t,revision r,usuario_revision_ponencia ur
WHERE t.id_ponencia=ur.id_ponencia
 AND r.fecha_revision=t.fecha_revision   
 AND ur.id_congreso='$idCongreso'
 GROUP BY r.id_revision
 ORDER BY r.fecha_revision";*/
$tablaTemporal3 = "
CREATE TABLE tmp3 
select urp.id_congreso,urp.id_ponencia,urp.id_usuario_evalua,r.* 
from tmp2 
inner join revision r on tmp2.fecha_revision=r.fecha_revision 
inner join usuario_revision_ponencia urp on r.id_revision=urp.id_revision_ponencia";


//echo "<br>modelo/trabajosResportesTMP.php tablaTemporal3 11/02/2025 : ".$tablaTemporal3."<br>";

$borratmp3="DROP TABLE IF EXISTS tmp3";
//echo "<br>modelo/trabajosResportesTMP.php borrar tmp2 : ".$borratmp3."<br>";
mysqli_query($conexion,$borratmp3);

//echo "<br>modelo/trabajosResportesTMP.php tmp3 : ".$tablaTemporal3."<br>";
mysqli_query($conexion, $tablaTemporal3);

/*
$tablaTemporal = "
CREATE TABLE tmp
SELECT substring(p.id_ponencia,8,3) as num,
    p.id_ponencia,
    p.titulo_ponencia,
    p.id_congreso,
    concat(u.nombres_usuario,' ',u.apellidos_usuario) as Ponente,
    u.email_usuario, 
    r.descripcion_revision,
    MAX(r.fecha_revision) as fecha,
    r.estatus_revision,
    p.id_usuario_evalua,
    r.id_revision
FROM ponencia p,
    usuario_revision_ponencia ur,
    tmp3 r,
    usuario u
WHERE   p.id_congreso='$idCongreso'
    AND p.id_tipo_ponencia=2

    AND p.id_congreso=ur.id_congreso
    AND p.id_ponencia=ur.id_ponencia 
    AND p.id_usuario_evalua=ur.id_usuario_evalua

    AND ur.id_revision_ponencia=r.id_revision

    AND p.id_usuario_registra = u.id_usuario

GROUP BY p.id_ponencia";
*/
/*
$tablaTemporal4 = "
    SELECT 
    r.id_revision,
    r.descripcion_revision,
    MAX(r.fecha_revision) as fecha,
    r.estatus_revision,
    FROM tmp3 t3,usuario_revision_ponencia ur
    WHERE ur.id_revision_ponencia=tmp3.id_revision
    ";
*/

//$tablaTamporal

$tablaTemporal = "
CREATE TABLE tmp
SELECT substring(p.id_ponencia,8,3) as num,
    p.id_congreso,
    p.id_ponencia,
    p.titulo_ponencia,
    concat(u.nombres_usuario,' ',u.apellidos_usuario) as Ponente,
    u.email_usuario, 
    p.id_usuario_evalua,
    ur.id_revision,
    ur.descripcion_revision,
    MAX(ur.fecha_revision) as fecha,
    ur.estatus_revision
 
 FROM ponencia p

 LEFT JOIN usuario u
    ON
    p.id_usuario_registra = u.id_usuario   

  LEFT JOIN tmp3 ur
    ON 
        p.id_congreso=ur.id_congreso
    AND p.id_ponencia=ur.id_ponencia 
    AND p.id_usuario_evalua=ur.id_usuario_evalua

  WHERE p.id_congreso='$idCongreso'
    AND p.id_tipo_ponencia=2 

GROUP BY p.id_ponencia";

//echo "<br>modelo/trabajosResportesTMP.php query tablaTemporal 2 : ".$tablaTemporal."<br>";

$borratmp="DROP TABLE IF EXISTS tmp";
//echo "<br>modelo/trabajosResportesTMP.php borrar tmp : ".$borratmp."<br>";
mysqli_query($conexion,$borratmp);

//echo "<br>modelo/trabajosResportesTMP.php tmp : ".$tablaTemporal."<br>";

mysqli_query($conexion, $tablaTemporal);
//echo "<br>Pase<br> se ejecuto tmp";


?>
