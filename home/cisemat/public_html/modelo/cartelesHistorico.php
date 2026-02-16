<?php
    /** 
    * Este modulo realiza la consulta de todos los Carteles de todos los congresos
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";

    $tituloPonencia="";
    $idPonencia="";
    $idTipoPonencia="";
    $categoriaPonencia="";
    $idUsuarioEvalua="";

    //Hace la consulta de los trabajos disponibles en el congreso actual para autor
/*
    $consCartelesHistorico = "SELECT * FROM ponencia
    INNER JOIN cartel ON ponencia.id_ponencia=cartel.id_ponencia
    INNER JOIN categoria ON ponencia.id_categoria=categoria.id_categoria
    INNER JOIN tipo_ponencia ON ponencia.id_tipo_ponencia=tipo_ponencia.id_tipo_ponencia
    WHERE ponencia.id_tipo_ponencia='1'
    ORDER BY ponencia.id_ponencia;";
*/


   $consCartelesHistorico="
    SELECT p.id_ponencia, 
       p.titulo_ponencia,
       concat(u.nombres_usuario,' ',u.apellidos_usuario) as Autor,
       u.email_usuario,
       r.descripcion_revision,
       r.estatus_revision,
       s.semblanza,
       c.id_congreso,
       p.id_usuario_evalua
   from ponencia p
     inner join usuario_revision_ponencia urp on p.id_ponencia=urp.id_ponencia and p.id_congreso=urp.id_congreso
     inner join revision r on urp.id_revision_ponencia = r.id_revision 
     inner join usuario u on p.id_usuario_registra = u.id_usuario  
     inner join semblanza s on p.id_usuario_registra=s.id_usuario 
     inner join congreso c on p.id_congreso=c.id_congreso   
  where r.descripcion_revision = 'RESUMEN'
        and r.estatus_revision = 'A'
        and p.id_tipo_ponencia=1 
  order by p.id_congreso desc, SUBSTRING(p.id_ponencia, 8, 3) asc";



    $resCartelesHistorico = mysqli_query($conexion, $consCartelesHistorico);

?>