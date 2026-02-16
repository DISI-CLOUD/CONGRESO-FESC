<?php
session_start();
require "../../modelo/conexion.php";
require "../avisoPrivacidad/correoCongreso.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../GuiasYPlantillas/guias.css">
    <style>
        ol,
        ul {
            padding-left: 20px;
            /* Elimina el sangrado izquierdo */
        }

        @media (max-width: 768px) {
            .boton-QR {
                font-size: 14px !important;
            }
        }
    </style>
</head>

<body>
    <header class="fixed-top">
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>
    <section style="margin-top: 200px;" class="Cuerpo-texto texto-justificado">
        <div class="container-fluid mb-5 pb-5">
            <div class="row pb-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mx-1">
                    <div class="container">
                        <h2 class="mb-3">Guias</h2>
                        <div class="container"></div>
                        <!-----------------------ACORDEON-------------------------------------------------->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-5 mb-5">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <!-------------PRIMER ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingUno">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseUno" aria-expanded="true" aria-controls="panelsStayOpen-collapseUno">
                                            ¿Cómo se registra una ponencia oral?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseUno" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingUno">
                                        <div class="accordion-body Cuerpo-texto">
                                            <strong>El registro de ponencias consta de tres procesos:</strong><br><br>
                                            <ul class="list-unstyled">
                                                <ol>
                                                    <li>El resumen.</li>
                                                    <li>El extenso.</li>
                                                    <li>El vídeo de la exposición de la ponencia.</li>
                                                </ol>
                                                <br>
                                                <li>El resumen, extenso y el vídeo de cada ponencia requieren ser registrados en el sitio del Congreso para ser evaluados por el Comité correspondiente.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-------------SEGUNDO ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingDos">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseDos" aria-expanded="true" aria-controls="panelsStayOpen-collapseDos">
                                            ¿Cuáles son los elementos que debe tener un resúmen para ponencia oral?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseDos" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingDos">
                                        <div class="accordion-body Cuerpo-texto">
                                            <span class="">
                                                La ponencia debe ser original y producto de investigación teórica o aplicada.
                                                Serán aceptados todos los trabajos que puedan hacer alguna aportación al conocimiento
                                                teórico o práctico en la enseñanza y aplicación de las matemáticas. El trabajo deberá tener un fundamento matemático explicito en el desarrollo y presentación de la ponencia. Así mismo, se debe
                                                cumplir con los lineamientos que se indican en la elaboración del resumen.
                                            </span><br><br>
                                            <strong>El resumen deberá contener:</strong>
                                            <br><br>
                                            <ul class="list-unstyled mt-2 mb-2">
                                                <ol>
                                                    <li>Título (Máximo 15 palabras)</li>
                                                    <li>Categoría.</li>
                                                    <li>Contenido (máximo 250 palabras estructurado de acuerdo a la categoría seleccionada).</li>
                                                    <li>Referencias en estilo APA(American Psychological Association séptima edición en inglés).</li>
                                                    <li>Nombre del autor (y opcional coautores. Máximo 5 integrantes).</li>
                                                   
                                                </ol>
                                            </ul>
                                            <br>
                                            <strong>Especificaciones del resumen:</strong>
                                            <br><br>
                                            <ol class="mt-2">
                                                <li class="fw-semibold mb-2">El título deberá reflejar el contenido de la ponencia.</li>
                                                <br>
                                                <li class="fw-semibold mb-2"> Las categorías en donde los autores podrán registrar sus trabajos relacionados al Proceso de Enseñanza Aprendizaje (PEA) son:</li>
                                                <ul style="list-style-type: square;" class="lista2">
                                                    <li>Enseñanza de las matemáticas con las TIC e inteligencia artificial (EN)</li>
                                                    <li>Experiencia e innovación didáctica en la enseñanza de las matemáticas (ID)</li>
                                                    <li>Investigación del proceso de la enseñanza de las matemáticas (IP)</li>
                                                    <li>Evaluación del aprendizaje en la enseñanza de las matemáticas (EA)</li>
                                                    <li>Aplicación y/o vinculación de las matemáticas con otras disciplinas (AP)</li>
                                                    <li>Al momento de registrar sus trabajos el ponente seleccionará la categoría que más se adapte a ellos.</li>
                                                    <br>
                                                </ul>
                                                <li class="fw-semibold mb-2">En el contenido se expondrá una síntesis del tema referido y se debe incluir según la categoría elegida:</li>
                                                <ul style="list-style-type: square;">
                                                    <li>Objetivo</li>
                                                    <li>Sustento teórico o antecedentes</li>
                                                    <li>Metodología o desarrollo</li>
                                                    <li>Resultados y/o conclusiones.</li>
                                                </ul>
                                                <br>
                                                <li class="fw-semibold mb-2">Es necesario que las citas y referencias incluidas en el documento se encuentren en formato APA (7ma. ed. en inglés).</li>
                                                <br>
                                                <li class="fw-semibold mb-2">Registro autores y coautores.
                                                    Los asistentes al Congreso podrán participar como ponentes con un máximo de 5 trabajos, ya sea como autor o coautor en las siguientes modalidades:</li>
                                                <ul style="list-style-type: square;">
                                                    <li>Ponencias</li>
                                                    <li>Talleres</li>
                                                    <li>Carteles</li>
                                                </ul>
                                            </ol>
                                            <span>Los asistentes podrán participar como ponentes con un máximo de 3 trabajos en la categoría de Ponencias, con un máximo de 2 Carteles y con un Taller.</span>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                                <!-------------TERCER ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSexto">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSexto" aria-expanded="true" aria-controls="panelsStayOpen-collapseSexto">
                                            ¿Cuáles son los elementos que debe tener un extenso para ponencia oral?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseSexto" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSexto">
                                        <div class="accordion-body Cuerpo-texto">
                                            <span class="">
                                                Para poder entregar los trabajos extensos de las ponencias orales es necesario:
                                            </span><br><br>
                                            <ol>
                                                <li>Tener aprobado el resumen de la ponencia oral por parte del comité evaluador.</li>
                                                <li>Que el autor que registró el resumen de la ponencia, sea el mismo que envíe el trabajo extenso.</li>
                                                <li>Revisar la <a class="Cuerpo-texto" href= "../../src/GuiasYPlantillas/Guia_para_autores.pdf" target="_blank">guía de autores</a> </li>
                                                <li>Todos los extensos se deben realizar en la <a class="Cuerpo-texto" href= "../../src/GuiasYPlantillas/Plantilla_extenso.docx">plantilla oficial del congreso actual</a> </li>
                                                <li>Accesar al "Registro de trabajos" para poder adjuntar los archivos requeridos.</li>
                                                <li>Respetar la fecha límite de registro de trabajos extensos</li>
                                            </ol>

                                            <strong>Los coautores no pueden registrar o modificar los extensos.</strong>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                                <!-------------CUARTO ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOctavo">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOctavo" aria-expanded="true" aria-controls="panelsStayOpen-collapseOctavo">
                                            ¿Cuáles son los elementos que debe tener un video para ponencia oral?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOctavo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOctavo">
                                        <div class="accordion-body Cuerpo-texto">
                                            <strong>La propuesta del video debe ajustarse a los requisitos siguientes:</strong><br><br>
                                            <ol>
                                                <li>La propuesta del video debe ajustarse a los requisitos siguientes:</li>
                                                <li>No debe de exceder los 50 MB (ya que tardaría demasiado en subir, preferentemente creado en zoom).</li>
                                                <li>El formato debe ser en .mp4 (encoder H.264).</li>
                                                <li>Resolución 1280*720 y 24 fps (fotogramas por segundo).</li>
                                                <li>Buen audio y vídeo. El video debe de durar entre 10 y 15 minutos como tiempos mínimo y máximo.</li>
                                                <li>El nombre del archivo es la clave de su ponencia + - + el nombre del autor.</li>
                                                <br>
                                                <ul style="list-style-type: square;">
                                                    <li>Ejemplo: POSM001-PedroGarciaMendoza</li>
                                                </ul>
                                                <br>
                                                <li>El vídeo deberá ser subido por el ponente a OneDrive, Drive o cualquier otra plataforma para almacenar archivos multimedia y se deberá compartir el URL para visualizar el vídeo con los permisos necesarios de visualización al correo <?php echo strtolower($correoCongreso); ?>.</li>
                                            </ol>
                                            <strong>Los elementos que debe incluir la exposición de la ponencia son:</strong>
                                            <br><br>
                                            <ul style="list-style-type: square;">
                                                <li>Título y el nombre de los ponentes</li>
                                                <li>Nombre de la institución de procedencia y el logo</li>
                                                <li>Introducción</li>
                                                <li>Problemática</li>
                                                <li>Objetivo(s)</li>
                                                <li>Sustento teórico y antececedentes</li>
                                                <li>Metodología o desarrollo</li>
                                                <li>Resultados</li> 
                                                <li>Discusión y conclusiones</li>
                                                <li>Referencias</li>

                                             </ul>
                                            <ol start="8">
                                                <li>Utilizar la plantilla para realizar su presentacion del video: <a class="Cuerpo-texto" href="../../src/GuiasYPlantillas/Plantilla_Ponencias1.pptx">Plantilla ponencias</a>
                                                </li>
                                                <!--li>Utilizar la plantilla para realizar su presentacion del video: Por definir 
                                                </li-->
                                            </ol>
                                            <strong>Cualquier aspecto o situación no considerada en la presente convocatoria será resuelta por el comité técnico y su decisión será inapelable.</strong>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                                <!-------------QUINTO ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTres">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTres" aria-expanded="true" aria-controls="panelsStayOpen-collapseTres">
                                            ¿Cómo se registra un cartel?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTres" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTres">
                                        <div class="accordion-body Cuerpo-texto">
                                            <strong>El registro de carteles consta de dos procesos:</strong>
                                            <br><br>
                                            <ul class="list-unstyled">
                                                <ol>
                                                    <li>El resumen.</li>
                                                    <li>El cartel.</li>
                                                </ol>
                                                <br>
                                                <li> El resumen y el cartel requieren ser registrados en el sitio del congreso para ser evaluados por el comité evaluador.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-------------SEXTO ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingCuarto">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseCuarto" aria-expanded="true" aria-controls="panelsStayOpen-collapseCuarto">
                                            ¿Cómo elaborar un resúmen de cartel?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseCuarto" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingCuarto">
                                        <div class="accordion-body Cuerpo-texto">
                                            <strong>Especificaciones del resumen:</strong>
                                            <br><br>
                                            <span class="">
                                                El cartel debe ser original y producto de investigación teórica o aplicada. Serán aceptadas todos los trabajos que puedan hacer alguna aportación al conocimiento teórico o práctico en la enseñanza y aplicación de las matemáticas. Así mismo se debe cumplir con los lineamientos que se indican en la elaboración del resumen.
                                            </span><br><br>
                                            
                                            <ol class="mt-2">
                                                <li class="fw-semibold mb-2">Título (Máximo 15 palabras).</li>
                                                <ul style="list-style-type: square;">
                                                    <li>El título deberá reflejar el contenido del cartel.</li>
                                                </ul>
                                                <br>
                                                <li class="fw-semibold mb-2">Categoria</li>
                                                <ul style="list-style-type: square;">
                                                    <li> Las categorias en donde los autores podrán registrar sus trabajos relacionados al Proceso de Enseñanza Aprendizaje (PEA) y a la enseñanza y la aplicación de las matemáticas son:<p></li>
                                                <ul style="list-style-type: square;">
                                                    <li>Enseñanza de las matemáticas con las TIC e inteligencia artifical (EN)</li>
                                                    <li>Experiencia e innovación didáctica en la enseñanza de las matemáticas (ID)</li>
                                                    <li>Investigación del proceso de la enseñanza de las matemáticas (IP)</li>
                                                    <li>Evaluación del aprendizaje en la enseñanza de las matemáticas (EA)</li>
                                                    <li>Aplicación y/o vinculación de las matemáticas con otras disciplinas (AP)</li>
                                                </ul> <br>
                                                <span>Al momento de registrar sus trabajos, el ponente seleccionará la categoría que más se adapte a ellos.</span> <br>
                                                <br>
                                                </ul>
                                                <li class="fw-semibold mb-2">Contenido (Máximo 150 palabras estructurado de acuerdo a la categoría seleccionada).</li>
                                                <ul style="list-style-type: square;">
                                                    <li> En el contenido se expondrá una síntesis del tema referido y se debe incluir según la categoría elegida:</li>
                                                <ul style="list-style-type: square;">
                                                    <li>Objetivo</li>
                                                    <li>Sustento teórico o antecedentes</li>
                                                    <li>Metodología o desarrollo</li>
                                                    <li>Resultados y/o conclusiones.</li>
                                                </ul>
                                                </ul>
                                                <br>
                                                <li class="fw-semibold mb-2">Bibliografía en estilo APA (American Psychological Association 7ma. ed.)</li>
                                                <ul style="list-style-type: square;">
                                                <li>"Es necesario que las citas y referencias incluidas en el documento se encuentren en formato APA 7ma. ed.</li>
                                                </ul>
                                                <br>
                                                <li class="fw-semibold mb-2">Nombre del autor (y opcional coautores. Máximo 5 integrantes).</li>
                                                <ul style="list-style-type: square;">
                                                <li> Los asistentes al congreso podrán participar como ponentes con un máximo de 5 trabajos ya sea como autor o coautor en las siguientes modalidades:</li>
                                                <ul style="list-style-type: square;">
                                                    <li>Ponencias</li>
                                                    <li>Talleres</li>
                                                    <li>Carteles</li>
                                                </ul>
                                            <br>
                                            <span>Los asistentes podrán participar como ponentes con un máximo de 3 trabajos en la categoría de Ponencias, con un máximo de 2 Carteles y con un Taller.</span>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                                <!-------------SEPTIMO ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingNueve">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseNueve" aria-expanded="true" aria-controls="panelsStayOpen-collapseNueve">
                                            ¿Cómo elaborar un cartel?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseNueve" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingNueve">
                                        <div class="accordion-body Cuerpo-texto">
                                            <li class="fw-semibold mb-2">El cartel debe incluir las siguientes secciones:</li>
                                            <ol class="mt-2">
                                                <li>Encabezado</li>
                                                <li>Resumen (sustento teórico)</li>
                                                <li>Palabras clave</li>
                                                <li>Introducción</li>
                                                <li>Metodología</li>
                                                <li>Resultados</li>
                                                <li>Discusión y/o conclusiones</li>
                                                <li>Índice de referencias (en formato APA).</li>
                                            </ol>
                                            <br>
                                            <li class="fw-semibold mb-2">Elementos de Contenido</li>
                                            
                                            <ul style="list-style-type: square;">
                                                <li>Logo del congreso (se lo compartiremos por correo)</li>
                                                <li>Logo de su institución</li>
                                                <li>Titulo centrado entre los logos de no más de 15 palabras</li>
                                                <li>No más de 5 autores</li>
                                                <li>El texto debe limitarse a no más de 500 palabras</li>
                                            </ul>
                                            <br>
                                            <li class="fw-semibold mb-2">Elementos de Formato</li>
                                            <ul style="list-style-type: square;">
                                                <li>El tipo de letra será a elección del autor. </li>
                                                <li>Es necesario una cuidadosa presentación tipográfica y calidad en los títulos, fotos, gráficos, etc.</li>
                                                <li>Todas las imágenes, figuras, tablas y ecuaciones deberán estar numeradas.</li>
                                                <li>Incluir un máximo de cuatro imágenes, figuras, tablas y/o ecuaciones.</li>
                                                <li>Cuidar la ortografía </li>
                                            </ul>
                                            </ol>
                                            <span>Cualquier situación no prevista estará sujeta a la resolución del comité organizador del evento</span>
                                        </div>
                                    </div>
                                </div>
                                <!-------------OCTAVO ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingQuinto">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseQuinto" aria-expanded="true" aria-controls="panelsStayOpen-collapseQuinto">
                                            ¿Cómo registrar un taller?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseQuinto" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingQuinto">
                                        <div class="accordion-body Cuerpo-texto">
                                            <span class="">
                                                Los talleres servirán para fortalecer la práctica profesional, a través del uso de tecnologías o sistemas aplicados a la enseñanza y aplicación de las matemáticas.
                                            </span><br><br>
                                            <strong>La propuesta de taller debe ajustarse a los requisitos siguientes:</strong>
                                            <br><br>
                                            <ul class="list-unstyled mt-2 mb-2">
                                                <ol>
                                                    <li>Un autor o coautor sólo podrá participar en un taller.</li>
                                                    <li>Los talleres constan de 2 sesiones de 2 horas cada una.</li>
                                                    <li>El registro se llevará a cabo en la página del congreso enviando sus resúmenes.</li>
                                                    <li>La propuesta de registro de taller debe contener:</li>
                                                    <br>
                                                    <ul style="list-style-type: square;">
                                                        <li>Título (máximo 15 palabras). El título deberá reflejar el contenido del taller.</li>
                                                        <li>Contenido (máximo 250 palabras) describir el objetivo, las actividades a realizar y los logros que se pretenden alcanzar.</li>
                                                        <li>Materiales (máximo 100 palabras), software necesario, el horario propuesto (opcional) y la tecnología en línea que utilizará (Zoom, Meet, Webex, Classroom, otro).</li>
                                                        <li>Autor (y coautores opcional) máximo dos coautores.</li>
                                                        <li>Las constancias son individuales para lo cual el autor y coautores requieren exponer el trabajo y realizar el pago correspondiente.</li>
                                                    </ul>
                                                    <br>
                                                </ol>
                                                <li><strong>Registro de talleres.</strong></li>
                                                <br>
                                                <span>Después del registro se revisarán los talleres para enviar la respuesta por email a los ponentes y realizar las observaciones correspondientes si es que las hubiera. También recibirán indicaciones para impartir el taller.

                                                    Cualquier aspecto o situación no considerada en la presente convocatoria será resuelta por la comisión de talleres y su decisión será inapelable.</span>
                                            </ul>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <!-------------Prototipo 1---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingPrototipo1">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapsePrototipo1" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapsePrototipo1">
                                            ¿Cómo registrar un prototipo robótico o una aplicación de inteligencia artificial?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapsePrototipo1" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingPrototipo1">
                                        <div class="accordion-body Cuerpo-texto">
                                            <strong class="">
                                            El registro de prototipo robótico o una aplicación de inteligencia artificial consta de dos procesos:
                                            </strong><br><br>
                                            <ol>
                                                <li>El resumen.</li>
                                                <li>Vídeo de exposición demostrativo.</li>
                                            </ol>
                                            <span>El resumen, y el vídeo de cada prototipo robótico o una aplicación de inteligencia artificial requieren ser registrados y evaluados por el comité correspondiente.
                                            <br> <br>
                                            Para realizar el registro y envío de resumen de su prototipo deberá ir a la siguiente URL: <br> <br>
                                            </span>
                                            
                                            <center>
                                            <a href="https://docs.google.com/forms/d/1p3Yheb18kOiQQCuoYSOnxvlgX4ksdF8lGFrN_GimjrQ/viewform?edit_requested=true&edit_requested=true&pli=1" style="font-size: 20px; text-decoration: none;" class="boton-QR" target="_blank">Registro prototipos Congreso17</a> <br> <br>
                                            <img width="180" height="180" src="../../src/Registra_proto.jpg" alt="QR del enlace" style="margin: 0 auto;" class="imagen-QR">
                                            </center>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                                <!-------------Prototipo 2---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingPrototipo2">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapsePrototipo2" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapsePrototipo2">
                                            ¿Cuáles son los elementos que debe contener un resumen para un prototipo robótico o aplicación de inteligencia artificial (IA)? 
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapsePrototipo2" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingPrototipo2">
                                        <div class="accordion-body Cuerpo-texto">
                                            <span class="">
                                            El prototipo robótico o aplicación de inteligencia artificial, debe ser original y propio, con fundamentos teóricos. Serán aceptados todos los trabajos que puedan dar solución a un problema real con el uso de la robótica o inteligencia artificial. 
                                            </span><br><br>
                                            <strong>El resumen deberá contener:</strong><br><br>
                                            <ol>
                                                <li>Título.</li>
                                                <li>Categoría.</li>
                                                <li>Contenido (máximo 250 palabras).</li>
                                                <li>Referencias bibliográficas o electrónicas en formato APA al final (American Psychological Association).</li>
                                                <li>Nombre de participantes (Número de participantes 3 por cada trabajo y en caso de ser alumnos requerirán un asesor docente).</li>
                                            </ol>
                                            
                                            <strong>Especificaciones del resumen:</strong> <br><br>
                                            <ol>
                                                <li>El título debe contener máximo 15 palabras.</li>
                                                <li>Las categorías en donde los autores podrán registrar sus trabajos relacionados a Prototipos Robóticos o Aplicaciones de Inteligencia Artificial son:</li>
                                            </ol>
                                            <p>Categorías Inteligencia Artificial:</p>
                                            <p>Machine learning (ML) <br>
                                            Chat bot (CB)
                                            </p><br>
                                            <p>Categorías Prototipos Robóticos</p>
                                            <p>Robots de asistencia y servicio (RS) <br>
                                            Robots móviles (RM)
                                            </p><br>
                                            <ol start="3">
                                                <li>En el contenido se expondrá una síntesis del tema referido y se debe incluir según la categoría elegida:</li> <br>
                                                <ul style="list-style-type: square;">
                                                    <li>Título</li>
                                                    <li>Objetivo</li>
                                                    <li>Estado del arte </li>
                                                    <li>Metodología o desarrollo </li>
                                                    <li>Resultados y/o conclusiones </li>
                                                </ul> <br>
                                                <li>Es necesario que las citas y referencias incluidas en el documento se encuentren en formato APA.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <!-------------Prototipo 3---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingPrototipo3">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapsePrototipo3" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapsePrototipo3">
                                            ¿Cuáles son los elementos que debe tener un video para un prototipo Robótico o aplicación de Inteligencia Artificial? 
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapsePrototipo3" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingPrototipo3">
                                        <div class="accordion-body Cuerpo-texto">
                                            <strong>El vídeo debe ajustarse a los siguientes requisitos:</strong>
                                            <ol>
                                                <li>Incluir al inicio la plantilla de Power Point del Congreso (<a href="Plantilla_Prototipos.pptx" class="boton-QR" style="font-size: 20px; text-decoration: none;" target="_blank">ver plantilla de Power Point</a>).</li>
                                                <li>No debe exceder los 300 MB.</li>
                                                <li>Formato .mp4.</li>
                                                <li>Resolución 1280 × 720 fps (fotogramas por segundo).</li>
                                                <li>Buen audio y vídeo.</li>
                                                <li>
                                                    El nombre del archivo es categoría-nombre de autor (sin espacios).
                                                    <ul style="list-style-type: square;"> <br>
                                                        <li><b>Ejemplo: RS-PerlaEstradaLopez</b></li>
                                                    </ul> <br>
                                                </li>
                                                <li>El vídeo deberá subirlo a drive, OneDrive o cualquier otra plataforma y se deberá compartir el URL en el formulario de registro: <br><a href="https://docs.google.com/forms/d/1p3Yheb18kOiQQCuoYSOnxvlgX4ksdF8lGFrN_GimjrQ/viewform?edit_requested=true&edit_requested=true&pli=1" style="font-size: 20px; text-decoration: none;" class="boton-QR" target="_blank">Prototipos Congreso 17</a></li>
                                                <li>Incluir referencias en formato APA.</li>
                                            </ol>
                                            <strong>Los elementos que debe incluir la exposición son:</strong> <br>
                                            <ul style="list-style-type: square;">
                                                <li>Temática.</li>
                                                <li>Objetivo </li>
                                                <li>Sustento teórico, Estado del arte o introducción. </li>
                                                <li>Metodología o desarrollo. </li>
                                                <li>Resultados y/o conclusiones. </li>
                                                <li>Bibliografía. </li>
                                            </ul>

                                            <strong>Fechas</strong> <br>
                                            <p>El periodo de recepción de resúmenes será del 3 al 14 de marzo y la recepción será vía URL a través de un formulario.</p>
                                            <p>El periodo de evaluación de resúmenes será del 17 al 21 de marzo. Una vez aceptado su trabajo, recibirá un correo electrónico donde se le proporcionará las instrucciones para compartir su video.</p>
                                            <p>El periodo de recepción de videos será del 24 de marzo al 4 de abril.</p>

                                            <strong>Costos</strong> <br>
                                            <p>Costo alumnos $250 <br>Costo profesores $1500</p>

                                            <strong>Cómo realizar el pago</strong> <br>
                                            <p>Solicitar una ficha referenciada al correo altamira@unam.mx, para realizar el pago bancario, especificando el monto a pagar. En caso de requerir factura se deberán enviar sus datos fiscales al mismo correo electrónico. <br>
                                            <b>Nota: solamente se facturará depósitos del mes corriente.</b></p>
                                            <p>Para pagos en el plantel, se pueden realizar directamente en el área de las cajas del plantel y especificar si es ponente o participante en prototipos robóticos aplicaciones IA.</p>
                                            <p>Se otorgará constancia de participación individual de la exposición.</p>
                                            <p><b>Cualquier aspecto o situación no considerada en la presente convocatoria será resuelta por el comité y su decisión será inapelable.</b></p>
                                        </div>
                                    </div>
                                </div>
                                <!-------------NOVENO ITEM---------------------->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingSeptimo">
                                        <button class="accordion-button Titulos" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeptimo" aria-expanded="true" aria-controls="panelsStayOpen-collapseSeptimo">
                                            ¿Cómo obtener mi constancia?
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseSeptimo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSeptimo">
                                        <div class="accordion-body Cuerpo-texto">
                                            <span class="">
                                                Las constancias son individuales, por lo que el autor y coautores que las requieran necesitan realizar la exposición del trabajo y el pago correspondiente.
                                            </span><br><br>
                                            <ul style="list-style-type: square;">
                                                <li>Se entregará constancia de <mark>"Asistencia al congreso"</mark>, cuando haya participado en las actividades del congreso.</li>
                                                <li>Se entregará constancia de <mark>"Presentación de ponencia"</mark>, cuando su trabajo en extenso y vídeo hayan sido aceptados por el comité organizador y estos hayan sido presentados en el evento.</li>
                                                <li>Se entregará constancia de <mark>"Publicación en memorias del congreso</mark>" con registro ISSN , cuando su trabajo en extenso haya sido incluido en las memorias del congreso.</li>
                                                <li>Se entregará constancia de <mark>“Participación en el concurso de carteles”</mark>, cuando el resumen, cartel y vídeo hayan sido aprobados por el comité y hayan participado en el concurso.</li>
                                                <li>Se entregará constancia de <mark>“Ganador en el concurso de carteles (1er, 2do y 3er lugar)”</mark>, cuando haya resultado ganador del concurso.</li>
                                                <li>Se entregará constancia de <mark>“Exposición de prototipo o proyecto”</mark>, cuando haya expuesto su prototipo y/o proyecto en el evento.</li>
                                                <li>Se entregará constancia de <mark>“Presentación de taller”</mark>, cuando el resumen haya sido aprobado por el comité y este se haya impartido (ponentes).</li>
                                                <li>Se entregará constancia de <mark>“Participación en taller”</mark>, cuando haya cursado los dos días correspondientes a la impartición de taller (asistentes).</li>
                                            </ul>
                                            </ul>
                                            <strong>Cualquier aspecto o situación no considerada en la presente convocatoria será resuelta por el comité organizador y su desición será inapelable.</strong>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //Trae el congreso más reciente
                                $consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
                                $resCongreso = mysqli_query($conexion, $consCongreso);
                                $fetchCongreso = mysqli_fetch_assoc($resCongreso);
                                // Traer usuario y contraseña
                                $correoCongreso = $fetchCongreso['correo_congreso'];
                                $hashContra = $fetchCongreso['contra_congreso'];
                                ?>
                                
                            </div><!--final del acordeon-->
                        </div><!--col-10-->
                        <!----------------------------------ACORDEON--------------------------------------------->
                    </div><!--container-->
                </div><!--col-10-->
            </div><!--row-->
        </div><!--fluid-->
    </section>
    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>

</html>
