<?php

require "../../modelo/registrarCongreso.php";
require "../../modelo/traerFechasCongreso.php";

?>
<?php
if (!empty($_SESSION['info'])) {
?>
    <div id="informacionExito" class="alert alert-success alert-dismissible fade show mt-3">
        <?php echo $_SESSION['info']; ?><!--<a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>-->
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
        <!--<a href="../TrabajosRegistrados/trabajosRegistrados.php"> Ver trabajos</a>-->
    </div>
<?php
}
?>

<?php
// Traer color automatizado
$valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$color = mysqli_query($conexion, $valorColor);
$rowColor = $color->fetch_assoc();
$colorHex = $rowColor['color_congreso'];
?>

<form method="POST" id="form" enctype="multipart/form-data">
    <div class="contenedor mt-4">
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-3 d-md-block col-md-5 d-sm-block col-sm-10 mb-3">
                <input id="nuevoCongreso" name="nuevoCongreso" class="btn pe-5 ps-5" type="button" value="Nuevo Congreso" style="background-color: <?php echo $colorHex; ?>; color: #FFF !important;">
            </div>
            <div class="col-xl-3 col-lg-3 d-md-block col-md-4 d-sm-block col-sm-12 col-xs-block col-xs-12">
                <!--------BOTON GUARDAR INPUT------------->
                <input style="display:none; background-color: <?php echo $colorHex; ?>; color: #FFF !important;" id="botonGuardarNuevoCongreso" name="botonGuardarNuevoCongreso" class="btn pe-5 ps-5" type="submit" value="Crear Congreso">
            </div>
        </div>
        <div class="botonAct">
            <a href="modificarCongreso.php" class="btn pe-5 ps-5" id="actualizarDatos" style="background-color: <?php echo $colorHex; ?>; color: #FFF !important;">Actualizar Congreso Actual</a>
        </div>
        <div id="nuevo" class="nuevo" style="display:none;">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modalidad del Congreso</label>
                    <input name="modalidadCongreso" class="form-control" id="exampleFormControlInput1" placeholder="">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 mb-3">
                    <!--Boton para subir o seleccionar nueva foto-->
                    <!-- <label for="inputFoto" class="form-label">Logo del Congreso</label>
                    <input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control" name="inputLogo" id="inputFotoPerfil"> -->
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-2">
                    <img src="../../src/question.png" class="imgQuestion" alt="">
                    <div class="d-inline-block col-8"><span class="textoAdvertencia">La modalidad del congreso debe ser Virtual, Presencial o Hibrida</span></div>
                </div>
            </div>
            <h4>Correo del Nuevo Congreso de Matemáticas</h4>
            <div class="campos-correo">
                <div class="campo-email">
                    <div class="col-auto">
                        <label for="inputMail" class="col-form-label">E-mail del Congreso</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="inputMail" name="inputMail" class="form-control input-email" aria-describedby="emailHelp">
                    </div>
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            Nuevo correo con el que se trabajará en el congreso.
                        </span>
                    </div>
                </div>
                <div class="campo-email">
                    <div class="col-auto">
                        <label for="inputMail" class="col-form-label">Contraseña de aplicación del Nuevo Correo</label>
                    </div>
                    <div class="col-auto">
                        <input type="password" id="inputPass" name="inputPass" class="form-control input-email" aria-describedby="emailHelp">
                        <input type="checkbox" onclick="mostrarContrasena()" class="check-pass">
                        <span class="form-text">
                            Mostrar Contraseña
                        </span>
                    </div>
                </div>
            </div>
            <h4>Fecha de las Actividades</h4>
            <div class=" head row mt-3 col-xl-10 col-lg-10 col-md-12 d-none d-sm-block mt-4  p-3  rounded" style="background-color: <?php echo $colorHex; ?> !important; color: #FFF !important;">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-4" >
                        <span>Descripcion del evento</span>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4"><span>Fecha de Inicio</span></div>
                    <div class="col-xl-3 col-lg-3 col-md-4"><span>Fecha Limite</span></div>
                </div>

            </div>
            <div class="row col-xl-10 col-lg-10 col-md-12 d-none d-sm-block mt-2 border border-success p-3 border-opacity-10 rounded">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-4 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Envío Invitaciones Y Convocatoria</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mb-3">
                        <input name="fecha1Inicio" type="date" class="dates form-control" id="uno" placeholder="col-form-label" value="<?php echo $fechasCongreso[1]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mb-3">
                        <input name="fecha1Fin" type="date" class="dates form-control" id="uno" placeholder="col-form-label" value="<?php echo $fechasCongreso[1]['fechaFin'] ?>" />
                    </div>
                </div>

                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Recepción De Resúmenes De Trabajos</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha2Inicio" type="date" class="dates form-control" id="dos" placeholder="col-form-label" value="<?php echo $fechasCongreso[2]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha2Fin" type="date" class="dates form-control" id="dos" placeholder="col-form-label" value="<?php echo $fechasCongreso[2]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Evaluación De Resúmenes Por Parte Del Comité</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha3Inicio" type="date" class="dates form-control" id="tres" placeholder="col-form-label" value="<?php echo $fechasCongreso[3]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha3Fin" type="date" class="dates form-control" id="tres" placeholder="col-form-label" value="<?php echo $fechasCongreso[3]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Resultado De Evaluación De Resúmenes</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha4Inicio" type="date" class="dates form-control" id="cuatro" placeholder="col-form-label" value="<?php echo $fechasCongreso[4]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha4Fin" type="date" class="dates form-control" id="cuatro" placeholder="col-form-label" value="<?php echo $fechasCongreso[4]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Recepción De Corrección De Resúmenes</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha5Inicio" type="date" class="dates form-control" id="cinco" placeholder="col-form-label" value="<?php echo $fechasCongreso[5]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha5Fin" type="date" class="dates form-control" id="cinco" placeholder="col-form-label" value="<?php echo $fechasCongreso[5]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mb-3 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Recepción De Trabajos En Extenso</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha6Inicio" type="date" class="dates form-control" id="seis" placeholder="col-form-label" value="<?php echo $fechasCongreso[6]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha6Fin" type="date" class="dates form-control" id="seis" placeholder="col-form-label" value="<?php echo $fechasCongreso[6]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Notificación De Observaciones De Los Trabajos En Extenso</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha7Inicio" type="date" class="dates form-control" id="siete" placeholder="col-form-label" value="<?php echo $fechasCongreso[7]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha7Fin" type="date" class="dates form-control" id="siete" placeholder="col-form-label" value="<?php echo $fechasCongreso[7]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Inicia El Periodo De Recepción De Pagos</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha8Inicio" type="date" class="dates form-control" id="ocho" placeholder="col-form-label" value="<?php echo $fechasCongreso[8]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha8Fin" type="date" class="dates form-control" id="ocho" placeholder="col-form-label" value="<?php echo $fechasCongreso[8]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Recepción De Extensos Finales</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha9Inicio" type="date" class="dates form-control" id="nueve" placeholder="col-form-label" value="<?php echo $fechasCongreso[9]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha9Fin" type="date" class="dates form-control" id="nueve" placeholder="col-form-label" value="<?php echo $fechasCongreso[9]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Recepción De Videos De Las Ponencias Aceptadas</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha10Inicio" type="date" class="dates form-control" id="diez" placeholder="col-form-label" value="<?php echo $fechasCongreso[10]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha10Fin" type="date" class="dates form-control" id="diez" placeholder="col-form-label" value="<?php echo $fechasCongreso[10]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Publicación Del Programa General Del Evento</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha11Inicio" type="date" class="dates form-control" id="once" placeholder="col-form-label" value="<?php echo $fechasCongreso[11]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha11Fin" type="date" class="dates form-control" id="once" placeholder="col-form-label" value="<?php echo $fechasCongreso[11]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Periodo De Impartición De Talleres En Línea</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha12Inicio" type="date" class="dates form-control" id="doce" placeholder="col-form-label" value="<?php echo $fechasCongreso[12]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha12Fin" type="date" class="dates form-control" id="doce" placeholder="col-form-label" value="<?php echo $fechasCongreso[12]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Fecha Del Congreso</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha13Inicio" type="date" class="dates form-control" id="trece" placeholder="col-form-label" value="<?php echo $fechasCongreso[13]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha13Fin" type="date" class="dates form-control" id="trece" placeholder="col-form-label" value="<?php echo $fechasCongreso[13]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Inicia El Envío De Constancias Virtuales</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha14Inicio" type="date" class="dates form-control" id="catorce" placeholder="col-form-label" value="<?php echo $fechasCongreso[14]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha14Fin" type="date" class="dates form-control" id="catorce" placeholder="col-form-label" value="<?php echo $fechasCongreso[14]['fechaFin'] ?>" />
                    </div>
                </div>
                <div class="row border-top">
                    <div class="col-6 col-xl-6 col-lg-6 col-md-4 mt-3 mb-3">
                        <label for="uno" class="col-xl-10 col-form-label">Publicación De Las Memorias Del Congreso</label>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha15Inicio" type="date" class="dates form-control" id="quince" placeholder="col-form-label" value="<?php echo $fechasCongreso[15]['fechaInicio']; ?>" />
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 mt-3 mb-3">
                        <input name="fecha15Fin" type="date" class="dates form-control" id="quince" placeholder="col-form-label" value="<?php echo $fechasCongreso[15]['fechaFin'] ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="row">
        <div class="col-xl-3 col-lg-3 d-md-block col-md-4 d-sm-block col-sm-12 col-xs-block col-xs-12 mt-3">
            <!--------BOTON EDITAR INPUT------------->
            <input style="display:none;" id="editarCongreso" name="editarCongreso" class="btn btn-azul pe-5 ps-5" type="button" value="Editar Fechas">
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 col-xs-block col-xs-12 mt-3">
            <!--------BOTON EDITAR INPUT------------->
            <input style="display:none;" id="actualizarCongreso" name="actualizarCongreso" class="btn btn-azul pe-5 ps-5" type="submit" value="Actualizar Fechas">
        </div>
    </div>
</form>

<script>
    const formulario = document.getElementById("form");
    const dates = document.querySelectorAll(" .dates");
    const inputs = document.querySelectorAll("#form");


    var nuevoCongreso = document.getElementById("nuevoCongreso");
    var actualizarDatos = document.getElementById("actualizarDatos");
    var cancelarNuevoCongreso = document.getElementById("cancelarNuevoCongreso");
    var botonGuardarNuevoCongreso = document.getElementById("botonGuardarNuevoCongreso");
    var editarCongreso = document.getElementById("editarCongreso");
    var actualizarCongreso = document.getElementById("actualizarCongreso");

    //Funcion para deshabilitar los campos
    function deshabilitarDates(date) {
        date.disabled = true;
    }

    function habilitarDates(date) {
        date.disabled = false;
    }
    //Funcion que limpia todos los valores de la fecha
    function limpiarDates(date) {
        date.value = "00-00-00";
    }
    //Deshabilita los campos al iniciar ya que se actualizarán
    dates.forEach(deshabilitarDates);

    //Boton para crear nuevo congreso

    nuevoCongreso.addEventListener('click', function() {
        if (botonGuardarNuevoCongreso.style.display == "block") {
            nuevo.style.display = "none";
            actualizarDatos.style.display = "block";
            editarCongreso.style.display = "block";
            botonGuardarNuevoCongreso.style.display = "none";
            nuevoCongreso.value = "Nuevo Congreso";
            dates.forEach(deshabilitarDates);
            window.location.reload();
        } else {
            nuevo.style.display = "block";
            actualizarDatos.style.display = "none";
            editarCongreso.style.display = "none";
            botonGuardarNuevoCongreso.style.display = "block";
            nuevoCongreso.value = "Cancelar";
            dates.forEach(limpiarDates);
            dates.forEach(habilitarDates);
        }

    });


    //Botones para editar el congreso
    editarCongreso.addEventListener('click', function() {
        if (actualizarCongreso.style.display == "block") {
            // actualizarCongreso.style.display = "none";
            // editarCongreso.value = "Editar Fechas";
            nuevoCongreso.style.display = "block";
            dates.forEach(deshabilitarDates);
            window.location.reload();
        } else {
            // actualizarCongreso.style.display = "block";
            // editarCongreso.value = "Cancelar";
            nuevoCongreso.style.display = "none";
            dates.forEach(habilitarDates);
        }

    });


    //Funcion genera los radios hecha por mi. 
    const fechaActual = (e) => {
        const fecha = new Date();
        diaActual = fecha.getDate().toString().padStart(2, '0');
        mesActual = (fecha.getMonth() + 1).toString().padStart(2, '0');
        añoActual = fecha.getFullYear();
        var fechaActual = `${añoActual}-${mesActual}-${diaActual}`;
        console.log(fechaActual);

        if (e.target.name != 'modalidadCongreso' && e.target.name != 'actualizarCongreso' && e.target.name != 'botonGuardarNuevoCongreso') {
            e.target.value = fechaActual;
        }



    }

    //Función para pasar minúsculas a mayúsculas.
    function minusculaAMayuscula(e) {
        //Guarda el valor de los input en un texto para hacerlo mayúscula.
        const texto = e.target.value;
        e.target.value = texto.toUpperCase();
    }

    //Listeners
    //Listener para cambiar de minúscula a mayúscula.
    inputs.forEach((input) => {
        input.addEventListener("keyup", minusculaAMayuscula);
        //input.addEventListener("keyup",validarFormulario);
    });

    window.addEventListener('load', function() {
        dates.forEach((date) => {
            date.addEventListener('click', function() {
                fechaActual(event);
                //date.value="2022-10-12"
            });
            //fechaActual;
        });

    });

    //Valida que no se reenvie el formulario
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }


    /*
    //Listener para cambiar de minúscula a mayúscula.
    dates.forEach((date)=>{
    	date.addEventListener("keyup",fechaActual);
        //date.addEventListener("keyup",validarInputNo);
    });
    */

   // Funcion para mostrar contraseña
   function mostrarContrasena() {
            var x = document.getElementById("inputPass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
</script>
