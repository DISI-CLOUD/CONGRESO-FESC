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
include '../../modelo/conexion.php';
//Trae el congreso más reciente
$consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
$resCongreso = mysqli_query($conexion, $consCongreso);
$fetchCongreso = mysqli_fetch_assoc($resCongreso);
// Traer usuario y contraseña
$modalidadCongreso = $fetchCongreso['modalidad_congreso'];
$correoCongreso = $fetchCongreso['correo_congreso'];

// Traer color automatizado
$valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$color = mysqli_query($conexion, $valorColor);
$rowColor = $color->fetch_assoc();
$colorHex = $rowColor['color_congreso'];
?>
<div class="contenedor mt-4">
    <form method="POST" action="../../modelo/actualizarCongresoDatos.php">
        <div id="nuevo" class="nuevo">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modalidad del Congreso</label>
                    <input name="modalidadCongreso" class="form-control" id="exampleFormControlInput1" value="<?php echo $modalidadCongreso; ?>" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-2">
                    <img src="../../src/question.png" class="imgQuestion" alt="">
                    <div class="d-inline-block col-8"><span class="textoAdvertencia">La modalidad del congreso debe ser Virtual, Presencial o Hibrida</span></div>
                </div>
            </div>
            <div class="botones">
                <input type="submit" value="Actualizar Modalidad" class="btn pe-5 ps-5" name="actModalidad" style="background-color: <?php echo $colorHex; ?>; color: #FFF !important;">
                <a href="registrarCongreso.php" class="btn pe-5 ps-5" style="background-color: <?php echo $colorHex; ?>; color: #FFF !important;">Cancelar</a>
            </div>
        </div>
    </form>
    <form method="POST" action="../../modelo/actualizarCongresoDatos.php">
        <div id="nuevo" class="nuevo">
            <h4 style="margin-top: 25px;">Actualizar Correo del Congreso de Matemáticas</h4>
            <label>Es necesario <b>registrar nuevamente</b> la <b>contraseña de aplicación</b> del congreso.</label>
            <div class="campos-correo" style="margin-top: 20px;">
                <div class="campo-email">
                    <div class="col-auto">
                        <label for="inputMail" class="col-form-label">E-mail del Congreso</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="inputMail" name="inputMail" class="form-control input-email" aria-describedby="emailHelp" value="<?php echo $correoCongreso; ?>" required>
                    </div>
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            Nuevo correo con el que se trabajará en el congreso.
                        </span>
                    </div>
                </div>
                <div class="campo-email">
                    <div class="col-auto">
                        <label for="inputMail" class="col-form-label">Contraseña del Nuevo Correo</label>
                    </div>
                    <div class="col-auto">
                        <input type="password" id="inputPass" name="inputPass" class="form-control input-email" aria-describedby="emailHelp" required>
                        <input type="checkbox" onclick="mostrarContrasena()" class="check-pass">
                        <span class="form-text">
                            Mostrar Contraseña
                        </span>
                    </div>
                </div>
            </div>
            <div class="botones">
                <input type="submit" value="Actualizar Correo" class="btn btn-azul pe-5 ps-5" name="actCorreo" style="background-color: <?php echo $colorHex; ?>; color: #FFF !important;">
                <a href="registrarCongreso.php" class="btn btn-azul pe-5 ps-5" style="background-color: <?php echo $colorHex; ?>; color: #FFF !important;">Cancelar</a>
            </div>
        </div>
    </form>
    <div class="info-final">
        <h4>Nota:</h4>
        <p class="form-text" style="font-size: 16px;">Para actualizar fechas, logo, banner, nombre del congreso, entre otros, diríjase al apartado de "Diseño de Página".</p>
        <a href="../../components/cambiarDiseño/cambiarDiseño.php" class="btn btn-azul pe-5 ps-5 botonDiseno" style="background-color: <?php echo $colorHex; ?>; color: #FFF !important;">Diseño Página</a>
    </div>
</div>

<script>
    // Funcion para mostrar contraseña
    function mostrarContrasena() {
        var x = document.getElementById("inputPass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        var inputs = document.querySelectorAll('input'); // Selecciona todos los elementos input

        // Agrega el event listener a cada input
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        });
    });
</script>