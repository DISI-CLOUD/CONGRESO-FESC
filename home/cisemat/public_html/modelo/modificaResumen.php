<?php 

/** 
 * Este modulo realiza el registro de los trabajos, contiene las restricciones de autores
 * y couatores, la clave de las ponencias.
 * Cualquier duda o sugerencia:
 * @author Carlos Tejeda tejeda.araujo.carlos.alfredo@gmail.com
 **/
require "conexion.php";
require "traerCongresoActual.php";
//Id de la ponencia
$idPonencia = $_GET['id'];
//Muestra la informacion exitosa y los muestra
$advertencia = "";
//$errores = array(); //Es un arreglo que guarda todos los errores y los muestra
// Establecer
$coautores = array();
//Si no esta vacio coautores
//Si no esta vacio coautores
if (!empty($_SESSION['coautores'])) {
    $coautores = $_SESSION['coautores'];
}
//Fecha actual
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('y-m-d G:i:s');
//$idPonencia=$_SESSION['coautores'];
//$coautores[0]=array("id"=>"PEDRO","nombres"=>"PEDRO","rfc"=>"PEDRO");
$_SESSION["tipoPonencia"] = "";
//Variables para el registro
$tipoPonencia = "";
$categoria = "";
$titulo = "";
$resumen = "";
$referencias = "";
$autor = "";

//Trae los datos de las categorias
$categorias = "SELECT * FROM categoria WHERE id_congreso='$idCongreso'";
$res2 = mysqli_query($conexion, $categorias);

//Estado de la revisión por defecto
$estatusRevision = '';

$consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
    INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
    WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
//echo "</p> Viene de modificar - modificaResumen.php - Congreso : ".$idCongreso." - ".$consUsuarioRevisionPonencia."</p>";


$resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
$fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);

/** 
 *******************************************************************************************************
 * Limite de coautores, se debe modificar en caso de aceptar mas coautores por trabajos
 *******************************************************************************************************
 **/
//Limite de coautores por taller
$limiteCoautoresCartel = '3';
$limiteCoautoresPonencia = '4';
$limiteCoautoresTaller = '2';
$limiteCoautoresPrototipo = '5';
/** 
 *******************************************************************************************************
 *******************************************************************************************************
 **/

/*
    //Trae los datos de los coautores
$cCoautores = "SELECT id_usuario, nombres_usuario, rfc_usuario FROM usuario";
$res3 = mysqli_query($conexion, $cCoautores);
*/

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


/** 
 *******************************************************************************************************
 * Consultas para la generación de códigos de trabajos
 *******************************************************************************************************
 **/
require "mRGeneracionIdTrabajo.php";

if (mysqli_num_rows($resUsuarioRevisionPonencia) > 0) {
    $estatusRevision = $fetchUsuarioRevisionPonencia['estatus_revision'];
    $idRevision = $fetchUsuarioRevisionPonencia['id_revision'];
//echo "</p> Estatus revision : ".$estatusRevision."</p>";
//echo "</p> Id revision : ".$idRevision."</p>";
}

if ($estatusRevision == 'R' || mysqli_num_rows($resUsuarioRevisionPonencia) == 0) {
    $errores = array();
//echo "</p> Entre al if estatus revision - viene de modificar.php - modificaResumen.php ";
    ///////////////////////////////////
    //Sección para agregar coautores
    ///////////////////////////////////
    if(isset($_POST['botonAgregarCoautor'])){
//echo "</p> Entre al if de agregar autores - viene de modificar.php - modificaResumen.php ";

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
    /** 
     *******************************************************************************************************
     * Boton actualizar para guardar las modificaciones realizadas
     *******************************************************************************************************
     **/
    if (isset($_POST['botonGuardar'])) {
//echo "</p> Entre al if de boton guardar - viene de modificar.php - modificaResumen.php ";
        $_SESSION['titulo_ponencia'] = mysqli_real_escape_string($conexion,$_POST["titulo"]);
        $_SESSION['id_categoria_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["categoria"]);
        $_SESSION['resumen_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["resumen"]);
        $_SESSION['tipo_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["tipo"]);
        $_SESSION['referencia_ponencia'] =  mysqli_real_escape_string($conexion,$_POST["referencia"]);
        $cvCat = $_SESSION['id_categoria_ponencia'];

        $nuevaCategoriaModificar = "SELECT * FROM categoria WHERE id_categoria = '$cvCat'";
        $newClaveCategoria = mysqli_query($conexion, $nuevaCategoriaModificar);
        $fecthCategoriaNueva=mysqli_fetch_assoc($newClaveCategoria);
        $claveNueva=$fecthCategoriaNueva['clave_cat'];
        /** 
         *******************************************************************************************************
         * Eliminar coautores
         *******************************************************************************************************
         **/
        $consEliminarCoautores = "DELETE FROM usuario_colabora_ponencia_18012024 WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
        $resEliminarCoautores = mysqli_query($conexion, $consEliminarCoautores);

//echo "<br> Elimina Coautores ".$consEliminarCoautores."<br>";                                  

        //Trae los datos especificos de la ponencia
        $consPonencia = "SELECT * FROM ponencia p 
                       INNER JOIN tipo_ponencia t ON t.id_tipo_ponencia=p.id_tipo_ponencia WHERE p.id_ponencia='$idPonencia' 
                                  AND p.id_congreso='$idCongreso'";
//echo "<br> ConsPonencia ".$consPonencia."<br>";                                  

        $resPonencia = mysqli_query($conexion, $consPonencia);
        $fetchPonencia = mysqli_fetch_assoc($resPonencia);
        //Datos anteriores de la ponencia
        $oldTituloPonencia = $fetchPonencia['titulo_ponencia'];
        $oldResumenPonencia = $fetchPonencia['resumen_ponencia'];
        $oldReferenciaPonencia = $fetchPonencia['referencia_ponencia'];
        $oldCategoriaPonencia = $fetchPonencia['id_categoria'];
        $oldTipoPonencia = $fetchPonencia['categoria_ponencia'];
        $oldIdTipoPonencia = $fetchPonencia['id_tipo_ponencia'];
        $idUsuarioEvalua = $fetchPonencia['id_usuario_evalua'];
        $errorRegistroPonencia = false;

        $newTipoPonencia = mysqli_real_escape_string($conexion, $_POST['tipo']);

//echo "<br> Nueva ponencia ".$newTipoPonencia." Old ".$oldTipoPonencia."<br>";         
        
        if ($newTipoPonencia != $oldTipoPonencia) {
            $consTipo = "SELECT * FROM tipo_ponencia WHERE categoria_ponencia='$newTipoPonencia';";
            $resTipo = mysqli_query($conexion, $consTipo);
            $fetchTipo = mysqli_fetch_assoc($resTipo);
            $newIdTipoPonencia = $fetchTipo['id_tipo_ponencia'];
            //Para cambiar de categoria y verifica que no haya excedido el numero de los trabajos especificos
            //Carteles
            if ($newIdTipoPonencia == 1) {
                if ($numeroCartelesRegistrados < $restriccionCartel) {
                    $resEliminarCategoriaPonencia = false;
                    $resEliminarCategoriaTaller = false;
                    $resEliminarCategoriaPrototipo = false;
                    if ($oldIdTipoPonencia == 2) {
                        $consEliminarCategoriaPonencia = "DELETE FROM oral WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaPonencia = mysqli_query($conexion, $consEliminarCategoriaPonencia);
                    } else if ($oldIdTipoPonencia == 3) {
                        $consEliminarCategoriaTaller = "DELETE FROM taller WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaTaller = mysqli_query($conexion, $consEliminarCategoriaTaller);
                    } else if ($oldIdTipoPonencia == 4) {
                        $consEliminarCategoriaPrototipo = "DELETE FROM prototipo WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaPrototipo = mysqli_query($conexion, $consEliminarCategoriaPrototipo);
                    }

                    //Si se eliminó
                    if ($resEliminarCategoriaPonencia || $resEliminarCategoriaTaller || $resEliminarCategoriaPrototipo) {
                        //Si pasa todos los filtros debe registrar el trbajo 
                        //Cartel
                        //Se subirá el trabajo
                        //Genera el id de la ponencia con el código
                        if ($numeroCartelesCongreso < 10) {
                            $numeroCartelesCongreso = '00' . $numeroCartelesCongreso;
                        } else {
                            if ($numeroCartelesCongreso < 100) {
                                $numeroCartelesCongreso = '0' . $numeroCartelesCongreso;
                            }
                        }
                        $newIdPonencia = $claveNueva .'-CASM' . $numeroCartelesCongreso;
                        //Cambia el id de la ponencia
                        $consCambiarIdCartel = "UPDATE ponencia SET id_ponencia='$newIdPonencia',id_tipo_ponencia='$newIdTipoPonencia' WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";

                        echo "</p>Cartel".$consCambiarIdCartel."</p>";

                        $resCambiarIdCartel = mysqli_query($conexion, $consCambiarIdCartel);
                        //Inserta en donde debe ir
                        $consInsertarCartel = "INSERT INTO cartel(id_ponencia,cartel,id_congreso) values ('$newIdPonencia','','$idCongreso')";
                        
                        echo "</p>Cartel".$consInsertarCartel."</p>";
                        
                        $resInsertarCartel = mysqli_query($conexion, $consInsertarCartel);
                        if ($resCambiarIdCartel && $resInsertarCartel) {
                            $_SESSION['info'] = "Se ha cambiado el tipo de ponencia a CARTEL";
                        } else {
                            $errores['db-error'] = "No se pudo cambiar el tipo de ponencia a CARTEL, comunicate error de ID.";
                        }
                    } else {
                        $errores['db-error'] = "No se pudo cambiar el tipo de ponencia a CARTEL, comunicate con nosotros.";
                    }

                } else {
                    $errores['db-error'] = "No puedes cambiar el tipo de ponencia a CARTEL ya que excediste el número de CARTELES permitidos.";
                    $newIdPonencia = $idPonencia;
                    $errorRegistroPonencia = true;
                }
                //Ponencia
            } else if ($newIdTipoPonencia == 2) {
                if ($numeroPonenciasRegistradas < $restriccionPonencia) {

                    $resEliminarCategoriaCartel = false;
                    $resEliminarCategoriaTaller = false;
                    $resEliminarCategoriaPrototipo = false;
                    if ($oldIdTipoPonencia == 1) {
                        $consEliminarCategoriaCartel = "DELETE FROM cartel WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaCartel = mysqli_query($conexion, $consEliminarCategoriaCartel);
                    } else if ($oldIdTipoPonencia == 3) {
                        $consEliminarCategoriaTaller = "DELETE FROM taller WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaTaller = mysqli_query($conexion, $consEliminarCategoriaTaller);
                    } else if ($oldIdTipoPonencia == 4) {
                        $consEliminarCategoriaPrototipo = "DELETE FROM prototipo WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaPrototipo = mysqli_query($conexion, $consEliminarCategoriaPrototipo);
                    }

                    //Si se eliminó
                    if ($resEliminarCategoriaCartel || $resEliminarCategoriaTaller || $resEliminarCategoriaPrototipo) {
                        //Si pasa todos los filtros debe registrar el trbajo 
                        //Cartel
                        //Se subirá el trabajo
                        //Genera el id de la ponencia con el código
                        if ($numeroPonenciasCongreso < 10) {
                            $numeroPonenciasCongreso = '00' . $numeroPonenciasCongreso;
                        } else {
                            if ($numeroPonenciasCongreso < 100) {
                                $numeroPonenciasCongreso = '0' . $numeroPonenciasCongreso;
                            }
                        }

                        $newIdPonencia = $claveNueva. '-POSM' . $numeroPonenciasCongreso;
                        //Cambia el id de la ponencia
                        $consCambiarIdPonencia = "UPDATE ponencia SET id_ponencia='$newIdPonencia',id_tipo_ponencia='$newIdTipoPonencia' WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resCambiarIdPonencia = mysqli_query($conexion, $consCambiarIdPonencia);
                        //Inserta en donde debe ir
                        $consInsertarPonencia = "INSERT INTO oral(id_ponencia,extenso_oral,id_congreso) values ('$newIdPonencia','','$idCongreso')";
                        //echo "</p>".$consInsertarPonencia."</p>";
                        $resInsertarPonencia = mysqli_query($conexion, $consInsertarPonencia);
                        if ($resCambiarIdPonencia && $resInsertarPonencia) {
                            $_SESSION['info'] = "Se ha cambiado el tipo de ponencia a PONENCIA ORAL";
                        } else {
                            $errores['db-error'] = "No se pudo cambiar el tipo de ponencia a PONENCIA ORAL, comunicate error de ID.";
                        }
                    } else {
                        $errores['db-error'] = "No se pudo cambiar el tipo de ponencia a PONENCIA ORAL, comunicate con nosotros.";
                    }
                } else {
                    $errores['db-error'] = "No puedes cambiar el tipo de ponencia a PONENCIA ORAL ya que excediste el número de PONENCIAS permitidos.";
                    $newIdPonencia = $idPonencia;
                    $errorRegistroPonencia = true;
                }
                //Taller
            } else if ($newIdTipoPonencia == 3) {
                if ($numeroTalleresRegistrados < $restriccionTaller) {

                    $resEliminarCategoriaCartel = false;
                    $resEliminarCategoriaOral = false;
                    $resEliminarCategoriaPrototipo = false;
                    if ($oldIdTipoPonencia == 1) {
                        $consEliminarCategoriaCartel = "DELETE FROM cartel WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaCartel = mysqli_query($conexion, $consEliminarCategoriaCartel);
                    } else if ($oldIdTipoPonencia == 2) {
                        $consEliminarCategoriaOral = "DELETE FROM oral WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaOral = mysqli_query($conexion, $consEliminarCategoriaOral);
                    } else if ($oldIdTipoPonencia == 4) {
                        $consEliminarCategoriaPrototipo = "DELETE FROM prototipo WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaPrototipo = mysqli_query($conexion, $consEliminarCategoriaPrototipo);
                    }

                    //Si se eliminó
                    if ($resEliminarCategoriaCartel || $resEliminarCategoriaOral || $resEliminarCategoriaPrototipo) {
                        //Si pasa todos los filtros debe registrar el trbajo 
                        //Cartel
                        //Se subirá el trabajo
                        //Genera el id de la ponencia con el código
                        if ($numeroTalleresCongreso < 10) {
                            $numeroTalleresCongreso = '00' . $numeroTalleresCongreso;
                        } else {
                            if ($numeroTalleresCongreso < 100) {
                                $numeroTalleresCongreso = '0' . $numeroTalleresCongreso;
                            }
                        }

                        $newIdPonencia = $claveNueva. '-TASM' . $numeroTalleresCongreso;

                        //Cambia el id de la ponencia
                        $consCambiarTaller = "UPDATE ponencia SET id_ponencia='$newIdPonencia',id_tipo_ponencia='$newIdTipoPonencia' WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resCambiarTaller = mysqli_query($conexion, $consCambiarTaller);
                        //Inserta en donde debe ir
                        $consInsertarTaller = "INSERT INTO taller(id_ponencia,id_congreso) values ('$newIdPonencia','$idCongreso')";
                        $resInsertarTaller = mysqli_query($conexion, $consInsertarTaller);
                        if ($resCambiarTaller && $resInsertarTaller) {
                            $_SESSION['info'] = "Se ha cambiado el tipo de ponencia a TALLER";
                        } else {
                            $errores['db-error'] = "No se pudo cambiar el tipo de ponencia a TALLER, comunicate error de ID.";
                        }
                    } else {
                        $errores['db-error'] = "No se pudo cambiar el tipo de ponencia a TALLER, comunicate con nosotros.";
                    }

                } else {
                    $errores['db-error'] = "No puedes cambiar el tipo de ponencia a TALLER ya que excediste el número de TALLERES permitidos.";
                    $newIdPonencia = $idPonencia;
                    $errorRegistroPonencia = true;
                }
                //Prototipo
            } else if ($newIdTipoPonencia == 4) {
                if ($numeroPrototiposRegistrados < $restriccionPrototipo) {
                    $resEliminarCategoriaCartel = false;
                    $resEliminarCategoriaOral = false;
                    $resEliminarCategoriaTaller = false;
                    if ($oldIdTipoPonencia == 1) {
                        $consEliminarCategoriaCartel = "DELETE FROM cartel WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaCartel = mysqli_query($conexion, $consEliminarCategoriaCartel);
                    } else if ($oldIdTipoPonencia == 2) {
                        $consEliminarCategoriaOral = "DELETE FROM oral WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaOral = mysqli_query($conexion, $consEliminarCategoriaOral);
                    } else if ($oldIdTipoPonencia == 3) {
                        $consEliminarCategoriaTaller = "DELETE FROM taller WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resEliminarCategoriaTaller = mysqli_query($conexion, $consEliminarCategoriaTaller);
                    }

                    //Si se eliminó
                    if ($resEliminarCategoriaCartel || $resEliminarCategoriaOral || $resEliminarCategoriaTaller) {
                        //Si pasa todos los filtros debe registrar el trbajo 
                        //Cartel
                        //Se subirá el trabajo
                        //Genera el id de la ponencia con el código
                        if ($numeroPrototiposCongreso < 10) {
                            $numeroPrototiposCongreso = '00' . $numeroPrototiposCongreso;
                        } else {
                            if ($numeroPrototiposCongreso < 100) {
                                $numeroPrototiposCongreso = '0' . $numeroPrototiposCongreso;
                            }
                        }
                        

                        $newIdPonencia = $claveNueva. '-PRSM' . $numeroPrototiposCongreso;

                        //Cambia el id de la ponencia
                        $consCambiarPrototipo = "UPDATE ponencia SET id_ponencia='$newIdPonencia',id_tipo_ponencia='$newIdTipoPonencia' WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                        $resCambiarPrototipo = mysqli_query($conexion, $consCambiarPrototipo);
                        //Inserta en donde debe ir
                        $consInsertarPrototipo = "INSERT INTO prototipo(id_ponencia,id_congreso) values ('$newIdPonencia','$idCongreso')";
                        $resInsertarPrototipo = mysqli_query($conexion, $consInsertarPrototipo);
                        if ($resCambiarPrototipo && $resInsertarPrototipo) {
                            $_SESSION['info'] = "Se ha cambiado el tipo de ponencia a PROTOTIPO";
                        } else {
                            $errores['db-error1'] = "No se pudo cambiar el tipo de ponencia a PROTOTIPO, comunicate error de ID.";
                        }
                    } else {
                        $errores['db-error2'] = "No se pudo cambiar el tipo de ponencia a PROTOTIPO, comunicate con nosotros.";
                    }


                } else {
                    $errores['db-error3'] = "No puedes cambiar el tipo de ponencia a PROTOTIPO ya que excediste el número de PROTOTIPOS permitidos.";
                    $newIdPonencia = $idPonencia;
                    $errorRegistroPonencia = true;
                }
            } else {
                $errores['db-erro4'] = "No existe el tipo de ponencia elegida.";
            }

            print "<script>window.location='../../components/ModificarResumen/ModificaResumen.php?id=$newIdPonencia';</script>";
        } else {
            $newIdPonencia = $idPonencia;
            $newIdTipoPonencia = $oldIdTipoPonencia;
            $errorRegistroPonencia = false;
        }

        /**************************LIMITE DE LOS TRABAJOS DE LOS COAUTORES*****************************************/
        //Validacion de los trabajos por coautores
        
//echo "<br>Cuenta coautores".count($coautores)."<br>";

        if (count($coautores) > 0) {
            //Variables para validar al coautor
            $coautorExcedeTrabajosTotales = '0';
            $coautorExcedeTrabajoEspecifico = '0';
            for ($i = 0; $i <= count($coautores) - 1; $i++) {
                $idAutor = $coautores[$i]["id"];
                $nombresAutor = $coautores[$i]["nombres"];
                $rfcAutor = $coautores[$i]["rfc"];
                /** 
                 *******************************************************************************************************
                 * Hace las consultas por coautor para no dejar avanzar en la ponencia si el coautor ha excedido sus trabajos
                 * de forma General y como Coautor > Autor y Coautor 
                 * Consulta las ponencias registradas hasta el momento como COAUTOR
                 *******************************************************************************************************
                 **/
                //Todas las ponencias hasta el momento del Coautor como Autor
                $consPonenciasRegistradasValidacionCoautor = "SELECT count(*) from ponencia 
                where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso'";
                $resPonenciasRegistradasValidacionCoautor = mysqli_query($conexion, $consPonenciasRegistradasValidacionCoautor);
                $fetchPonenciasRegistradasValidacionCoautor = mysqli_fetch_assoc($resPonenciasRegistradasValidacionCoautor);
                $numeroDePonenciasRegistradasValidacionCoautor = $fetchPonenciasRegistradasValidacionCoautor['count(*)'];
                
                //Carteles
                $consNumeroCartelesRegistradosValidacionCoautor = "SELECT count(*) from ponencia 
                where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='1'";
                
                $rescNumeroCartelesRegistradosValidacionCoautor = mysqli_query($conexion, $consNumeroCartelesRegistradosValidacionCoautor);
                $fetchNumeroCartelesRegistradosValidacionCoautor = mysqli_fetch_assoc($rescNumeroCartelesRegistradosValidacionCoautor);
                $numeroCartelesRegistradosValidacionCoautor = $fetchNumeroCartelesRegistradosValidacionCoautor['count(*)'];
                //Ponencias
                $consNumeroPonenciasRegistradasValidacionCoautor = "SELECT count(*) from ponencia 
                where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='2'";

                $rescNumeroPonenciasRegistradasValidacionCoautor = mysqli_query($conexion, $consNumeroPonenciasRegistradasValidacionCoautor);
                $fetchNumeroPonenciasRegistradasValidacionCoautor = mysqli_fetch_assoc($rescNumeroPonenciasRegistradasValidacionCoautor);
                $numeroPonenciasRegistradasValidacionCoautor = $fetchNumeroPonenciasRegistradasValidacionCoautor['count(*)'];
                //Talleres
                $consNumeroTalleresRegistradosValidacionCoautor = "SELECT count(*) from ponencia 
                where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='3'";
                
                $rescNumeroTalleresRegistradosValidacionCoautor = mysqli_query($conexion, $consNumeroTalleresRegistradosValidacionCoautor);
                $fetchNumeroTalleresRegistradosValidacionCoautor = mysqli_fetch_assoc($rescNumeroTalleresRegistradosValidacionCoautor);
                $numeroTalleresRegistradosValidacionCoautor = $fetchNumeroTalleresRegistradosValidacionCoautor['count(*)'];
                //Prototipo
                $consNumeroPrototiposRegistradosValidacionCoautor = "SELECT count(*) from ponencia 
                where id_usuario_registra='$idAutor' AND id_congreso='$idCongreso' AND id_tipo_ponencia='4'";
                
                $rescNumeroPrototiposRegistradosValidacionCoautor = mysqli_query($conexion, $consNumeroPrototiposRegistradosValidacionCoautor);
                $fetchNumeroPrototiposRegistradosValidacionCoautor = mysqli_fetch_assoc($rescNumeroPrototiposRegistradosValidacionCoautor);
                $numeroPrototiposRegistradosValidacionCoautor = $fetchNumeroPrototiposRegistradosValidacionCoautor['count(*)'];
                //Todas las ponencias hasta el momento del Coautor como Coautor
                $consPonenciasRegistradasCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                                    INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                                    WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND 
                                          usuario_colabora_ponencia_18012024.id_congreso='$idCongreso'";
                $resPonenciasRegistradasCoautorValidacionCoautor = mysqli_query($conexion, $consPonenciasRegistradasCoautorValidacionCoautor);
                $fetchPonenciasRegistradasCoautorValidacionCoautor = mysqli_fetch_assoc($resPonenciasRegistradasCoautorValidacionCoautor);
                $numeroDePonenciasRegistradasCoautorValidacionCoautor = $fetchPonenciasRegistradasCoautorValidacionCoautor['count(*)'];
                //Carteles
                $consNumeroCartelesRegistradosCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                                    INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                                    WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND 
                                          usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='1'";
                $rescNumeroCartelesRegistradosCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroCartelesRegistradosCoautorValidacionCoautor);
                $fetchNumeroCartelesRegistradosCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroCartelesRegistradosCoautorValidacionCoautor);
                $numeroCartelesRegistradosCoautorValidacionCoautor = $fetchNumeroCartelesRegistradosCoautorValidacionCoautor['count(*)'];
                //Ponencias
                $consNumeroPonenciasRegistradasCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                                    INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                                    WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND 
                                          usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='2'";
                $rescNumeroPonenciasRegistradasCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroPonenciasRegistradasCoautorValidacionCoautor);
                $fetchNumeroPonenciasRegistradasCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroPonenciasRegistradasCoautorValidacionCoautor);
                $numeroPonenciasRegistradasCoautorValidacionCoautor = $fetchNumeroPonenciasRegistradasCoautorValidacionCoautor['count(*)'];
                //Talleres
                $consNumeroTalleresRegistradosCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                                    INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                                    WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND 
                                          usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='3'";
                $rescNumeroTalleresRegistradosCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroTalleresRegistradosCoautorValidacionCoautor);
                $fetchNumeroTalleresRegistradosCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroTalleresRegistradosCoautorValidacionCoautor);
                $numeroTalleresRegistradosCoautorValidacionCoautor = $fetchNumeroTalleresRegistradosCoautorValidacionCoautor['count(*)'];
                //Prototipo
                $consNumeroPrototiposRegistradosCoautorValidacionCoautor = "SELECT count(*) FROM usuario_colabora_ponencia_18012024
                                    INNER JOIN ponencia ON usuario_colabora_ponencia_18012024.id_ponencia=ponencia.id_ponencia
                                    WHERE usuario_colabora_ponencia_18012024.id_usuario='$idAutor' AND 
                                          usuario_colabora_ponencia_18012024.id_congreso='$idCongreso' AND ponencia.id_tipo_ponencia='3'";
                $rescNumeroPrototiposRegistradosCoautorValidacionCoautor = mysqli_query($conexion, $consNumeroPrototiposRegistradosCoautorValidacionCoautor);
                $fetchNumeroPrototiposRegistradosCoautorValidacionCoautor = mysqli_fetch_assoc($rescNumeroPrototiposRegistradosCoautorValidacionCoautor);
                $numeroPrototiposRegistradosCoautorValidacionCoautor = $fetchNumeroPrototiposRegistradosCoautorValidacionCoautor['count(*)'];

//echo "<br> Prototipos : ".$consNumeroPrototiposRegistradosCoautorValidacionCoautor."<br>";                
                /** 
                 *******************************************************************************************************
                 * Consulta las restricciones del numero de TRABAJOS ESPECIFICOS asignadas al Coautor
                 *******************************************************************************************************
                 **/
                $consRestriccionTrabajosValidacionCoautor = "SELECT * FROM trabajos_registrar WHERE id_usuario='$idAutor'";

                $resRestriccionTrabajosValidacionCoautor = mysqli_query($conexion, $consRestriccionTrabajosValidacionCoautor);
                $fetchRestriccionTrabajosValidacionCoautor = mysqli_fetch_assoc($resRestriccionTrabajosValidacionCoautor);
                $restriccionCartelValidacionCoautor = $fetchRestriccionTrabajosValidacionCoautor['cartel_trabajos_registrar'];
                $restriccionPonenciaValidacionCoautor = $fetchRestriccionTrabajosValidacionCoautor['ponencia_trabajos_registrar'];
                $restriccionTallerValidacionCoautor = $fetchRestriccionTrabajosValidacionCoautor['taller_trabajos_registrar'];
                $restriccionMesaValidacionCoautor = $fetchRestriccionTrabajosValidacionCoautor['mesa_redonda_trabajos_registrar'];
                $restriccionPrototipoValidacionCoautor = $fetchRestriccionTrabajosValidacionCoautor['prototipo_trabajos_registrar'];
                $limiteDePonenciasTotalesCoautor = $fetchRestriccionTrabajosValidacionCoautor['maximo_trabajos_registrar'];

                /** 
                 *******************************************************************************************************
                 * Switch que verifica todas las PONENCIAS GENERALES por coautor limite de 5 ponencias y 
                 * las especificas.
                 *******************************************************************************************************
                 **/
                $numeroDePonenciasTotalesRegistradasValidacionCoautor = $numeroDePonenciasRegistradasValidacionCoautor + $numeroDePonenciasRegistradasCoautorValidacionCoautor;
                if ($numeroDePonenciasTotalesRegistradasValidacionCoautor < $limiteDePonenciasTotalesCoautor) {
                    switch ($newIdTipoPonencia) {
                        case '1':
                            //Verifica que no rebase el limite de trabajos del coautor en tipo Cartel
                            $numeroCartelesValidacionCoautor = $numeroCartelesRegistradosValidacionCoautor + $numeroCartelesRegistradosCoautorValidacionCoautor;
                            if ($numeroCartelesValidacionCoautor >= $restriccionCartelValidacionCoautor) {
                                $coautorExcedeTrabajoEspecifico = $coautorExcedeTrabajoEspecifico + 1;
                                $errorRegistroPonencia = true;
                            }
                            break;
                        case '2':
                            //Verifica que no rebase el limite de trabajos del coautor en tipo Ponencia
                            $numeroPonenciasValidacionCoautor = $numeroPonenciasRegistradasValidacionCoautor + $numeroPonenciasRegistradasCoautorValidacionCoautor;
                            if ($numeroPonenciasValidacionCoautor >= $restriccionPonenciaValidacionCoautor) {
                                $coautorExcedeTrabajoEspecifico = $coautorExcedeTrabajoEspecifico + 1;
                                $errorRegistroPonencia = true;
                            }
                            break;
                        case '3':
                            //Verifica que no rebase el limite de trabajos del coautor en tipo Taller
                            $numeroTalleresValidacionCoautor = $numeroTalleresRegistradosValidacionCoautor + $numeroTalleresRegistradosCoautorValidacionCoautor;
                            if ($numeroTalleresValidacionCoautor >= $restriccionTallerValidacionCoautor) {
                                $coautorExcedeTrabajoEspecifico = $coautorExcedeTrabajoEspecifico + 1;
                                $errorRegistroPonencia = true;
                            }
                            break;
                        case '4':

                            //Verifica que no rebase el limite de trabajos del coautor en tipo Prototipo
                            $numeroPrototiposValidacionCoautor = $numeroPrototiposRegistradosValidacionCoautor + $numeroPrototiposRegistradosCoautorValidacionCoautor;
                            if ($numeroPrototiposValidacionCoautor >= $restriccionPrototipoValidacionCoautor) {
                                $coautorExcedeTrabajoEspecifico = $coautorExcedeTrabajoEspecifico + 1;
                                $errorRegistroPonencia = true;
                            }
                            break;
                    }
                } else {
                    $coautorExcedeTrabajosTotales = $coautorExcedeTrabajosTotales + 1;
                    $errorRegistroPonencia = true;
                }
                /** 
                 *******************************************************************************************************
                 *******************************************************************************************************
                 **/
            }
        } else {
            //En caso de que no exceda ningun coautor sus limites, los registra
            $coautorExcedeTrabajosTotales = 0;
            $coautorExcedeTrabajoEspecifico = 0;

        }

        /** 
         *******************************************************************************************************
         * Registro del trabajo
         *******************************************************************************************************
         **/
        switch ($newIdTipoPonencia) {
            case '1':
                //Ponencias
                //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                //Restriccion de los coautores

                if (count($coautores) <= $limiteCoautoresCartel) {
                    //Restriccion de los coautores tengan trbajos totales disponibles
                    if ($coautorExcedeTrabajosTotales == 0) {
                        //Restriccion de los coautores tengan trabajo especifico disponible
                        if ($coautorExcedeTrabajoEspecifico == 0) {
                            //Si pasa todos los filtros debe registrar el trbajo 
                            //Cartel
                            //Se subirá el trabajo
                            //Inserta los coautores
                            //Bucle para el registro de los coautores  
                            $infoCoautores = ". ";
                            for ($i = 0; $i <= count($coautores) - 1; $i++) {
                                $idAutor = $coautores[$i]["id"];
                                $nombresAutor = $coautores[$i]["nombres"];
                                $rfcAutor = $coautores[$i]["rfc"];
                                //Inserta nueva ponencia
                                $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia, id_usuario, id_congreso)
                                                    values('$newIdPonencia', '$idAutor', '$idCongreso')";


                                $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                $infoCoautores = " y a la de tus coautores. ";
                            }
                            if ($resEliminarCoautores) {
                                //Muestra si el registro fue exitoso y lo muestra en información.
                                $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (" . $_SESSION['correoElectronico'] . ") " . $infoCoautores;
                                $_SESSION['info'] = $info;

                            } else {
                                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                            }
                        } else {
                            $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo " . $newTipoPonencia . " ya que ha excedió el límite.";
                        }
                    } else {
                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                    }
                } else {
                    $errores['sistema-restriccion'] = "No puedes registrar más de " . $limiteCoautoresCartel . " coautores en cartel.";
                }
                break;
            case '2':
                //Carteles
                //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                //Restriccion de los coautores

                if (count($coautores) <= $limiteCoautoresPonencia) {
                    //Restriccion de los coautores tengan trbajos totales disponibles
                    if ($coautorExcedeTrabajosTotales == 0) {
                        //Restriccion de los coautores tengan trabajo especifico disponible
                        if ($coautorExcedeTrabajoEspecifico == 0) {
                            //Si pasa todos los filtros debe registrar el trbajo 
                            //Cartel
                            //Se subirá el trabajo
                            //Inserta los coautores
                            //Bucle para el registro de los coautores  
                            $infoCoautores = ". ";
                            for ($i = 0; $i <= count($coautores) - 1; $i++) {
                                $idAutor = $coautores[$i]["id"];
                                $nombresAutor = $coautores[$i]["nombres"];
                                $rfcAutor = $coautores[$i]["rfc"];
                                //Inserta nueva ponencia
                                $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia, id_usuario, id_congreso)
                                                    values('$newIdPonencia', '$idAutor', '$idCongreso')";

//echo "<br> Inserta ".$insertarColaboradorPonencia."<br>";

                                $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                $infoCoautores = " y a la de tus coautores. ";
                            }
                            if ($resEliminarCoautores) {
                                //Muestra si el registro fue exitoso y lo muestra en información.
                                $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (" . $_SESSION['correoElectronico'] . ") " . $infoCoautores;
                                $_SESSION['info'] = $info;

                            } else {
                                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                            }
                        } else {
                            $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo " . $newTipoPonencia . " ya que ha excedió el límite.";
                        }
                    } else {
                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                    }
                } else {
                    $errores['sistema-restriccion'] = "No puedes registrar más de " . $limiteCoautoresPonencia . " coautores en cartel.";
                }
                break;
            case '3':
                //Talleres
                //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                //Restriccion de los coautores

                if (count($coautores) <= $limiteCoautoresTaller) {
                    //Restriccion de los coautores tengan trbajos totales disponibles
                    if ($coautorExcedeTrabajosTotales == 0) {
                        //Restriccion de los coautores tengan trabajo especifico disponible
                        if ($coautorExcedeTrabajoEspecifico == 0) {
                            //Si pasa todos los filtros debe registrar el trbajo 
                            //Cartel
                            //Se subirá el trabajo
                            //Inserta los coautores
                            //Bucle para el registro de los coautores  
                            $infoCoautores = ". ";
                            for ($i = 0; $i <= count($coautores) - 1; $i++) {
                                $idAutor = $coautores[$i]["id"];
                                $nombresAutor = $coautores[$i]["nombres"];
                                $rfcAutor = $coautores[$i]["rfc"];
                                //Inserta nueva ponencia
                                $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia, id_usuario, id_congreso)
                                                    values('$newIdPonencia', '$idAutor', '$idCongreso')";
                                $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                $infoCoautores = " y a la de tus coautores. ";
                            }
                            if ($resEliminarCoautores) {
                                //Muestra si el registro fue exitoso y lo muestra en información.
                                $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (" . $_SESSION['correoElectronico'] . ") " . $infoCoautores;
                                $_SESSION['info'] = $info;

                            } else {
                                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                            }
                        } else {
                            $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo " . $newTipoPonencia . " ya que ha excedió el límite.";
                        }
                    } else {
                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                    }
                } else {
                    $errores['sistema-restriccion'] = "No puedes registrar más de " . $limiteCoautoresTaller . " coautores en cartel.";
                }
                $_SESSION['error'] = $errores;
                break;

            case '4':
                //Protipo
                //Se subirá el trabajo si cumple la restriccion de tipo ponencia
                //Restriccion de los coautores

                if (count($coautores) <= $limiteCoautoresPrototipo) {
                    //Restriccion de los coautores tengan trbajos totales disponibles
                    if ($coautorExcedeTrabajosTotales == 0) {
                        //Restriccion de los coautores tengan trabajo especifico disponible
                        if ($coautorExcedeTrabajoEspecifico == 0) {
                            //Si pasa todos los filtros debe registrar el trbajo 
                            //Cartel
                            //Se subirá el trabajo
                            //Inserta los coautores
                            //Bucle para el registro de los coautores  
                            $infoCoautores = ". ";
                            for ($i = 0; $i <= count($coautores) - 1; $i++) {
                                $idAutor = $coautores[$i]["id"];
                                $nombresAutor = $coautores[$i]["nombres"];
                                $rfcAutor = $coautores[$i]["rfc"];
                                //Inserta nueva ponencia
                                $insertarColaboradorPonencia = "INSERT INTO usuario_colabora_ponencia_18012024 (id_ponencia,id_usuario,id_congreso)
                                                    values('$newIdPonencia', '$idAutor', '$idCongreso')";
                                $data_check1 = mysqli_query($conexion, $insertarColaboradorPonencia);
                                $infoCoautores = " y a la de tus coautores. ";
                            }
                            if ($resEliminarCoautores) {
                                //Muestra si el registro fue exitoso y lo muestra en información.
                                $info = "Registro de trabajo exitoso. Se ha enviado un correo electrónico a la dirección (" . $_SESSION['correoElectronico'] . ") " . $infoCoautores;
                                $_SESSION['info'] = $info;

                            } else {
                                $errores['db-error'] = "Fallo mientras intentaba hacer el registro en la Base.";
                            }
                        } else {
                            $errores['sistema-restriccion'] = "Alguno de tus coautores no puede registrar más trabajos de tipo " . $newTipoPonencia . " ya que ha excedió el límite.";
                        }
                    } else {
                        $errores['sistema-restriccion'] = "Alguno de tus coautores rebasa el limite de trabajos a registrar. Ponte en contacto con ellos.";
                    }
                } else {
                    $errores['sistema-restriccion'] = "No puedes registrar más de " . $limiteCoautoresPrototipo . " coautores en cartel.";
                }
                $_SESSION['error'] = $errores;
                break;

            default:
                $errores['sistema-restriccion'] = "Selecciona un tipo de Trabajo.";
                break;

        }





        $newTituloPonencia = mysqli_real_escape_string($conexion, $_POST['titulo']);
        $newResumenPonencia = mysqli_real_escape_string($conexion, $_POST['resumen']);
        $newReferenciaPonencia = mysqli_real_escape_string($conexion, $_POST['referencia']);
        $newCategoriaPonencia = mysqli_real_escape_string($conexion, $_POST['categoria']);
        
        //Actualiza la ponencia
        $actualizarPonencia = "UPDATE ponencia SET titulo_ponencia='$newTituloPonencia',resumen_ponencia='$newResumenPonencia',
                                                   referencia_ponencia='$newReferenciaPonencia',id_categoria='$newCategoriaPonencia' 
                                WHERE id_ponencia='$newIdPonencia' AND id_congreso='$idCongreso'";
//echo "<br> Actualiza ponencia".$actualizarPonencia."<br>";                                

        $data_check = mysqli_query($conexion, $actualizarPonencia);

        if ($data_check) {
            //Crea una nueva revision para volver a estar en estatus de evaluacion
            if ($idUsuarioEvalua != '' && $errorRegistroPonencia == false) 
            {
                //Inserta una nueva revisión con el estatus de EXTENSO
                //Genera id aleatorio de revision
                $numeroAleatorio = uniqid();

                //Se genera el id a partir del Id de usuario, id ponencia y numero aleatorio
                $idGenerado = $_SESSION['id'] ."-". $newIdPonencia."-".$idCongreso."-".$numeroAleatorio;

                $insertarRevisionResumen = "INSERT INTO revision(id_revision,descripcion_revision,fecha_revision) VALUES ('$idGenerado','RESUMEN','$fechaActual')";
                $resRevisionResumen = mysqli_query($conexion, $insertarRevisionResumen);
//echo "<br> Inserta revision: ".$insertarRevisionResumen."<br>";   
//echo "<br> Inserta revision: ".$resRevisionResumen."<br>";

                if ($resRevisionResumen) 
                {
                    $info = "Se han actualizado los datos de la ponencia. Se ha enviado un correo electrónico al autor y al evaluador para su revisión.";
                    $_SESSION['info'] = $info;
                } 
                else 
                {
                    $errores['db-error'] = "fallo la creeacion.";
                }

                //Se relaciona la revision con la ponencia
                $insertaRelacionRevision = "INSERT INTO usuario_revision_ponencia(id_usuario_evalua,id_ponencia,id_revision_ponencia,id_congreso) 
                                            VALUES ('$idUsuarioEvalua','$newIdPonencia','$idGenerado',$idCongreso)";
                $resRelacionRevision = mysqli_query($conexion, $insertaRelacionRevision);
//echo "<br> Relaciona ponencia : ".$insertaRelacionRevision ."<br>";                                

            } else if ($errorRegistroPonencia == true) {
                $errores["ERROR-TRABAJO"] = "No se ha podido realizar el envío del trabajo ya que tienes algunos errores.";
            }
            //Muestra si el registro fue exitoso y lo muestra en información.
            $info = "Se han guardado los ultimos cambios que realizaste.";
            $_SESSION['info'] = $info;

        } else {
            $errores['actualizar-datos-general'] = "¡No has cambiado ningún dato!";
        }

        $_SESSION['error'] = $errores;
    }
    /** 
     *******************************************************************************************************
     * Boton quitar couator
     *******************************************************************************************************
     **/
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


} else {

    $info = '';
    $_SESSION['info'] = $info;
    $advertencia = "Las modificaciones ya se han guardado. No puedes volver a editarla. Se ha enviado al evaluador un correo para su revisión.";
}
?>