<?php
require "../../modelo/conexion.php";
require "../../modelo/traerCongresoActual.php"; 

//Hace la consulta de los trabajos disponibles en el congreso actual para autor
//$consDatosPago = "SELECT * FROM pago WHERE id_congreso='$idCongreso'";

//consulta Ivan NC
$consDatosPago = "SELECT pago.*, RESULTADO.id_usuario as ponente from pago 
left join 
(select id_usuario from(	
select * from 
	(select p.id_ponencia, p.titulo_ponencia, u.id_usuario,  u.nombres_usuario, u.apellidos_usuario, u.email_usuario, tp.categoria_ponencia, 'PONENTE' from ponencia p  
    inner join usuario u on p.id_usuario_registra=u.id_usuario
    inner join tipo_ponencia tp on p.id_tipo_ponencia=tp.id_tipo_ponencia  
    inner join usuario_revision_ponencia urp on p.id_ponencia=urp.id_ponencia and p.id_congreso=urp.id_congreso
    inner join revision r on urp.id_revision_ponencia = r.id_revision 
    inner join oral o on p.id_ponencia = o.id_ponencia and p.id_congreso=o.id_congreso 
    where p.id_congreso='$idCongreso'  
    	and r.descripcion_revision = 'EXTENSO REVISION FINAL'
        and r.estatus_revision = 'A'
        and p.id_tipo_ponencia=2)as ponentes 
union 
select * from  
(select p.id_ponencia, p.titulo_ponencia, u.id_usuario, u.nombres_usuario, u.apellidos_usuario, u.email_usuario, tp.categoria_ponencia, 'COAUTOR' from usuario_colabora_ponencia_18012024 ucp 
   inner join ponencia p on ucp.id_ponencia=p.id_ponencia and ucp.id_congreso=p.id_congreso  
   inner join usuario u on ucp.id_usuario=u.id_usuario   
   inner join tipo_ponencia tp on p.id_tipo_ponencia=tp.id_tipo_ponencia 
   inner join usuario_revision_ponencia urp on p.id_ponencia=urp.id_ponencia and p.id_congreso=urp.id_congreso
   inner join revision r on urp.id_revision_ponencia = r.id_revision 
   inner join oral o on p.id_ponencia = o.id_ponencia and p.id_congreso=o.id_congreso
   where ucp.id_congreso ='$idCongreso'  
   and r.descripcion_revision = 'EXTENSO REVISION FINAL'
   and r.estatus_revision = 'A'
   and p.id_tipo_ponencia =2 ) as coautor order by id_ponencia)as datos
union   
 select id_usuario from(	
select * from 
	(select p.id_ponencia, p.titulo_ponencia, p.id_tipo_ponencia,u.id_usuario, u.nombres_usuario, u.apellidos_usuario, u.email_usuario, tp.categoria_ponencia, 'PONENTE' from ponencia p  
    inner join usuario u on p.id_usuario_registra=u.id_usuario
    inner join tipo_ponencia tp on p.id_tipo_ponencia=tp.id_tipo_ponencia  
    inner join usuario_revision_ponencia urp on p.id_ponencia=urp.id_ponencia and p.id_congreso=urp.id_congreso
    inner join revision r on urp.id_revision_ponencia = r.id_revision 
    where p.id_congreso='$idCongreso'  
    	and r.descripcion_revision = 'RESUMEN'
        and r.estatus_revision = 'A'
        and p.id_tipo_ponencia in (1,3))as ponentes 
union
select * from  
(select p.id_ponencia, p.titulo_ponencia, p.id_tipo_ponencia, u.id_usuario, u.nombres_usuario, u.apellidos_usuario, u.email_usuario, tp.categoria_ponencia, 'COAUTOR' from usuario_colabora_ponencia_18012024 ucp 
   inner join ponencia p on ucp.id_ponencia=p.id_ponencia and ucp.id_congreso=p.id_congreso  
   inner join usuario u on ucp.id_usuario=u.id_usuario   
   inner join tipo_ponencia tp on p.id_tipo_ponencia=tp.id_tipo_ponencia 
   inner join usuario_revision_ponencia urp on p.id_ponencia=urp.id_ponencia and p.id_congreso=urp.id_congreso
   inner join revision r on urp.id_revision_ponencia = r.id_revision 
   where ucp.id_congreso ='$idCongreso'  
   and r.descripcion_revision = 'RESUMEN'
   and r.estatus_revision = 'A'
   and p.id_tipo_ponencia in (1,3) ) as coautor order by id_ponencia)as datos2
   		)as RESULTADO
   on pago.id_usuario=RESULTADO.id_usuario where pago.id_congreso='$idCongreso'";


$resDatosPago = mysqli_query($conexion, $consDatosPago);

?>