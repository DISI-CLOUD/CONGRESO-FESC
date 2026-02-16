<?php 
    session_start(); 
/** 
*******************************************************************************************************
* Apartado que muestra las actividades llevadas acabo en el congreso anterio, empezando por el congreso XV .
* Cualquier duda o sugerencia:
* @author Magda Marina Sanchez Campos marinacampos1125@gmail.com, Alison Michelle Rubio Garcia,Carlos Tejeda Araujo.
****/ 
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
    <title>Memorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./programaMemoriasAcercade.css">
    

</head>
<body>
<header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->  
    <?php 
		require_once('../../Layouts/nav.php');
	?>
</header>
<section style="margin-top: 250px;">
    <div class="container mt-5 mb-5"><!----------CONTENEDOR PRINCIPAL----------->  
        <h2 class="mb-3">Memorias</h2><!--------TITULO INTERNO------------>  
        <!-----------CARDS CONGRESO------------> 
        <div class= "container  border rounded justify-content-center">
            <div class="row justify-content-center">
                <div class="card-body-congresoXIV rounded col-8 p-4 m-3">XIV EDICIÓN</div>
                <div class="col-2 m-3"><img src="../../src/logos_congresos/XIV.png" alt="XIV Congreso" height= "95px"  width= "95px"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col m3">
                    <h5 class="card-title m-3">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</h5>
                    <p class="card-title m-3">5 y 6 de Mayo 2022</p>
                </div>
            </div>
            <div>
                <div class="card-body-congresoXIV rounded col-3 p-2 m-3"><i class="fa fa-info-circle m-2"></i>Acerca de</div>
            </div>
        <!-----------ACERCA DE CARDS------------> 
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="card mb-3">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title m-3">Legal</h5>
                            <p class="card-title m-3">Memorias del Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas, Año 6, No. 3,
                                agosto 2021 – agosto 2022, es una publicación anual editada por la Universidad Nacional Autónoma de México, 
                                Ciudad Universitaria, Delegación Coyoacán, Ciudad de México, C.P. 04510, a través de la Facultad de Estudios Superiores Cuautitlán,
                                Carretera Cuautitlán – Teoloyucán km. 2.5, Col. San Sebastián Xhala, Cuautitlán Izcalli, Estado de México, C.P. 54714, Tel. (55)56231890 y (55)56231886,
                                http://congresomatematicas.cuautitlan2.unam.mx, altamira@unam.mx. Editor responsable Dr. Jorge Altamira Ibarra. <br><br>
                                Reserva de Derecho al uso Exclusivo No. 04-2016-080508273200-203. Otorgado por el Instituto Nacional del derecho de Autor, ISSN 2448-7945, 
                                ambos otorgados por el Instituto Nacional de derechos de Autor. Responsable de la última actualización de este número, Departamento de Matemáticas 
                                de la Facultad de Estudios Superiores Cuautitlán, Carretera Cuautitlán – Teoloyucán km. 2.5, Col. San Sebastián Xhala, Cuautitlán Izcalli Estado de México, 
                                C.P. 54715, fecha de la última modificación., mayo 2022. Se autoriza la reproducción total o parcial de los textos aquí publicados 
                                siempre y cuando se cite la fuente completa y la dirección electrónica de la publicación.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-3">
                            <h5 class="card-title m-3">Directorio</h5>
                            <h5 class="card-title m-3">Directorio UNAM</h5>
                            <h6 class="card-title m-3">Dr. Enrique Luis Graue Wiechers</h6>
                            <p class="card-text m-3">Rector</p>
                            <h6 class="card-text m-3">Dr. Leonardo Lomelí Vanegas</h6>
                            <p class="card-text m-3">Secretario General</p>
                            <h6 class="card-text m-3">Dr. Luis Agustín Icaza Longoria</h6>
                            <p class="card-text m-3">Secretario Administrativo<br></p>                            
                            <h5 class="card-title m-3">Directorio FES Cuautitlán</h5>
                            <h6 class="card-text m-3">Dr. David Quintanar Guerrero</h6>
                            <p class="card-text m-3">Director</p>
                            <h6 class="card-text m-3">I. A. Alfredo Alvarez Cárdenas</h6>
                            <p class="card-text m-3">Secretario General</p>
                            <h6 class="card-text m-3">Dr. Jorge Altamira Ibarra</h6>
                            <p class="card-text m-3">Jefe del departamento de Matemáticas</p>                        
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-3">
                            <h5 class="card-title m-3">Comité evaluador científico nacional</h5>
                            <p class="card-title m-3">Dr. Aguilar Márquez Armando<br>
                                                    Dr. Altamira Ibarra Jorge<br>
                                                    Dra. Canabal Cáceres Silvia Guadalupe<br>
                                                    FM. Castillo Padilla Juana<br>
                                                    Dr. Contreras Espinosa José Juan<br>
                                                    MC. Flores Pérez Mayte<br>
                                                    Dr. García León Omar<br>
                                                    M en I. García Ruiz Juan José<br>
                                                    Dr. Hernández Castillo José Luz<br>
                                                    Dr. Hernández Gómez Víctor Hugo<br>
                                                    M en SI. Lara Martínez Maricela<br>
                                                    Dra. León Rodríguez Frida María<br>
                                                    LSC. López Pacheco Liana<br>
                                                    Dr. López Salazar Leonel Gualberto<br>
                                                    M en CE. Márquez Ortega Domingo<br>
                                                    Dr. Mata Vargas Iván Noé<br>
                                                    Dra. Mora Reyes Laura<br>
                                                    Dr. Oropeza Legorreta Carlos<br>
                                                    Dr. Osorio Galicia Ramón<br>
                                                    M en I. Pineda Becerril Miguel de Nazareth<br>
                                                    Dr. Ramos Carranza Rogelio<br>
                                                    Ing. Rico Castro José Juan<br>
                                                    Dra. Rigaud Téllez Nelly<br>
                                                    Dr. Roldán Vázquez Valentín<br>
                                                    MGTI. Rosas Fonseca Rosalba Nancy<br>
                                                    Dr. Sánchez Barrera Julio Moisés<br>
                                                    M en C. Sánchez Guerra José Isaac<br>
                                                    Dr. Sánchez Nava Hugo<br>
                                                    Dra. Urrutia Vargas Celina Elena<br>
                                                    MAO. Urrutia Vargas Martha Lilia<br>
                                                    M en C. Vázquez Salazar María Guadalupe<br>
                                                    M en I. Vázquez Suarez Vicente<br></p> 
                            <h5 class="card-title m-3">Comité evaluador científico internacional:</h5>
                            <p class="card-title m-3">Dra. Crespo Crespo Cecilia (Argentina)<br>
                                                    Dr. Francisco Curcio Italo (Brasil)<br>
                                                    Dr. Gaitán Lozano Ricardo (Colombia)<br>
                                                    Dra. Mota Villegas Dorenis Josefina (Venezuela)<br>
                                                    Mtro. Valle Pereira Ricardo Enrique (Venezuela)<br></p>           
                </div>
            </div>
        </div>
        <!-----------CARDS ACERCA DE------------> 
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="card mb-3">
                    <div class="row">
                        <div class="card-body">
                            <h5 class="card-title m-3">Comité organizador</h5>
                            <p class="card-title m-3">Dr. Aguilar Márquez Armando<br>
                                                    Dr. Altamira Ibarra Jorge<br>
                                                    Dr. Contreras Espinosa José Juan<br>
                                                    Dr. García León Omar<br>
                                                    Dr. Hernández Castillo José Luz<br>
                                                    Dr. Hernández Gómez Víctor Hugo<br>
                                                    Dra. León Rodríguez Frida María<br>
                                                    M en I.Pineda Becerril Miguel de Nazareth<br>
                                                    Ing. Rico Castro José Juan<br>
                                                    Dr. Roldán Vázquez Valentín<br>
                                                    Dr. Sánchez Barrera Julio Moisés<br></p>
                            <h5 class="card-title m-3">Comité técnico</h5>
                            <p class="card-title m-3">MDA. Clemente Rodríguez Clarisa<br>
                                                    M en C. Flores Pérez Mayte<br>
                                                    M en SI. Lara Martínez Maricela<br>
                                                    LSC. López Pacheco Liana<br>
                                                    Dr. López Salazar Leonel Gualberto<br>
                                                    M en CE. Márquez Ortega Domingo<br>
                                                    M en TIC. Pérez Hernández Guillermo<br>
                                                    Ing. Rico Castro José Juan<br>
                                                    Dr. Roldán Vázquez Valentín<br>
                                                    MGTI. Rosas Fonseca Rosalba Nancy<br>
                                                    M en C. Sánchez Guerra José Isaac<br>
                                                    M en C. Vázquez Salazar María Guadalupe<br></p>
                            <h5 class="card-title m-3">Comité editorial</h5>
                            <p class="card-title m-3">Dr. Altamira Ibarra Jorge<br>
                                                    LI. Barrera Romero Elizabeth<br>
                                                    LI.González Hernández Rocío<br>
                                                    Dr. Hernández Castillo José Luz<br>
                                                    LSC. López Pacheco Liana<br>
                                                    LI. Pérez Solano Carla Pamela<br>
                                                    M en I. Ruíz Camargo Cariño<br>
                                                    M en C. Vázquez Salazar María Guadalupe<br></p>
                            <h5 class="card-title m-3">Coordinación de diseño gráfico</h5>
                            <p class="card-title m-3">LDCV. Simón Farfán Karina<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-3">
                            <h5 class="card-title m-3">Prólogo</h5>
                            <p class="card-title m-3">El Decimocuarto Congreso Internacional sobre la Enseñanza y Aplicación de 
                                 Matemáticas tiene el propósito de reunir a investigadores y profesores de reconocida 
                                 trayectoria profesional relacionados con la enseñanza y aplicación de las matemáticas ahora con 
                                 el panorama actual en los ambientes virtuales y a partir de la nueva normalidad a la que nos 
                                 enfrentamos al regreso de nuestras actividades de manera híbrida. El objetivo es intercambiar 
                                 experiencias y conocimientos que permitan mejorar la enseñanza y aprendizaje de las matemáticas 
                                 en todos los niveles educativos, conjuntando esfuerzos en beneficio de los estudiantes. Durante 
                                 el congreso se podrá analizar, discutir y difundir el estado del conocimiento de las matemáticas 
                                 a nivel nacional o internacional, vinculando una visión conjunta de los participantes proponiendo 
                                 acciones e intereses comunes, así como la investigación de calidad que interactúe en la actualización 
                                 y perfeccionamiento del desarrollo científico, tecnológico y social.</p>           
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card mb-3">
                            <h5 class="card-title m-3">Agradecimientos</h5>
                            <p class="card-title m-3">Se le agradece al Dr. David Quintanar Guerrero Director 
                                de la FES-Cuautitlán, I. A. Alfredo Alvarez Cárdenas Secretario General de la 
                                FES-Cuautitlán y a la Lic. Claudia Vanessa Joachin Bolaños Coordinadora de 
                                Comunicación y Extensión Universitaria, por brindarnos su apoyo para la 
                                realización de este Congreso. Nuestro agradecimiento y reconocimiento al grupo 
                                de alumnos y profesores que participaron en la realización de este Congreso.</p>           
                </div>
                <div class="card mb-3">
                            <h5 class="card-title m-3">Edición de memorias</h5>
                            <p class="card-title m-3"> Dr. Altamira Ibarra Jorge<br>
                                                    Dr. Hernández Castillo José Luz<br>
                                                    LSC. López Pacheco Liana<br></p>
                            <h5 class="card-title m-3">Diseño de Memoria</h5>
                            <p class="card-title m-3">LSC. López Pacheco Liana<br></p>           
                </div>
            </div>
        </div>
        
    </div>
    <section>
<?php 
		require_once('../../Layouts/maps.php');
	?>
</section>
</section>
<footer><!-----------CONTENEDOR PIE DE PAGINA------------>
<?php 
		require_once('../../Layouts/footer.php');
	?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
</body>
</html>