<?php 
  include_once ("../../modelo/conexion.php");
  require '../../modelo/traerCongresoActual.php';
  if(!empty($_POST['costoPonente']) && !empty($_POST['costoAsistente']) &&  !empty($_POST['costoEstudiante'])){
    $ponente = $_POST['costoPonente'];
    $asistente = $_POST['costoAsistente'];
    $estudiante = $_POST['costoEstudiante'];
    
    $sql = " INSERT INTO costo (`idCosto`, `id_congreso`, `Tipo`, `Costo`, `Descripcion`) VALUES ('1', '".$idCongreso."', 'PONENTES', '".$ponente."', 'Internos y externos que presentan trabajos'), ('2', '".$idCongreso."', 'ASISTENTES', '".$asistente."', 'Internos y externos que no presentan trabajos'), ('3', '".$idCongreso."', 'ESTUDIANTES', '".$estudiante."', 'Estudiantes de licenciatura o media superior, únicamente pueden participar como asistentes y con derecho a un taller o curso.') 
    ON DUPLICATE KEY UPDATE
    Costo = CASE
                    WHEN Tipo = 'PONENTES' THEN '".$ponente."'
                    WHEN Tipo = 'ASISTENTES' THEN '".$asistente."'
                    WHEN Tipo = 'ESTUDIANTES' THEN '".$estudiante."'
                    -- Agrega más descripciones y costos aquí según sea necesario
                    ELSE Costo -- Si no coincide ninguna descripción, mantén el costo actual
                END;";
    
    $resultado=mysqli_query($conexion,$sql);
    if ($resultado){
      echo "<script language='JavaScript'>
                alert('Los datos se han actualizado correctamente');
                </script>
                ";
                print "<script>window.location='../../components/cambiarDiseño/cambiarDiseño.php';</script>";
    }else{
      
           //Los datos No se guradaron Bien
                echo "<script language='JavaScript'>
                alert('ERROR: Los datos NO  fueron actualizados correctamente');
                </script>
                ";
                print "<script>window.location='../../components/cambiarDiseño/cambiarDiseño.php';</script>";
       
            }
      mysqli_close($conexion);
  }else{
    echo "<script language='JavaScript'>
                alert('ERROR: Debe completar los campos de formulario');
                </script>
                ";
    print "<script>window.location='../../components/cambiarDiseño/cambiarDiseño.php';</script>";
  }
?>