<!--div class="container p-0 col-xl-12 col-lg-12 col-md-12 d-none d-md-block justify-content-sm-center zi"-->
<div class="container p-0 col-xl-12 col-lg-12 col-md-12 d-none d-md-block justify-content-sm-center" >
        <?php // Traer imagen del banner de la BD
        $imagenSQL = "SELECT banner_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
        $traerIMG = mysqli_query($conexion, $imagenSQL);
        $rowImagen = $traerIMG->fetch_assoc();
        $rutaIMG = $rowImagen['banner_congreso'];
        $rutaFinal = str_replace("../", "./", $rutaIMG);
        ?>
        <a href="https://congresomatematicas.cuautitlan.unam.mx/"><img src="<?php echo $rutaFinal; ?>" alt="" class="imagen d-flex p-0 col-xl-12 col-lg-12 col-md-12 d-sm-none d-md-block"></a>
      
 </div>
<hr class="container linea">
<div class="container p-0  d-sm-block d-md-none justify-content-sm-center zi">
        <?php // Traer imagen del logo de la BD
        $rutaSQL = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso);";
        $ejecrutaSQL = mysqli_query($conexion, $rutaSQL);
        $rowCongreso = mysqli_fetch_assoc($ejecrutaSQL);
        $rutaLogo = $rowCongreso['logo_congreso'];
        $rutaFinalLogo = str_replace("../../", "./", $rutaLogo);
        ?>
        <!-- ./src/logos_congresos/logoXVI.jpg -->
        <img src="<?php echo $rutaFinalLogo; ?>" alt="Logo Congreso" class="img-thumbnail border border-0">
</div>