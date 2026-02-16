<?php require_once "../../modelo/crearCuenta.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Cuenta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="./styles.css?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('rcaptcha', {
                'sitekey': '6Le-LBcjAAAAAAJ1FfWNwbOONpcYMYZ_XMIfmE9m'
            });
        };
    </script>


</head>

<body>
    <div class="mascara-blur" id="mascara-blur"></div>
    <div class="mascara-privacidad" id="mascara-privacidad"></div>

    <div class="container mt-4 content-flag" id="content-flag">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="important-ad">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="alert-heading w-100"><strong>Anuncio Importante:</strong></h4>
                        <i class="fas fa-times px-1" id="close-flag"></i>
                    </div>
                    <h4>Incompatibilidad con Mozilla Firefox</h4>
                    <p><br><br>Por favor, ten en cuenta que nuestra página web no es compatible actualmente con Mozilla Firefox. Te sugerimos utilizar otro navegador como Google Chrome, Microsoft Edge u Opera para acceder a nuestros servicios. Lamentamos las molestias y agradecemos tu comprensión.</p>
                    <p><br><br>Gracias.</p>
                    <p><strong>CISEyAM</strong></p>
                </div>
            </div>
        </div>
    </div>


    <div class="privacy-notice" id="privacy-notice">
        <div class="content">
            <h2>AVISO DE PRIVACIDAD DE LA FACULTAD DE ESTUDIOS SUPERIORES CUAUTITLÁN DE LA UNAM</h2>
            <div class="scrollable-content" id="scrollable-content">
                <?php include "../../components/avisoPrivacidad/correoCongreso.php"; ?>

                <!-- Aqui comienza el aviso de privacidad, se puede modificar -->
        <p><br>Antes de proporcionarnos tus datos personales, tómate un momento para leer el siguiente Aviso de Privacidad en el que informamos, de conformidad con lo dispuesto por el Reglamento de Transparencia, Acceso a la información Pública y Protección de Datos Personales para la Universidad Nacional Autónoma de México (en adelante "LA UNAM"), sobre cómo y con qué fines tratamos tu información personal.</p>
        <p>Al proporcionar tus datos daremos por entendido que estás de acuerdo con los términos de este Aviso, las finalidades del tratamiento de los datos, así como los medios y procedimiento que ponemos a tu disposición para ejercer tus derechos de acceso, rectificación, cancelación y oposición en la sección V de este Aviso de Privacidad.</p>

        <p><strong><br>1. Fundamento legal universitario</strong></p>
        <p>Artículos del 12 al 19 del Reglamento de Transparencia, Acceso a la Información Pública y Protección de Datos Personales para la UNAM.</p>

        <p><strong><br>II. Identidad y domicilio de la responsable</strong></p>
        <p>El Departamento de Matemáticas de la Facultad de Estudios Superiores Cuautitlán de la UNAM, ubicado en el edificio A8, planta baja.</p>

        <p><strong><br>III. Datos personales que trata la FES CUAUTITLAN.</strong></p>
        <p>Los datos personales que solicita el departamento de matemáticas son: nombre y apellidos, RFC, correo electrónico vigente, número de teléfono, y posiblemente una clave de acceso. Además, se requieren datos académicos y laborales pertinentes. Asimismo, se sugiere adjuntar una foto de perfil para facilitar la identificación.</p>

        <p><strong><br>IV. Transferencia de datos personales</strong></p>
        <p>La FES CUAUTITLÁN UNAM no realizará transferencia alguna de los datos que recaba y sólo transmitirá los datos necesarios en los casos previstos en la Ley Federal de Transparencia y Acceso a la Información y en el Reglamento de Transparencia, Acceso a la Información Pública y Protección de Datos Personales para la Universidad Nacional Autónoma de México. En especial, la FESC UNAM transferirá sus datos personales a aquellas dependencias o entidades que forman parte de LA UNAM. Le informamos que dicha transferencia no requiere de su consentimiento conforme a la normatividad porque las instituciones que forman parte de LA UNAM operan bajo la misma reglamentación universitaria.</p>

        <p><strong><br>V. Medios y procedimientos para ejercer sus derechos ARCO y/o revocar el consentimiento</strong></p>
        <p>Usted o su representante legal podrá ejercer cualquiera de los derechos de acceso, rectificación, cancelación u oposición (en lo sucesivo "Derechos ARCO"), así como revocar su consentimiento para el tratamiento de sus datos personales enviando un correo electrónico a la oficina del Departamento de matemáticas:</p>
        <p><a href="mailto:<?php echo strtolower($correoCongreso); ?>"><?php echo strtolower($correoCongreso); ?></a></p>
        <p>Para poder atender en tiempo y forma sus Derechos ARCO es necesario que su petición señale lo siguiente:</p>
        <ul>
            <li>El nombre del titular y su cuenta de correo electrónico para comunicarle la respuesta a su solicitud.</li>
            <li>Adjuntar el documento que acredite su identidad, o en su caso, la representación legal del titular.</li>
            <li>La descripción clara y precisa de los datos personales respecto de los que se busca ejercer alguno de los derechos antes mencionados.</li>
            <li>Cualquier otro elemento o documento que facilite la localización de los datos personales.</li>
        </ul>
        <p>Para el caso de las solicitudes de rectificación el titular deberá indicar las modificaciones a realizarse y aportar la documentación que sustente su petición.</p>
        <p>En caso de que la información proporcionada sea errónea o insuficiente, o bien, no se acompañen los documentos de acreditación correspondientes, El departamento de matemáticas, dentro de los cinco (5) días hábiles siguientes a la recepción de la solicitud, podrá requerirle que aporte los elementos o oficina documentos necesarios para dar trámite a la misma. Usted contará con diez (10) días hábiles para atender el requerimiento, contados a partir del día siguiente en que lo haya recibido. De no dar respuesta en dicho plazo, se tendrá por no presentada la solicitud correspondiente. El departamento de matemáticas le comunicará la determinación adoptada, en un plazo máximo de veinte (20) días hábiles contados desde la fecha en que se recibió la solicitud, a efecto de que, si resulta procedente, haga efectiva la misma dentro de los quince (15) días hábiles siguientes a que se comunique la respuesta. Y esta se dará vía electrónica a la dirección de correo que se especifique en la Solicitud.</p>

        <p><strong><br>VI: Cambios al Aviso de Privacidad de la FES CUAUTITLÁN UNAM</strong></p>
        <p>La FESC UNAM puede modificar, revisar o hacer cambios en el presente aviso en cualquier momento de conformidad con el Reglamento de Transparencia, Acceso a la Información Pública y Protección de Datos Personales para la UNAM y legislación universitaria aplicable. No obstante, tales cambios se darán a conocer mediante:</p>
        <ul>
            <li>Anuncios visibles en la FES CUAUTITLÁN UNAM;</li>
            <li>Trípticos o folletos disponibles en nuestras instalaciones;</li>
            <li>El sitio web oficial de la FESC UNAM, <a href="http://www.cuautitlan.unam.mx/">http://www.cuautitlan.unam.mx/</a>;</li>
            <li>Correo electrónico institucional o el que usted nos haya proporcionado.</li>
        </ul>

        <p>Fecha última actualización:  15/11/2023</p>
        <p><strong><br>Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas (CISEyAM).</strong></p>

        <!--Aqui termina el aviso de privacidad-->
            </div>
            <button id="accept-btn">Acepto</button>
        </div>
    </div>




    <!--Centra el formulario a la mitad de la pantalla-->
    <div class="container full-screen d-flex align-items-center justify-content-center vh-100">
        <div class="row registro p-sm-10">
            <div class="col ">
            </div>
            <div class="col-md-12 col-lg-5 col-xl-6 formulario_container">
                <div class="my-5 d-flex justify-content align-items-center">
                    <span class="h1 text-secondary"><u>Registro 1/4</u></span>
                    <img id="rfcInformacion" style="cursor: pointer" class="mx-3 rfcInformacion viewPassword imagenQuestion" src="../../src/question.png" alt="" data-toggle="tooltip" data-placement="right" title="El registro consta de 4 pasos, te encuntras en el 1/4, registrar tus datos personales.">
                </div>
                <h1 class="titulo">Crear Cuenta</h1>
                <form id="formulario" class="formulario" action="cuenta.php" method="POST">
                    <?php
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
                    <!--Grupo Nombres-->
                    <div class="mb-3" id="formulario_grupo_nombres">
                        <label for="nombres" class="form-label"><span class="text-danger">*</span> Nombre</label>
                        <!--input type="text" class="form-control" id="nombres" name="nombres" maxlength="90" placeholder="Escribe tu nombre" onkeypress="return validarNombres(event)"-->
                        <input type="text" class="form-control" id="nombres" name="nombres" maxlength="90" placeholder="Escribe tu nombre">
                        <p class="formulario_input-error" id="formulario_informacion_nombres">El nombre no debe contener acentos,
                            más de dos espacios y máximo 90 caractéres.</p>
                    </div>
                    <!--Grupo Apellidos-->
                    <div class="mb-3 formulario_grupo">
                        <label for="apellidos" class="form-label"><span class="text-danger">*</span> Apellidos</label>
                        <!--input type="text" class="form-control input" id="apellidos" name="apellidos" maxlength="90" placeholder="Escribe tus apellidos" onkeypress="return validarApellidos(event)"-->
                         <input type="text" class="form-control input" id="apellidos" name="apellidos" maxlength="90" placeholder="Escribe tus apellidos">
                        <p class="formulario_input-error" id="formulario_informacion_apellidos">Los apellidos no deben
                            contener acentos, más de dos espacios y máximo 90 caractéres.</p>
                    </div>
                    <!--Grupo Correo Electrónico-->
                    <div class="mb-3 formulario_grupo">
                        <label for="correoElectronico" class="form-label" maxlength="90"><span class="text-danger">*</span> Correo Electrónico</label>
                        <input type="text" class="form-control input" id="correoElectronico" name="correoElectronico" placeholder="Escribe tu correo" onkeypress="return validarCorreo(event)">
                        <p class="formulario_input-error" id="formulario_informacion_correoElectronico">Esta dirección
                            no tiene formato de correo válido. (ejemplo@ejemplo.com)</p>
                    </div>
                    <!--Grupo RFC-->
                    <div class="mb-3 formulario_grupo">
                        <label for="rfc" class="form-label"><span class="text-danger">*</span> RFC</label>
                        <a href="https://www.mi-rfc.com.mx/consulta-rfc-homoclave" target="blank"><img id="rfcInformacion" class="rfcInformacion viewPassword imagenQuestion" src="../../src/question.png" alt="" data-toggle="tooltip" data-placement="right" title="¿No sabes cuál es tu RFC? Consúltalo dando click aquí."></a>
                        <input type="text" class="form-control input" id="rfc" name="rfc" maxlength="30" placeholder="" onkeypress="return validarRfc(event)">
                        <p class="formulario_input-error" id="formulario_informacion_rfc">El RFC no debe exceder de 30
                            caractéres.</p>
                    </div>

                    <!-- Grupo botón aviso-privacidad -->
                    <div class="mb-1 contenedor_link">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            <input type="checkbox" id="accept-checkbox"> Da click en <span id="privacy-link">"Aviso de privacidad"</span> y lee con atención antes de aceptar.
                        </label>
                    </div>




                    <!-- <div id="rcaptcha" data-callback="validarCaptcha" class="g-recaptcha my-3"></div> -->
                    <div id="rcaptcha" data-callback="validarCaptcha" class="g-recaptcha my-3" data-sitekey="6LcELiEpAAAAAErU0beIwb2pkBdOQSHhOUOc6pFX"></div>

                    <!--Grupo Tienes cuenta-->
                    <div class="mb-1 contenedor_link">
                        <label class="form-label link">¿Ya tienes una cuenta?<a class="link_sesion" href="../inicioSesion/sesion.php" disable> Inicia Sesión.</a></label>
                    </div>
                    <!--Grupo Registrate-->
                    <div class="mb-1 div_boton align-items-center justify-content-center">
                        <input type="submit" class="btn btn boton registrate" id="registrate" name="registrate" value="Registrate" disabled>
                    </div>
                    <span class="text-danger">* Campos obligatorios</span>
                    <!--Grupo Volver-->
                    <div class="mt-5" role="group">
                        <a href="#!"><i class="fa fa-chevron-left link" style="font-size: 20px;" aria-hidden="true" onclick="history.back()"><span style="font-family: 'Inter Tight', sans-serif; font-weight: 600;">
                                    Volver</span></i></a>
                    </div>
                </form>
            </div>
            <?php
            include("../../modelo/conexion.php");
            $sql = $conexion->query("SELECT ruta FROM imagenescrearcuenta WHERE id_imagen = 2");
            $rutaAc = $sql->fetch_object();
            $ruta = $rutaAc->ruta;
            if ($ruta == "") {
                $default = "../../src/ImgCrearCuenta/defaultScreen.jpg";
                $ruta = $default;
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

    <script src="cuenta.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer> -->
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
    <!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer> 
</script> -->
    </script>

</body>

</html>
