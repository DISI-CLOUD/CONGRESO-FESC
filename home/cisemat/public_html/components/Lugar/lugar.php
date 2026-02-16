<?php 
    session_start(); 
    require "../../modelo/conexion.php";   
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
    <title>Lugar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./lugar.css">

</head>
<body>
<header class="fixed-top">
    <?php 
		require_once('../../Layouts/nav.php');
	?>
</header>
<section style="margin-top: 250px;">
    <div class="container mt-5 mb-5">
        <h2 class="mb-3">Lugar</h2>
        <div class="div">
            <div class="row text-center border border-success p-3 border-opacity-10 rounded ">
                <span >
                    Facultad de Estudios Superiores Cuautitlán<br>
                    Km 2.5 carretera Cuautitlán-Teoloyucan, San Sebastián Xhala, Cuautitlán Izcalli;,
                    Estado de México.
                    C.P. 54714.
                </span>
            </div>
            <div class="row mt-4 map-responsive mb-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.5259176186373!2d-99.18976938469959!3d19.690221237493482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f54156948569%3A0x9ef349d975d1150f!2sFES%20Cuautitl%C3%A1n%20UNAM%20Campus%20IV!5e0!3m2!1ses!2smx!4v1666168722872!5m2!1ses!2smx" width="800" height="600" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    
    </div>
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
