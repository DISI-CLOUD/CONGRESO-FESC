<?php
/** 
 *******************************************************************************************************
 * Apartado hace consultas y actualizaciones de administrador/asignaciones
 * Cualquier duda o sugerencia:
 * @author Alison Michelle Rubio Garcia allyssonrg@gmail.com
 *******************************************************************************************************
 **/


require "conexion.php";
require "traerDatosPrograma.php";
require "traerCongresosPasados.php";

//echo "<br>Llego aquí 1 ".$idCongreso."<br>";
if (!empty($_POST["asignarEvaluador"])) {
  $evaluador = $_POST['selectEvaluador'];

  if (isset($_POST['checkbox'])) {

    //recorre el array del checkbox
    foreach ($_POST['checkbox'] as $valor) {
//echo "<br>Llego aquí valor ".$valor."<br>";
       
      //consulta el id del autor de la ponencia
      $consAutorPonencia = "SELECT * FROM ponencia WHERE id_ponencia='$valor' AND id_congreso='$idCongreso'";
      $resAutorPonencia = mysqli_query($conexion, $consAutorPonencia);
      $fetchAutorPonencia = mysqli_fetch_assoc($resAutorPonencia);
      $autorPonencia = $fetchAutorPonencia['id_usuario_registra'];
//echo "<br>Llego aquí 2 ".$consAutorPonencia."<br>";


      if ($evaluador == $autorPonencia) { //si es diferente entonces se puede evaluar

        $errores['restriccion-error'] = "Fallo, un evaluador no se puede evaluar.";

      } else {
        //consulta el maximo de ponencias que tiene ese evaluador
        $consEvaluadorPonencias = "SELECT * FROM evaluador WHERE id_usuario='$evaluador'";
        $resEvaluadorPonencias = mysqli_query($conexion, $consEvaluadorPonencias);
        $fetchEvaluadorPonencia = mysqli_fetch_assoc($resEvaluadorPonencias);
        $numPonenciasEvaluador = $fetchEvaluadorPonencia['numero_ponencias'];

        $consPonenciasEvaluador = "SELECT COUNT(id_congreso) as total FROM ponencia WHERE id_usuario_evalua='$evaluador' AND id_congreso='$idCongreso' GROUP BY id_congreso";
        $resPonenciasEvaluador = mysqli_query($conexion, $consPonenciasEvaluador);
        $fetchPonenciasEvaluador = mysqli_fetch_assoc($resPonenciasEvaluador);
        $ponenciasEvaluador = $fetchPonenciasEvaluador['total'];
//echo "<br>Llego aquí 3 ".$consPonenciasEvaluador."<br>";
        if ($ponenciasEvaluador >= $numPonenciasEvaluador) {
          $errores['db-error'] = "Fallo este evaluador ya tiene asignadas todas sus ponencias.";
        } else {

          //hace la consulta y actualiza tabla ponencia
          $consActualizaEvaluador = "UPDATE ponencia  SET id_usuario_evalua='$evaluador' WHERE id_ponencia='$valor' AND id_congreso='$idCongreso'";
          $resActualizaEvaluador = mysqli_query($conexion, $consActualizaEvaluador);
//echo "<br>Llego aquí 4 ".$consActualizaEvaluador."<br>";
          if ($resActualizaEvaluador) {
            //Muestra si el registro fue exitoso y lo muestra en información.
            $info = "Se han actualizado los evaluadores, Se ha notificado a su correo electronico";
            $_SESSION['info'] = $info;

            $consEmailEvaluador = "SELECT * FROM usuario WHERE id_usuario = '$evaluador'";
            $resEmailEvaluador = mysqli_query($conexion, $consEmailEvaluador);
            $fetchEmailEvaluador = mysqli_fetch_assoc($resEmailEvaluador);
            $emailEvaluador = $fetchEmailEvaluador['email_usuario'];
            //require_once '../../librerias/PHPMailer/src/correoAsignacionEvaluador.php';



          } else {
            $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
          }
          //Fecha actual
          date_default_timezone_set('America/Mexico_City');
          $fechaActual = date('y-m-d G:i:s');
          //Inserta una nueva revisión con el estatus de EXTENSO
          //Genera id aleatorio de revision
          $numeroAleatorio = uniqid();

          $consIdRevisionPonencia = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$valor' AND id_congreso='$idCongreso'";
          $resIdRevisionPonencia = mysqli_query($conexion, $consIdRevisionPonencia);
//echo "<br>Llego aquí 5 ".$consIdRevisionPonencia."<br>";
          if (mysqli_num_rows($resIdRevisionPonencia) > 0) {
            $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                        INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                        WHERE usuario_revision_ponencia.id_ponencia='$valor' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
//echo "<br>Llego aquí 5.1 ".$consUsuarioRevisionPonencia."<br>";

            $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
            $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
            //Campos de la revision

            /*$estadoRevisionPonencia=$fetchUsuarioRevisionPonencia['estatus_revision'];
            $descripcionRevisionPonencia=$fetchUsuarioRevisionPonencia['descripcion_revision'];
            } else{
            $descripcionRevisionPonencia="RESUMEN";
                }
                */
            if (mysqli_num_rows($resUsuarioRevisionPonencia) > 0) {
              $estadoRevisionPonencia = $fetchUsuarioRevisionPonencia['estatus_revision'];
              $descripcionRevisionPonencia = $fetchUsuarioRevisionPonencia['descripcion_revision'];

            } else {
              $descripcionRevisionPonencia = "RESUMEN";
            }
          } else {


            $descripcionRevisionPonencia = "RESUMEN";

          }



          //Se genera el id a partir del Id de usuario, id ponencia y numero aleatorio
          //$idGenerado = $_SESSION['id'] ."-". $newIdPonencia ."-".$idCongreso."-". $numeroAleatorio;
          $idGenerado = $_SESSION['id'] ."-". $valor ."-".$idCongreso."-".$numeroAleatorio;


          $insertarRevisionExtenso = "INSERT INTO revision(id_revision,descripcion_revision,fecha_revision) VALUES ('$idGenerado','$descripcionRevisionPonencia','$fechaActual')";
//echo "<br>Llego aquí 6 ".$insertarRevisionExtenso."<br>";
          
          $resRevisionExtenso = mysqli_query($conexion, $insertarRevisionExtenso);
          //Se relaciona la revision con la ponencia
          
          $insertaRelacionRevision = "INSERT INTO usuario_revision_ponencia(id_usuario_evalua,id_ponencia,id_revision_ponencia,id_congreso) VALUES ('$evaluador','$valor','$idGenerado',$idCongreso)";
//echo "<br>Llego aquí 7 ".$insertaRelacionRevision."<br>";
          $resRelacionRevision = mysqli_query($conexion, $insertaRelacionRevision);
        }
      }
    }

  }

}

if (!empty($_POST["botonDesasignar"])) {
  $ponenciaID = $_POST["botonDesasignar"];
  $desEvaluador = "UPDATE ponencia SET id_usuario_evalua=NULL WHERE id_ponencia = '$ponenciaID' and id_congreso= '$idCongreso';";
  // Ejecutar la consulta SQL
  $resDesEvaluador = $conexion->query($desEvaluador);
}


?>