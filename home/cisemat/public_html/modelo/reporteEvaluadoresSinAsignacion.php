<?php 
/** 
*******************************************************************************************************
* Apartado asignar maximo de ponencias a un evaluador
* Cualquier duda o sugerencia:
* @author Carlos Alfredo Tejeda Araujo tejeda.araujo.carlos.alfredo@gmail.com
*******************************************************************************************************
**/ 

require "traerCongresoActual.php";
//Trae datos de los evaluadores que aun no han sido asignados a una ponencia actual del congreso como su numero maximo de ponencias, su nombre y su email.
/*$traerReporteEvaluadoresSinAsignacion="SELECT e.*,u.nombres_usuario,u.apellidos_usuario,u.email_usuario 
                       				   FROM evaluador e, funcion_usuario f 
                       				     INNER JOIN usuario u ON e.id_usuario=u.id_usuario 
                       				       WHERE NOT EXISTS 
                       				         (SELECT * FROM ponencia p 
                       				         	 WHERE p.id_usuario_evalua=e.id_usuario 
                       				         	  AND p.id_congreso='$idCongreso' 
                       				         	 GROUP BY p.id_usuario_evalua)
                       				        AND e.id_usuario=f.id_usuario 
                       				        AND (f.id_funcion=21 
                       				         AND f.estado_funcion='ON')";*/
$traerReporteEvaluadoresSinAsignacion="SELECT e.*,u.nombres_usuario,u.apellidos_usuario,u.email_usuario 
                       				   FROM evaluador e, funcion_usuario f, usuario u
                       				       WHERE e.id_usuario IS NOT NULL 
                       				        AND e.id_usuario NOT IN (SELECT id_usuario_evalua FROM ponencia p 
                       				        	                     WHERE p.id_congreso='$idCongreso'
                       				        	                     AND p.id_usuario_evalua IS NOT NULL )
                       				        AND u.id_usuario=e.id_usuario 
                       				        AND e.id_usuario=f.id_usuario 
                       				        AND (f.id_funcion=21 
                       				        AND f.estado_funcion='ON')
                       				        GROUP BY e.id_usuario
                       				    	ORDER BY u.apellidos_usuario";                      				         
//echo "<br>".$traerReporteEvaluadoresSinAsignacion."<br>";
$resTraerReporteEvaluadoresSinAsignacion=mysqli_query($conexion,$traerReporteEvaluadoresSinAsignacion);


?>