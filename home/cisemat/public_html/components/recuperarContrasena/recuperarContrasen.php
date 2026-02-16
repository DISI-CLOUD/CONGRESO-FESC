<!DOCTYPE html>
<html lang="en">

<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Recuperar contraseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!--Centra el formulario a la mitad de la pantalla-->
    <div class="container full-screen d-flex align-items-center justify-content-center vh-100">
        <div class="row registro p-sm-10">
            <div class="col">
            </div>
            <div class="col-md-12 col-lg-5 col-xl-5 formulario_container">
                <h1 class="">Restablecer contraseña</h1>
                <hr class="mb-4" />
                <?php
                require 'recuperarContrasena.php';
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

                <p class="instruccion">Escriba su correo electrónico y, en caso de tener una cuenta, recibirá
                    instrucciones para restablecer su contraseña.</p>
                <form id="formulario" class="formulario" action="recuperarContrasena.php" method="POST">
                    <label for="correoElectronico" class="form-label">Correo electrónico</label>
                    <input type="text" class="form-control input mb-3" id="correoElectronico" name="correoElectronico"
                        placeholder="Escribe tu correo" onkeypress="return validarCorreo(event)" required>
                    <div class="row">
                        <div class="col-4 mt-4">
                            <a href="#!" onclick="history.back()"><img id="volver" class="volver"
                                    src="../../src/back.png" data-placement="right">Volver</a>
                        </div>
                        <div class="col-8">
                            <button id="restablecerContrasena" name="restablecerContrasena" type="submit"
                                class="btn btn boton mt-4">Restablecer contraseña</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            include("../../modelo/conexion.php");
            $sql = $conexion->query("SELECT ruta FROM imagenescrearcuenta WHERE id_imagen = 3");
            $rutaPass = $sql->fetch_object();
            $ruta=$rutaPass->ruta;            
            if($ruta == ""){
                $default="../../src/ImgCrearCuenta/defaultScreen.jpg";
                $ruta=$default;
            }
            ?>
            <div class="imagen_container p-0 d-none d-lg-block col-md-5 col-lg-5 col-xl-5">
                <img class="imagen rounded-end" src="<?= $ruta  ?>">
            </div>
            <div class="col">
            </div>
        </div>
    </div>
    <!--Referencia al archivo de JavaScript al final para que se carguen los componentes-->
    <script src="recuperarContrasena.js"></script>
</body>

</html>