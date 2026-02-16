<?php
require "../../modelo/plantillaResumenTraerDatos.php";
//unset($_SESSION['coautores']);
//unset($coautores);
?>


<?php
if (isset($_SESSION['info'])) {
?>
    <div id="informacionExito" class="alert alert-success alert-dismissible fade show mt-3">
        <?php print "<script>alert(\" Registro de trabajo exitoso. Se ha enviado un correo electrónico al autor y coautores.\");window.location='../TrabajosRegistrados/trabajosRegistrados.php';</script>";
        exit;
        echo $_SESSION['info']; ?><a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a> o <a href="../subirResumen/subirResumen.php"> subir otro trabajo</a>

    </div>
<?php
}
?>
<?php
if (count($errores) > 0) {
?>
    <div id="informacionError" class="alert alert-danger alert-dismissible fade show mt-3">
        <?php
        foreach ($errores as $showerror) {
            echo $showerror;
        }
        ?>
        <a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>
    </div>
<?php
}
?>
<form class="g-3 needs-validation mt-5" method="POST" id="formulario">
    <!-------AUTOR--------------->
    <div class="row mt-4">


        <style type="text/css">


        </style>
        <div class="col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12">
            <label for="validationCustom02" class="form-label subtitulos">Autor</label>
            <input id="autor" name="autor" type="text" class="form-control" id="validationCustom02" required value="<?php echo $fetch['nombres_usuario'] . ' ' . $fetch['apellidos_usuario']; ?>" disabled>
        </div>
        <div class="d-flex col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12">
            <div class="mt-4 d-flex align-self-end">
                <img style="cursor: pointer" src="../../src/question.png" class="imgQuestion me-2" alt="" data-toggle="tooltip" data-placement="right" title="Como autor solo tu tendras derecho de hacer correcciones al trabajo">
                <!--<span class="span-textos ">Como autor solo tu tendras derecho de hacer correcciones al trabajo</span>-->
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-1 d-sm-none d-md-block"></div>
    </div>


    <!-----------COAUTORES--------------->
    <div class="row mt-4">
        <div class="col-xl-8 col-lg-8 d-md-block col-md-12 col-sm-block col-sm-12">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 d-sm-block col-sm-12 mb-3">
                    <label for="validationCustom02" class="form-label subtitulos">RFC coautores</label>
                    <!--------COAUTOR INPUT------------->
                    <input type="text" class="form-control" id="coautor" name="coautor">
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 d-sm-block col-sm-12 ">
                    <div class=" mt-4">
                        <input name="botonAgregarCoautor" id="botonAgregarCoautor" class="btn pt-1 pb-1 ps-5 pe-5 btn-azul" type="submit" value="Agregar">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 d-md-block col-md-12 d-sm-block col-sm-12">
                    <div class="mt-4 d-flex align-self-end">
                        <img style="cursor: pointer" src="../../src/question.png" class="imgQuestion me-2" alt="" data-toggle="tooltip" data-placement="right" title="Registra tus coautores ingresando el RFC de cada uno de ellos.">
                        <!--<span class="span-textos ">Registra tus coautores ingresando el RFC de cada uno de ellos.</span>-->
                    </div>
                </div>
            </div>


            <!------------LISTA DE COAUTORES------------->
            <div class="row mt-4">
                <div class="col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 mb-3">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col"><input class="btn btn-sm" style="color:red" type="submit" name="botonQuitarCoautores" id="botonQuitarCoautores" value="Quitar Todos X">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $_SESSION['coautores'] = $coautores;
                            if (isset($_SESSION['coautores']) && !empty($_SESSION['coautores'])) {
                                foreach ($_SESSION['coautores'] as $indice => $coautores_) {
                                    $posicion_array = $indice;
                                    if ($coautores_ != null) {

                            ?>
                                        <tr>
                                            <td>
                                                <?= $coautores_['nombres'] ?>
                                                <?= $coautores_['apellidos'] ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <button value="<?= $posicion_array ?>" class="btn btn-small btn-danger" type="submit" name="botonQuitarCoautor" id="botonQuitarCoautor">
                                                    <i class="fa-solid fa-user-xmark"></i></button>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

    <!-------------------------------------------------->

    <div class="col-xl-6 col-lg-6 d-md-block col-md-12 d-sm-block col-sm-12">
        <div class="mt-4 d-flex align-self-end">
            <img style="cursor: pointer" src="../../src/question.png" class="imgQuestion me-2" alt="" data-toggle="tooltip" data-placement="right" title="Es necesario que los coautores se encuentren registrados en la plataforma, podrás realizar correcciones, ellos van a poder ver el estatus de la ponencia.">
            <!--<span class="span-textos ">Es necesario que los coautores 
            se encuentren registrados en la plataforma, podrás realizar correcciones, ellos van a poder ver el estatus de la ponencia.
            Se permiten maximo:
            <ul>
                <li>Cuatro coautores por ponencia oral.</li>
                <li>Tres coautores por cartel </li>
                <li>Dos coautores por taller.</li>
                <li>Cinco coautores por prototipo.</li>
            </ul>
            </span>-->
        </div>

        <div class="col-xl-2 col-lg-2 d-md-none d-lg-block  d-sm-none d-md-block mb-4"></div>
    </div>
    </div>
    <div class="container">
        <div class="row mt-3 ">
            <div class="col-xl-2 col-lg-2 d-md-inline col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mt-2">
                <div class="d-grid">
                    <button type="button" name="btn-cartel" id="btn-cartel" class="btn btn-tipo-ponencia p-2" disabled>Cartel</button>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 d-md-inline col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mt-2">
                <div class="d-grid">
                    <button type="button" name="btn-ponencia" id="btn-ponencia" class="btn btn-tipo-ponencia p-2" >Ponencia</button>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 d-md-inline col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mt-2">
                <div class="d-grid">
                    <button type="button" name="btn-taller" id="btn-taller" class="btn btn-tipo-ponencia p-2" >Taller</button>
                </div>
            </div>
             <!--Para registrar prototipos-->
            <div class="col-xl-2 col-lg-2 d-md-inline col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mt-2">
                <div class="d-grid">
                    <button type="button" name="btn-prototipo" id="btn-prototipo" class="btn btn-tipo-ponencia p-2" disabled>Prototipo</button>
                </div>
            </div>
        </div>
    

        <?php
        /*Obtiene el numero de trabajos que puede meter un usuario en particular*/
        require "../../modelo/mRRestriccionTrabajoUsuario.php";

        ?>
        
<div class="mt-3">
    <img src="../../src/question.png" class="imgQuestion" alt="">
    <span class="span-textos mb-4">Recuerda que solo podrás ser autor o coautor en:
    <ul>
        <li><?php echo $restriccionCartel; ?> carteles </li>
        <li><?php echo $restriccionPonencia; ?> ponencias orales</li>
              <li><?php echo $restriccionTaller; ?> taller</li>
      <!--  <li><?php echo $restriccionPrototipo; ?> prototipo.</li>-->
    </ul>
            Y podrás participar en un máximo de <?php echo $limiteDePonenciasTotales; ?> trabajos</span>
</div>
                
                        <!-------------FORMULARIO ------------>




        <!---------TIPO------------->
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12 mt-2">
                <label for="categoria" class="form-label subtitulos">Tipo</label>
                <!--------TIPO INPUT------------->
                <input type="text" class="form-control" id="tipo" name="tipo" readonly value='<?php echo $_SESSION['tipo_ponencia']; ?>'>
            </div>

            <!---------CATEGORIA------------->
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12 mt-2">
                    <label for="categoria" class="form-label subtitulos">Categoria</label>
                    <select class="form-select" id="categoria" name="categoria" required>
                        <?php
                        echo "</p> Categorias (plantillaResumen.php linea 209) : ".$categorias."</p>";
                        $res2 = mysqli_query($conexion, $categorias);
                        while ($fetch2 = mysqli_fetch_assoc($res2)) {
                            $idCategoria = $fetch2["id_categoria"];
                            $categoria = $fetch2["categoria"];
                            if ($idCategoria == $_SESSION["id_categoria_ponencia"]) {
                                echo $idCategoriaPonencia;
                        ?>
                                <option selected value="<?php echo $idCategoria; ?>" name="<?php echo $idCategoria; ?>">
                                    <?php echo $categoria; ?>
                                </option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $idCategoria; ?>" name="<?php echo $idCategoria; ?>">
                                    <?php echo $categoria; ?>
                                </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex col-xl-4 col-lg-4 col-md-5 d-ms-block col-sm-12 mt-3">
                    <div class=" d-flex align-self-end d-inline">
                        <img style="cursor: pointer" src="../../src/question.png" class="imgQuestion me-2" alt="" data-toggle="tooltip" data-placement="right" title="Selecciona la categoria que más se adecue a tu ponencia.">
                        <!--<span class="span-textos ">Selecciona la categoria que más se adecue a tu ponencia.</span>-->
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-1 d-sm-none d-md-block"></div>
            </div>

            <!---------TITULO------------->
            <div class="row mt-4">
                <div class="col-xl-4 col-lg-4 col-md-6 d-ms-block col-sm-12">
                    <label for="titulo" class="form-label subtitulos">Titulo</label>
                    <!--------TITULO INPUT------------->
                    <input type="text" class="form-control" id="titulo" name="titulo" value='<?php echo $_SESSION['titulo_ponencia']; ?>'>
                    <!--------ADVERTENCIA TITULO------------->
                    <span id="formulario_informacion_titulo" class="span-textos mt-2 formulario_input-error">El titulo
                        no debe exeder 15 palabras</span>
                    <!--------MUESTRA LAS PALABRAS RESTANTES------------->
                    <span id="contadorTitulo" class="span-textos">0 de 15</span>
                </div>
                <div class="d-flex col-xl-4 col-lg-4 col-md-5 d-ms-block col-sm-12 mt-3">
                    <div class="d-flex d-inline align-self-end">
                        <img style="cursor: pointer" src="../../src/question.png" class="imgQuestion me-2" alt="" data-toggle="tooltip" data-placement="right" title="Tu titulo debera reflejar el contenido de la ponencia">
                        <!--<span class="span-textos">Tu titulo debera reflejar el contenido de la ponencia</span>-->
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
                        <textarea spellcheck="true" lang="es" class="form-control" rows="15" id="resumen" name="resumen"><?php echo $_SESSION['resumen_ponencia']; ?></textarea>
                    </div>
                    <!--------ADVERTENCIA RESUMEN------------->
                    <span id="formulario_informacion_resumen" class="span-textos formulario_input-error">El resumen no
                        debe exceder de 250 palabras</span>
                    <!--------MUETSRA LAS PALABRAS RESTANTES------------->
                    <!-- <span id="contadorResumen" class="span-textos">0 de 250</span>-->
                    <span id="contadorResumen" class="span-textos">0 de 250</span>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 d-sm-block col-sm-12">
                    <div class="mt-2 d-flex d-inline">
                        <img style="cursor: pointer" src="../../src/question.png" class="imgQuestion me-2" alt="" data-toggle="tooltip" data-placement="right" title="Refleja en una síntesis del trabajo los objetivos, el sustento teórico, la metodología o desarrollo y los resultados o conclusiones.">
                        <!--<span class="span-textos">Refleja en una síntesis del trabajo los objetivos, el sustento teórico, la metodología o desarrollo y los resultados o conclusiones.</span>-->
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 d-sm-none d-md-block">
            </div>
            </div>
            <script>
                // Cargue la biblioteca Typo.js
            </script>

            <!--------REFERENCIAS------------->
            <div class="row mt-4">
                <div class="col-xl-7 col-lg-7 col-md-7 d-sm-block col-sm-12 mb-3">
                    <label for="referencia" class="form-label subtitulos">Referencias</label>
                    <!--------REFERENCIAS INPUT------------->
                    <input type="text" class="form-control" id="referencia" name="referencia" value='<?php echo $_SESSION['referencia_ponencia']; ?>'>
                    <!--------ADVERTENCIA REFERENCIAS------------->
                    <span id="formulario_informacion_referencia" class="span-textos formulario_input-error">Las
                        referencias no deberan exeder las 50 palabras </span>
                    <!--------MUETSRA LAS PALABRAS RESTANTES------------->
                    <span id="contadorReferencia" class="span-textos">0 de 50</span>
                </div>
                <div class="d-flex col-xl-3 col-lg-3 col-md-3 d-sm-block col-sm-12">
                    <div class="d-flex d-inline align-self-end">
                        <img style="cursor: pointer" src="../../src/question.png" class="imgQuestion me-2" alt="" data-toggle="tooltip" data-placement="right" title="Es necesario que las citas y referencias se encuentren en formato APA (American Psychological Association)">
                        <!--<span class="span-textos ">Es necesario que las citas y referencias se encuentren en formato APA (American Psychological Association)</span>-->
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 d-sm-none d-md-block "></div>
            </div>
            <!--
    <div class="col-12 mt-4">
        
        <input class="btn pt-1 pb-1 ps-5 pe-5 btn-azul mt-2" type="button" id="botonGuardarResumen" value="Guardar Resumen">
        <input class="btn pt-1 pb-1 ps-5 pe-5 btn-azul mt-2" type="button" id="botonNuevoResumen" value="Limpiar Campos">
        <div class="d-flex col-xl-3 col-lg-3 col-md-3 d-sm-block col-sm-12 mt-4">
            <div class="d-flex d-inline align-self-end">
                <img src="../../src/question.png" class="imgQuestion me-2" alt="">
                <span class="span-textos ">Al presionar Guardar el resumen no se enviará, se guardará para que puedas terminarlo cuando tengas tiempo.</span>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 d-sm-none d-md-block "></div>
    </div>
    <div class="col-12 my-5">
            -->

        </div>

        <!--------BOTON PARTICIPAR INPUT------------->
        <a href=""><input id="botonParticipar" name="botonParticipar" class="btn btn-azul ps-5 pe-5 my-5" type="submit" value="Participar" disabled></a>

    </div>

</form>
