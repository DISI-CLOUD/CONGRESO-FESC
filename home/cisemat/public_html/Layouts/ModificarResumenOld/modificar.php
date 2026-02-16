<?php
    require "../../modelo/modificaResumen.php";
    $idPonencia=$_GET['id'];
    if($idPonencia==''){
        print "<script>window.location='/cbb/index.php';</script>";
    
    }
    $_SESSION['idPonenciaEditar']=$idPonencia;

    //Trae los datos especificos de la ponencia
    $consPonencia = "SELECT * FROM ponencia WHERE id_ponencia='$idPonencia'";
    $resPonencia = mysqli_query($conexion, $consPonencia);
    $fetchPonencia=mysqli_fetch_assoc($resPonencia);

    $tituloPonencia=$fetchPonencia['titulo_ponencia'];
    $resumenPonencia=$fetchPonencia['resumen_ponencia'];
    $referenciasPonencia=$fetchPonencia['referencia_ponencia'];
    $idEvaluador=$fetchPonencia['id_usuario_evalua'];
    //unset($_SESSION['coautores']);
    //unset($coautores);

    //Consulta si tiene coautores la ponencia
    $consCoautorPonencia = "SELECT * FROM  usuario_colabora_ponencia WHERE id_ponencia='$idPonencia'";
    $resCoautorPonencia = mysqli_query($conexion, $consCoautorPonencia);
    
    //Trae los datos de coautores de la ponencia
    $consCoautores = "SELECT * FROM  usuario_colabora_ponencia 
    INNER JOIN usuario ON usuario_colabora_ponencia.id_usuario=usuario.id_usuario WHERE usuario_colabora_ponencia.id_ponencia='$idPonencia'";
    $resCoautores = mysqli_query($conexion, $consCoautores);
    //$fetch=mysqli_fetch_assoc($resCoautores);
    $coautores=array();
    if(mysqli_num_rows($resCoautores)>0){
        $i=0;
        while($fetchCoautores = mysqli_fetch_assoc($resCoautores)){
            $coautores[$i]['nombres']=$fetchCoautores['nombres_usuario'];
            $coautores[$i]['rfc']=$fetchCoautores['rfc_usuario'];
            $coautores[$i]['id']=$fetchCoautores['id_usuario'];
            $i=$i+1;
        }
    }
?>

<div class="mt-3">
    <img src="../../src/question.png" class="imgQuestion" alt="">
    <span class="span-textos mb-4">Recuerda que solo podrás ser autor o coautor de 3 trabajos de este tipo; Y de N trabajos como maximo</span>
</div>
<!-------------FORMULARIO ------------>
<form class="g-3 needs-validation mt-5" method="POST" action="" id="formulario" novalidate>
<?php 
    if(strlen($_SESSION['info'])>1){
        ?>
        <div id="informacionExito" class="alert alert-success text-center">
            <?php echo $_SESSION['info']; ?>
            <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
        </div>
        <?php
    }
    ?>
    <?php
    if(count($errores) > 0){
        ?>
        <div id="informacionError" class="alert alert-warning text-center">
            <?php
            foreach($errores as $showerror){
                echo $showerror;
            }
            ?>
            <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
        </div>
        <?php
    }
?>                        
    <!---------CATEGORIA------------->
    <div class="row">
    <div class="col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12 mt-2">
        <label for="categoria" class="form-label subtitulos">Categoria</label>
        <select disabled class="form-select" id="categoria" name="categoria" required>
            <option disabled>Selecciona una opción</option>
            <?php
                while($fetch2 = mysqli_fetch_assoc($res2)){
                    $idCategoria=$fetch2["id_categoria"];
                    $categoria=$fetch2["categoria"];
                    if($idCategoria==$fetchPonencia['id_categoria']){
            ?>
                <option selected value="<?php echo $idCategoria; ?>" name="<?php echo $idCategoria; ?>"><?php echo $categoria; ?></option>
            <?php
                    }else{
                        ?>
                        <option value="<?php echo $idCategoria; ?>" name="<?php echo $idCategoria; ?>"><?php echo $categoria; ?></option>
                    <?php
                    }
                }
            ?>
        </select>
    </div>

    <div class="d-flex col-xl-4 col-lg-4 col-md-5 d-ms-block col-sm-12 mt-3">
        <div class=" d-flex align-self-end d-inline">
            <img src="../../src/question.png" class="imgQuestion me-2" alt="">
            <span class="span-textos ">Selecciona la categoria que más se adecue a tu ponencia.</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-1 d-sm-none d-md-block"></div>
    </div>

    <!---------TITULO------------->
    <div class="row mt-4">
        <div class="col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12">
            <label for="titulo" class="form-label subtitulos">Titulo</label>
            <!--------TITULO INPUT------------->
            <input disabled type="text" class="form-control" id="titulo" name="titulo" required value="<?php echo $tituloPonencia; ?>">
            <!--------ADVERTENCIA TITULO------------->
            <span id="formulario_informacion_titulo" class="span-textos mt-2 formulario_input-error">El titulo no debe exeder 15 palabras</span>
            <!--------MUETSRA LAS PALABRAS RESTANTES------------->
            <span id="contadorTitulo" class="span-textos">0 de 15</span>
        </div>
        <div class="d-flex col-xl-4 col-lg-4 col-md-5 d-ms-block col-sm-12">
            <div class="d-flex d-inline align-self-end">
                <img src="../../src/question.png" class="imgQuestion me-2" alt="">
                <span class="span-textos">Tu titulo debera reflejar el contenido de la ponencia</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-1 d-sm-none d-md-block"></div>
    </div>

    <!--------RESUMEN------------->
    <div class="row mt-4">
        <div class="col-xl-8 col-lg-8 col-md-8 d-sm-block col-sm-12 mb-3">
            <div class="mb-3">
                <label for="resumen" class="form-label subtitulos">Resumen</label>
                <!--------RESUMEN INPUT------------->
                <textarea spellcheck="true" disabled class="form-control" rows="15" id="resumen" name="resumen" required><?php  echo $resumenPonencia ?></textarea>
            </div>
            <!--------ADVERTENCIA RESUMEN------------->
            <span id="formulario_informacion_resumen" class="span-textos formulario_input-error">El resumen debe ser entre 150 y 250 palabras</span>
            <!--------MUETSRA LAS PALABRAS RESTANTES------------->
            <span id="contadorResumen" class="span-textos">0 de 15</span>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 d-sm-block col-sm-12">
            <div class="mt-2 d-flex d-inline">
                <img src="../../src/question.png" class="imgQuestion me-2" alt="">
                <span class="span-textos">Refleja en una síntesis del trabajo los objetivos, el sustento teórico, la metodología o desarrollo y los resultados o conclusiones.</span>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 d-sm-none d-md-block">
        </div>
    </div>      

    <!--------REFERENCIAS------------->
    <div class="row mt-4">
        <div class="col-xl-7 col-lg-7 col-md-7 d-sm-block col-sm-12 mb-3">
            <label for="referencia" class="form-label subtitulos">Referencias</label>
            <!--------REFERENCIAS INPUT------------->
            <input disabled type="text" class="form-control" id="referencia" name="referencia" required value="<?php echo $referenciasPonencia ?>">
             <!--------ADVERTENCIA REFERENCIAS------------->
            <span id="formulario_informacion_referencia" class="span-textos formulario_input-error">Las referencias no deberan exeder las 50 palabras </span>
            <!--------MUETSRA LAS PALABRAS RESTANTES------------->
            <span id="contadorReferencia" class="span-textos">0 de 15</span>
        </div>
        <div class="d-flex col-xl-3 col-lg-3 col-md-3 d-sm-block col-sm-12">
            <div class="d-flex d-inline align-self-end">
                <img src="../../src/question.png" class="imgQuestion me-2" alt="">
                <span class="span-textos ">Es necesario que las citas y referencias se encuentren en formato APA (American Psychological Association)</span>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 d-sm-none d-md-block "></div>
    </div>

    <!-------AUTOR--------------->
    <div class="row mt-4">
    <div class="col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12">
            <label for="validationCustom02" class="form-label subtitulos">Autor</label>
            <input id="autor" name="autor" type="text" class="form-control" id="validationCustom02" value="<?php echo $fetch['nombres_usuario']; ?>" disabled>
        </div>
        <div class="d-flex col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12">
        <div class="mt-4 d-flex align-self-end">
            <img src="../../src/question.png" class="imgQuestion me-2" alt="">
            <span class="span-textos ">Como autor solo tu tendras derecho de hacer correcciones al trabajo</span>
        </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-1 d-sm-none d-md-block"></div>
    </div>
    <!-----------OMITIDO--------------->
    <!-----------COAUTORES--------------->
    <div class="row mt-4">
        <div class="col-xl-8 col-lg-8 d-md-block col-md-12 col-sm-block col-sm-12">
            <!--
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 d-sm-block col-sm-12 mb-3">
                    <label for="validationCustom02" class="form-label subtitulos">Coautores</label>
                    
                    <select name="selectCoautor" class="form-select" id="categoria" required>
                        <option disabled>Selecciona una opción</option>
                        <?php
                        /*
                            while($fetch3 = mysqli_fetch_assoc($res3)){
                                $idAutor=$fetch3["id_usuario"];
                                $nombresAutor=$fetch3["nombres_usuario"];
                                $rfcAutor=$fetch3["rfc_usuario"];
                        ?>
                            <option selected value="<?php echo $idAutor; ?>" name="<?php echo $idAutor; ?>"><?php echo $rfcAutor; ?></option>
                        <?php
                            }*/
                        ?>
                    </select>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 d-sm-block col-sm-12 ">
                    <div class=" mt-4">
                    <input name="botonAgregarCoautor" class="btn pt-1 pb-1 ps-5 pe-5 btn-azul" type="submit" value="Agregar">
                    </div>
                </div>
            </div>
            -->
    <!------------LISTA DE COAUTORES-------------> 
            <div class="row mt-4">
                <div class="col-xl-5 col-lg-5 col-md-6 d-sm-block col-sm-12 mb-3">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //$_SESSION['coautores']=$coautores;
                            if(count($coautores)!=0){
                                for($i=0;$i<=count($coautores)-1;$i ++){
                                    //$idAutor=$coautores["id"];
                                    $nombresAutor=$coautores[$i]["nombres"];
                                    //$rfcAutor=$coautores["rfc"];
                            ?>
                                <tr>
                                    <td><?php echo $coautores[$i]["nombres"]; ?></td>
                                </tr>   
                            <?php }
                            }                                    
                        ?>    
                    </tbody>
                </table>
                </div>
                <div class="d-flex col-xl-2 col-lg-2 col-md-2 d-sm-block col-sm-12 mb-3 ">
                    <!--
                    <div class=" d-flex align-self-end">
                    <input  class="btn btn-rojo " type="submit" name="botonQuitarCoautor" value="Quitar">
                    </div>
                    -->
                </div>
                <!------------------------------>
            </div>
        </div>
<!-------------------------------------------------->

       <!--<div class="col-xl-3 col-lg-3 d-md-block col-md-12 d-sm-block col-sm-12">
            <div class="mt-4 d-flex">
            <img src="../../src/question.png" class="imgQuestion me-2" alt="">
            <span class="span-textos ">Es necesario que los coautores 
            se encuentren registrados en la plataforma, no podran realizar correcciones, pero si podran ver 
            el estatus de la ponencia.
            Se permiten maximo cuatro coautores por ponencia oral 
            o cartel y, solo uno por taller </span>
        </div>

        <div class="col-xl-2 col-lg-2 d-md-none d-lg-block  d-sm-none d-md-block mb-2"></div>
        </div>-->
    </div>
    <div class=" row mt-4">
        <div class="col-xl-3 col-lg-3 d-md-block col-md-4 d-sm-block col-sm-12 col-xs-block col-xs-12 mt-3">
            <!--------BOTON  EDITAR INPUT------------->
            <button id="botonEditar" name="botonEditar" class=" btn btn-azul ps-5 pe-5 ms-3" type="button" onclick="conteoGeneral()">Editar</button>
        </div>
        </form>
        <?php
            if($idEvaluador==''){
        ?>
            <div class="col-xl-3 col-lg-3 d-md-block col-md-4 d-sm-block col-sm-12 col-xs-block col-xs-12 mt-3">
                <!--------BOTON GUARDAR INPUT------------->
                <input disabled id="botonGuardar" name="botonGuardar" class=" btn btn-azul ps-5 pe-5 ms-3" type="submit" value="Guardar">    
            </div> 
        <?php
            }else{
        ?>
            <div class="col-xl-3 col-lg-3 d-md-block col-md-4 d-sm-block col-sm-12 col-xs-block col-xs-12 mt-3">
                <!--------BOTON GUARDAR INPUT------------->
                <input onclick="confirmar(event)" disabled id="botonGuardar" name="botonGuardar" class=" btn btn-azul ps-5 pe-5 ms-3" type="submit" value="Guardar">    
            </div>                
        <?php
            }
        ?>
        <div class="col-xl-3 col-lg-3 d-md-block col-md-4 d-sm-block col-sm-12 col-xs-block col-xs-12 mt-3">
        <input id="botonCancelar" name="botonCancelar" class=" btn btn-dorado ps-5 pe-5 ms-3 " type="button" value="Cancelar" onClick="history.go(-1);">
        </div>
        

    </div>
    </div>




