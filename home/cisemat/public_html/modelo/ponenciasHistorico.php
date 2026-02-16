<?php
    /** 
    * Este modulo realiza la consulta de todos las Ponencias Orales de todos los congresos
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";

    $tituloPonencia="";
    $idPonencia="";
    $idTipoPonencia="";
    $categoriaPonencia="";
    $idUsuarioEvalua="";

    /*
    //Para tener el numero de ponencia
    $consPonenciasOralesHistorico_previo = "CREATE TEMPORARY TABLE tmp001rh SELECT substring(p.id_ponencia,8,3) as num,p.* FROM ponencia p ORDER BY num;";
    $resPonenciasOralesHistorico_previo = mysqli_query($conexion, $consPonenciasOralesHistorico_previo);

    //Hace la consulta de los trabajos disponibles en el congreso actual para autor
    $consPonenciasOralesHistorico = "SELECT * FROM tmp001rh ponencia
    INNER JOIN oral ON ponencia.id_ponencia=oral.id_ponencia and oral.id_congreso=ponencia.id_congreso 
    INNER JOIN categoria ON ponencia.id_categoria=categoria.id_categoria
    INNER JOIN tipo_ponencia ON ponencia.id_tipo_ponencia=tipo_ponencia.id_tipo_ponencia
    INNER JOIN semblanza ON ponencia.id_usuario_registra=semblanza.id_usuario 
    WHERE ponencia.id_tipo_ponencia='2'
    ORDER BY ponencia.num;";

    */


    //query ivan NC

    
    $consPonenciasOralesHistorico= "SELECT o.id_ponencia,
       o.extenso_oral,
       p.titulo_ponencia,
       p.fecha_registro_ponencia,
       p.video_ponencia,
        p.id_usuario_registra,
       p.id_usuario_evalua,
       concat(u.nombres_usuario,' ',u.apellidos_usuario) as Autor,
       u.email_usuario,
       r.descripcion_revision,
       r.estatus_revision,
       s.semblanza,
       c.id_congreso,
       c2.categoria, 
       tp.*
 from oral o 
  inner join ponencia p on o.id_ponencia = p.id_ponencia and o.id_congreso=p.id_congreso 
  inner join usuario_revision_ponencia urp on o.id_ponencia=urp.id_ponencia and o.id_congreso=urp.id_congreso
  inner join revision r on urp.id_revision_ponencia = r.id_revision 
  inner join usuario u on p.id_usuario_registra = u.id_usuario  
  inner join semblanza s on p.id_usuario_registra=s.id_usuario 
  inner join congreso c on o.id_congreso=c.id_congreso   
  inner join categoria c2 on p.id_categoria=c2.id_categoria  
  inner join tipo_ponencia tp on p.id_tipo_ponencia = tp.id_tipo_ponencia 
  where o.id_usuario_evalua_final =751
        and r.descripcion_revision = 'EXTENSO REVISION FINAL'
        and r.estatus_revision = 'A'
        and tp.id_tipo_ponencia=2
  ORDER BY p.id_congreso desc, SUBSTRING(o.id_ponencia, 8, 3) asc 
";



    $resPonenciasOralesHistorico = mysqli_query($conexion, $consPonenciasOralesHistorico);

?>