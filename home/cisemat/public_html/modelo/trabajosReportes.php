<?php
    /** 
    * Este modulo realiza la consulta de todos los trabajos registrados en el congreso actual
    * y los trabajos de tipo ponencia oral para los reportes de administrador.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    require "traerCongresoActual.php";

    $tituloPonencia="";
    $idPonencia="";
    $idTipoPonencia="";
    $categoriaPonencia="";
    $idUsuarioEvalua="";
    //Congreso
    //$idCongreso="15";

    //Hace la consulta de los trabajos disponibles en el congreso actual para todas los trabajos
    $consTrabajosRegistrados = "SELECT * FROM ponencia 
                                WHERE id_congreso='$idCongreso' 
                                ORDER BY id_tipo_ponencia";
    $resTrabajosRegistrados = mysqli_query($conexion, $consTrabajosRegistrados);

    //Hace la consulta de los trabajos disponibles en el congreso actual para ponencias
    $consPonenciasRegistradas = "SELECT * FROM ponencia 
                                 WHERE id_congreso='$idCongreso' AND id_tipo_ponencia='2' 
                                 ORDER BY SUBSTRING(id_ponencia, 4, 2) ASC, SUBSTRING(id_ponencia, -3) ASC";
    $resPonenciasRegistradas = mysqli_query($conexion, $consPonenciasRegistradas);

    $etapaTrabajo = $_SESSION['reporte'];
    $pendienteEF = NULL;
    $rechazoTipo = 'R';
    
    // Pendiente por evaluar extenso final
    if($etapaTrabajo == 'EXTENSO REVISION FINAL'){
      $pendienteEF = 'F';
    }

    // Rechazo de extenso
    if($etapaTrabajo == 'EXTENSO REVISION FINAL'){
      $rechazoTipo = 'FR';
    }

    
//*************************************************************************************
// Consulta "CATALOGO" para crear la tabla de TODOS LOS TRABAJOS DEL CONGRESO ACTUAL
// La tabla creada la utilizan todas las demas consultas
// La tabla tmp que se tuiliza es temporal y se crea en /modelo/trabajosReportesTMP.php
//*************************************************************************************

    $queryTemporalCatalogo = " CREATE TABLE catalogotmp
    SELECT 
       b.num,
       b.id_ponencia,
       b.titulo_ponencia,
       b.ponente,
       b.email_usuario,
       b.fecha,
       b.id_usuario_evalua,
       b.descripcion_revision,
       b.estatus_revision,
     concat(u.nombres_usuario,' ',u.apellidos_usuario) as Evaluador,
       u.email_usuario as correo_evaluador,
       b.id_revision 
    FROM tmp b
    LEFT JOIN usuario u ON b.id_usuario_evalua=u.id_usuario
    ORDER BY b.num";

//***********************************************************************************
// Antes de ejecutar el Query anterior borra la tabla catalogotmp de la Base de datos
//***********************************************************************************

$borracatalogo="DROP TABLE IF EXISTS catalogotmp";
mysqli_query($conexion,$borracatalogo);
//echo "<br>queryTemporalCatalogo: ".$queryTemporalCatalogo."<br>";
$ejecucionTMPCatalogo = mysqli_query($conexion,$queryTemporalCatalogo);


//***********************************************************************************
// Consulta tabla temporal TODOS LOS TRABAJOS REGISTRADOS EN EL CONGRESO ACTUAL
// Es el reporte que se muestra al inicio    
//***********************************************************************************

$queryCatalogo ="Select * from catalogotmp";
$queryCatalogo2 = mysqli_query($conexion,$queryCatalogo);
$numrowCatalogo2=mysqli_num_rows($queryCatalogo2);

//***********************************************************************************
// Consulta tabla temporal TRABAJOS PENDIENTES POR CORREGIR
//***********************************************************************************
$queryTemporalPendienteCorregir = "SELECT * from catalogotmp 
                                   WHERE descripcion_revision = '$etapaTrabajo' 
                                     AND estatus_revision = '$rechazoTipo' 
                                   ORDER BY num";
//echo "<br>Todo ok 3<br>";
$ejecucionTMPPendienteCorregir = mysqli_query($conexion, $queryTemporalPendienteCorregir);

//***********************************************************************************
// Consulta tabla temporal TRABAJO ACEPTADO
//***********************************************************************************
$queryTemporalAprobado = "SELECT * FROM catalogotmp 
                          WHERE descripcion_revision = '$etapaTrabajo' 
                            AND estatus_revision = 'A' ";
/*echo "<br>Todo queryTemporalAprobado ".$queryTemporalAprobado ." <br>";*/
$ejecucionTMPAprobado = mysqli_query($conexion, $queryTemporalAprobado);

//***********************************************************************************
// Consulta tabla temporal TRABAJO PENDIENTE POR EVALUAR
//***********************************************************************************
$queryTmpPendienteEvaluar = "SELECT * FROM catalogotmp 
                            WHERE descripcion_revision = '$etapaTrabajo' 
                              AND Evaluador IS NOT NULL
                              AND (estatus_revision IS NULL 
                              OR estatus_revision=''
                              OR estatus_revision='F')";
                              
//echo "<br>queryTmpPendienteEvaluar ".$queryTmpPendienteEvaluar ." <br>";
$ejecucionTMPPendienteEvaluar= mysqli_query($conexion,$queryTmpPendienteEvaluar); 
//echo "<br>Pase<br>";                         

?>