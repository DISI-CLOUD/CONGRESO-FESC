<?php
    /** 
    * Este modulo realiza la modificación del resumen, cuando aún no tiene evaluador asignado, y 
    * cuando el resumen ha sido rechazado.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    
    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    $_SESSION['info']=""; //Muestra la informacion exitosa y los muestra
    //$coautores=array();

    //Fecha actual
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('y-m-d G:i:s');

    //Trae los datos del usuario
    $datosAutor = "SELECT * FROM usuario WHERE id_usuario='$_SESSION[id]'";
    $res = mysqli_query($conexion, $datosAutor);
    $fetch = mysqli_fetch_assoc($res);

    //Trae los datos de las categorias
    $categorias = "SELECT * FROM categoria";
    $res2 = mysqli_query($conexion, $categorias);

    //Trae los datos de los coautores
    $cCoautores = "SELECT id_usuario, nombres_usuario, rfc_usuario FROM usuario";
    $res3 = mysqli_query($conexion, $cCoautores);

    //Id de la ponencia
    $idPonencia=$_GET['id'];

    //Estado de la revisión por defecto
    $estatusRevision='';

    $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
    INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
    WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
    $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
    $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);

    if(mysqli_num_rows($resUsuarioRevisionPonencia)>0){
        $estatusRevision=$fetchUsuarioRevisionPonencia['estatus_revision'];
    }

    if(($estatusRevision=='R' || mysqli_num_rows($resUsuarioRevisionPonencia)==0)){
        if(isset($_POST['botonGuardar'])){
            //Trae los datos especificos de la ponencia
            $consPonencia = "SELECT * FROM ponencia WHERE id_ponencia='$idPonencia'";
            $resPonencia = mysqli_query($conexion, $consPonencia);
            $fetchPonencia=mysqli_fetch_assoc($resPonencia);
            //Datos anteriores de la ponencia
            $oldTituloPonencia=$fetchPonencia['titulo_ponencia'];
            $oldResumenPonencia=$fetchPonencia['resumen_ponencia'];
            $oldReferenciaPonencia=$fetchPonencia['referencia_ponencia'];
            $oldCategoriaPonencia=$fetchPonencia['id_categoria'];
            $idUsuarioEvalua=$fetchPonencia['id_usuario_evalua'];
            
            if($_POST['titulo']!=$oldTituloPonencia || $_POST['resumen']!=$oldResumenPonencia || $_POST['referencia']!=$oldReferenciaPonencia || $_POST['categoria']!=$oldCategoriaPonencia){
                $newTituloPonencia=mysqli_real_escape_string($conexion,$_POST['titulo']);
                $newResumenPonencia=mysqli_real_escape_string($conexion,$_POST['resumen']);
                $newReferenciaPonencia=mysqli_real_escape_string($conexion,$_POST['referencia']);
                $newCategoriaPonencia=mysqli_real_escape_string($conexion,$_POST['categoria']);
                //Actualiza la ponencia
                $actualizarPonencia = "UPDATE ponencia SET titulo_ponencia='$newTituloPonencia',resumen_ponencia='$newResumenPonencia',referencia_ponencia='$newReferenciaPonencia',id_categoria='$newCategoriaPonencia' WHERE id_ponencia='$idPonencia' and id_congreso='$idCongreso'";
                $data_check = mysqli_query($conexion, $actualizarPonencia);
            
                if($data_check){
                    //Crea una nueva revision para volver a estar en estatus de evaluacion
                    if($idUsuarioEvalua!=''){
                        //Inserta una nueva revisión con el estatus de EXTENSO
                        //Genera id aleatorio de revision
                        $numeroAleatorio=uniqid();
                        
                        //Se genera el id a partir del Id de usuario, id ponencia y numero aleatorio
                        $idGenerado = $_SESSION['id'] ."-". $idPonencia."-".$idCongreso."-"$numeroAleatorio;
                      //$idGenerado = $_SESSION['id'] ."-". $newIdPonencia."-".$idCongreso."-".$numeroAleatorio;
                       
                        $insertarRevisionResumen = "INSERT INTO revision(id_revision,descripcion_revision,fecha_revision) VALUES ('$idGenerado','RESUMEN','$fechaActual')";
                        $resRevisionResumen = mysqli_query($conexion, $insertarRevisionResumen);
                        if($resRevisionResumen){
                            $info = "Se ha.";
                            $_SESSION['info'] = $info;
                        }else{
                            $errores['db-error'] = "fallo la creeacion.";
                        }

                        //Se relaciona la revision con la ponencia
                        $insertaRelacionRevision = "INSERT INTO usuario_revision_ponencia(id_usuario_evalua,id_ponencia,id_revision_ponencia) VALUES ('$idUsuarioEvalua','$idPonencia','$idGenerado')";
                        $resRelacionRevision= mysqli_query($conexion, $insertaRelacionRevision); 
                    }           
                    //Muestra si el registro fue exitoso y lo muestra en información.
                    $info = "Se han actualizado los datos de la ponencia. Se ha enviado un correo electrónico al autor y al evaluador para su revisión.";
                    $_SESSION['info'] = $info;
                }else{
                    $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                }

            }else{
                $errores['actualizar-datos-general'] = "¡No has cambiado ningún dato!";
            }
        }
    }else{
        $info = '';
        $_SESSION['info'] = $info;
        $errores['db-error'] = "Ya has editado esta ponencia. No puedes volver a editarla.";
    }



?>