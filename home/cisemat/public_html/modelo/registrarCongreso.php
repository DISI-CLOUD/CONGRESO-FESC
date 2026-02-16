<?php
    /** 
    * Este modulo realiza la creación / modificación del congreso y sus fechas.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/ 
    require "conexion.php";
    require "traerCongresoActual.php";

    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    $_SESSION['info']=''; //Muestra la informacion exitosa y los muestra

    if(isset($_POST["botonGuardarNuevoCongreso"])){

        $fecha1Inicio=$_POST['fecha1Inicio'];
        $fecha1Fin=$_POST['fecha1Fin'];

        $fecha2Inicio=$_POST['fecha2Inicio'];
        $fecha2Fin=$_POST['fecha2Fin'];

        $fecha3Inicio=$_POST['fecha3Inicio'];
        $fecha3Fin=$_POST['fecha3Fin'];

        $fecha4Inicio=$_POST['fecha4Inicio'];
        $fecha4Fin=$_POST['fecha4Fin'];

        $fecha5Inicio=$_POST['fecha5Inicio'];
        $fecha5Fin=$_POST['fecha5Fin'];
        
        $fecha6Inicio=$_POST['fecha6Inicio'];
        $fecha6Fin=$_POST['fecha6Fin'];

        $fecha7Inicio=$_POST['fecha7Inicio'];
        $fecha7Fin=$_POST['fecha7Fin'];

        $fecha8Inicio=$_POST['fecha8Inicio'];
        $fecha8Fin=$_POST['fecha8Fin'];

        $fecha9Inicio=$_POST['fecha9Inicio'];
        $fecha9Fin=$_POST['fecha9Fin'];

        $fecha10Inicio=$_POST['fecha10Inicio'];
        $fecha10Fin=$_POST['fecha10Fin'];

        $fecha11Inicio=$_POST['fecha11Inicio'];
        $fecha11Fin=$_POST['fecha11Fin'];

        $fecha12Inicio=$_POST['fecha12Inicio'];
        $fecha12Fin=$_POST['fecha12Fin'];

        $fecha13Inicio=$_POST['fecha13Inicio'];
        $fecha13Fin=$_POST['fecha13Fin'];

        $fecha14Inicio=$_POST['fecha14Inicio'];
        $fecha14Fin=$_POST['fecha14Fin'];
        
        $fecha15Inicio=$_POST['fecha15Inicio'];
        $fecha15Fin=$_POST['fecha15Fin'];

        $modalidadCongreso=mysqli_real_escape_string($conexion,$_POST['modalidadCongreso']);
        $emailCongreso=mysqli_real_escape_string($conexion,$_POST['inputMail']);

        // Encriptamiento de la contraseña del congreso (PENDIENTE)
        // $passCongreso=mysqli_real_escape_string($conexion,$_POST['inputPass']);
        // $encpassCon = password_hash($passCongreso, PASSWORD_BCRYPT);
        $encpassCon = mysqli_real_escape_string($conexion,$_POST['inputPass']);

        // $logo=$_FILES['inputLogo'];

        if($fecha1Inicio==''    || $fecha2Inicio==''    || $fecha3Inicio==''    || $fecha4Inicio==''    || $fecha5Inicio==''    || $fecha6Inicio==''    || $fecha7Inicio==''    || $fecha8Inicio==''    || $fecha9Inicio==''    || $fecha10Inicio==''   || $fecha11Inicio==''  || $fecha12Inicio=='' || $fecha13Inicio==''    || $fecha14Inicio==''   || $fecha15Inicio==''
        || $fecha1Fin==''   || $fecha2Fin==''  || $fecha3Fin=='' || $fecha4Fin==''    || $fecha5Fin==''   || $fecha6Fin==''  || $fecha7Fin=='' || $fecha8Fin==''    || $fecha9Fin==''   || $fecha10Fin=='' || $fecha11Fin==''   || $fecha12Fin=='' || $fecha13Fin==''   || $fecha14Fin=='' || $fecha15Fin==''
        || $modalidadCongreso=='' || $emailCongreso=='' || $encpassCon==''){
            // $logo=='' ||
            $errores['db-error'] = "Debes rellenar todos los campos.";
            //$_SESSION['error'] =$errores['db-error'];
        }else{
            //Saca el id nuevo del congreso
            require "traerCongresoActual.php";
            //Inserta el congreso
            $newIdCongreso=$idCongreso+1;
            //Se sube  el logo del congresos
            // $tamanio = 10000;
            // if(isset($_FILES['inputLogo']) && ($_FILES['inputLogo']['type'] == 'image/jpg' || $_FILES['inputLogo']['type'] == 'image/jpeg')){
            // //Rutas
            // $ruta="../../src/logos_congresos/";
            // $fichero=$ruta.basename($_FILES["inputLogo"]["name"]);
            // //Mueve el fichero al servidor
            // $rutaLogo=$ruta."_logo_".$newIdCongreso."_".$_FILES['inputLogo']['name'];
            //     if( $_FILES['inputLogo']['size'] < ($tamanio * 1024) ){
            //         move_uploaded_file( $_FILES['inputLogo']['tmp_name'], $rutaLogo);                   
            //     }
            //     else{
            //         $errores['db-error'] = "¡Error al subir el documento peso superior al permitido!";
            //     }

            // }else if(isset($_FILES['inputLogo']) && ($_FILES['inputLogo']['type'] != 'image/jpeg')){
            //     $errores['db-error'] ="Solo se admiten imágenes con formato .jpg";
                
            // }

            /********************************************************************************************************** */     
            $insertarCongreso = "INSERT INTO congreso(id_congreso,modalidad_congreso,logo_congreso,correo_congreso,contra_congreso) VALUES ('$newIdCongreso','$modalidadCongreso','$rutaProvisional', '$emailCongreso', '$encpassCon')";
            $resInsertarCongreso = mysqli_query($conexion, $insertarCongreso);
            $actualizarCategorias = "UPDATE categoria SET id_congreso = '$newIdCongreso'";
            $actCateg = mysqli_query($conexion, $actualizarCategorias);
            //'$rutaLogo', logo_congreso,

            //Ciclo para insertar las fechas en un arreglo
            for ($i=1; $i <=15 ; $i++) { 
                $fechas[$i]=array("inicio"=>$_POST['fecha'.$i.'Inicio'],"fin"=>$_POST['fecha'.$i.'Fin']);
            }

            //Ciclo para insertar las fechas en la base de datos
            for ($i=1; $i <=15 ; $i++) {
                $fechaInicio= $fechas[$i]['inicio']; 
                $fechaFin= $fechas[$i]['fin'];

                $insertarFechasCongreso="INSERT INTO `fecha_congreso`(`fecha_congreso_inicio`, `fecha_congreso_fin`, `id_congreso`, `id_evento`) VALUES ('$fechaInicio','$fechaFin','$newIdCongreso','$i')";
                $resInsertarFechasCongreso = mysqli_query($conexion, $insertarFechasCongreso);
            }
    
            if($resInsertarCongreso){
                $info = "Se han registrado los datos del nuevo congreso. Ahora puedes personalizar el congreso en el apartado Diseño de pagina.";
                $_SESSION['info'] = $info;
            }else{
                $errores['db-error'] = "No se ha podido registrar el congreso.";
            }

            require "traerCongresoActual.php";     
        }

    }

    if(isset($_POST["actualizarCongreso"])){

        $fecha1Inicio=$_POST['fecha1Inicio'];
        $fecha1Fin=$_POST['fecha1Fin'];

        $fecha2Inicio=$_POST['fecha2Inicio'];
        $fecha2Fin=$_POST['fecha2Fin'];

        $fecha3Inicio=$_POST['fecha3Inicio'];
        $fecha3Fin=$_POST['fecha3Fin'];

        $fecha4Inicio=$_POST['fecha4Inicio'];
        $fecha4Fin=$_POST['fecha4Fin'];

        $fecha5Inicio=$_POST['fecha5Inicio'];
        $fecha5Fin=$_POST['fecha5Fin'];
        
        $fecha6Inicio=$_POST['fecha6Inicio'];
        $fecha6Fin=$_POST['fecha6Fin'];

        $fecha7Inicio=$_POST['fecha7Inicio'];
        $fecha7Fin=$_POST['fecha7Fin'];

        $fecha8Inicio=$_POST['fecha8Inicio'];
        $fecha8Fin=$_POST['fecha8Fin'];

        $fecha9Inicio=$_POST['fecha9Inicio'];
        $fecha9Fin=$_POST['fecha9Fin'];

        $fecha10Inicio=$_POST['fecha10Inicio'];
        $fecha10Fin=$_POST['fecha10Fin'];

        $fecha11Inicio=$_POST['fecha11Inicio'];
        $fecha11Fin=$_POST['fecha11Fin'];

        $fecha12Inicio=$_POST['fecha12Inicio'];
        $fecha12Fin=$_POST['fecha12Fin'];

        $fecha13Inicio=$_POST['fecha13Inicio'];
        $fecha13Fin=$_POST['fecha13Fin'];

        $fecha14Inicio=$_POST['fecha14Inicio'];
        $fecha14Fin=$_POST['fecha14Fin'];
        
        $fecha15Inicio=$_POST['fecha15Inicio'];
        $fecha15Fin=$_POST['fecha15Fin'];

        $modalidadCongreso=$_POST['modalidadCongreso'];

        require "traerCongresoActual.php";
        
        //Ciclo para insertar las fechas en un arreglo
        for ($i=1; $i <=15 ; $i++) { 
            $fechas[$i]=array("inicio"=>$_POST['fecha'.$i.'Inicio'],"fin"=>$_POST['fecha'.$i.'Fin']);
        }

        //Ciclo para insertar las fechas en la base de datos
        for ($i=1; $i <=15 ; $i++) {
            $fechaInicio= $fechas[$i]['inicio']; 
            $fechaFin= $fechas[$i]['fin'];

            $actualizarFechasCongreso="UPDATE `fecha_congreso` SET `fecha_congreso_inicio`='$fechaInicio',`fecha_congreso_fin`='$fechaFin' WHERE id_evento=$i";
            $resActualizarFechasCongreso = mysqli_query($conexion, $actualizarFechasCongreso);
        }

        if($resActualizarFechasCongreso){
            $info = "Se han actualizado las fechas del congreso.";
            $_SESSION['info'] = $info;
        }else{
            $errores['db-error'] = "No se han podido actualizado las fechas del congreso..";
        }        
    }

?>
