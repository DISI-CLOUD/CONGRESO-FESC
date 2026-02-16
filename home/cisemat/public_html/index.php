<?php
session_start();
require 'modelo/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		require_once('Layouts/iconoCongresoLink.php');
	?>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title id="titulo">Congreso FESC</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="./styles.css?v=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>

    </style>
</head>

<body>
	<div class="mascara-blur" id="mascara-blur"></div>

	<header class="fixed-top">
		<?php
		$index = true;
		require_once('Layouts/nav.php');
		?>
	</header>

    <div class="container mt-4 content-flag" id="content-flag">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="important-ad">
                    <button type="button" class="close-button" id="close-flag">
                        <i class="fas fa-times px-2"></i>
                    </button>
                    <h4 class="alert-heading"><strong>Anuncio Importante:</strong></h4>
					<h4>Incompatibilidad con Mozilla Firefox</h4>
                    <p><br><br>Por favor, ten en cuenta que nuestra página web no es compatible actualmente con Mozilla Firefox. Te sugerimos utilizar otro navegador como Google Chrome, Microsoft Edge u Opera para acceder a nuestros servicios. Lamentamos las molestias y agradecemos tu comprensión.</p>
                    <p><br><br>Gracias.</p>
                    <p><strong>CISEyAM</strong></p>
                </div>
            </div>
        </div>
	</div>

	<section style="margin-top: 210px;">

		<?php
		require_once('Layouts/banner.php');
		?>
		<?php
		require_once('Layouts/fechas.php');
		?>
	</section>
	<section>
		<?php
		require_once('Layouts/carrusel.php');
		?>
	</section>
	<section>
		<?php
		require_once('Layouts/maps.php');
		?>
	</section>





	<footer>
		<?php
		require_once('Layouts/footer.php');
		?>
	</footer>


	<script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script defer src="./index.js"></script>
	<script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>

	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JC5NVC40HC"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JC5NVC40HC');
</script>
</body>

</html>
