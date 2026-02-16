<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    header("Location: ../../components/inicioSesion/sesion.php");
}
require_once('../../modelo/actualizarPerfilGeneral.php');
/*
    if(time()-$_SESSION['time']>30){
        session_destroy();
        header('location: /cbbcongress/components/inicioSesion/sesion.php');
    }*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

</head>
<header>
    <?php
    require_once('../../Layouts/nav.php');
    require '../../modelo/completarPerfil.php';
    //Verifica que el usuario tenga su perfil completado

    if ($estadoUsuario == '') {
        $info = "No tienes registrados tus datos laborales o tu nivel académico. Debes completar tú perfil para acceder a todas las funciones del sitio. Al completar tu perfil debes cerrar la sesión y volverla a iniciar para habilitar las funciones.";
        $_SESSION['datosAdicionales'] = $info;
    } else if ($estadoUsuario == 'I') {
        $info = "La vigencia de tu semblanza ha expirado. Debes ir a tus datos académicos para actualizar tu semblanza para acceder a todas las funciones del sitio. Al completar tu perfil debes cerrar la sesión y volverla a iniciar para habilitar las funciones.";
        $_SESSION['datosAdicionales'] = $info;
    } else {
        $info = '';
        $_SESSION['datosAdicionales'] = $info;
    }




    ?>
</header>

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                <?php
                require_once('../../Layouts/sidebar.php');
                ?>

            </div>
            <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                <div class="container">
                    <div class="container p-2 my-5 justify-content-right"> <!--Contenedor Titulo-->
                        <h1>Perfil de <?php echo $nombresUsuario //Asigna el nombre
                                        ?></h1>
                        <p>Información relevante sobre ti</p>
                    </div>

                    <?php
                    if (strlen($_SESSION['datosAdicionales']) > 1) {
                    ?>
                        <div class="alert alert-warning position-static" role="alert">
                            <h4 class="alert-heading">Completar perfil</h4>
                            <p>Aún no has completado tu perfil.</p>
                            <hr>
                            <p class="mb-0"><?php echo $_SESSION['datosAdicionales']; ?></p>
                            <a href="../DatosAcademicos/academicos.php"> Datos académicos</a>
                            <span>o</span>
                            <a href="../DatosLaborales/laborales.php"> Datos laborales</a>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    require '../../modelo/traerDatosPerfil.php';

                    ?>
                    <div class="container p-2 my-5 justify-content-right"> <!--Contenedor Foto de Perfil-->
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 p-3">
                                    <h2>Foto de perfil</h2>
                                    <div class="row-sm-1 p-4">
                                        <?php
                                        //Asigna la foto de usuario correpondiente
                                        if (!empty($_SESSION["correoElectronico"])) {
                                        ?>
                                            <img src="<?php echo $_SESSION["foto"] ?>" class="rounded-circle" alt="Foto de Perfil" width="250" height="250">
                                        <?php } ?>
                                    </div>
                                    <p><span style="color: #767676;">Suba un archivo .jpg o .png. Se recomienda un tamaño de 256px x 256px y no más de 1.5 mb</span></p>
                                </div>
                                <div class="col-sm-4 p-2">
                                    <div class="row p-2">
                                        <?php // Traer color automatizado
                                        $valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
                                        $color = mysqli_query($conexion, $valorColor);
                                        $rowColor = $color->fetch_assoc();
                                        $colorHex = $rowColor['color_congreso'];
                                        ?>
                                        <input id="botonCambiarFoto" name="botonCambiarFoto" type="button" class="btn btn-style-chico shadow p-1 col-8" value="Cambiar foto" style="background-color: <?php echo $colorHex; ?>!important;">
                                        <input style="display:none;" id="botonGuardarFoto" name="botonGuardarFoto" type="submit" class="btn btn-style-chico shadow p-1 col-8 mt-3" value="Guardar foto">
                                        <div id="myDIV" style="border:1px; display:none;" class="myDIV mt-3"><input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control" name="inputFotoPerfil" id="inputFotoPerfil"> <!--Boton para subir o seleccionar nueva foto--></div>
                                    </div>

                                    <div class="row p-2">
                                        <input type="submit" class="btn btn-outline-danger col-8" id="botonEliminarFoto" name="botonEliminarFoto" value="Eliminar foto">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="container p-2 my-5 justify-content-right"> <!--Contenedor datos usuario-->
                        <div class="col-sm-6 p-3">
                            <form id="formulario" class="formulario" action="perfil.php" method="POST">
                                <?php
                                if (strlen($_SESSION['info']) > 1) {
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
                                <!--Grupo Nombres-->
                                <div class="mb-3" id="formulario_grupo_nombres">
                                    <label for="nombres" class="form-label">Nombres</label>
                                    <input class="form-control" type="text" id="nombres" name="nombres" placeholder="Escribe tus nombres" maxlength="90" onkeypress="return validarNombres(event)" value="<?php echo $nombresUsuario //Consulta los datos del usuario en la sesion
                                                                                                                                                                                                            ?>" aria-label="nombres" disabled>
                                    <p class="formulario_input-error" id="formulario_informacion_nombres">El nombre no debe contener más de dos espacios y máximo 90 caractéres.</p>
                                </div>
                                <!--Grupo Apellidos-->
                                <div class="mb-3 formulario_grupo">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input class="form-control" type="text" id="apellidos" name="apellidos" maxlength="90" placeholder="Escribe tus apellidos" onkeypress="return validarApellidos(event)" value="<?php echo $apellidosUsuario //Consulta los datos del usuario en la sesion
                                                                                                                                                                                                                    ?>" aria-label="apellidos" disabled>
                                    <p class="formulario_input-error" id="formulario_informacion_apellidos">Los apellidos no deben contener más de dos espacios y máximo 90 caractéres.</p>

                                </div>
                                <!--Grupo RFC-->
                                <div class="mb-3 formulario_grupo">
                                    <label for="rfc" class="form-label">RFC/ID</label>
                                    <a href="https://www.mi-rfc.com.mx/consulta-rfc-homoclave"><img id="rfcInformacion" class="rfcInformacion viewPassword imagenQuestion" src="../../src/question.png" alt="" data-toggle="tooltip" data-placement="right" title="¿No sabes cuál es tu RFC? Consúltalo dando click aquí."></a>
                                    <input class="form-control" type="text" id="rfc" name="rfc" maxlength="30" placeholder="Escribe tu RFC/ID" onkeypress="return validarRfc(event)" value="<?php echo $rfcUsuario //Consulta los datos del usuario en la sesion
                                                                                                                                                                                            ?>" aria-label="rfc" disabled>
                                    <p class="formulario_input-error" id="formulario_informacion_rfc">El RFC no debe exceder de 30 caractéres.</p>
                                </div>
                                <!--Grupo Correo Electrónico-->
                                <div class="row">
                                    <div class="col">
                                        <label for="correoElectronico" class="form-label" maxlength="90">Correo electrónico</label>
                                        <input class="form-control" type="text" id="correoElectronico" placeholder="Escribe tu correo" name="correoElectronico" onkeypress="return validarCorreo(event)" value="<?php echo $emailUsuario //Consulta los datos del usuario en la sesion
                                                                                                                                                                                                                ?>" aria-label="correoElectronico" disabled>
                                        <p class="formulario_input-error is-valid" id="formulario_informacion_correoElectronico">Esta dirección no tiene formato de correo válido. (ejemplo@ejemplo.com)</p>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2 div_boton align-items-center justify-content-center p-4">
                                            <img id="cambioDeEmail" class="cambioDeEmail viewPassword imagenQuestion" src="../../src/question.png" alt="" data-toggle="tooltip" data-placement="right" title="Al cambiar de email, tambien tendras que volver a verificar tu cuenta"></a>
                                            <input type="button" class="btn btn-outline-danger" value="Cambiar" id="botonCambiarCorreo" name="botonCambiarCorreo">
                                            <input type="submit" class="btn btn-style-chico shadow p-1" value="Guardar" id="botonGuardarCorreo" name="botonGuardarCorreo" style="display:none;" disabled>
                                        </div>
                                    </div>
                                </div>
                                <!--Grupo Número de Teléfono-->
                                <div class="row mb-3 formulario_grupo">
                                    <label for="phone" class="form-label" maxlength="90">Número de teléfono</label>

                                    <div class="col">
                                        <input class="form-control" type="text" id="telefono" name="telefono" placeholder="Escribe tu telefono" onkeypress="return validarTelefono(event)" value="<?php echo $telefonoUsuario //Consulta los datos del usuario en la sesion
                                                                                                                                                                                                    ?>" aria-label="numeroTelefono" disabled>
                                        <!-- Codigos de area para futura implementacion con WhatsApp
                                <input id="phone" type="tel" name="phone" class="border border-success rounded py-2 border-opacity-10 phone"  value='<?php echo $telefonoUsuario //Consulta los datos del usuario en la sesion
                                                                                                                                                        ?> '/>
                                -->
                                        <p class="formulario_input-error " id="formulario_informacion_telefono">Esto no es un número de telefono válido.</p>
                                    </div>

                                </div>

                                <!--Grupo Cambiar Datos-->
                                <div class="mb-1 div_boton align-items-center justify-content-center">
                                    <input class="btn btn-style-chico shadow p-1 px-5" type="button" name="botonCambiarDatos" id="botonCambiarDatos" value="Cambiar datos" style="background-color: <?php echo $colorHex; ?>!important;">
                                    <input class="btn btn-style-chico shadow p-1 px-5" style="display:none;" type="submit" name="botonGuardar" id="botonGuardar" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!--  <script defer src="./index.js"></script> -->
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
    <script src="perfil.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</body>
<script>
    function getIp(callback) {
        fetch('https://ipinfo.io/json?token=<your token>', {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then((resp) => resp.json())
            .catch(() => {
                return {
                    country: 'us',
                };
            })
            .then((resp) => callback(resp.country));
    }
    var phoneInput = null;

    const phoneInputField = document.querySelector("#phone");
    if( phoneInputField != null){
        phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    }
    

    function process(event) {
        event.preventDefault();

        const phoneNumber = phoneInput.getNumber();

    }
</script>

</html>
