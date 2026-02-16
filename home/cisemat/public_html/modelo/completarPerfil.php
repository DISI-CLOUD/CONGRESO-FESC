<?php
    /** 
    * Este modulo realiza una comprobación del perfil, en caso de no haber subido la semblanza
    * completado la instutución, nivel acádemico, y la vigencia de la semblanza.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/  
    require "conexion.php";
    require "traerDatosPerfil.php";

    
    //Fecha actual
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('y-m-d G:i:s h:i:s');
    //Tiempo de expiracion de la semblanza en años
    $tiempoDeExpiracionSemblanza=2;
    //$estadoPrivilegio = array(); //Es un arreglo que guarda los estados del privilegio
    //$cont2=0; //Es para recorrer las posiciones del segundo arreglo

    $completarPerfil = "SELECT * FROM usuario 
    INNER JOIN semblanza ON usuario.id_usuario=semblanza.id_usuario
    INNER JOIN trayectoria_laboral ON usuario.id_trayectoria_laboral=trayectoria_laboral.id_trayectoria_laboral
    WHERE email_usuario ='$emailUsuario'";
    $resCompletarPerfil = mysqli_query($conexion, $completarPerfil);
    $fetchCompletarPerfil=mysqli_fetch_assoc($resCompletarPerfil);

    //Datos academicos
    $semblanza = $fetchCompletarPerfil['semblanza'];
    $fechaSemblanza = $fetchCompletarPerfil['fecha_actualizacion_semblanza'];
    $nivelAcademico = $fetchCompletarPerfil['id_nivel_academico'];
    //Datos laborales
    $institucionTrayectoriaLaboral = $fetchCompletarPerfil['id_institucion_trayectoria_laboral'];
    $estadoTrayectoriaLaboral = $fetchCompletarPerfil['id_pais_trayectoria_laboral'];
    $paisTrayectoriaLaboral = $fetchCompletarPerfil['id_estado_trayectoria_laboral'];
    $estadoUsuario = $fetchCompletarPerfil['estado_usuario'];

    //Verifica que la semblanza sea vigente
    $consVigenciaSemblanza = "SELECT TIMESTAMPDIFF(year,'$fechaSemblanza','$fechaActual') AS vigencia_semblanza;";
    $resVigenciaSemblanza = mysqli_query($conexion, $consVigenciaSemblanza);
    $fetchVigenciaSemblanza=mysqli_fetch_assoc($resVigenciaSemblanza);
    $tiempoSemblanza = $fetchVigenciaSemblanza['vigencia_semblanza'];

    if($estadoUsuario==''){
        if(!empty($semblanza) && !empty($nivelAcademico)){        
            //Actualiza el estado del usuario
            $consVerificarUsuario = "UPDATE usuario SET estado_usuario='B' WHERE id_usuario='$_SESSION[id]'";
            $resVerificarUsuario = mysqli_query($conexion, $consVerificarUsuario);
            //$fetchSubirPrivilegios = mysqli_fetch_assoc($resSubirPrivilegios);
        }
    }else{
        if($estadoUsuario!='B'){
            if($tiempoSemblanza>=$tiempoDeExpiracionSemblanza){
                //Actualiza los privilegios del usuario quitandole los privilegios
                for ($i=12; $i <=15 ; $i++) { 
                    $consSubirPrivilegios = "UPDATE funcion_usuario SET id_funcion='$i', estado_funcion='OFF' WHERE id_usuario='$_SESSION[id]' AND id_funcion='$i'";
                    $resSubirPrivilegios = mysqli_query($conexion, $consSubirPrivilegios);
                }
                
                //Actualiza el estado del usuario
                $consVerificarUsuario = "UPDATE usuario SET estado_usuario='I' WHERE id_usuario='$_SESSION[id]'";
                $resVerificarUsuario = mysqli_query($conexion, $consVerificarUsuario);
                //$fetchSubirPrivilegios = mysqli_fetch_assoc($resSubirPrivilegios);
            }else{
                //Actualiza los privilegios del usuario
                for ($i=12; $i <=15 ; $i++) { 
                    $consSubirPrivilegios = "UPDATE funcion_usuario SET id_funcion='$i', estado_funcion='ON' WHERE id_usuario='$_SESSION[id]' AND id_funcion='$i'";
                    $resSubirPrivilegios = mysqli_query($conexion, $consSubirPrivilegios);
                }
                
                //Actualiza el estado del usuario
                $consVerificarUsuario = "UPDATE usuario SET estado_usuario='A' WHERE id_usuario='$_SESSION[id]'";
                $resVerificarUsuario = mysqli_query($conexion, $consVerificarUsuario);
                
               /* $consPrivilegiosEstado="SELECT * FROM funcion_usuario WHERE id_usuario='$_SESSION[id]'";
                $resPrivilegiosEstado = mysqli_query($conexion,$consPrivilegiosEstado);
                while($row2=mysqli_fetch_array($resPrivilegiosEstado)){
                    $estadoPrivilegio[$cont2]=$row2['estado_funcion'];
                    $cont2++;
                }
                $_SESSION['estadoPrivilegio']=$estadoPrivilegio;*/
                //$fetchSubirPrivilegios = mysqli_fetch_assoc($resSubirPrivilegios);
            }
        }else{
            if(!empty($semblanza) && !empty($nivelAcademico) && !empty($institucionTrayectoriaLaboral) && !empty($estadoTrayectoriaLaboral)  && !empty($paisTrayectoriaLaboral) ){
                //Actualiza los privilegios del usuario
                for ($i=12; $i <=15 ; $i++) { 
                    $consSubirPrivilegios = "UPDATE funcion_usuario SET id_funcion='$i', estado_funcion='ON' WHERE id_usuario='$_SESSION[id]' AND id_funcion='$i'";
                    $resSubirPrivilegios = mysqli_query($conexion, $consSubirPrivilegios);
                }
                
                //Actualiza el estado del usuario
                $consVerificarUsuario = "UPDATE usuario SET estado_usuario='A' WHERE id_usuario='$_SESSION[id]'";
                $resVerificarUsuario = mysqli_query($conexion, $consVerificarUsuario);
                //$fetchSubirPrivilegios = mysqli_fetch_assoc($resSubirPrivilegios);
            }
        }
        
    }


?>