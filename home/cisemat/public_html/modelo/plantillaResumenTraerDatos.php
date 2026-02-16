<?php
    /** 
    * Este modulo realiza el registro de los trabajos, contiene las restricciones de autores
    * y couatores, la clave de las ponencias.
    * Cualquier duda o sugerencia:
    * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
    **/  
    require "conexion.php";
    require "traerCongresoActual.php";
    //Persistencia
    // Establecer

    $coautores=array();
   //unset($_SESSION['coautores']);
   //die;
    //Si no esta vacio coautores
    if(!empty($_SESSION['coautores'])){
        $coautores=$_SESSION['coautores'];
    }
    //Fecha actual
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('y-m-d G:i:s');
    //$idPonencia=$_SESSION['coautores'];
    //$coautores[0]=array("id"=>"PEDRO","nombres"=>"PEDRO","rfc"=>"PEDRO");
    $_SESSION["tipoPonencia"]="";
    //Variables para el registro
    $tipoPonencia="";
    $categoria="";
    $titulo="";
    $resumen="";
    $referencias="";
    $autor="";
    /** 
    *******************************************************************************************************
    * Limite de coautores, se debe modificar en caso de aceptar mas coautores por trabajos
    *******************************************************************************************************
    **/ 
    //Limite de coautores por taller
    $limiteCoautoresCartel='3';
    $limiteCoautoresPonencia='4';
    $limiteCoautoresTaller='2';
    $limiteCoautoresPrototipo='5';
    
    /** 
    *******************************************************************************************************
    *******************************************************************************************************
    **/
    //Alguno de tus coautores rebasa el limite de 4 trabajos a registrar. Ponte en contacto con ellos.
    $errores = array(); //Es un arreglo que guarda todos los errores y los muestra
    unset($_SESSION['info']);
    //Trae los datos del usuario
    $datosAutor = "SELECT * FROM usuario WHERE id_usuario='$_SESSION[id]'";
    $res = mysqli_query($conexion, $datosAutor);
    $fetch = mysqli_fetch_assoc($res);

    //Trae los datos de las categorias
    $categorias = "SELECT * FROM categoria WHERE id_congreso='$idCongreso'";
    
    
    $res2 = mysqli_query($conexion, $categorias);
 
    //Trae los datos de los coautores
    $cCoautores = "SELECT id_usuario, nombres_usuario, rfc_usuario FROM usuario";
    $res3 = mysqli_query($conexion, $cCoautores);

   
    /** 
     *******************************************************************************************************
    * Consulta las restricciones del numero de trabajos como autor y couator
    *******************************************************************************************************
    **/
    require "mRTrabajosAutorCoautor.php";

    /** 
     *******************************************************************************************************
    * Consulta las restricciones del numero de trabajos asignadas al usuario
    *******************************************************************************************************
    **/
    require "mRRestriccionTrabajoUsuario.php";

//echo "Llegue 6";
    /** 
     *******************************************************************************************************
    * Consultas para la generación de códigos de trabajos
    *******************************************************************************************************
    **/
    require "mRGeneracionIdTrabajo.php";

    if(isset($_POST['botonAgregarCoautor'])){
        $_SESSION['titulo_ponencia'] = mysqli_real_escape_string($conexion,$_POST["titulo"]);
        $_SESSION['id_categoria_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["categoria"]);
        $_SESSION['resumen_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["resumen"]);
        $_SESSION['tipo_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["tipo"]);
        $_SESSION['referencia_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["referencia"]);
        //Coautor existe
        $consObtenerRFC="SELECT rfc_usuario FROM usuario WHERE id_usuario='$_SESSION[id]'";
        $resObtenerRFC=mysqli_query($conexion,$consObtenerRFC);
        $fecthObtenerRFC=mysqli_fetch_assoc($resObtenerRFC);
        $rfcAutor=$fecthObtenerRFC['rfc_usuario'];

        $couatorExiste=0;
        $rfcCoautor=$_POST['coautor'];
        
        //echo "<br> Coautor : ".$rfcCoautor."<br>";
        
        //Si es diferente de su RFC lo registra
        if($rfcCoautor!=$rfcAutor){
            $coautor = "SELECT * FROM usuario WHERE rfc_usuario='$rfcCoautor'";
            $res4 = mysqli_query($conexion, $coautor);
            if(mysqli_num_rows($res4)>0){
                $fetch4 = mysqli_fetch_assoc($res4);
                    //Valida que el usuario no sea el mismo
                    $validaCoautor=$_SESSION['coautores'];
                    //Si el usuario no ha introducido ningun coautor
                    if(count($validaCoautor)!=0){
                        for($i=0;$i<=count($validaCoautor)-1;$i++){
                            //$idAutor=$coautores["id"];
                            //$rfcAutor=$coautores["rfc"];
                            if($coautores[$i]["rfc"]==$fetch4['rfc_usuario']){
                                $couatorExiste=$couatorExiste+1;
                            }
                        }
                        if($couatorExiste==0){
                            $coautores[]=array("id"=>$fetch4['id_usuario'],"nombres"=>$fetch4['nombres_usuario'],"apellidos"=>$fetch4['apellidos_usuario'],"rfc"=>$fetch4['rfc_usuario'],"correoElectronico"=>$fetch4['email_usuario']);
                            $_SESSION['coautores']=$coautores;
                        }
                    }else{
                        $coautores[]=array("id"=>$fetch4['id_usuario'],"nombres"=>$fetch4['nombres_usuario'],"apellidos"=>$fetch4['apellidos_usuario'],"rfc"=>$fetch4['rfc_usuario'],"correoElectronico"=>$fetch4['email_usuario']);
                        $_SESSION['coautores']=$coautores;
                    }
            }else{
                $errores['sistema-restriccion'] = "El RFC '".$rfcCoautor."' no se encuentra registrado. Comunícate con el coautor para que se registre en la plataforma.";
                
            }
        }else{
            $errores['sistema-restriccion'] = "El RFC '".$rfcCoautor."' te pertence, no puedes ser autor y coautor.";
        }
    }
   

    if(isset($_POST['botonQuitarCoautores'])){
        $_SESSION['titulo_ponencia'] = mysqli_real_escape_string($conexion,$_POST["titulo"]);
        $_SESSION['id_categoria_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["categoria"]);
        $_SESSION['resumen_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["resumen"]);
        $_SESSION['tipo_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["tipo"]);
        $_SESSION['referencia_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["referencia"]);

        //unset($coautores[1]);
        unset($_SESSION['coautores']);
        unset($coautores);
        if(!empty($_SESSION['coautores'])){
            $coautores=$_SESSION['coautores'];
            
        }
        $coautores=array();
        //$_SESSION['coautores']=$coautores;
    }
    //Borrar
      if(!empty($_SESSION['titulo_ponencia'])){
          echo "Título de ponencia : ".$_SESSION['titulo_ponencia'];
        }else
          //echo "No hay título de ponencia : ";
  
    if(isset($_POST['botonQuitarCoautor']) && $_POST['botonQuitarCoautor'] >= 0){
        $_SESSION['titulo_ponencia'] = mysqli_real_escape_string($conexion,$_POST["titulo"]);
        $_SESSION['id_categoria_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["categoria"]);
        $_SESSION['resumen_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["resumen"]);
        $_SESSION['tipo_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["tipo"]);
        $_SESSION['referencia_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["referencia"]);
        $posicionEliminar = $_POST['botonQuitarCoautor'];

        if(isset($coautores[$posicionEliminar])){

            unset($coautores[$posicionEliminar]);

            sort($coautores);

            $_SESSION['coautores'] = $coautores;

        }

    }
    if(isset($_POST['botonParticipar'])){   

        $_SESSION['titulo_ponencia'] = mysqli_real_escape_string($conexion,$_POST["titulo"]);
        $_SESSION['id_categoria_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["categoria"]);
        $_SESSION['resumen_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["resumen"]);
        $_SESSION['tipo_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["tipo"]);
        $_SESSION['referencia_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["referencia"]); 

        /*****************************************************************************************************************/
        //Correccion de codigo por Leonardo Samuel Juarez Aguayo
        //consulta nombre autor
        
        $nombreAutor = $fetch['nombres_usuario'] . ' ' . $fetch['apellidos_usuario'];
        $res = mysqli_query($conexion, $datosAutor);
        $fetch = mysqli_fetch_assoc($res);

        $nombreCat = $_SESSION['id_categoria_ponencia'];

        $datosCategoria = "SELECT * FROM categoria WHERE id_categoria='$nombreCat'";
        $res2 = mysqli_query($conexion, $datosCategoria);
        $fetch2 = mysqli_fetch_assoc($res2);
        $nombreCategoria = $fetch2['categoria'];

        $querycat= "SELECT * FROM categoria WHERE id_categoria='$nombreCat'";
        $resCat = mysqli_query($conexion, $querycat);
        $fetchCat = mysqli_fetch_assoc($resCat);
        $claveCat = $fetchCat['clave_cat'];

        
/*****************************************************************************************************************/
        //Consulta Tipo Ponencia
        $tipoPonencia=mysqli_real_escape_string($conexion, $_POST['tipo']);
        $consultaTipoPonencia = "SELECT * FROM tipo_ponencia WHERE categoria_ponencia = '$tipoPonencia'";
        $result = mysqli_query($conexion, $consultaTipoPonencia);
        $pon = mysqli_fetch_assoc($result); 
        if(mysqli_num_rows($result)>0){
            $idTipoPonencia=$pon['id_tipo_ponencia'];
        }else{
            //Excepcion de la ponencia porque no selecciono ninguno
            $idTipoPonencia=0;
        }
        
        /////Trae los datos introducidos al presionar el boton participar

        
        $categoria=mysqli_real_escape_string($conexion, $_POST['categoria']);
        $titulo=mysqli_real_escape_string($conexion, $_POST['titulo']);
        $resumen=mysqli_real_escape_string($conexion, $_POST['resumen']);
        $referencias=mysqli_real_escape_string($conexion, $_POST['referencia']);
        $autor=mysqli_real_escape_string($conexion, $_SESSION['id']);
        
        //Borrar
        if (empty($resumen)){
            echo "<br>Despues de oprimir participar resumen vacio<br>";
        }


        //Las ponencias no se pueden llamar igual
        $consultaPonencia = "SELECT * FROM ponencia WHERE titulo_ponencia = '$titulo'";
        $resConsultaPonencia = mysqli_query($conexion, $consultaPonencia);
        
        if(mysqli_num_rows($resConsultaPonencia)==0)  {
            /**************************LIMITE DE LOS TRABAJOS DE LOS COAUTORES*****************************************/   
            //Validacion de los trabajos por coautores
            if(count($coautores)>0){
                //Variables para validar al coautor
                $coautorExcedeTrabajosTotales='0';
                $coautorExcedeTrabajoEspecifico='0';
                for($i=0;$i<=count($coautores)-1;$i ++){
                    $idAutor=$coautores[$i]["id"];
                    $nombresAutor=$coautores[$i]["nombres"];
                    $rfcAutor=$coautores[$i]["rfc"];
                    /** 
                    *******************************************************************************************************
                    * Hace las consultas por coautor para no dejar avanzar en la ponencia si el coautor ha excedido sus trabajos
                    * de forma General y como Coautor > Autor y Coautor 
                    * Consulta las ponencias registradas hasta el momento como COAUTOR
                    *******************************************************************************************************
                    **/ 
                        //Cuenta todas las ponencias hasta el momento del Coautor como Autor
                        $consPonenciasRegistradasValidacionCoautor = "SELECT count(*) from ponencia where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso'";

                        $resPonenciasRegistradasValidacionCoautor = mysqli_query($conexion, $consPonenciasRegistradasValidacionCoautor);
                        $fetchPonenciasRegistradasValidacionCoautor = mysqli_fetch_assoc($resPonenciasRegistradasValidacionCoautor);
                        $numeroDePonenciasRegistradasValidacionCoautor=$fetchPonenciasRegistradasValidacionCoautor['count(*)'];     
                        
                        //Carteles
                        $consNumeroCartelesRegistradosValidacionCoautor = "SELECT count(*) from ponencia where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='1'";
                        $rescNumeroCartelesRegistradosValidacionCoautor = mysqli_query($conexion, $consNumeroCartelesRegistradosValidacionCoautor);
                        $fetchNumeroCartelesRegistradosValidacionCoautor = mysqli_fetch_assoc($rescNumeroCartelesRegistradosValidacionCoautor);
                        $numeroCartelesRegistradosValidacionCoautor=$fetchNumeroCartelesRegistradosValidacionCoautor['count(*)'];     
                        
                        //Ponencias
                        $consNumeroPonenciasRegistradasValidacionCoautor = "SELECT count(*) from ponencia where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='2'";
                        $rescNumeroPonenciasRegistradasValidacionCoautor = mysqli_query($conexion, $consNumeroPonenciasRegistradasValidacionCoautor);
                        $fetchNumeroPonenciasRegistradasValidacionCoautor = mysqli_fetch_assoc($rescNumeroPonenciasRegistradasValidacionCoautor);
                        $numeroPonenciasRegistradasValidacionCoautor=$fetchNumeroPonenciasRegistradasValidacionCoautor['count(*)']; 
                        
                        //Talleres
                        $consNumeroTalleresRegistradosValidacionCoautor = "SELECT count(*) from ponencia where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='3'";
                        $rescNumeroTalleresRegistradosValidacionCoautor = mysqli_query($conexion, $consNumeroTalleresRegistradosValidacionCoautor);
                        $fetchNumeroTalleresRegistradosValidacionCoautor = mysqli_fetch_assoc($rescNumeroTalleresRegistradosValidacionCoautor);
                        $numeroTalleresRegistradosValidacionCoautor=$fetchNumeroTalleresRegistradosValidacionCoautor['count(*)']; 
                        
                        //Prototipo
                        $consNumeroPrototiposRegistradosValidacionCoautor = "SELECT count(*) from ponencia where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='4'";
                        $rescNumeroPrototiposRegistradosValidacionCoautor = mysqli_query($conexion, $consNumeroPrototiposRegistradosValidacionCoautor);
                        $fetchNumeroPrototiposRegistradosValidacionCoautor = mysqli_fetch_assoc($rescNumeroPrototiposRegistradosValidacionCoautor);
                        $numeroPrototiposRegistradosValidacionCoautor=$fetchNumeroPrototiposRegistradosValidacionCoautor['count(*)']; 

                        //Cuenta todas las ponencias hasta el momento del Coautor como Coautor
                        $consPonenciasRegistradasCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                        INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                        WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND usuario_colabora_ponencia_18012024.id_congreso='$idCongreso'";
                        $resPonenciasRegistradasCoautorValidacionCoautor = mysqli_query($conexion, $consPonenciasRegistradasCoautorValidacionCoautor);
                        $fetchPonenciasRegistradasCoautorValidacionCoautor = mysqli_fetch_assoc($resPonenciasRegistradasCoautorValidacionCoautor);
                        $numeroDePonenciasRegistradasCoautorValidacionCoautor=$fetchPonenciasRegistradasCoautorValidacionCoautor['count(*)']; 
                        //Carteles
                        $consNumeroCartelesRegistradosCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                        INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                        WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='1'";
                        $rescNumeroCartelesRegistradosCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroCartelesRegistradosCoautorValidacionCoautor);
                        $fetchNumeroCartelesRegistradosCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroCartelesRegistradosCoautorValidacionCoautor);
                        $numeroCartelesRegistradosCoautorValidacionCoautor=$fetchNumeroCartelesRegistradosCoautorValidacionCoautor['count(*)']; 
                        //Ponencias
                        $consNumeroPonenciasRegistradasCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                        INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                        WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='2'";
                        $rescNumeroPonenciasRegistradasCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroPonenciasRegistradasCoautorValidacionCoautor);
                        $fetchNumeroPonenciasRegistradasCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroPonenciasRegistradasCoautorValidacionCoautor);
                        $numeroPonenciasRegistradasCoautorValidacionCoautor=$fetchNumeroPonenciasRegistradasCoautorValidacionCoautor['count(*)'];
                        //Talleres
                        $consNumeroTalleresRegistradosCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                        INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                        WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='3'";
                        $rescNumeroTalleresRegistradosCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroTalleresRegistradosCoautorValidacionCoautor);
                        $fetchNumeroTalleresRegistradosCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroTalleresRegistradosCoautorValidacionCoautor);
                        $numeroTalleresRegistradosCoautorValidacionCoautor=$fetchNumeroTalleresRegistradosCoautorValidacionCoautor['count(*)'];
                        //Prototipo
                        $consNumeroPrototiposRegistradosCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                        INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                        WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='3'";
                        $rescNumeroPrototiposRegistradosCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroPrototiposRegistradosCoautorValidacionCoautor);
                        $fetchNumeroPrototiposRegistradosCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroPrototiposRegistradosCoautorValidacionCoautor);
                        $numeroPrototiposRegistradosCoautorValidacionCoautor=$fetchNumeroPrototiposRegistradosCoautorValidacionCoautor['count(*)'];
                        /** 
                        *******************************************************************************************************
                        * Consulta las restricciones del numero de TRABAJOS ESPECIFICOS asignadas al Coautor
                        *******************************************************************************************************
                        **/ 
                        $consRestriccionTrabajosValidacionCoautor = "SELECT * FROM trabajos_registrar WHERE id_usuario='$idAutor'";
                        $resRestriccionTrabajosValidacionCoautor = mysqli_query($conexion, $consRestriccionTrabajosValidacionCoautor);
                        $fetchRestriccionTrabajosValidacionCoautor = mysqli_fetch_assoc($resRestriccionTrabajosValidacionCoautor);

                        $restriccionCartelValidacionCoautor=$fetchRestriccionTrabajosValidacionCoautor['cartel_trabajos_registrar']; 
                        $restriccionPonenciaValidacionCoautor=$fetchRestriccionTrabajosValidacionCoautor['ponencia_trabajos_registrar']; 

                        $restriccionTallerValidacionCoautor=$fetchRestriccionTrabajosValidacionCoautor['taller_trabajos_registrar']; 
                        $restriccionMesaValidacionCoautor=$fetchRestriccionTrabajosValidacionCoautor['mesa_redonda_trabajos_registrar']; 
                        $restriccionPrototipoValidacionCoautor=$fetchRestriccionTrabajosValidacionCoautor['prototipo_trabajos_registrar'];
                        $limiteDePonenciasTotalesCoautor=$fetchRestriccionTrabajosValidacionCoautor['maximo_trabajos_registrar'];
                        
                        /** 
                        *******************************************************************************************************
                        * Switch que verifica todas las PONENCIAS GENERALES por coautor limite de 5 ponencias y 
                        * las especificas.
                        *******************************************************************************************************
                        **/                         
                        $numeroDePonenciasTotalesRegistradasValidacionCoautor=$numeroDePonenciasRegistradasValidacionCoautor+$numeroDePonenciasRegistradasCoautorValidacionCoautor;
                        if($numeroDePonenciasTotalesRegistradasValidacionCoautor<=$limiteDePonenciasTotalesCoautor){
                            switch ($idTipoPonencia) {
                                case '1':
                                    //Verifica que no rebase el limite de trabajos del coautor en tipo Cartel
                                    $numeroCartelesValidacionCoautor=$numeroCartelesRegistradosValidacionCoautor+$numeroCartelesRegistradosCoautorValidacionCoautor;
                                    if($numeroCartelesValidacionCoautor>=$restriccionCartelValidacionCoautor){
                                        $coautorExcedeTrabajoEspecifico=$coautorExcedeTrabajoEspecifico+1;
                                    }
                                    break;
                                case '2':
                                    //Verifica que no rebase el limite de trabajos del coautor en tipo Ponencia
                                    $numeroPonenciasValidacionCoautor=$numeroPonenciasRegistradasValidacionCoautor+$numeroPonenciasRegistradasCoautorValidacionCoautor;
                                    if($numeroPonenciasValidacionCoautor>=$restriccionPonenciaValidacionCoautor){
                                        $coautorExcedeTrabajoEspecifico=$coautorExcedeTrabajoEspecifico+1;
                                    }
                                    break;                                
                                case '3':
                                    //Verifica que no rebase el limite de trabajos del coautor en tipo Taller
                                    $numeroTalleresValidacionCoautor=$numeroTalleresRegistradosValidacionCoautor+$numeroTalleresRegistradosCoautorValidacionCoautor;
                                    if($numeroTalleresValidacionCoautor>=$restriccionTallerValidacionCoautor){
                                        $coautorExcedeTrabajoEspecifico=$coautorExcedeTrabajoEspecifico+1;
                                    }
                                    break;
                                case '4':
                                    
                                    //Verifica que no rebase el limite de trabajos del coautor en tipo Prototipo
                                    $numeroPrototiposValidacionCoautor=$numeroPrototiposRegistradosValidacionCoautor+$numeroPrototiposRegistradosCoautorValidacionCoautor;
                                    if($numeroPrototiposValidacionCoautor>=$restriccionPrototipoValidacionCoautor){
                                        $coautorExcedeTrabajoEspecifico=$coautorExcedeTrabajoEspecifico+1;
                                    }
                                    break;                                
                            }
                        }else{
                            $coautorExcedeTrabajosTotales=$coautorExcedeTrabajosTotales+1;
                        } 
                        /** 
                        *******************************************************************************************************
                        *******************************************************************************************************
                        **/                        
                    }       
                }else{
                    //En caso de que no exceda ningun coautor sus limites, los registra
                    $coautorExcedeTrabajosTotales=0;
                    $coautorExcedeTrabajoEspecifico=0;
                }
                               
                /** 
                *******************************************************************************************************
                * Registro del trabajo
                *******************************************************************************************************
                **/   
                //Si el usuario no ha rebasado el limite de ponencias
                $numeroDePonenciasTotalesRegistradas=$numeroDePonenciasRegistradas+$numeroDePonenciasRegistradasCoautor;
                if($numeroDePonenciasTotalesRegistradas<$limiteDePonenciasTotales){
                    switch ($idTipoPonencia) {
                        case '1':
                            //Ponencias
                            //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                            $numeroTotalCartelesRegistrados=$numeroCartelesRegistrados+$numeroCartelesRegistradosCoautor;
                            if($numeroTotalCartelesRegistrados<$restriccionCartel){   
                                //Restriccion de los coautores
                                if(count($coautores)<=$limiteCoautoresCartel){
                                    //Restriccion de los coautores tengan trbajos totales disponibles
                                    if($coautorExcedeTrabajosTotales==0){
                                        //Restriccion de los coautores tengan trabajo especifico disponible
                                        if($coautorExcedeTrabajoEspecifico==0){
                                            //Si pasa todos los filtros debe registrar el trbajo 
                                            //Cartel
                                            //Se subirá el trabajo
                                                //Genera el id de la ponencia con el código
                                                if ($numeroCartelesCongreso<10) {
                                                    $numeroCartelesCongreso='00'.$numeroCartelesCongreso;
                                                }else{
                                                    if($numeroCartelesCongreso<100){
                                                        $numeroCartelesCongreso='0'.$numeroCartelesCongreso;
                                                    }
                                                }
                                                
                                                // $idPonencia='CASM'.$numeroCartelesCongreso.$idCongreso;
                                                $idPonencia=$claveCat.'-CASM'.$numeroCartelesCongreso;

                                                //Inserta nueva ponencia
                                                $insertarPonencia = "INSERT INTO ponencia (id_ponencia,titulo_ponencia, resumen_ponencia, referencia_ponencia, id_tipo_ponencia, id_categoria, id_usuario_registra, fecha_registro_ponencia, id_congreso)
                                                values('$idPonencia','$titulo', '$resumen', '$referencias', '$idTipoPonencia', '$categoria','$autor','$fechaActual','$idCongreso')";
                                                $data_check = mysqli_query($conexion, $insertarPonencia);
                                                    
                                                /*
                                                //Busca el id de la ponencia con el nombre
                                                $consultaIdPonencia = "SELECT * FROM ponencia WHERE titulo_ponencia = '$titulo'";
                                                $consultaIdPonenciaRes = mysqli_query($conexion, $consultaIdPonencia);
                                                $fetchPonencia = mysqli_fetch_assoc($consultaIdPonenciaRes); 
                                                $idPonencia=$fetchPonencia['id_ponencia'];
                                                */

                                                //asignar los id a las tablas de ponencia, curso, cartel, prototipo etc
                                                $asignaValoraCartel="INSERT INTO cartel(id_ponencia,cartel,id_congreso) values ('$idPonencia','',$idCongreso)";
                                                $data_check2 = mysqli_query($conexion, $asignaValoraCartel);
                                                //Inserta los coautores
                                                //Bucle para el registro de los coautores  
                                                $infoCoautores=". ";
                                                for($i=0;$i<=count($coautores)-1;$i ++){
                                                    $idAutor=$coautores[$i]["id"];
                                                    $nombresAutor=$coautores[$i]["nombres"];
                                                    $rfcAutor=$coautores[$i]["rfc"];
                                                    //Inserta nueva ponencia
                                                    $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia, id_usuario, id_congreso)
                                                    values('$idPonencia', '$idAutor', '$idCongreso')";
                                                    $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                                    $infoCoautores=" y a la de tus coautores. ";
                                                }
                                            
                                                if($data_check){
                                                    //Muestra si el registro fue exitoso y lo muestra en información.
                                                    $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (".$_SESSION['correoElectronico'].") ".$infoCoautores;
                                                    require_once "../../librerias/PHPMailer/src/correoRegistroResumen.php";
                                                    $_SESSION['info'] = $info;
                                                    //Quita a los coautores
                                                    unset($_SESSION['coautores']);
                                                    unset($coautores);
                                                    if(!empty($_SESSION['coautores'])){
                                                        $coautores=$_SESSION['coautores'];
                                                        
                                                    }
                                                    $coautores=array();
                                                    //header('location: ../../index.php');
                                                    
                                                }else{
                                                    $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                                                }                                        
                                        }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo ".$tipoPonencia." ya que ha excedió el límite.";
                                        }
                                    }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                                    }
                                }else{
                                    $errores['sistema-restriccion'] = "No puedes registrar más de ".$limiteCoautoresCartel." coautores en cartel.";
                                } 
                            }else{
                                $errores['sistema-restriccion'] = "No puedes registrar más de ".$restriccionCartel." cartel(es).";
                            }
                            break;

                        case '2':
                            //Ponencias
                            //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                            $numeroTotalPonenciasRegistradas=$numeroPonenciasRegistradas+$numeroPonenciasRegistradasCoautor;
                            if($numeroTotalPonenciasRegistradas<$restriccionPonencia){   
                                //Restriccion de los coautores
                                if(count($coautores)<=$limiteCoautoresPonencia){
                                    //Restriccion de los coautores tengan trbajos totales disponibles
                                    if($coautorExcedeTrabajosTotales==0){
                                        //Restriccion de los coautores tengan trabajo especifico disponible
                                        if($coautorExcedeTrabajoEspecifico==0){
                                            //Si pasa todos los filtros debe registrar el trbajo 
                                                //Genera el id de la ponencia con el código
                                                if ($numeroPonenciasCongreso<10) {
                                                    $numeroPonenciasCongreso='00'.$numeroPonenciasCongreso;
                                                }else{
                                                    if($numeroPonenciasCongreso<100){
                                                        $numeroPonenciasCongreso='0'.$numeroPonenciasCongreso;
                                                    }
                                                }
                                                
                                                // $idPonencia='POSM'.$numeroPonenciasCongreso.$idCongreso;                                        
                                                $idPonencia=$claveCat.'-POSM'.$numeroPonenciasCongreso;                                        
                                            //Inserta nueva ponencia
                                            $insertarPonencia = "INSERT INTO ponencia (id_ponencia,titulo_ponencia, resumen_ponencia, referencia_ponencia, id_tipo_ponencia, id_categoria, id_usuario_registra, fecha_registro_ponencia, id_congreso)
                                            values('$idPonencia','$titulo', '$resumen', '$referencias', '$idTipoPonencia', '$categoria','$autor','$fechaActual','$idCongreso')";
                                            $data_check = mysqli_query($conexion, $insertarPonencia);
                                            
                                            /*
                                            //Busca el id de la ponencia con el nombre
                                            $consultaIdPonencia = "SELECT * FROM ponencia WHERE titulo_ponencia = '$titulo'";
                                            $consultaIdPonenciaRes = mysqli_query($conexion, $consultaIdPonencia);
                                            $fetchPonencia = mysqli_fetch_assoc($consultaIdPonenciaRes); 
                                            $idPonencia=$fetchPonencia['id_ponencia'];
                                            */

                                            //asignar los id a las tablas de ponencia, curso, cartel, prototipo etc
                                            $asignaValoraPonenciaOral="INSERT INTO oral(id_ponencia,id_congreso) VALUES ('$idPonencia','$idCongreso')";
                                            $data_check3 = mysqli_query($conexion, $asignaValoraPonenciaOral);
                                            //Inserta los coautores
                                            //Bucle para el registro de los coautores  
                                            $infoCoautores=". ";
                                            for($i=0;$i<=count($coautores)-1;$i ++){
                                                $idAutor=$coautores[$i]["id"];
                                                $nombresAutor=$coautores[$i]["nombres"];
                                                $rfcAutor=$coautores[$i]["rfc"];
                                                //Inserta nueva ponencia
                                                $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia, id_usuario, id_congreso)
                                                values('$idPonencia', '$idAutor', '$idCongreso')";
                                                $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                                $infoCoautores=" y a la de tus coautores. ";
                                            }

                                            if($data_check){
                                                //Muestra si el registro fue exitoso y lo muestra en información.
                                                $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (".$_SESSION['correoElectronico'].") ".$infoCoautores;
                                                require_once "../../librerias/PHPMailer/src/correoRegistroResumen.php";
                                                $_SESSION['info'] = $info;
                                                //Quita a los coautores
                                                unset($_SESSION['coautores']);
                                                unset($coautores);
                                                if(!empty($_SESSION['coautores'])){
                                                    $coautores=$_SESSION['coautores'];
                                                    
                                                }
                                                $coautores=array();
                                                //header('location: ../../index.php');
                                                
                                            }else{
                                                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                                            }                                                                           
                                        }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo ".$tipoPonencia." ya que ha excedió el límite.";
                                        }
                                    }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                                    }
                                }else{
                                    $errores['sistema-restriccion'] = "No puedes registrar más de ".$limiteCoautoresPonencia." coautores en ponencia oral.";
                                } 
                            }else{
                                $errores['sistema-restriccion'] = "No puedes registrar más de ".$restriccionPonencia." ponencia(s).";
                            }
            
                            break;
                        case '3':
                            //Taller
                            //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                            $numeroTotalTalleresRegistrados=$numeroTalleresRegistrados+$numeroTalleresRegistradosCoautor;
                            if($numeroTotalTalleresRegistrados<$restriccionTaller){   
                                //Restriccion de los coautores
                                if(count($coautores)<=$limiteCoautoresTaller){
                                    //Restriccion de los coautores tengan trbajos totales disponibles
                                    if($coautorExcedeTrabajosTotales==0){
                                        //Restriccion de los coautores tengan trabajo especifico disponible
                                        if($coautorExcedeTrabajoEspecifico==0){
                                            //Si pasa todos los filtros debe registrar el trabajo 
                                            //Genera el id de la ponencia con el código
                                            if ($numeroTalleresCongreso<10) {
                                                $numeroTalleresCongreso='00'.$numeroTalleresCongreso;
                                            }else{
                                                if($numeroTalleresCongreso<100){
                                                    $numeroTalleresCongreso='0'.$numeroTalleresCongreso;
                                                }
                                            }
                                            
                                            // $idPonencia='TASM'.$numeroTalleresCongreso.$idCongreso; 
                                            $idPonencia=$claveCat.'-TASM'.$numeroTalleresCongreso; 
                                            
                                        
                                            
                                                                           
                                            //Inserta nueva ponencia
                                            $insertarPonencia = "INSERT INTO ponencia (id_ponencia,titulo_ponencia, resumen_ponencia, referencia_ponencia, id_tipo_ponencia, id_categoria, id_usuario_registra, fecha_registro_ponencia, id_congreso)
                                            values('$idPonencia','$titulo', '$resumen', '$referencias', '$idTipoPonencia', '$categoria','$autor','$fechaActual','$idCongreso')";
                                            $data_check = mysqli_query($conexion, $insertarPonencia);
                                            
                                            /*
                                            //Busca el id de la ponencia con el nombre
                                            $consultaIdPonencia = "SELECT * FROM ponencia WHERE titulo_ponencia = '$titulo'";
                                            $consultaIdPonenciaRes = mysqli_query($conexion, $consultaIdPonencia);
                                            $fetchPonencia = mysqli_fetch_assoc($consultaIdPonenciaRes); 
                                            $idPonencia=$fetchPonencia['id_ponencia'];
                                            */
                                             
                                            //asignar los id a las tablas de ponencia, curso, cartel, prototipo etc
                                            $asignaValoraTaller="INSERT INTO taller(id_ponencia,id_congreso) VALUES ('$idPonencia','$idCongreso')";
                                            $data_check4 = mysqli_query($conexion, $asignaValoraTaller);
                                          
                                            //Inserta los coautores
                                            //Bucle para el registro de los coautores  
                                            $infoCoautores=". ";
                                            for($i=0;$i<=count($coautores)-1;$i ++){
                                                $idAutor=$coautores[$i]["id"];
                                                $nombresAutor=$coautores[$i]["nombres"];
                                                $rfcAutor=$coautores[$i]["rfc"];
                                                //Inserta nueva ponencia
                                                $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia, id_usuario, id_congreso)
                                                values('$idPonencia', '$idAutor', '$idCongreso')";
                                                $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                                $infoCoautores=" y a la de tus coautores. ";
                                            }

                                            if($data_check){
                                                //Muestra si el registro fue exitoso y lo muestra en información.
                                                $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (".$_SESSION['correoElectronico'].") ".$infoCoautores;
                                                require_once "../../librerias/PHPMailer/src/correoRegistroResumen.php";
                                                $_SESSION['info'] = $info;
                                                //header('location: ../../index.php');
                                                //Quita a los coautores
                                                unset($_SESSION['coautores']);
                                                unset($coautores);
                                                if(!empty($_SESSION['coautores'])){
                                                    $coautores=$_SESSION['coautores'];
                                                    
                                                }
                                                $coautores=array();
                                            }else{
                                                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                                            }   
                                                                                                                 
                                        }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo ".$tipoPonencia." ya que ha excedió el límite.";
                                        }
                                    }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                                    }
                                }else{
                                    $errores['sistema-restriccion'] = "No puedes registrar más de ".$limiteCoautoresTaller." coautores en taller.";
                                } 
                            }else{
                                $errores['sistema-restriccion'] = "No puedes registrar más de ".$restriccionTaller." taller(es).";
                            }                        
                                    
                            break;
                        case '4':
                            //Prototipo
                            //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                            $numeroTotalPrototiposRegistrados=$numeroPrototiposRegistrados+$numeroPrototiposRegistradosCoautor;
                            if($numeroTotalPrototiposRegistrados<$restriccionPrototipo){   
                                //Restriccion de los coautores
                                if(count($coautores)<=$limiteCoautoresPrototipo){
                                    //Restriccion de los coautores tengan trbajos totales disponibles
                                    if($coautorExcedeTrabajosTotales==0){
                                        //Restriccion de los coautores tengan trabajo especifico disponible
                                        if($coautorExcedeTrabajoEspecifico==0){
                                            //Si pasa todos los filtros debe registrar el trbajo 
                                                //Genera el id de la ponencia con el código
                                                if ($numeroPrototiposCongreso<10) {
                                                    $numeroPrototiposCongreso='00'.$numeroPrototiposCongreso;
                                                }else{
                                                    if($numeroPrototiposCongreso<100){
                                                        $numeroPrototiposCongreso='0'.$numeroPrototiposCongreso;
                                                    }
                                                }
                                                
                                                // $idPonencia='PRSM'.$numeroPrototiposCongreso.$idCongreso;                                        
                                                $idPonencia=$claveCat.'-PRSM'.$numeroPrototiposCongreso;                                        
                                            //Inserta nueva ponencia
                                            $insertarPonencia = "INSERT INTO ponencia (id_ponencia,titulo_ponencia, resumen_ponencia, referencia_ponencia, id_tipo_ponencia, id_categoria, id_usuario_registra, fecha_registro_ponencia, id_congreso)
                                            values('$idPonencia','$titulo', '$resumen', '$referencias', '$idTipoPonencia', '$categoria','$autor','$fechaActual','$idCongreso')";
                                            $data_check = mysqli_query($conexion, $insertarPonencia);
                                                
                                            /*
                                            //Busca el id de la ponencia con el nombre
                                            $consultaIdPonencia = "SELECT * FROM ponencia WHERE titulo_ponencia = '$titulo'";
                                            $consultaIdPonenciaRes = mysqli_query($conexion, $consultaIdPonencia);
                                            $fetchPonencia = mysqli_fetch_assoc($consultaIdPonenciaRes); 
                                            $idPonencia=$fetchPonencia['id_ponencia'];
                                            */
                                            
                                            //asignar los id a las tablas de ponencia, curso, cartel, prototipo etc
                                            $asignaValoraPrototipo="INSERT INTO prototipo(id_ponencia,id_congreso) VALUES ('$idPonencia','$idCongreso')";
                                            $data_check6 = mysqli_query($conexion, $asignaValoraPrototipo);
                                            //Inserta los coautores
                                            //Bucle para el registro de los coautores  
                                            $infoCoautores=". ";
                                            for($i=0;$i<=count($coautores)-1;$i ++){
                                                $idAutor=$coautores[$i]["id"];
                                                $nombresAutor=$coautores[$i]["nombres"];
                                                $rfcAutor=$coautores[$i]["rfc"];
                                                //Inserta nueva ponencia
                                                $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia, id_usuario, id_congreso)
                                                values('$idPonencia', '$idAutor', '$idCongreso')";
                                                $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                                $infoCoautores=" y a la de tus coautores. ";
                                            }
                                        
                                            if($data_check){
                                                //Muestra si el registro fue exitoso y lo muestra en información.
                                                $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (".$_SESSION['correoElectronico'].") ".$infoCoautores;
                                                require_once "../../librerias/PHPMailer/src/correoRegistroResumen.php";
                                                $_SESSION['info'] = $info;
                                                //header('location: ../../index.php');
                                                //Quita a los coautores
                                                unset($_SESSION['coautores']);
                                                unset($coautores);
                                                if(!empty($_SESSION['coautores'])){
                                                    $coautores=$_SESSION['coautores'];
                                                    
                                                }
                                                $coautores=array();
                                            }else{
                                                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                                            }                                  
                                        }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo ".$tipoPonencia." ya que ha excedió el límite.";
                                        ?>
                                        <script>
                                            setTimeout(function() {
                                                <?php 
                                                    $errorRestriccion = json_encode($errores);
                                                ?>
                                                let mensajeError = <?php echo $errorRestriccion; ?>;
                                                alert(mensajeError['sistema-restriccion']);
                                                window.location.href = '../../components/subirResumen/subirResumen.php';
                                            }, 0);
                                        </script>
                                        <?php
                                        }
                                    }else{
                                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                                        ?>
                                        <script>
                                            setTimeout(function() {
                                                <?php 
                                                    $errorRestriccion = json_encode($errores);
                                                ?>
                                                let mensajeError = <?php echo $errorRestriccion; ?>;
                                                alert(mensajeError['sistema-restriccion']);
                                                window.location.href = '../../components/subirResumen/subirResumen.php';
                                            }, 0);
                                        </script>
                                        <?php
                                    }
                                }else{
                                    $errores['sistema-restriccion'] = "No puedes registrar más de ".$limiteCoautoresPrototipo." coautores en prototipo.";
                                    ?>
                                    <script>
                                        setTimeout(function() {
                                            <?php 
                                                $errorRestriccion = json_encode($errores);
                                            ?>
                                            let mensajeError = <?php echo $errorRestriccion; ?>;
                                            alert(mensajeError['sistema-restriccion']);
                                            window.location.href = '../../components/subirResumen/subirResumen.php';
                                        }, 0);
                                    </script>
                                    <?php
                                } 
                            }else{
                                $errores['sistema-restriccion'] = "No puedes registrar más de ".$restriccionPrototipo." prototipo(s).";
                                ?>
                                <script>
                                    setTimeout(function() {
                                        <?php 
                                            $errorRestriccion = json_encode($errores);
                                        ?>
                                        let mensajeError = <?php echo $errorRestriccion; ?>;
                                        alert(mensajeError['sistema-restriccion']);
                                        window.location.href = '../../components/subirResumen/subirResumen.php';
                                    }, 0);
                                </script>
                                <?php
                            }                 
                        
                            break;
                        default:
                            $errores['sistema-restriccion'] = "Selecciona un tipo de Trabajo.";
                            ?>
                            <script>
                                setTimeout(function() {
                                    <?php 
                                        $errorRestriccion = json_encode($errores);
                                    ?>
                                    let mensajeError = <?php echo $errorRestriccion; ?>;
                                    alert(mensajeError['sistema-restriccion']);
                                    window.location.href = '../../components/subirResumen/subirResumen.php';  
                                }, 0);
                            </script>
                            <?php
                            break;
                    }
            }else{
                $errores['sistema-restriccion'] = "Has excedido el número de trabajos registrados, solo puedes registrar ".$limiteDePonenciasTotales." trabajos por congreso.
                En caso de querer registrar más, acude a la dirección del congreso.";


                ?>
            <script>
                setTimeout(function() {
                    <?php 
                        $errorRestriccion = json_encode($errores);
                    ?>
                    let mensajeError = <?php echo $errorRestriccion; ?>;
                    alert(mensajeError['sistema-restriccion']);
                    window.location.href = '../../components/subirResumen/subirResumen.php';
                }, 0);
            </script>
            <?php
            }

        }else{
            $errores['sistema-restriccion'] = "Este nombre de la ponencia ya ha sido elegido, por favor, elige otro.";
            ?>
            <script>
                setTimeout(function() {
                    <?php 
                        $errorRestriccion = json_encode($errores);
                    ?>
                    let mensajeError = <?php echo $errorRestriccion; ?>;
                    alert(mensajeError['sistema-restriccion']);
                    window.location.href = '../../components/subirResumen/subirResumen.php';
                }, 0);
            </script>
            <?php
        }   



    }

?>
