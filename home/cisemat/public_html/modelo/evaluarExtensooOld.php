<?php 
    /** 
    * Este modulo realiza la evaluación de los trabajos en extenso, contempla la rubrica y comentario
    * general.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/  
    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    $_SESSION['info']="";
    unset($_SESSION['info']);
    $idPonencia=$_GET["id"];
    $punto1="";
    $punto2="";
    $punto3="";
    $punto4="";
    $punto5="";
    $punto6="";
    $punto7="";
    $punto8="";
    $punto9="";
    //Comentarios
    $comentarioGeneral="";
    $comentarioGeneral="";
    $comentarioPunto1="";
    $comentarioPunto2="";
    $comentarioPunto3="";
    $comentarioPunto4="";
    $comentarioPunto5="";
    $comentarioPunto6="";
    $comentarioPunto7="";
    $comentarioPunto8="";
    $comentarioPunto9="";
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('y-m-d G:i:s');

    //En caso de que rellene todos los radio buttons
    //Verificacion de la revision más actual.
    $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
    INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
    WHERE usuario_revision_ponencia.id_ponencia='$idPonencia')";        
    $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
    $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
    //Campos de la revision
    $estatusRevision=$fetchUsuarioRevisionPonencia['estatus_revision'];
    $descripcionRevision=$fetchUsuarioRevisionPonencia['descripcion_revision'];
    require '../../modelo/traerDatosAutoresYCoautores.php';
    

    if($estatusRevision=='' || $estatusRevision=='F'){
        if(isset($_POST["finalizarEvaluacion"])){
            //Captura los comentarios
            $comentarioPunto1=mysqli_real_escape_string($conexion,$_POST["comentarioPunto1"]);
            $comentarioPunto2=mysqli_real_escape_string($conexion,$_POST["comentarioPunto2"]);
            $comentarioPunto3=mysqli_real_escape_string($conexion,$_POST["comentarioPunto3"]);
            $comentarioPunto4=mysqli_real_escape_string($conexion,$_POST["comentarioPunto4"]);
            $comentarioPunto5=mysqli_real_escape_string($conexion,$_POST["comentarioPunto5"]);
            $comentarioPunto6=mysqli_real_escape_string($conexion,$_POST["comentarioPunto6"]);
            $comentarioPunto7=mysqli_real_escape_string($conexion,$_POST["comentarioPunto7"]);
            $comentarioPunto8=mysqli_real_escape_string($conexion,$_POST["comentarioPunto8"]);
            $comentarioPunto9=mysqli_real_escape_string($conexion,$_POST["comentarioPunto9"]);
        
        
            //Captura todos los datos de la rubrica del 1 al 9
            if(!empty($_POST["Option1"])){
                $punto1=$_POST["Option1"];
            }
            if(!empty($_POST["Option2"])){
                $punto2=$_POST["Option2"];
            }
            if(!empty($_POST["Option3"])){
                $punto3=$_POST["Option3"];
            }
            if(!empty($_POST["Option4"])){
                $punto4=$_POST["Option4"];
            }
            if(!empty($_POST["Option5"])){
                $punto5=$_POST["Option5"];
            }
            if(!empty($_POST["Option6"])){
                $punto6=$_POST["Option6"];
            }
            if(!empty($_POST["Option7"])){
                $punto7=$_POST["Option7"];
            }
            if(!empty($_POST["Option8"])){
                $punto8=$_POST["Option8"];
            }
            if(!empty($_POST["Option9"])){
                $punto9=$_POST["Option9"];
            }
        
            $comentarioGeneral=mysqli_real_escape_string($conexion,$_POST["comentarioGeneral"]);
            if($punto1=='' || $punto2=='' || $punto3=='' || $punto4=='' || $punto5=='' || $punto6=='' || $punto7=='' || $punto8=='' || $punto9==''){
                $errores['sistema-error'] = "Debes evaluar todos los puntos.";
            }else{
                //En caso de que rellene todos los radio buttons        
                //Crea la rubrica punto evaluar
                $consRubrica1="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','1','$punto1','$comentarioPunto1')";
                $resRubrica1=mysqli_query($conexion,$consRubrica1);
                $consRubrica2="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','2','$punto2','$comentarioPunto2')";
                $resRubrica2=mysqli_query($conexion,$consRubrica2);
                $consRubrica3="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','3','$punto3','$comentarioPunto3')";
                $resRubrica3=mysqli_query($conexion,$consRubrica3);
                $consRubrica4="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','4','$punto4','$comentarioPunto4')";
                $resRubrica5=mysqli_query($conexion,$consRubrica4);
                $consRubrica5="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','5','$punto5','$comentarioPunto5')";
                $resRubrica5=mysqli_query($conexion,$consRubrica5);
                $consRubrica6="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','6','$punto6','$comentarioPunto6')";
                $resRubrica6=mysqli_query($conexion,$consRubrica6);
                $consRubrica7="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','7','$punto7','$comentarioPunto7')";
                $resRubrica7=mysqli_query($conexion,$consRubrica7);
                $consRubrica8="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','8','$punto8','$comentarioPunto8')";
                $resRubrica8=mysqli_query($conexion,$consRubrica8);
                $consRubrica9="INSERT INTO revision_punto_evaluar(id_revision, id_punto_evaluar, estado_punto_evaluar, comentario_punto_evaluar) VALUES ('$idRevision','9','$punto9','$comentarioPunto9')";
                $resRubrica9=mysqli_query($conexion,$consRubrica9);
                //Verificacion de la revision más actual.
                $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia')";        
                $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);
                //Campos de la revision
                $estatusRevision=$fetchUsuarioRevisionPonencia['estatus_revision'];
                $descripcionRevision=$fetchUsuarioRevisionPonencia['descripcion_revision'];
                //require '../../modelo/traerDatosAutoresYCoautores.php';
                //Si algun punto es no
                if($punto1=='NO' || $punto2=='NO' || $punto3=='NO' || $punto4=='NO' || $punto5=='NO' || $punto6=='NO' || $punto7=='NO' || $punto8=='NO' || $punto9=='NO'){
                    //Si evalua por primera vez y es rechazado
                    if($estatusRevision=='' && $descripcionRevision=='EXTENSO'){
                        //CAMBIAR EL ID POR EL DE LOS PRIVILEGIOS
                        //Cambia el estatus del trabajo
                        $cambiarEstadoRevision="UPDATE revision SET fecha_revision='$fechaActual', estatus_revision='R', descripcion_general_revision='$comentarioGeneral' WHERE id_revision='$idRevision'";
                        $rescambiarEstadoRevision=mysqli_query($conexion,$cambiarEstadoRevision);
                        //Si algun punto es no
                        $info = "Se ha evaluado el EXTENSO con estatus de RECHAZADO. Se ha notificado al AUTOR para la correción correspondiente.";
                    }  
                    //Si es evaluado por el Evaluador final y es rechazado
                    if(($estatusRevision=='F' || $estatusRevision=='FR' || $estatusRevision=='') && $descripcionRevision=='EXTENSO REVISION FINAL' ){
                        //CAMBIAR EL ID POR EL DE LOS PRIVILEGIOS
                        //Cambia el estatus del trabajo
                        $cambiarEstadoRevision="UPDATE revision SET fecha_revision='$fechaActual', estatus_revision='FR', descripcion_general_revision='$comentarioGeneral' WHERE id_revision='$idRevision'";
                        $rescambiarEstadoRevision=mysqli_query($conexion,$cambiarEstadoRevision);
                        //Si algun punto es no
                        $info = "Se ha evaluado el EXTENSO por el EVALUADOR FINAL con estatus de RECHAZADO. Se ha notificado al AUTOR para la correción correspondiente.";
                    }                                       
                }else{
                    //Si evalua por primera vez y es ACEPTADO
                    if(($estatusRevision=='NULL' && $descripcionRevision=='EXTENSO') ){
                        //CAMBIAR EL ID POR EL DE LOS PRIVILEGIOS
                        //Cambia el estatus del trabajo
                        $cambiarEstadoRevision="UPDATE revision SET fecha_revision='$fechaActual', estatus_revision='F',descripcion_revision='EXTENSO REVISION FINAL', descripcion_general_revision='$comentarioGeneral' WHERE id_revision='$idRevision'";
                        $rescambiarEstadoRevision=mysqli_query($conexion,$cambiarEstadoRevision);
                        //Si algun punto es no
                        $info = "Se ha evaluado el EXTENSO con estatus de APROBADO. Se ha ENVIADO AL EVALUADOR FINAL para su ULTIMA REVISION, se ha notificado al AUTOR.";
                    }  
                    //Si es evaluado por el Evaluador final y es ACEPTADO
                    if($estatusRevision=='F' && $descripcionRevision=='EXTENSO REVISION FINAL'){
                        //CAMBIAR EL ID POR EL DE LOS PRIVILEGIOS
                        //Cambia el estatus del trabajo
                        $cambiarEstadoRevision="UPDATE revision SET fecha_revision='$fechaActual', estatus_revision='A', descripcion_general_revision='$comentarioGeneral' WHERE id_revision='$idRevision'";
                        $rescambiarEstadoRevision=mysqli_query($conexion,$cambiarEstadoRevision);
                        //Si algun punto es no
                        $info = "Se ha evaluado el EXTENSO por el EVALUADOR FINAL con estatus de APROBADO. Se ha notificado al AUTOR para la correción correspondiente.";
                    }  
                    
                    $info = "Se ha evaluado el EXTENSO con estatus de APROBADO. Se ha enviado un correo electrónico al autor del trabajo.";
                    require_once ('../../cartas/cartaExtensoAprobado.php');
                    require_once ('../../librerias/PHPMailer/src/correoAprobacionExtenso.php');
                    
                }
                $info="PROBELMMAS";
                $_SESSION['info'] = $info;
        
            }
        
        }
    }else{
        $info = '';
        $_SESSION['info'] = $info;
        $errores['db-error'] = "Ya has evaluado esta ponencia. No puedes volver a evaluarla.";
    }



?>