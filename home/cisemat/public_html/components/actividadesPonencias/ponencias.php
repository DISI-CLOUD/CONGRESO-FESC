<?php 
    session_start();    
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
    <title>Ponencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./ponencias.css">

</head>
<body>
<header class="fixed-top"> <!--------------MANDA A LLAMAR LA NAVBAR--------------->  
    <?php 
		require_once('../../Layouts/nav.php');
	?>
</header>
<section style="margin-top: 250px;">

<div class="container-fluid mt-5 mb-5">
    <div class="row p-2">
        <div class="col-xl-1 col-lg-1 col-md-1 d-none d-sm-block"></div>
        <div class="col-xl-11 col-lg-11 col-md-11 col-sm-12">
            <div class= "container col-xl-10 col-lg-10 col-md-12 col-sm-12">
                <h2 class="mb-3">Ponencias</h2>
                <div class="mb-5">
                    <a href="../../src/convocatoria/XV.pdf" target="_blank"> <input class=" btn-convocatoria px-5 pb-1" type="submit"  value="Ver Convocatoria" ></a><!-----------Descarga la convocatoria------------>
                </div>
            <!----------------cards de las ponencias--------------------------->
            <div class="row">
                <div class="div col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body m-2"><!--Cuerpo de la card-->
                            <div class="row">
                                <div class="col-xl-10 col-lg-9 col-md-8 d-sm-block col-sm-12 rounded card-body-congreso mb-2" style="background-color: #CBE6FE;">
                                    <!--Nombre de la ponencia-->
                                    <p class="mt-3" id="edicion">Conferencias Magistrales</p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 d-sm-flex justify-content-center ">
                                    <!--Logo del congreso actual-->
                                <img src="../../src/logos_congresos/XV.jpeg" alt="XIV Congreso" class="logo" height= "70px"  width= "80px">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xl-8 col-lg-8 col-md-12 d-sm-block col-sm-12 mt-3 mb-3">
                                    <span class="span-texto">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
                                </div>
                            </div>
                            <!--Fecha del congreso-->
                            <div class="mb-5">
                                <span class="span-fecha">4 y 5 de Mayo 2023</span>
                            </div>   
                            <div class="d-flex justify-content-start">
                            <a href="../../components/programaMagistrales/programaMagistral.php" class="link">Ver ponencias</a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <i class="fab fa-laravel"></i>
                            </div>
                        </div>
                    </div>
                </div><!----fin de la card de conferencias magistrales--->
                <!----------------cards de las ponencias--------------------------->
                <div class="div col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12">
                    <div class="card">
                        <div class="card-body m-2"><!--Cuerpo de la card-->
                            <div class="row">
                                <div class="col-xl-10 col-lg-9 col-md-8 d-sm-block col-sm-12 rounded card-body-congreso mb-2" style="background-color: #CBE6FE;">
                                    <!--Nombre de la ponencia-->
                                    <p class="mt-3" id="edicion">Ponencias Orales</p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 d-sm-flex justify-content-center ">
                                    <!--Logo del congreso actual-->
                                <img src="../../src/logos_congresos/XV.jpeg" alt="XIV Congreso" class="logo" height= "70px"  width= "80px">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xl-8 col-lg-8 col-md-12 d-sm-block col-sm-12 mt-3 mb-3">
                                    <span class="span-texto">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
                                </div>
                            </div>
                            <!--Fecha del congreso-->
                            <div class="mb-5">
                                <span class="span-fecha">4 y 5 de Mayo 2023</span>
                            </div>   
                            <div class="d-flex justify-content-start">
                                <a href="../../components/GuiasYPlantillas/guias.php" class="link">Ver bases</a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <i class="fab fa-laravel"></i>
                            </div>
                        </div>
                    </div>
                </div><!----fin de la card de ponencias orales--->



                    <!----------------cards de las ponencias--------------------------->
                    <div class="div col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-body m-2"><!--Cuerpo de la card-->
                            <div class="row">
                                <div class="col-xl-10 col-lg-9 col-md-8 d-sm-block col-sm-12 rounded card-body-congreso mb-2" style="background-color: #CBE6FE;">
                                    <!--Nombre de la ponencia-->
                                    <p class="mt-3" id="edicion">Cartel (Concurso) </p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 d-sm-flex justify-content-center ">
                                    <!--Logo del congreso actual-->
                                <img src="../../src/logos_congresos/XV.jpeg" alt="XIV Congreso" class="logo" height= "70px"  width= "80px">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xl-8 col-lg-8 col-md-12 d-sm-block col-sm-12 mt-3 mb-3">
                                    <span class="span-texto">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
                                </div>
                            </div>
                            <!--Fecha del congreso-->
                            <div class="mb-5">
                                <span class="span-fecha">4 y 5 de Mayo 2023</span>
                            </div>   
                            <div class="d-flex justify-content-start">
                                <a href="../../components/GuiasYPlantillas/guias.php" class="link">Ver bases</a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <i class="fab fa-laravel"></i>
                            </div>
                        </div>
                    </div> 
                </div><!----fin de la card de cartel--->

                    <!----------------cards de las ponencias--------------------------->
                    <div class="div col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-body m-2"><!--Cuerpo de la card-->
                            <div class="row">
                                <div class="col-xl-10 col-lg-9 col-md-8 d-sm-block col-sm-12 rounded card-body-congreso mb-2" style="background-color: #CBE6FE;">
                                    <!--Nombre de la ponencia-->
                                    <p class="mt-3" id="edicion">Taller</p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 d-sm-flex justify-content-center ">
                                    <!--Logo del congreso actual-->
                                <img src="../../src/logos_congresos/XV.jpeg" alt="XIV Congreso" class="logo" height= "70px"  width= "80px">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xl-8 col-lg-8 col-md-12 d-sm-block col-sm-12 mt-3 mb-3">
                                    <span class="span-texto">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
                                </div>
                            </div>
                            <!--Fecha del congreso-->
                            <div class="mb-5">
                                <span class="span-fecha">4 y 5 de Mayo 2023</span>
                            </div>   
                            <div class="d-flex justify-content-start">
                                <a href="../../components/GuiasYPlantillas/guias.php" class="link">Ver bases</a>
                            </div>
                            <div class="d-flex justify-content-end">
                                <i class="fab fa-laravel"></i>
                            </div>
                        </div>
                    </div>
                </div><!----fin de la card de ctaller--->
                <!----------------cards de las ponencias--------------------------->
                <div class="div col-xl-6 col-lg-6 col-md-6 d-sm-block col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-body m-2"><!--Cuerpo de la card-->
                            <div class="row">
                                <div class="col-xl-10 col-lg-9 col-md-8 d-sm-block col-sm-12 rounded card-body-congreso mb-2"style="background-color: #CBE6FE;">
                                    <!--Nombre de la ponencia-->
                                    <p class="mt-3" id="edicion">Mesa Redonda</p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 d-sm-flex justify-content-center ">
                                    <!--Logo del congreso actual-->
                                <img src="../../src/logos_congresos/XV.jpeg" alt="XIV Congreso" class="logo" height= "70px"  width= "80px">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xl-8 col-lg-8 col-md-12 d-sm-block col-sm-12 mt-3 mb-3">
                                    <span class="span-texto">Congreso Internacional Sobre la Enseñanza y Aplicación de las Matemáticas</span>
                                </div>
                            </div>
                            <!--Fecha del congreso-->
                            <div class="mb-5">
                                <span class="span-fecha">4 y 5 de Mayo 2023</span>
                            </div>   
                            <div class="d-flex justify-content-start">

                            </div>
                            <div class="d-flex justify-content-end">
                                <i class="fab fa-laravel"></i>
                            </div>
                        </div>
                    </div>
                </div><!----fin de la card de mesa redonda-->
            </div>
            </div>
        </div>
    </div>
</div><!--container-->
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
