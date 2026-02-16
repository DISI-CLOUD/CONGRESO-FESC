<?php
// Modulo que trae trabajos de memorias
// Todos los trabajos en EXTENSO REVISION FINAL y estan APROBADOS
// Hecho por Ricardo Leaños Medina dudas: ricardoleanosmedina@gmail.com


require "conexion.php";
require "traerCongresoActual.php";

/*
$queryTrabajosMemorias = "SELECT oral.id_ponencia, 
oral.extenso_oral, 
ponencia.titulo_ponencia,
concat(usuario.nombres_usuario,' ',usuario.apellidos_usuario) as Autor,
usuario.email_usuario,
revision.descripcion_revision,
revision.estatus_revision
FROM oral 
JOIN ponencia ON oral.id_ponencia = ponencia.id_ponencia 
JOIN revision on  revision.id_revision =oral.id_ponencia
JOIN usuario ON ponencia.id_usuario_registra = usuario.id_usuario
WHERE oral.id_usuario_evalua_final = 751 
AND revision.descripcion_revision = 'EXTENSO REVISION FINAL'
AND revision.estatus_revision = 'A'
AND ponencia.id_congreso = '$idCongreso'
GROUP BY ponencia.id_ponencia
ORDER BY SUBSTRING(oral.id_ponencia, 8, 3) ASC";
*/


//query IVAN NC
$queryTrabajosMemorias= "SELECT o.id_ponencia,
       o.extenso_oral,
       p.titulo_ponencia,
       concat(u.nombres_usuario,' ',u.apellidos_usuario) as Autor,
       u.email_usuario,
       r.descripcion_revision,
       r.estatus_revision,
       s.semblanza
 from oral o 
  inner join ponencia p on o.id_ponencia = p.id_ponencia and o.id_congreso=p.id_congreso 
  inner join usuario_revision_ponencia urp on o.id_ponencia=urp.id_ponencia and o.id_congreso=urp.id_congreso
  inner join revision r on urp.id_revision_ponencia = r.id_revision 
  inner join usuario u on p.id_usuario_registra = u.id_usuario  
  inner join semblanza s on p.id_usuario_registra=s.id_usuario 
  where o.id_usuario_evalua_final =751
        and p.id_congreso= '$idCongreso' 
        and r.descripcion_revision = 'EXTENSO REVISION FINAL'
        and r.estatus_revision = 'A'
ORDER BY SUBSTRING(o.id_ponencia, 8, 3) ASC";

 

// Cuando se corrija el error del hash debe ser cambiado el JOIN revision on  revision.id_revision LIKE CONCAT ('%', oral.id_ponencia, '%') por el id

$trabajosFinales = mysqli_query($conexion, $queryTrabajosMemorias);

//JOIN revision on  revision.id_revision LIKE CONCAT ('%', oral.id_ponencia, '%')
?>