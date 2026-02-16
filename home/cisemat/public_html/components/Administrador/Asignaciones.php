
<?php

/** 
 *******************************************************************************************************
 * Apartado asignaciones, muestras las consultas.
 * Cualquier duda o sugerencia:
 * @author Alison Michelle Rubio Garcia allyssonrg@gmail.com, Marina Sanchez 
 *******************************************************************************************************
 **/


session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
    exit;
}
$errores = array(); //Es un arreglo que guarda todos los errores y los muestra
$_SESSION['info'] = ""; //Muestra la informacion exitosa y los muestra
require "../../modelo/borraAsignacion.php";
require "../../modelo/conexion.php";
require "../../modelo/maximoAsignacion.php";
require_once "../../modelo/privilegiosUsuario.php";





$estadoPrivilegio = []; // Un arreglo que guarda los estados del privilegio
$cont2 = 0; // Para recorrer las posiciones del segundo arreglo

$consPrivilegiosEstado = "SELECT * FROM funcion_usuario WHERE id_usuario = ?";
$stmt = mysqli_prepare($conexion, $consPrivilegiosEstado);
mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
mysqli_stmt_execute($stmt);
$resPrivilegiosEstado = mysqli_stmt_get_result($stmt);

while ($row2 = mysqli_fetch_array($resPrivilegiosEstado)) {
    $estadoPrivilegio[$cont2] = $row2['estado_funcion'];
    $cont2++;
}

$_SESSION['estadoPrivilegio'] = $estadoPrivilegio;

foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
    if ($valor == 41 && $estado == 'ON') {
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
            <title>Asignaciones</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">


            <link rel="stylesheet" href="./admin.css">
            <link rel="stylesheet" href="./styleOfTab.css">
            <link rel="stylesheet" href="../../Layouts/CardTrabajoSinEvaluador/trabajoSinEva.css">
<!--

             <link rel="stylesheet" href="./trabajo.css">
-->

 


            <!-- Cargar jQuery primero -->
            <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

            <!-- Luego, cargar Bootstrap 5 -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script> -->


        </head>

        <body>
            <header>
                <?php
                require_once('../../Layouts/nav.php');
                ?>
            </header>
            <form method="POST">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                            <?php
                            require_once('../../Layouts/sidebar.php');
                            ?>

                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                            <div class="container">
                                <h2 class="mt-5 mb-5">Asignaciones</h2>
                                <!-------------------------------------------------------------------------------------------->
  
                                <h4>Tipo de Trabajo</h4>
                                <div class="tabs-container">
                                    <ul aria-labelledby="tabs-title">
                                        <li><a id="tab-1" href="#ponencia"> Ponencia </a></li>
                                        <li><a id="tab-2" href="#cartel"> Cartel </a></li>
                                        <li><a id="tab-3" href="#taller"> Taller </a></li>
                                        <li><a id="tab-4" href="#prototipo"> Prototipo </a></li>
                                    </ul>

                                    <div class="tabs_panels flow">
                                        <div id="ponencia" aria-labelledby="tab-1">
                                            <p></p>
                                            <div class="row">

                                                <div
                                                    class="table-responsive border border-success p-2 border-opacity-10 rounded">
                                                    <?php if (strlen($_SESSION['info']) > 1): ?>
                                                        <div id="informacionExito" class="alert alert-success text-center">
                                                            <?php echo htmlspecialchars($_SESSION['info']);
                                                            // require_once "../../librerias/PHPMailer/src/correoAsignacionEvaluador.php";
                                                            ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (count($errores) > 0): ?>
                                                        <div id="informacionError" class="alert alert-danger text-center">
                                                            <?php foreach ($errores as $showerror): ?>
                                                                <?php echo htmlspecialchars($showerror); ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
   
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-cabecera">
                                                                <th scope="col" class="text-wrap">#</th>
                                                                <th scope="col" class="text-wrap">Trabajo</th>
                                                                <th scope="col" class="text-wrap">Título</th>
                                                                <th scope="col" class="text-wrap">Autor</th>
                                                                <th scope="col" class="text-wrap">Tipo</th>
                                                                <th scope="col" class="text-wrap">Categoría</th>
                                                                <th scope="col" class="text-wrap">Fecha</th>
                                                                <th scope="col" class="text-wrap">Ver Detalles</th>
                                                                <th scope="col" class="text-wrap">Evaluador</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            require "../../modelo/traerDatosPrograma.php";
                                                            require "../../modelo/traerCongresoActual.php";

                                                            while ($idPonencia = mysqli_fetch_assoc($resPOregisSE)): ?>

                                                                <tr
                                                                    id="<?php echo htmlspecialchars($idPonencia['id_ponencia']); ?>">
                                                                <?php endwhile; ?>
                                                                <?php
                                                                require "../../modelo/traerDatosPrograma.php"; //Trae los registros de Ponencias del congreso actual
                                                        
                                                                while ($fetchTrabajosRegistrados = mysqli_fetch_assoc($resPOregisSE)) {
                                                                    $tituloPonencia = htmlspecialchars($fetchTrabajosRegistrados['titulo_ponencia']);
                                                                    $idUsuarioEvalua = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_evalua']);
                                                                    $idPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_ponencia']);
                                                                    $idTipoPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_tipo_ponencia']);
                                                                    $idAutor = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_registra']);
                                                                    $idCategoriaPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_categoria']);
                                                                    $fechaRegistroPonencia = htmlspecialchars($fetchTrabajosRegistrados['fecha_registro_ponencia']);

                                                                    //Da formato de fecha
                                                                    $date = date_create($fechaRegistroPonencia);
                                                                    $fechaRevisionPonenciaFormato = date_format($date, "Y/m/d H:i");

                                                                    // la categoria de la ponencia
                                                                    $consCategoriaPonencia = "SELECT * FROM categoria WHERE id_categoria='$idCategoriaPonencia'";
                                                                    $resCategoriaPonencia = mysqli_query($conexion, $consCategoriaPonencia);
                                                                    $fetchCategoriaPonencia = mysqli_fetch_assoc($resCategoriaPonencia);
                                                                    $categoriaPonencia = htmlspecialchars($fetchCategoriaPonencia['categoria']);

                                                                    //Consulta el tipo de la ponencia
                                                                    $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                                                                    $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                                                                    $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                                                                    $tipoPonencia = htmlspecialchars($fetchTipoPonencia['categoria_ponencia']);

                                                                    //Consulta al autor
                                                                    //Hace la consulta de los autores de la ponencia
                                                                    $consAutor = "SELECT * FROM usuario WHERE id_usuario='$idAutor'";
                                                                    $resAutor = mysqli_query($conexion, $consAutor);
                                                                    $fetchAutor = mysqli_fetch_assoc($resAutor);
                                                                    $nombreAutor = htmlspecialchars($fetchAutor['nombres_usuario']);
                                                                    $apellidosAutor = htmlspecialchars($fetchAutor['apellidos_usuario']);
                                                                    $nombreCompletoAutor = $apellidosAutor . " " . $nombreAutor;

                                                                    //Traer id de usuario revision ponencia
                                                                    $consIdRevisionPonencia = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia'  AND id_congreso='$idCongreso'";
                                                                    //LGLS 20241024 Agregue el idCongreso en la clausula de arriba;
                                                                    $resIdRevisionPonencia = mysqli_query($conexion, $consIdRevisionPonencia);

                                                                    if (mysqli_num_rows($resIdRevisionPonencia) > 0) {
                                                                        $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";

                                                                        $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                                                                        $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);

                                                                        //Campos de la revision
                                                                        if (mysqli_num_rows($resUsuarioRevisionPonencia) > 0) {
                                                                            $estadoRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['estatus_revision']);
                                                                            $descripcionRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['descripcion_revision']);
                                                                        }
                                                                    } else {
                                                                        $descripcionRevisionPonencia = "RESUMEN";
                                                                    }

                                                                    if ($idUsuarioEvalua != '') {
                                                                        $consNombreEvaluador = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
                                                                        $resNombreUsuarioEvalua = mysqli_query($conexion, $consNombreEvaluador);
                                                                        $fetchNombreUsuarioEvalua = mysqli_fetch_assoc($resNombreUsuarioEvalua);
                                                                        $nombresUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["nombres_usuario"]);
                                                                        $apellidosUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["apellidos_usuario"]);
                                                                        $nombreCompletoUsuarioEvalua = $apellidosUsuarioEvalua . " " . $nombresUsuarioEvalua;
                                                                    } else {
                                                                        $nombreCompletoUsuarioEvalua = '';
                                                                    }
                                                                    ?>
                                                                    <th scope="row">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                value="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                name="checkbox[]">
                                                                        </div>
                                                                    </th>

                                                                    <td>
                                                                        <?php echo $idPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tituloPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoAutor ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tipoPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $categoriaPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $fechaRevisionPonenciaFormato ?>
                                                                    </td>
                                                                    <td>

                                                                        <?php //echo $descripcionRevisionPonencia ?>
   
<div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title"></span>
    <a target="_blank" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1">
        <button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button>
    </a></div>                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoUsuarioEvalua ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="cartel" aria-labelledby="tab-2">
                                            <p></p>
                                            <div class="row">

                                                <div
                                                    class="table-responsive border border-success p-2 border-opacity-10 rounded">
                                                    <?php if (strlen($_SESSION['info']) > 1): ?>
                                                        <div id="informacionExito" class="alert alert-success text-center">
                                                            <?php echo htmlspecialchars($_SESSION['info']);
                                                            require_once "../../librerias/PHPMailer/src/correoAsignacionEvaluador.php";
                                                            ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (count($errores) > 0): ?>
                                                        <div id="informacionError" class="alert alert-danger text-center">
                                                            <?php foreach ($errores as $showerror): ?>
                                                                <?php echo htmlspecialchars($showerror); ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <table class="table">

                                                        <thead>
                                                            <tr class="table-cabecera">
                                                                <th scope="col" class="text-wrap">#</th>
                                                                <th scope="col" class="text-wrap">Trabajo</th>
                                                                <th scope="col" class="text-wrap">Título</th>
                                                                <th scope="col" class="text-wrap">Autor</th>
                                                                <th scope="col" class="text-wrap">Tipo</th>
                                                                <th scope="col" class="text-wrap">Categoría</th>
                                                                <th scope="col" class="text-wrap">Fecha</th>
                                                                <th scope="col" class="text-wrap">Ver Detalles</th>
                                                                <th scope="col" class="text-wrap">Evaluador</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            require "../../modelo/traerDatosPrograma.php";
                                                            require "../../modelo/traerCongresoActual.php";

                                                            while ($idPonencia = mysqli_fetch_assoc($resCAregisSE)): ?>

                                                                <tr
                                                                    id="<?php echo htmlspecialchars($idPonencia['id_ponencia']); ?>">
                                                                <?php endwhile; ?>
                                                                <?php
                                                                require "../../modelo/traerDatosPrograma.php"; //Trae los registros de Ponencias del congreso actual
                                                        
                                                                while ($fetchTrabajosRegistrados = mysqli_fetch_assoc($resCAregisSE)) {
                                                                    $tituloPonencia = htmlspecialchars($fetchTrabajosRegistrados['titulo_ponencia']);
                                                                    $idUsuarioEvalua = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_evalua']);
                                                                    $idPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_ponencia']);
                                                                    $idTipoPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_tipo_ponencia']);
                                                                    $idAutor = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_registra']);
                                                                    $idCategoriaPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_categoria']);
                                                                    $fechaRegistroPonencia = htmlspecialchars($fetchTrabajosRegistrados['fecha_registro_ponencia']);

                                                                    //Da formato de fecha
                                                                    $date = date_create($fechaRegistroPonencia);
                                                                    $fechaRevisionPonenciaFormato = date_format($date, "Y/m/d H:i");

                                                                    // la categoria de la ponencia
                                                                    $consCategoriaPonencia = "SELECT * FROM categoria WHERE id_categoria='$idCategoriaPonencia'";
                                                                    $resCategoriaPonencia = mysqli_query($conexion, $consCategoriaPonencia);
                                                                    $fetchCategoriaPonencia = mysqli_fetch_assoc($resCategoriaPonencia);
                                                                    $categoriaPonencia = htmlspecialchars($fetchCategoriaPonencia['categoria']);

                                                                    //Consulta el tipo de la ponencia
                                                                    $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                                                                    $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                                                                    $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                                                                    $tipoPonencia = htmlspecialchars($fetchTipoPonencia['categoria_ponencia']);

                                                                    //Consulta al autor
                                                                    //Hace la consulta de los autores de la ponencia
                                                                    $consAutor = "SELECT * FROM usuario WHERE id_usuario='$idAutor'";
                                                                    $resAutor = mysqli_query($conexion, $consAutor);
                                                                    $fetchAutor = mysqli_fetch_assoc($resAutor);
                                                                    $nombreAutor = htmlspecialchars($fetchAutor['nombres_usuario']);
                                                                    $apellidosAutor = htmlspecialchars($fetchAutor['apellidos_usuario']);
                                                                    $nombreCompletoAutor = $apellidosAutor . " " . $nombreAutor;

                                                                    //Traer id de usuario revision ponencia
                                                                    $consIdRevisionPonencia = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                                                                    $resIdRevisionPonencia = mysqli_query($conexion, $consIdRevisionPonencia);

                                                                    if (mysqli_num_rows($resIdRevisionPonencia) > 0) {
                                                                        $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";

                                                                        $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                                                                        $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);

                                                                        //Campos de la revision
                                                                        if (mysqli_num_rows($resUsuarioRevisionPonencia) > 0) {
                                                                            $estadoRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['estatus_revision']);
                                                                            $descripcionRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['descripcion_revision']);
                                                                        }
                                                                    } else {
                                                                        $descripcionRevisionPonencia = "RESUMEN";
                                                                    }

                                                                    if ($idUsuarioEvalua != '') {
                                                                        $consNombreEvaluador = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
                                                                        $resNombreUsuarioEvalua = mysqli_query($conexion, $consNombreEvaluador);
                                                                        $fetchNombreUsuarioEvalua = mysqli_fetch_assoc($resNombreUsuarioEvalua);
                                                                        $nombresUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["nombres_usuario"]);
                                                                        $apellidosUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["apellidos_usuario"]);
                                                                        $nombreCompletoUsuarioEvalua = $apellidosUsuarioEvalua . " " . $nombresUsuarioEvalua;
                                                                    } else {
                                                                        $nombreCompletoUsuarioEvalua = '';
                                                                    }
                                                                    ?>
                                                                    <th scope="row">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                value="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                name="checkbox[]">
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <?php echo $idPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tituloPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoAutor ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tipoPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $categoriaPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $fechaRevisionPonenciaFormato ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php //echo $descripcionRevisionPonencia ?>
<div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title"></span>
    <a target="_blank" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1">
        <button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button>
    </a></div>                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoUsuarioEvalua ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!--/* AQUI CIERRA DIV */-->
                                        </div>
                                        <div id="taller" aria-labelledby="tab-3">
                                            <p></p>
                                            <div class="row">

                                                <div
                                                    class="table-responsive border border-success p-2 border-opacity-10 rounded">
                                                    <?php if (strlen($_SESSION['info']) > 1): ?>
                                                        <div id="informacionExito" class="alert alert-success text-center">
                                                            <?php echo htmlspecialchars($_SESSION['info']);
                                                            require_once "../../librerias/PHPMailer/src/correoAsignacionEvaluador.php";
                                                            ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (count($errores) > 0): ?>
                                                        <div id="informacionError" class="alert alert-danger text-center">
                                                            <?php foreach ($errores as $showerror): ?>
                                                                <?php echo htmlspecialchars($showerror); ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-cabecera">
                                                                <th scope="col" class="text-wrap">#</th>
                                                                <th scope="col" class="text-wrap">Trabajo</th>
                                                                <th scope="col" class="text-wrap">Título</th>
                                                                <th scope="col" class="text-wrap">Autor</th>
                                                                <th scope="col" class="text-wrap">Tipo</th>
                                                                <th scope="col" class="text-wrap">Categoría</th>
                                                                <th scope="col" class="text-wrap">Fecha</th>
                                                                <th scope="col" class="text-wrap">Ver Detalles</th>
                                                                <th scope="col" class="text-wrap">Evaluador</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            require "../../modelo/traerDatosPrograma.php";
                                                            require "../../modelo/traerCongresoActual.php";

                                                            while ($idPonencia = mysqli_fetch_assoc($resTAregisSE)): ?>

                                                                <tr
                                                                    id="<?php echo htmlspecialchars($idPonencia['id_ponencia']); ?>">
                                                                <?php endwhile; ?>
                                                                <?php
                                                                require "../../modelo/traerDatosPrograma.php"; //Trae los registros de Ponencias del congreso actual
                                                        
                                                                while ($fetchTrabajosRegistrados = mysqli_fetch_assoc($resTAregisSE)) {
                                                                    $tituloPonencia = htmlspecialchars($fetchTrabajosRegistrados['titulo_ponencia']);
                                                                    $idUsuarioEvalua = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_evalua']);
                                                                    $idPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_ponencia']);
                                                                    $idTipoPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_tipo_ponencia']);
                                                                    $idAutor = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_registra']);
                                                                    $idCategoriaPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_categoria']);
                                                                    $fechaRegistroPonencia = htmlspecialchars($fetchTrabajosRegistrados['fecha_registro_ponencia']);

                                                                    //Da formato de fecha
                                                                    $date = date_create($fechaRegistroPonencia);
                                                                    $fechaRevisionPonenciaFormato = date_format($date, "Y/m/d H:i");

                                                                    // la categoria de la ponencia
                                                                    $consCategoriaPonencia = "SELECT * FROM categoria WHERE id_categoria='$idCategoriaPonencia'";
                                                                    $resCategoriaPonencia = mysqli_query($conexion, $consCategoriaPonencia);
                                                                    $fetchCategoriaPonencia = mysqli_fetch_assoc($resCategoriaPonencia);
                                                                    $categoriaPonencia = htmlspecialchars($fetchCategoriaPonencia['categoria']);

                                                                    //Consulta el tipo de la ponencia
                                                                    $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                                                                    $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                                                                    $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                                                                    $tipoPonencia = htmlspecialchars($fetchTipoPonencia['categoria_ponencia']);

                                                                    //Consulta al autor
                                                                    //Hace la consulta de los autores de la ponencia
                                                                    $consAutor = "SELECT * FROM usuario WHERE id_usuario='$idAutor'";
                                                                    $resAutor = mysqli_query($conexion, $consAutor);
                                                                    $fetchAutor = mysqli_fetch_assoc($resAutor);
                                                                    $nombreAutor = htmlspecialchars($fetchAutor['nombres_usuario']);
                                                                    $apellidosAutor = htmlspecialchars($fetchAutor['apellidos_usuario']);
                                                                    $nombreCompletoAutor = $apellidosAutor . " " . $nombreAutor;

                                                                    //Traer id de usuario revision ponencia
                                                                    $consIdRevisionPonencia = "SELECT * FROM usuario_revision_ponencia 
                                                                                               WHERE id_ponencia='$idPonencia' 
                                                                                                 AND id_congreso='$idCongreso'";
                                                                    $resIdRevisionPonencia = mysqli_query($conexion, $consIdRevisionPonencia);

                                                                    if (mysqli_num_rows($resIdRevisionPonencia) > 0) {
                                                                        $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";

                                                                        $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                                                                        $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);

                                                                        //Campos de la revision
                                                                        if (mysqli_num_rows($resUsuarioRevisionPonencia) > 0) {
                                                                            $estadoRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['estatus_revision']);
                                                                            $descripcionRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['descripcion_revision']);
                                                                        }
                                                                    } else {
                                                                        $descripcionRevisionPonencia = "RESUMEN";
                                                                    }

                                                                    if ($idUsuarioEvalua != '') {
                                                                        $consNombreEvaluador = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
                                                                        $resNombreUsuarioEvalua = mysqli_query($conexion, $consNombreEvaluador);
                                                                        $fetchNombreUsuarioEvalua = mysqli_fetch_assoc($resNombreUsuarioEvalua);
                                                                        $nombresUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["nombres_usuario"]);
                                                                        $apellidosUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["apellidos_usuario"]);
                                                                        $nombreCompletoUsuarioEvalua = $apellidosUsuarioEvalua . " " . $nombresUsuarioEvalua;
                                                                    } else {
                                                                        $nombreCompletoUsuarioEvalua = '';
                                                                    }
                                                                    ?>
                                                                    <th scope="row">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                value="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                name="checkbox[]">
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <?php echo $idPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tituloPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoAutor ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tipoPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $categoriaPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $fechaRevisionPonenciaFormato ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php //echo $descripcionRevisionPonencia ?>
<div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title"></span><a target="_blank" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoUsuarioEvalua ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--/* AQUI CIERRA DIV */-->
                                        </div>
                                        <div id="prototipo" aria-labelledby="tab-4">
                                            <p></p>
                                            <div class="row">

                                                <div
                                                    class="table-responsive border border-success p-2 border-opacity-10 rounded">
                                                    <?php if (strlen($_SESSION['info']) > 1): ?>
                                                        <div id="informacionExito" class="alert alert-success text-center">
                                                            <?php echo htmlspecialchars($_SESSION['info']);
                                                            require_once "../../librerias/PHPMailer/src/correoAsignacionEvaluador.php";
                                                            ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (count($errores) > 0): ?>
                                                        <div id="informacionError" class="alert alert-danger text-center">
                                                            <?php foreach ($errores as $showerror): ?>
                                                                <?php echo htmlspecialchars($showerror); ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-cabecera">
                                                                <th scope="col" class="text-wrap">#</th>
                                                                <th scope="col" class="text-wrap">Trabajo</th>
                                                                <th scope="col" class="text-wrap">Título</th>
                                                                <th scope="col" class="text-wrap">Autor</th>
                                                                <th scope="col" class="text-wrap">Tipo</th>
                                                                <th scope="col" class="text-wrap">Categoría</th>
                                                                <th scope="col" class="text-wrap">Fecha</th>
                                                                <th scope="col" class="text-wrap">Ver Detalles</th>
                                                                <th scope="col" class="text-wrap">Evaluador</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            require "../../modelo/traerDatosPrograma.php";
                                                            require "../../modelo/traerCongresoActual.php";

                                                            while ($idPonencia = mysqli_fetch_assoc($resPRregisSE)): ?>

                                                                <tr
                                                                    id="<?php echo htmlspecialchars($idPonencia['id_ponencia']); ?>">
                                                                <?php endwhile; ?>
                                                                <?php
                                                                require "../../modelo/traerDatosPrograma.php"; //Trae los registros de Ponencias del congreso actual
                                                        
                                                                while ($fetchTrabajosRegistrados = mysqli_fetch_assoc($resPRregisSE)) {
                                                                    $tituloPonencia = htmlspecialchars($fetchTrabajosRegistrados['titulo_ponencia']);
                                                                    $idUsuarioEvalua = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_evalua']);
                                                                    $idPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_ponencia']);
                                                                    $idTipoPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_tipo_ponencia']);
                                                                    $idAutor = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_registra']);
                                                                    $idCategoriaPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_categoria']);
                                                                    $fechaRegistroPonencia = htmlspecialchars($fetchTrabajosRegistrados['fecha_registro_ponencia']);

                                                                    //Da formato de fecha
                                                                    $date = date_create($fechaRegistroPonencia);
                                                                    $fechaRevisionPonenciaFormato = date_format($date, "Y/m/d H:i");

                                                                    // la categoria de la ponencia
                                                                    $consCategoriaPonencia = "SELECT * FROM categoria WHERE id_categoria='$idCategoriaPonencia'";
                                                                    $resCategoriaPonencia = mysqli_query($conexion, $consCategoriaPonencia);
                                                                    $fetchCategoriaPonencia = mysqli_fetch_assoc($resCategoriaPonencia);
                                                                    $categoriaPonencia = htmlspecialchars($fetchCategoriaPonencia['categoria']);

                                                                    //Consulta el tipo de la ponencia
                                                                    $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                                                                    $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                                                                    $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                                                                    $tipoPonencia = htmlspecialchars($fetchTipoPonencia['categoria_ponencia']);

                                                                    //Consulta al autor
                                                                    //Hace la consulta de los autores de la ponencia
                                                                    $consAutor = "SELECT * FROM usuario WHERE id_usuario='$idAutor'";
                                                                    $resAutor = mysqli_query($conexion, $consAutor);
                                                                    $fetchAutor = mysqli_fetch_assoc($resAutor);
                                                                    $nombreAutor = htmlspecialchars($fetchAutor['nombres_usuario']);
                                                                    $apellidosAutor = htmlspecialchars($fetchAutor['apellidos_usuario']);
                                                                    $nombreCompletoAutor = $apellidosAutor . " " . $nombreAutor;

                                                                    //Traer id de usuario revision ponencia
                                                                    $consIdRevisionPonencia = "SELECT * FROM usuario_revision_ponencia WHERE id_ponencia='$idPonencia' AND id_congreso='$idCongreso'";
                                                                    $resIdRevisionPonencia = mysqli_query($conexion, $consIdRevisionPonencia);

                                                                    if (mysqli_num_rows($resIdRevisionPonencia) > 0) {
                                                                        $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";

                                                                        $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                                                                        $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);

                                                                        //Campos de la revision
                                                                        if (mysqli_num_rows($resUsuarioRevisionPonencia) > 0) {
                                                                            $estadoRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['estatus_revision']);
                                                                            $descripcionRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['descripcion_revision']);
                                                                        }
                                                                    } else {
                                                                        $descripcionRevisionPonencia = "RESUMEN";
                                                                    }

                                                                    if ($idUsuarioEvalua != '') {
                                                                        $consNombreEvaluador = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
                                                                        $resNombreUsuarioEvalua = mysqli_query($conexion, $consNombreEvaluador);
                                                                        $fetchNombreUsuarioEvalua = mysqli_fetch_assoc($resNombreUsuarioEvalua);
                                                                        $nombresUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["nombres_usuario"]);
                                                                        $apellidosUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["apellidos_usuario"]);
                                                                        $nombreCompletoUsuarioEvalua = $apellidosUsuarioEvalua . " " . $nombresUsuarioEvalua;
                                                                    } else {
                                                                        $nombreCompletoUsuarioEvalua = '';
                                                                    }
                                                                    ?>
                                                                    <th scope="row">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                value="<?php echo htmlspecialchars($idPonencia) ?>"
                                                                                name="checkbox[]">
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <?php echo $idPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tituloPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoAutor ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $tipoPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $categoriaPonencia ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $fechaRevisionPonenciaFormato ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php //echo $descripcionRevisionPonencia ?>
<div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title"></span><a target="_blank" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>                                                                
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $nombreCompletoUsuarioEvalua ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--/* AQUI CIERRA DIV */-->
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <div class="container">
                                <h4 class="mb-3">Buscar Evaluador</h4>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 d-sm-block col-sm-12 mb-3">
                                        <select id="selectEvaluador" name="selectEvaluador" class="form-select"
                                            aria-label="Default select example">
                                            <?php

                                            //require "../../modelo/traerDatosPrograma.php";
                                            //require "../../modelo/traerCongresoActual.php";
                                            //require "../../modelo/conexion.php";

                                            $consEvaluadores = "SELECT * FROM usuario 
                                            INNER JOIN funcion_usuario ON usuario.id_usuario = funcion_usuario.id_usuario
                                            INNER JOIN funcion ON funcion_usuario.id_funcion = funcion.id_funcion
                                            WHERE funcion.id_funcion = 20 AND estado_funcion = 'ON' ORDER BY nombres_usuario";
//echo "<br>consEvaluadores ".$consEvaluadores."<br>";
                                            $stmt = mysqli_prepare($conexion, $consEvaluadores);
                                            mysqli_stmt_execute($stmt);
                                            $resEvaluadores = mysqli_stmt_get_result($stmt);

//echo "<br>1 <br>";
                                            while ($fetchEvaluadores = mysqli_fetch_assoc($resEvaluadores)) {

                                                $nombresUsuario = htmlspecialchars($fetchEvaluadores["nombres_usuario"]);
                                                $apellidosUsuario = htmlspecialchars($fetchEvaluadores["apellidos_usuario"]);
                                                $emailevaluador = htmlspecialchars($fetchEvaluadores["correo_usuario"]);
                                                $idUsuario = $fetchEvaluadores['id_usuario'];

//echo "<br>idUsuario ".$idUsuario."<br>";

                                                $consTotalPonenciasAsignadas="SELECT COUNT(id_usuario_evalua) as total FROM ponencia 
                                                                              WHERE id_usuario_evalua='$idUsuario' AND id_congreso='$idCongreso' 
                                                                              GROUP BY id_usuario_evalua";
                                                $resTotalPonenciasAsignadas = mysqli_query($conexion, $consTotalPonenciasAsignadas);
                                                $fetchTotalPonenciasAsignadas = mysqli_fetch_assoc($resTotalPonenciasAsignadas);
                                                $TotalPonenciasAsignadas = htmlspecialchars($fetchTotalPonenciasAsignadas["total"]);
                                                
                                                $consTotalPonenciasEvaluador="SELECT id_usuario,numero_ponencias FROM evaluador 
                                                                              WHERE id_usuario='$idUsuario'";
                                                $resTotalPonenciasEvaluador = mysqli_query($conexion, $consTotalPonenciasEvaluador);
                                                $fetchTotalPonenciasEvaluador = mysqli_fetch_assoc($resTotalPonenciasEvaluador);
                                                $TotalPonenciasEvaluador = htmlspecialchars($fetchTotalPonenciasEvaluador["numero_ponencias"]);

                                                if ($TotalPonenciasAsignadas){
                                                  if ($TotalPonenciasAsignadas >= $TotalPonenciasEvaluador)
                                                  $nombreCompletoUsuario = "SATURADO(A) - ".$TotalPonenciasAsignadas." de ".$TotalPonenciasEvaluador." - ".$nombresUsuario . " " . $apellidosUsuario;
                                                  else
                                                    $nombreCompletoUsuario = $TotalPonenciasAsignadas." de ".$TotalPonenciasEvaluador." - ".$nombresUsuario . " " . $apellidosUsuario;
                                                }
                                                else
                                                    $nombreCompletoUsuario = "0"." de ".$TotalPonenciasEvaluador. " - ".$nombresUsuario . " " . $apellidosUsuario;

                                                ?>
                                                <option value="<?php echo $idUsuario ?>" id="<?php echo $idUsuario ?>"
                                                    name="<?php echo $idUsuario ?>">
                                                    <?php echo $nombreCompletoUsuario ?>
                                                </option>
                                                <?php
                                            }

                                            mysqli_stmt_close($stmt);
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class=" col-xl-2 col-lg-2 col-md-6 d-sm-block col-sm-12 mb-3">
                                    <input type="submit" id="asignarEvaluador" name="asignarEvaluador"
                                        class="btn btn-style px-4" value="Asignar">
                                </div>

                            </div>

                            <!--Configuracion del ponenicas por evaluador-->

                            <hr></br>
                            <div class="container">
                                <h4>Configuración del Evaluador </h4>
                                <div class="row">

                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-3">
                                        <span>Número de Ponencias máximas por evaluador:</span>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6 mb-3">
                                        <input type="number" class="form-control" name="numAsignaciones" id="numAsignaciones">
                                    </div>


                                    <div class="col-xl-3 col-lg-3 col-md-6 d-sm-block col-sm-12 mb-3">
                                        <input type="submit" id="configurarMaximo" name="configurarMaximo"
                                            class="btn btn-style px-4" value="Configurar maximo">
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <!--Total de trabajos que cuentan con un evaluador-->
                            <div class="container">
                                <h4>Trabajos Totales con Evaluador </h4>
                                <div class="row" style="margin-bottom: 50px;">
                                    <div class="table-responsive border border-success p-2 border-opacity-10 rounded">
                                        <?php if (strlen($_SESSION['info']) > 1): ?>
                                            <div id="informacionExito" class="alert alert-success text-center">
                                                <?php echo htmlspecialchars($_SESSION['info']);
                                                require_once "../../librerias/PHPMailer/src/correoAsignacionEvaluador.php";
                                                ?>

                                            </div>
                                        <?php endif; ?>

                                        <?php if (count($errores) > 0): ?>
                                            <div id="informacionError" class="alert alert-danger text-center">
                                                <?php foreach ($errores as $showerror): ?>
                                                    <?php echo htmlspecialchars($showerror); ?>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                        <table class="table">
                                            <thead>
                                                <tr class="table-cabecera">
                                                    <th scope="col" class="text-wrap">Trabajo</th>
                                                    <th scope="col" class="text-wrap">Título</th>
                                                    <th scope="col" class="text-wrap">Autor</th>
                                                    <th scope="col" class="text-wrap">Tipo</th>
                                                    <th scope="col" class="text-wrap">Categoría</th>
                                                    <th scope="col" class="text-wrap">Fecha</th>
                                                    <th scope="col" class="text-wrap">Ver Detalles</th>
                                                    <th scope="col" class="text-wrap">Evaluador</th>
                                                    <th scope="col" class="text-wrap"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require "../../modelo/traerDatosPrograma.php";

                                                while ($idPonencia = mysqli_fetch_assoc($resTrabajosTotCE)): ?>

                                                    <tr id="<?php echo htmlspecialchars($idPonencia['id_ponencia']); ?>">
                                                    <?php endwhile; ?>
                                                    <?php
                                                    require "../../modelo/traerDatosPrograma.php"; //Trae los registros de Ponencias del congreso actual
                                            
                                                    while ($fetchTrabajosRegistrados = mysqli_fetch_assoc($resTrabajosTotCE)) {
                                                        $tituloPonencia = htmlspecialchars($fetchTrabajosRegistrados['titulo_ponencia']);
                                                        $idUsuarioEvalua = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_evalua']);
                                                        $idPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_ponencia']);
                                                        $idTipoPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_tipo_ponencia']);
                                                        $idAutor = htmlspecialchars($fetchTrabajosRegistrados['id_usuario_registra']);
                                                        $idCategoriaPonencia = htmlspecialchars($fetchTrabajosRegistrados['id_categoria']);
                                                        $fechaRegistroPonencia = htmlspecialchars($fetchTrabajosRegistrados['fecha_registro_ponencia']);

                                                        //Da formato de fecha
                                                        $date = date_create($fechaRegistroPonencia);
                                                        $fechaRevisionPonenciaFormato = date_format($date, "Y/m/d H:i");

                                                        // la categoria de la ponencia
                                                        $consCategoriaPonencia = "SELECT * FROM categoria WHERE id_categoria='$idCategoriaPonencia'";
                                                        $resCategoriaPonencia = mysqli_query($conexion, $consCategoriaPonencia);
                                                        $fetchCategoriaPonencia = mysqli_fetch_assoc($resCategoriaPonencia);
                                                        $categoriaPonencia = htmlspecialchars($fetchCategoriaPonencia['categoria']);

                                                        //Consulta el tipo de la ponencia
                                                        $consTipoPonencia = "SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
                                                        $resTipoPonencia = mysqli_query($conexion, $consTipoPonencia);
                                                        $fetchTipoPonencia = mysqli_fetch_assoc($resTipoPonencia);
                                                        $tipoPonencia = htmlspecialchars($fetchTipoPonencia['categoria_ponencia']);

                                                        //Consulta al autor
                                                        //Hace la consulta de los autores de la ponencia
                                                        $consAutor = "SELECT * FROM usuario WHERE id_usuario='$idAutor'";
                                                        $resAutor = mysqli_query($conexion, $consAutor);
                                                        $fetchAutor = mysqli_fetch_assoc($resAutor);
                                                        $nombreAutor = htmlspecialchars($fetchAutor['nombres_usuario']);
                                                        $apellidosAutor = htmlspecialchars($fetchAutor['apellidos_usuario']);
                                                        $nombreCompletoAutor = $apellidosAutor . " " . $nombreAutor;

                                                        //Traer id de usuario revision ponencia
                                                        //Linea 879 
                                                        $consIdRevisionPonencia = "SELECT * FROM usuario_revision_ponencia 
                                                                                   WHERE id_ponencia='$idPonencia' 
                                                                                    AND id_congreso='$idCongreso'";
                                                        $resIdRevisionPonencia = mysqli_query($conexion, $consIdRevisionPonencia);

                                                        if (mysqli_num_rows($resIdRevisionPonencia) > 0) {
                                                            $consUsuarioRevisionPonencia = "SELECT * FROM revision WHERE revision.fecha_revision=(SELECT MAX(fecha_revision) FROM revision 
                                INNER JOIN usuario_revision_ponencia ON revision.id_revision=usuario_revision_ponencia.id_revision_ponencia
                                WHERE usuario_revision_ponencia.id_ponencia='$idPonencia' AND usuario_revision_ponencia.id_congreso='$idCongreso')";
                                                            //echo "<br> Consulta consUsuarioRevisionPonencia : ".$consUsuarioRevisionPonencia."<br>";
                                                            $resUsuarioRevisionPonencia = mysqli_query($conexion, $consUsuarioRevisionPonencia);
                                                            $fetchUsuarioRevisionPonencia = mysqli_fetch_assoc($resUsuarioRevisionPonencia);

                                                            //Campos de la revision
                                                            if (mysqli_num_rows($resUsuarioRevisionPonencia) > 0) {
                                                                $estadoRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['estatus_revision']);
                                                                $descripcionRevisionPonencia = htmlspecialchars($fetchUsuarioRevisionPonencia['descripcion_revision']);
                                                            }
                                                        } else {
                                                            $descripcionRevisionPonencia = "RESUMEN";
                                                        }

                                                        if ($idUsuarioEvalua != '') {
                                                            $consNombreEvaluador = "SELECT * FROM usuario WHERE id_usuario='$idUsuarioEvalua'";
                                                            $resNombreUsuarioEvalua = mysqli_query($conexion, $consNombreEvaluador);
                                                            $fetchNombreUsuarioEvalua = mysqli_fetch_assoc($resNombreUsuarioEvalua);
                                                            $nombresUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["nombres_usuario"]);
                                                            $apellidosUsuarioEvalua = htmlspecialchars($fetchNombreUsuarioEvalua["apellidos_usuario"]);
                                                            $nombreCompletoUsuarioEvalua = $apellidosUsuarioEvalua . " " . $nombresUsuarioEvalua;
                                                        } else {
                                                            $nombreCompletoUsuarioEvalua = '';
                                                        }
                                                        ?>
                                                        <td scope="row">
                                                            <?php echo $idPonencia ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tituloPonencia ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $nombreCompletoAutor ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tipoPonencia ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $categoriaPonencia ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $fechaRevisionPonenciaFormato ?>
                                                        </td>
                                                        <td>
                                                            <?php //echo $descripcionRevisionPonencia ?>
<div class="container mt-3 d-flex justify-content-end"><span id="spanFlecha" class="card-title"></span><a target="_blank" href="../../components/VisualizacionResumen/visualizacionResumen.php?id=<?php echo $idPonencia; ?>&visualizacion=1"><button class="flechaCard"><i class="fa-solid fa-arrow-right"></i></button></a></div>                                                            
                                                        </td>
                                                        <td>
                                                            <?php echo $nombreCompletoUsuarioEvalua ?>
                                                        </td>
                                                        <td style="text-align: right;">


                                                            <?php

                                                            $extensoFinal = "SELECT estatus_revision FROM revision WHERE fecha_revision = ( SELECT MAX(fecha_revision) FROM revision INNER JOIN usuario_revision_ponencia ON revision.id_revision = usuario_revision_ponencia.id_revision_ponencia WHERE usuario_revision_ponencia.id_ponencia = '$idPonencia' AND  usuario_revision_ponencia.id_congreso='$idCongreso');";
                                                            $resExtensoFinal = mysqli_query($conexion, $extensoFinal);

                                                            // Asegúrate de obtener el valor de estatus_revision correctamente
                                                            $rowExtensoFinal = mysqli_fetch_assoc($resExtensoFinal);
                                                            $estatusRevision = $rowExtensoFinal['estatus_revision'];

                                                            if ($estatusRevision != 'AF') { ?>
                                                                <button value="<?= $idPonencia ?>" class="btn btn-small btn-danger"
                                                                    type="submit" name="botonDesasignar" id="botonDesasignar">Desasignar
                                                                </button>

                                                            <?php } ?>


                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!------------------------------------------------------->
                    </div>



                    <!----------------------------------------------------------------------------------------------->

                </div>
            </div>
        </div>
    </form>
    <footer>
        <?php
        require_once('../../Layouts/footer.php');
        ?>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
    <script src="../../components/Administrador/tabla.js"></script>
</body>

</html>
<?php
    }
}
?>