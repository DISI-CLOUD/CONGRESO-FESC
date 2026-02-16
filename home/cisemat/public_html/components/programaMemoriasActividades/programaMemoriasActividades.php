<?php 
    session_start();    
?>
/** 
*******************************************************************************************************
* Apartado que muestra las actividades que se llevaron acabo en cada uno de los congresos anteriores.
* Cualquier duda o sugerencia:
* @author Magda Marina Sanchez Campos marinacampos1125@gmail.com, Alison Rubio, Carlos Tejeda. 
*******************************************************************************************************
**/
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
    <link rel="stylesheet" href="../../Layouts/CardMemoriaActividades/memoriaActividades.css">

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
        <div class="row">
            
        <?php 
		require_once('../../Layouts/CardMemoriaActividades/cardMemoriaActividades.php');
        ?>
            
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