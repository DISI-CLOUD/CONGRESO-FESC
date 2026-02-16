<!DOCTYPE html>
<html lang="es">

<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Verificar código</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css">
    <style>
        .requisito-cumplido {
            color: green !important;
            font-weight: bold !important;
        }
    </style>
</head>

<body>
    <!--Centra el formulario a la mitad de la pantalla-->
    <div class="container full-screen d-flex align-items-center justify-content-center vh-100">
        <div class="row registro p-sm-10">
            <div class="col">
            </div>
            <div class="col-md-12 col-lg-5 col-xl-5 formulario_container">
                <?php 
                session_start();
                if (isset($_SESSION['usuarioNuevo']) && $_SESSION['usuarioNuevo'] == 1) {
                ?>
                    <div class="my-5 d-flex justify-content align-items-center">
                        <span class="h1 text-secondary"><u>Registro 2/4</u></span>
                        <img id="rfcInformacion" style="cursor: pointer; width: 25px; height: 25px;" class="mx-3 rfcInformacion viewPassword imagenQuestion" src="../../src/question.png" alt="" data-toggle="tooltip" data-placement="right" title="El registro consta de 4 pasos, te encuentras en el 2/4, verificar tu cuenta de correo y poner una contraseña.">
                    </div>
                <?php  } ?>
                <h1 class="">Código de verificación</h1>
                <hr class="mb-4" />
                <form id="formulario" class="formulario" method="POST" autocomplete="off">
                    <?php
                    $errores = [];
                    if (isset($_SESSION['info'])) {
                    ?>
                        <div id="informacionExito" class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($errores) > 0) {
                    ?>
                        <div id="informacionError" class="alert alert-danger text-center">
                            <?php
                            foreach ($errores as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <label for="codigoVerificaion" class="form-label">Código de verificación</label>
                    <input type="text" class="form-control input mb-3" id="codigoVerificaion" name="codigoVerificaion" autocomplete="off" placeholder="Ingresa el código de verificación">
                    <label for="contrasena" class="form-label">Nueva contraseña</label>
                    <input type="password" class="form-control input mb-3" id="contrasena" name="contrasena" autocomplete="off" placeholder="Escribe tu nueva contraseña" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-])[A-Za-z\d!@#$%^&*()_+\-]{8,}$" required>
                    <div class="instruccion">
                        <p>La nueva contraseña debe contener:</p>
                        <ul>
                            <li id="reqCaracteres">Mínimo 8 caracteres</li>
                            <li id="reqEspecial">Al menos un carácter especial</li>
                            <li id="reqNumero">Al menos un número</li>
                            <li id="reqMayuscula">Una letra mayúscula</li>
                        </ul>
                    </div>
                    <label for="verificarContrasena" class="form-label">Verificar contraseña</label>
                    <input type="password" class="form-control input mb-3" id="verificarContrasena" name="verificarContrasena" placeholder="Escribe tu nueva contraseña" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-])[A-Za-z\d!@#$%^&*()_+\-]{8,}$" required>
                    <div class="row">
                        <div class="col-4 mt-4">
                            <a href="../../components/crearCuenta/cuenta.php"><img id="volver" class="volver" src="../../src/back.png" onclick="" data-placement="right">Volver</a>
                        </div>
                        <div class="col-8">
                            <button name="verificar" id="verificar" type="submit" class="btn btn boton mt-4" disabled>Verificar código</button>
                        </div>
                    </div>
                </form>
                <?php
                require 'datosVerificacion.php';
                ?>
            </div>
            <div class="imagen_container p-0 d-none d-lg-block col-md-5 col-lg-5 col-xl-5 rounded">
                <img class="imagen" src="../../src/unamRC.jpeg">
            </div>
        </div>
    </div>
    <script>
        const formulario = document.getElementById("formulario");
        const contrasena = document.getElementById("contrasena");
        const contrasena2 = document.getElementById("verificarContrasena");
        const verificar = document.getElementById("verificar");

        const campos = {
            hash: false,
            contrasena: false,
            contrasena2: false
        };

        const validarCampo = (expresion, input, campo) => {
            if (expresion.test(input.value)) {
                campos[campo] = true;
            } else {
                campos[campo] = false;
                verificar.disabled = true;
            }
        };

        const validarFormulario = (e) => {
            switch (e.target.name) {
                case "hash":
                    validarCampo(expresiones.correo, e.target, "hash");
                    break;
            }
        };

        const contrasenaLlena = () => {
            if (contrasena.value.length >= 8) {
                campos.contrasena = true;
            } else {
                campos.contrasena = false;
                verificar.disabled = true;
            }
        };

        const inputs = [contrasena, contrasena2];

        inputs.forEach((input) => {
            input.addEventListener("keyup", validarFormulario);
        });

        formulario.addEventListener("keyup", (e) => {
            e.preventDefault();
            if (campos.hash) {
                verificar.disabled = false;
            }
        });

        const expresiones = {
            correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
        };

        const contrasenaInput = document.getElementById('contrasena');
        const verificarContrasenaInput = document.getElementById('verificarContrasena');
        const verificarButton = document.getElementById('verificar');

        const checkPasswordMatch = () => {
            const contrasenaValue = contrasenaInput.value;
            const verificarContrasenaValue = verificarContrasenaInput.value;

            if (contrasenaValue === verificarContrasenaValue) {
                verificarButton.disabled = false;
                contrasenaInput.style.borderColor = 'green';
                verificarContrasenaInput.style.borderColor = 'green';
            } else {
                verificarButton.disabled = true;
                contrasenaInput.style.borderColor = 'red';
                verificarContrasenaInput.style.borderColor = 'red';
            }
        };

        contrasenaInput.addEventListener('input', checkPasswordMatch);
        verificarContrasenaInput.addEventListener('input', checkPasswordMatch);

        const verificarRequisitos = () => {
            const contrasenaValue = contrasenaInput.value;

            const reqCaracteres = document.getElementById('reqCaracteres');
            const reqEspecial = document.getElementById('reqEspecial');
            const reqNumero = document.getElementById('reqNumero');
            const reqMayuscula = document.getElementById('reqMayuscula');

            reqCaracteres.classList.toggle('requisito-cumplido', contrasenaValue.length >= 8);
            reqEspecial.classList.toggle('requisito-cumplido', /[!@#$%^&*()_+\-]/.test(contrasenaValue));
            reqNumero.classList.toggle('requisito-cumplido', /\d/.test(contrasenaValue));
            reqMayuscula.classList.toggle('requisito-cumplido', /[A-Z]/.test(contrasenaValue));
        };

        contrasenaInput.addEventListener('input', verificarRequisitos);
    </script>

</body>

</html>
