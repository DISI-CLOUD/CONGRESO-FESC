<?php 
/** 
*******************************************************************************************************
* Apartado asignar maximo de ponencias a un evaluador
* Cualquier duda o sugerencia:
* @author Carlos Alfredo Tejeda Araujo tejeda.araujo.carlos.alfredo@gmail.com
*******************************************************************************************************
**/ 

require "traerCongresoActual.php";
//Trae datos de los evaluadores como su numero maximo de ponencias, ponencias asignadas al momento, su nombre y su email.
$traerReporteEvaluadores="SELECT p.id_usuario_evalua,
                                 u.nombres_usuario,
                                 u.apellidos_usuario,
                                 u.email_usuario, 
                                 COUNT(p.id_usuario_evalua) AS 'ponencias_asignadas',  
                                 e.numero_ponencias 
                          FROM ponencia p  
                            INNER JOIN usuario u 
                              ON p.id_usuario_evalua = u.id_usuario 
                                INNER JOIN evaluador e 
                                  ON u.id_usuario=e.id_usuario 
                          WHERE p.id_congreso='$idCongreso' 
                          GROUP BY p.id_usuario_evalua;";
$resTraerReporteEvaluadores=mysqli_query($conexion,$traerReporteEvaluadores);


?>