<?php
    /** 
    * Este modulo realiza la actualización de los datos academicos, el nivel acádemico y la semblanza
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com, Alison Rubio, Marina Sanches.
    **/  
    require "conexion.php";

    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    $_SESSION['info']=""; //Muestra la informacion exitosa y los muestra

    require "completarPerfil.php";



    if(!empty($_POST['botonGuardarDatosAcademicos'])){
        //Si no hay errores ejecuta el registro.
        $nivelAcademico = $_POST["selectNivelAcademico"];
        if(count($errores) === 0){
            $actualizarUsuario = "UPDATE usuario SET id_nivel_academico='$nivelAcademico' WHERE id_usuario='$_SESSION[id]'";
            $data_check = mysqli_query($conexion, $actualizarUsuario);
            if($data_check){
                //Muestra si el registro fue exitoso y lo muestra en información.
                $info = "Se han actualizado tus datos academicos.";
                $_SESSION['info'] = $info;
                //Vuelve a traer los datos del usuario para mostrarlos en el formulario
                include("../../modelo/traerDatosAcademicos.php");
                require "completarPerfil.php";
                require "completarPerfil.php";
                if($estadoUsuario=='B'){
                    print "<script>window.location='../../components/DatosLaborales/laborales.php';</script>";
                }
            }else{
                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
            }
        }
    }

    if (!empty($_POST['subirSemblanza'])) {
        if(!empty($_FILES['inputSemblanza']['name'])){
            $tamanio = 10000;
            if(mime_content_type($_FILES['inputSemblanza']['tmp_name']) == 'application/pdf'){
            //Rutas
            $ruta="../../src/semblanza/";
            $fichero=$ruta.basename($_FILES["inputSemblanza"]["name"]);
            //Mueve el fichero al servidor
            $rutaSemblanza=$ruta."semblanza_perfil_usuario_".$_SESSION["id"]. $_FILES['inputSemblanza']['name'];
                if( $_FILES['inputSemblanza']['size'] < ($tamanio * 1024) ){
                   // move_uploaded_file( $_FILES['inputSemblanza']['tmp_name'], $rutaSemblanza . $_FILES['inputSemblanza']['name']);
                     move_uploaded_file( $_FILES['inputSemblanza']['tmp_name'], $rutaSemblanza);
                    $info = "Se han actualizado tus datos academicos.";
                    $_SESSION['info'] = $info;
                //consulta los datos tabla usuario sacar id y pasarlo a tabla semblanza e igual la fecha y hora
                    if(count($errores) === 0){
                        date_default_timezone_set('America/Mexico_City');
                        $fechaActual = date('y-m-d G:i:s');
                        $consultaIdUsuario = "SELECT * FROM usuario WHERE id_usuario = '$idUsuario'";
                        $consultaIdUsuarioRes = mysqli_query($conexion, $consultaIdUsuario);
                        $fetchUsuario = mysqli_fetch_assoc($consultaIdUsuarioRes); 
                        $idUsuario=$fetchUsuario['id_usuario'];
                        $actualizarSemblanza = "UPDATE semblanza SET semblanza='$rutaSemblanza', fecha_actualizacion_semblanza='$fechaActual' WHERE id_usuario='$_SESSION[id]'";
                        $data_check = mysqli_query($conexion, $actualizarSemblanza);
                        if($data_check){
                            $info = "Se han actualizado tus datos academicos.";
                            $_SESSION['info'] = $info;
                        }
                         
                        require "completarPerfil.php";
                        require "completarPerfil.php";
                        if($estadoUsuario=='A'){
                            print "<script>window.location='../../components/DatosAcademicos/academicos.php';</script>";
                        }
                        if($estadoUsuario=='B'){
                            print "<script>window.location='../../components/DatosLaborales/laborales.php';</script>";
                        }
                    }                         
                }
                else{
                
                    $errores['db-error'] = "Error al subir el documento peso superior al permitido !.";
                }

            }else if(isset($_FILES['inputSemblanza']) && mime_content_type($_FILES['inputSemblanza']['tmp_name']) != 'application/pdf'){
                $errores['db-error'] ="Solo se admiten documentos PDF";
                
            }
        }else{
            $errores['user-error'] = "Debes elegir un archivo.";
        }
    
    }

    






?>