<?php
/** 
*******************************************************************************************************
* Apartado asignar maximo de ponencias a un evaluador
* Cualquier duda o sugerencia:
* @author Alison Michelle Rubio Garcia allyssonrg@gmail.com
*******************************************************************************************************
**/ 


require "conexion.php";

if(!empty($_POST["configurarMaximo"])){
    
    $evaluador=$_POST['selectEvaluador'];
    $nMaxAsignaciones=$_POST['numAsignaciones'];
   

            //sin marcar errores 
            if(count($errores) === 0){
            $consEvaluadores ="SELECT * FROM evaluador WHERE id_usuario='$evaluador'";
            $resEvaluadores= mysqli_query($conexion,$consEvaluadores);
            if($fetchEvaluadores=mysqli_num_rows($resEvaluadores)>0){

                $actualizaAsignacion1 = "UPDATE evaluador SET numero_ponencias='$nMaxAsignaciones'  WHERE  id_usuario='$evaluador'";
                $consActualizaAsignacion1 = mysqli_query($conexion, $actualizaAsignacion1);
                $info = "Se ha actualizado el numero de ponencias del evaluador.";
                $_SESSION['info'] = $info;
            }
            else{
                    $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la base.";
                }
            }
    }






?>