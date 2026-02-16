<?php
    /** 
    * Este modulo realiza la evaluación de los resumenes de todos los trabajos, solo comentario
    * general.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/  
    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    $_SESSION['info']="";

    unset($_SESSION['info']);
    $idPonencia=$_GET["id"];
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('y-m-d G:i:s');

    //Verificacion de la revision más actual.

    $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
    INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
    WHERE usuario_revision_ponencia.id_ponencia='$idPonencia')";
    $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
    $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
    $estatusRevision=$fetchUsuarioRevisionPonencia['estatus_revision'];
        
    //Trae los datos del autor y coautores de la ponencia
    require '../../modelo/traerDatosAutoresYCoautores.php';

    // Taer correo del evaluador para correo de evaluacion
    $idEvaluador = $_SESSION["id"];
    $queryCorreoEvaluador = "SELECT * FROM usuario WHERE id_usuario = $idEvaluador";
    $resqueryCorreoEvaluador = mysqli_query($conexion, $queryCorreoEvaluador);
    $fetchCorreoEvaluador = mysqli_fetch_assoc($resqueryCorreoEvaluador);
    $correoEvaluador = $fetchCorreoEvaluador['email_usuario'];

    if(empty($estatusRevision)){
        if(isset($_POST['aprobar'])){
            //Campos de la revision
            $comentarioGeneral=mysqli_real_escape_string($conexion,$_POST["comentarioGeneral"]);
            $idRevision=$fetchUsuarioRevisionPonencia['id_revision'];

            // Comentar las siguientes 2 variables para pruebas
            $updRevision="UPDATE revision SET fecha_revision='$fechaActual', estatus_revision='A', descripcion_general_revision='$comentarioGeneral' WHERE id_revision='$idRevision'";
            $resRevision=mysqli_query($conexion,$updRevision);

            $tipoTrabajoEvaluado = substr($idPonencia, 3, 2);
            $confirmacionCorreo = '';

            if($tipoTrabajoEvaluado == 'CA'){
                require_once ('../../cartas/cartaCartelAprobado.php');
                $confirmacionCorreo = 'ON';
            } 
            
            if($tipoTrabajoEvaluado == 'TA'){
                require_once ('../../cartas/cartaTallerAprobado.php');
                $confirmacionCorreo = 'ON';
            } 

            if($tipoTrabajoEvaluado == 'PO'){
                require_once ('../../cartas/cartaResumenPonenciaAprobado.php');
                $confirmacionCorreo = 'ON';
            }

            if($confirmacionCorreo == 'ON'){
                $evaluacionResumen = 'APROBADO';
                require_once ('../../librerias/PHPMailer/src/correoAceptacionResumen.php');
                $info = "Se ha evaluado el RESUMEN con estatus de APROBADO. Se ha enviado un correo electrónico al autor del trabajo.";
                $_SESSION['info'] = $info;
            } else {
                $info = "Error al evaluar el trabajo. Comunicate con el administrador a través del correo del congreso.";
                $_SESSION['info'] = $info;
            }
          
            ?>

        <script>
            setTimeout(function() {
                alert("Se ha evaluado el RESUMEN con estatus de APROBADO. Se ha enviado un correo electrónico al autor del trabajo.");
                window.location.href = '../../components/TrabajosAsignados/trabajosAsignados.php';
            }, 0);
        </script>

            <?php
            

             require_once ('../../cartas/cartaResumenPonenciaAprobado.php');
             require_once ('../../librerias/PHPMailer/src/correoAceptacionResumen.php');

            // $info = "Se ha evaluado el RESUMEN con estatus de APROBADO. Se ha enviado un correo electrónico al autor del trabajo.";
             //$_SESSION['info'] = $info;

        
        }
        
        if(isset($_POST['rechazar'])){
            $comentarioGeneral=mysqli_real_escape_string($conexion,$_POST["comentarioGeneral"]);
            //Campos de la revision
            $idRevision=$fetchUsuarioRevisionPonencia['id_revision'];
            // Comentar las siguientes 2 variables para pruebas
            $updRevision="UPDATE revision SET fecha_revision='$fechaActual', estatus_revision='R', descripcion_general_revision='$comentarioGeneral' WHERE id_revision='$idRevision'";
            $resRevision=mysqli_query($conexion,$updRevision);

            require_once ('../../cartas/cartaRechazoResumen.php');
            $evaluacionResumen = 'RECHAZADO';
            require_once ('../../librerias/PHPMailer/src/correoRechazoResumen.php');
            
            $info = "Se ha evaluado el RESUMEN con estatus de RECHAZADO. Se ha enviado un correo electrónico al autor del trabajo.";
            $_SESSION['info'] = $info;

            ?>

            <script>
                setTimeout(function() {
                    alert("Se ha evaluado el RESUMEN con estatus de RECHAZADO. Se ha enviado un correo electrónico al autor del trabajo.");
                    window.location.href = '../../components/TrabajosAsignados/trabajosAsignados.php';
                }, 0);
            </script>

            <?php
        }    
    }else{
        $info = '';
        $_SESSION['info'] = $info;
        $errores['db-error'] = "Ya has evaluado esta ponencia. No puedes volver a evaluarla.";
    }



?>