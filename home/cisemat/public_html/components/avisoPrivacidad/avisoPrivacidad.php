<?php
session_start();
require "../../modelo/conexion.php";
require "../../components/avisoPrivacidad/correoCongreso.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once('../../Layouts/iconoCongresoLink.php');
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso de privacidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <style>
        .container-aviso {
            text-align: justify;
            width: min(90%, 1200px);
            margin: 0 auto;
            
        }
        .reduced-line-height {
            line-height: 1.3;
            /* Puedes ajustar el valor según tus preferencias. */
        }
    </style>
</head>

<body>
    <header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>

    <section style="margin-top: 200px;">
        <div class="container-aviso mt-5 mb-5">
            <h2 class="mb-3 text-center" style="margin-top: 10px;">AVISO DE PRIVACIDAD DE LA FACULTAD DE ESTUDIOS
                SUPERIORES CUAUTITLÁN DE LA UNAM<hr></h2>
            <p><br><br>Tómate un momento para leer el siguiente Aviso de Privacidad en el que informamos, de conformidad con
                lo dispuesto por el Reglamento de Transparencia, Acceso a la información Pública y Protección de Datos
                Personales para la Universidad Nacional Autónoma de México (en adelante "LA UNAM"), sobre cómo y con qué
                fines tratamos tu información personal.</p>
            <p>Al proporcionar tus datos daremos por entendido que estás de acuerdo con los términos de este Aviso, las
                finalidades del tratamiento de los datos, así como los medios y procedimiento que ponemos a tu
                disposición para ejercer tus derechos de acceso, rectificación, cancelación y oposición en la sección V
                de este Aviso de Privacidad.</p>

            <p><strong><br><br>1. Fundamento legal universitario</strong></p>
            <p>Artículos del 12 al 19 del Reglamento de Transparencia, Acceso a la Información Pública y Protección de
                Datos Personales para la UNAM.</p>

            <p><strong><br>II. Identidad y domicilio de la responsable</strong></p>
            <p>El Departamento de Matemáticas de la Facultad de Estudios Superiores Cuautitlán de la UNAM, ubicado en el
                edificio A8, planta baja.</p>

            <p><strong><br>III. Datos personales que trata la FES CUAUTITLÁN.</strong></p>
            <p>Los datos personales que solicita el departamento de matemáticas son: nombre y apellidos, RFC, correo
                electrónico vigente, número de teléfono, y posiblemente una clave de acceso. Además, se requieren datos
                académicos y laborales pertinentes. Asimismo, se sugiere adjuntar una foto de perfil para facilitar la
                identificación.</p>

            <p><strong><br>IV. Transferencia de datos personales</strong></p>
            <p>La FES CUAUTITLÁN UNAM no realizará transferencia alguna de los datos que recaba y sólo transmitirá los
                datos necesarios en los casos previstos en la Ley Federal de Transparencia y Acceso a la Información y
                en el Reglamento de Transparencia, Acceso a la Información Pública y Protección de Datos Personales para
                la Universidad Nacional Autónoma de México. En especial, la FESC UNAM transferirá sus datos personales a
                aquellas dependencias o entidades que forman parte de LA UNAM. Le informamos que dicha transferencia no
                requiere de su consentimiento conforme a la normatividad porque las instituciones que forman parte de LA
                UNAM operan bajo la misma reglamentación universitaria.</p>

            <p><strong><br>V. Medios y procedimientos para ejercer sus derechos ARCO y/o revocar el
                    consentimiento</strong></p>
            <p>Usted o su representante legal podrá ejercer cualquiera de los derechos de acceso, rectificación,
                cancelación u oposición (en lo sucesivo "Derechos ARCO"), así como revocar su consentimiento para el
                tratamiento de sus datos personales enviando un correo electrónico a la oficina del Departamento de
                matemáticas:</p>
            <p><a href="mailto:<?php echo strtolower($correoCongreso); ?>">
                    <?php echo strtolower($correoCongreso); ?>
                </a></p>
            <p>Para poder atender en tiempo y forma sus Derechos ARCO es necesario que su petición señale lo siguiente:
            </p>
            <ul>
                <li>El nombre del titular y su cuenta de correo electrónico para comunicarle la respuesta a su
                    solicitud.</li>
                <li>Adjuntar el documento que acredite su identidad, o en su caso, la representación legal del titular.
                </li>
                <li>La descripción clara y precisa de los datos personales respecto de los que se busca ejercer alguno
                    de los derechos antes mencionados.</li>
                <li>Cualquier otro elemento o documento que facilite la localización de los datos personales.</li>
            </ul>
            <p>Para el caso de las solicitudes de rectificación el titular deberá indicar las modificaciones a
                realizarse y aportar la documentación que sustente su petición.</p>
            <p>En caso de que la información proporcionada sea errónea o insuficiente, o bien, no se acompañen los
                documentos de acreditación correspondientes, El departamento de matemáticas, dentro de los cinco (5)
                días hábiles siguientes a la recepción de la solicitud, podrá requerirle que aporte los elementos o
                oficina documentos necesarios para dar trámite a la misma. Usted contará con diez (10) días hábiles para
                atender el requerimiento, contados a partir del día siguiente en que lo haya recibido. De no dar
                respuesta en dicho plazo, se tendrá por no presentada la solicitud correspondiente. El departamento de
                matemáticas le comunicará la determinación adoptada, en un plazo máximo de veinte (20) días hábiles
                contados desde la fecha en que se recibió la solicitud, a efecto de que, si resulta procedente, haga
                efectiva la misma dentro de los quince (15) días hábiles siguientes a que se comunique la respuesta. Y
                esta se dará vía electrónica a la dirección de correo que se especifique en la Solicitud.</p>

            <p><strong><br>VI: Cambios al Aviso de Privacidad de la FES CUAUTITLÁN UNAM</strong></p>
            <p>La FESC UNAM puede modificar, revisar o hacer cambios en el presente aviso en cualquier momento de
                conformidad con el Reglamento de Transparencia, Acceso a la Información Pública y Protección de Datos
                Personales para la UNAM y legislación universitaria aplicable. No obstante, tales cambios se darán a
                conocer mediante:</p>
            <ul>
                <li>Anuncios visibles en la FES CUAUTITLÁN UNAM;</li>
                <li>Trípticos o folletos disponibles en nuestras instalaciones;</li>
                <li>El sitio web oficial de la FESC UNAM, <a
                        href="http://www.cuautitlan.unam.mx/">http://www.cuautitlan.unam.mx/</a></li>
                <li>Correo electrónico institucional o el que usted nos haya proporcionado.</li>
            </ul>

            <p>Fecha última actualización:  15/11/2023</p>
            <p><strong><br>Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas (CISEMAT).</strong>
            </p>
        </div>
    </section>


    <footer><!-----------CONTENEDOR PIE DE PAGINA------------>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>