<?php

require "../../modelo/evaluarResumen.php";
$idPonencia = $_GET['id'];

if ($idPonencia == '') {
    print "<script>window.location='/cbb/index.php';</script>";
}

?>
<?php
if (!empty($_SESSION['info'])) {
?>
    <div id="informacionExito" class="alert alert-success alert-dismissible fade show mt-3">
        <?php echo $_SESSION['info']; ?><br><a href="../TrabajosAsignados/trabajosAsignados.php"> Ver trabajos asignados</a>
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
        <?php echo $_SESSION['info']; ?><a href="../TrabajosAsignados/trabajosAsignados.php"> Ver trabajos asignados</a>
    </div>
<?php
}
?>
<form id="formulario" method="POST">

    <div class="row mt-5">
        <div class="col-12">
            <a target="_blank" href="../VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia ?>&visualizacion=2">Ver Resumen</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-10 col-lg-10 col-md-12 d-sm-block col-md-12">
            <table class="container table border-top border-end border-start mt-4">
                <thead>
                    <tr class=" d-flex text-center table-head">
                        <th scope="col" class="col-xl-12 col-lg-12 col-md-12">Observaciones Generales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <textarea name="comentarioGeneral" id="resultado" rows="10" class="col-12" onkeydown="return evitarEnter(event)"></textarea>
                        </th>
                    </tr>
                </tbody>
            </table>
            <span id="contadorPalabras"><b></b></span>
        </div>
        <div class="col-2"></div>
    </div>

    <div class="row">
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <div class="row d-flex justify-content-center ">
                <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mb-3">
                    <div class="d-grid">
                        <!---------BOTON FINALIZAR---->
                        <input onclick="confirmar(event)" class="btn btn-style" type="submit" name="rechazar" value="Rechazar">
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 d-xs-block col-xs-12 mb-3">
                    <div class="d-grid ">
                        <!---------BOTON CANCELAR---->
                        <input onclick="confirmar2(event)" class="btn btn-style" type="submit" name="aprobar" value="Aprobar">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 d-md-none d-lg-block d-sm-none d-md-block"></div>
    </div>
</form>

<script>
    const formulario = document.getElementById("formulario");
    const inputs = document.querySelectorAll("#formulario");


    document.addEventListener("DOMContentLoaded", function() {
        const textarea = document.getElementById("resultado");
        const contadorPalabras = document.getElementById("contadorPalabras");
        const rechazarBtn = document.querySelector('input[name="rechazar"]');
        const aprobarBtn = document.querySelector('input[name="aprobar"]');

        function actualizarContador() {
            const texto = textarea.value.trim();
            const palabras = texto === "" ? 0 : texto.split(/\s+/).length;

            contadorPalabras.textContent = `${palabras} de 80`;

            if (palabras > 80) {
                rechazarBtn.disabled = true;
                aprobarBtn.disabled = true;
                contadorPalabras.style.color = 'red';
            } else {
                rechazarBtn.disabled = false;
                aprobarBtn.disabled = false;
                contadorPalabras.style.color = '';
            }
        }

        textarea.addEventListener("input", actualizarContador);

        actualizarContador(); // Actualizar el contador al cargar la página con texto preexistente
    });


    /*
    //Función para pasar minúsculas a mayúsculas.
    function minusculaAMayuscula(e){
    	//Guarda el valor de los input en un texto para hacerlo mayúscula.
    	const texto=e.target.value;
    	e.target.value=texto.toUpperCase();
    }

    //Listeners
    //Listener para cambiar de minúscula a mayúscula.
    inputs.forEach((input)=>{
    	input.addEventListener("keyup",minusculaAMayuscula);
    	//input.addEventListener("keyup",validarFormulario);
    });
    */

    function evitarEnter(event) {
        // Si se presiona la tecla Enter (código 13), evita el salto de línea
        if (event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    function confirmar(event) {
        if (!confirm('¿Esta seguro de RECHAZAR este resumen?')) {
            event.preventDefault();
        }
    }

    function confirmar2(event) {
        if (!confirm('¿Esta seguro de ACEPTAR este resumen?')) {
            event.preventDefault();
        }
    }
</script>