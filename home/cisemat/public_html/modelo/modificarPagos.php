<?php

require "conexion.php";

$errores = array(); //Es un arreglo que guarda todos los errores y los muestra
$_SESSION['info']=""; //Muestra la informacion exitosa y los muestra
    

    if(!empty($_POST["validarPago"])){
        $tipoAsistencia=$_POST['asistencia'];
        if( isset($_POST['checkbox'])){
            foreach($_POST['checkbox'] as $valor){
                //$consComparar="SELECT * FROM pago WHERE id_pago='$valor'";
                $consComparar="SELECT * FROM pago inner join usuario u on pago.id_usuario =u.id_usuario  WHERE id_pago='$valor'";

                $resComparar=mysqli_query($conexion,$consComparar);
                $fetchComparar=mysqli_fetch_assoc($resComparar);
                $idFila=$fetchComparar['id_tipo_asistencia'];
                $estatus=$fetchComparar['estatus_pago'];
                $email_usuario=$fetchComparar['email_usuario'];

                if($estatus=='APROBADO'){
                    $errores['info']="El pago ya se encuentra validado";
                }
                else{

                    if($idFila==$tipoAsistencia){
                    
                        $consActualizaPago="UPDATE pago  SET estatus_pago='APROBADO' WHERE id_pago='$valor'";
                        $resActualizaPago = mysqli_query($conexion, $consActualizaPago);

                        if($resActualizaPago){
                            //notificamos por email la aprobacion del pago 
                            require_once "../../librerias/PHPMailer/src/correoRegistroPago.php";

                            //Muestra si el registro fue exitoso y lo muestra en información.
                            $info = "¡Se ha aprobado el pago con exito!";
                            $_SESSION['info'] = $info;
                        
                        }else{
                            $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
                        }
                    }
                    else{
                    $errores['info']="Por favor valida que el pago corresponda con el tipo de asistencia seleccionado.";
                    } 
                }                
            }
       }
    } 

    if(!empty($_POST["contactarUsuario"])){
        if(isset($_POST['checkbox'])){
            foreach($_POST['checkbox'] as $valor){
                $consComparar="SELECT * FROM pago WHERE id_pago='$valor'";
                $resComparar=mysqli_query($conexion,$consComparar);
                $fetchComparar=mysqli_fetch_assoc($resComparar);
                $id_usuario=$fetchComparar['id_usuario'];

                $consContacto="SELECT * FROM usuario WHERE id_usuario='$id_usuario'";
                $resContacto=mysqli_query($conexion,$consContacto);
                $fetchContacto=mysqli_fetch_assoc($resContacto);
                $contactoNombres=$fetchContacto['nombres_usuario'];
                $contactoApellidos=$fetchContacto['apellidos_usuario'];
                $contactoEmail=$fetchContacto['email_usuario'];

                if($resContacto){
                    //Muestra si el registro fue exitoso y lo muestra en información.
                    $info = "Contacto de {$contactoNombres} {$contactoApellidos}, email {$contactoEmail}";
                    $_SESSION['info'] = $info;
                
                }else{
                    $errores['db-error'] = "Fallo mientras se consultaba en base de datos";
                }
            }
        }
    }

    if (!empty($_POST["rechazarPago"])) {
        if (isset($_POST['checkbox'])) {
            foreach ($_POST['checkbox'] as $valor) {
                //$consComparar = "SELECT * FROM pago WHERE id_pago='$valor'";
                $consComparar="SELECT * FROM pago inner join usuario u on pago.id_usuario =u.id_usuario  WHERE id_pago='$valor'";    

                $resComparar = mysqli_query($conexion, $consComparar);
                $fetchComparar = mysqli_fetch_assoc($resComparar);
                
                // Obtener el estado actual del pago
                $estatus = $fetchComparar['estatus_pago'];
                $email_usuario=$fetchComparar['email_usuario'];
                
                if ($estatus == 'RECHAZADO') {
                    $errores['info'] = "El pago ya se encuentra rechazado";
                } else {
                    $consActualizaPago = "UPDATE pago SET estatus_pago='RECHAZADO' WHERE id_pago='$valor'";
                    $resActualizaPago = mysqli_query($conexion, $consActualizaPago);
    
                    if ($resActualizaPago) {
                        //enviamos un email al usuario con la notificacion del rechazo del pago  
                        require_once "../../librerias/PHPMailer/src/correoRechazoPago.php";
                        
                        $info = "¡Se ha rechazado el pago con éxito!";
                        $_SESSION['info'] = $info;
                    } else {
                        $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
                    }
                }
            }
        }
    }
    



?>
