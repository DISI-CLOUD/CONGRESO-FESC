<?php
session_start();
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    echo "<script>alert('Acceso inválido.'); window.location.href='../../components/inicioSesion/sesion.php';</script>";
    exit;
}

require_once "../../modelo/conexion.php";
require_once "../../modelo/privilegiosUsuario.php";

// Traer color automatizado
$valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$color = mysqli_query($conexion, $valorColor);
$rowColor = $color->fetch_assoc();
$colorHex = $rowColor['color_congreso'];

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
    if ($valor == 44 && $estado == 'ON') {
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
            <title>Congreso</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
                crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">
            <link rel="stylesheet" href="../../Layouts/NavbarYPestaña/pestaña.css">
            <link rel="stylesheet" href="./admin.css">
            <link rel="stylesheet" href="../../Layouts/CrearCongreso/crearCongreso.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
                integrity="sha384-fbnYnJt1BfFj/tKuWELG5S7tv+20a2OvEgduPJi1d0zDAtMDodhQKgX8hKfQIP3z"
                crossorigin="anonymous">
            <style>
                /* Estilos para la tarjeta */
                nav {
    z-index: 1000;
}
.side-menu {
    z-index: 999; /* Asegura que sea menor que el z-index del nav */
}
                .card {
                    border: 1px solid #ccc;
                    padding: 10px;
                    width: 1200px;
                    margin-left: 35px;
                    position: relative;
                    z-index: 1;
                }

                h2.modulo {
                    margin-top: 16px;
                }

                .option {
                    cursor: pointer;
                    border: 1px solid #ccc;
                    border-radius: 8px;
                    padding: 8px 12px;
                    margin-bottom: 5px;
                    margin-top: 8px;
                    transition: background-color 0.3s;
                    display: flex;
                    align-items: center;
                    
                }

                .option i {
                    margin-left: 20px;
                }

                .content {
                    /*max-height: 0;*/
                    /*overflow: hidden;*/
                    transition: max-height 1.5s ease-in-out;
                    /*max-height: 400px; /* Establece una altura máxima */
                    /*overflow-y: auto; /* Agrega una barra de desplazamiento vertical si es necesario */

                }

                .content.slow-close {
                    transition: max-height 0.5s ease-in-out;
                }

                .content.show {
                    max-height: 600px; /* Ajusta la altura máxima según tus necesidades */
                }
                .fa {
  color: #C5B268 !important;
}
.contenido{
    margin-top: 160px;
}
            </style>
        </head>
        <body>
            <header class="fixed-top d-block">
                <?php
                require_once('../../Layouts/nav.php');
                
                ?>
            </header>
            <?php
              /* se agrego para arreglar el traslape */
              ?>
              
            <div class="container-fluid contenido">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                        <?php
                        require_once('../../Layouts/sidebar.php');
                        ?>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                        <div class="container">
                            <h2 class="mt-5 mb-5">Administrar Diseño</h2>
                            <h4 style="color: rgb(234, 190, 63);" >Costo Individuales</h4>                         
                                <!-----------DATOS DE CUOTAS AL CONGRESO------------>
                            <div class="table-responsive"
                                    style="margin-left: 30px;padding-left: 0px;border-top-left-radius: 14px;border-top-right-radius: 14px;border-bottom-right-radius: 14px;border-bottom-left-radius: 14px;margin-right: 38px;">
                                <table class="table">
                                    <thead style="text-align: center;background: var(--bs-blue);">
                                        <tr class="first-row">
                                            <th
                                                    style="color: white;padding: 16px 0px 8px 8px;padding-right: 0px;margin: 0px;margin-right: 3px;background-color: <?php echo $colorHex; ?> !important;">
                                                    Cuotas Actuales&nbsp;</th>
                                            <th style="color: white;background-color: <?php echo $colorHex; ?> !important;">Cuotas Actualizadas</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center; border:0.5px  solid var(--bs-gray);">
                                                <?php 
                                                    require '../../modelo/traerCostos.php';
                                                    while($row=mysqli_fetch_assoc($res)){                        
                                                ?>
                                                <div class="row my-1 mx-5">
                                                    <div class="card-body-cuotas rounded text-center py-2"><b><?php echo $row['Tipo'];//Asigna el nombre?></b>
                                                    </div>
                                                    <div class="col-sm-4 col-md-6 col-lg-6 px-3 pt-2 mt-3">
                                                        <p class="pt py-2 text-center">Cuota</p>
                                                    </div>
                                                    <div class="col mt-4">
                                                        <span class="cuotas text-center border border-success p-2 border-opacity-10 rounded">$<?php echo $row['Costo'];//Asigna el nombre?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="row m-1">
                                                    <i class="fa fa-question-circle" style="font-size: 30px;" aria-hidden="true"><p class="subtitulo py-2"><?php echo $row['Descripcion'];//Asigna el nombre?></p></i>
                                                </div>
                                                <?php } mysqli_free_result($res);?>
                                            </td>
                                            <form action="atualizaCosto.php" class="row g-4" method="POST">
                                            <td style="text-align: center; border:0.5px  solid var(--bs-gray);">               
                                                <!-----------DATOS DE CUOTAS AL CONGRESO------------>
                                                <!--<form action="<?=$_SERVER['PHP_SELF']?>" class="row g-4" method="POST">-->
                                                <div class="row my-1 mx-5">
                                                    <div class="card-body-cuotas rounded text-center py-2" ><b>PONENTES</b></div>
                                                    <div class="col-sm-4 col-md-6 col-lg-6 px-3 pt-2 mt-3"><p class="pt py-2 text-center">Nueva Cuota</p></div>
                                                    <div class="col m-4">
                                                    <!--<span class="cuotas text-center border border-success p-2 border-opacity-10 rounded">$1,400.00</span>-->
                                                    <input type="text" name="costoPonente" id="ponente" class="form-control" placeholder="$$$"autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row m-1"><p class="subtitulo py-2"></p></div>
                                                <div class="row my-2 mx-5">
                                                    <div class="card-body-cuotas rounded text-center py-2"><b>ASISTENTES</b></div>
                                                    <div class="col-sm-4 col-md-6 col-lg-6 px-3 pt-2 mt-3"><p class="pt py-2 text-center">Nueva Cuota</p>
                                                    </div>
                                                    <div class="col m-4">
                                                        <!--<span class="cuotas text-center border border-success p-2 border-opacity-10 rounded">$1,000.00</span>-->
                                                        <input type="text" name="costoAsistente" id="asistente" class="form-control" placeholder="$$$"autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="row m-1">
                                                    <p class="subtitulo py-2"></p>
                                                </div>
                                                <div class="row my-2 mx-5">
                                                    <div class="card-body-cuotas rounded text-center py-2"><b>ESTUDIANTES</b></div>
                                                    <div class="col-sm-4 col-md-6 col-lg-6  px-3 pt-2"><p class="pt py-2 text-center">Nueva Cuota</p> </div>
                                                    <div class="col m-4">
                                                        <!--<span class="cuotas text-center border border-success p-2 border-opacity-10 rounded">$200.00</span>-->
                                                        <input type="text" name="costoEstudiante" id="estudiante" class="form-control" placeholder="$$$"autocomplete="off">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>      
                                            <td style="text-align: right;border-style: none; width: 215px;" colspan="2">
                                                <input id="modificarCosto" name="botonModificarCosto" class="btn btn-azul pe-5 ps-5" type="submit" value="Modificar" style="background-color: <?php echo $colorHex; ?> !important;">
                                            </td>
                                            </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>      
            <footer>
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
    <?php }
}
?>
