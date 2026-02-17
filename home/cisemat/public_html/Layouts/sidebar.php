<?php
require "../../modelo/privilegiosUsuario.php";
require "../../modelo/completarPerfil.php";

// Validar sesión y escapar datos
if (isset($_SESSION['id'])) {
    $userId = mysqli_real_escape_string($conexion, $_SESSION['id']);

    $estadoPrivilegio = array();
    $cont2 = 0;

    // Consulta preparada para evitar SQL injection
    $consPrivilegiosEstado = "SELECT * FROM funcion_usuario WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conexion, $consPrivilegiosEstado);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $resPrivilegiosEstado = mysqli_stmt_get_result($stmt);

    while ($row2 = mysqli_fetch_array($resPrivilegiosEstado)) {
        $estadoPrivilegio[$cont2] = $row2['estado_funcion'];
        $cont2++;
    }

    $_SESSION['estadoPrivilegio'] = $estadoPrivilegio;
}
?>


<button class="btn background-lateral-boton col-12 mt-4 p-3 d-lg-none" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
    <i class="fa-solid fa-align-justify"> Panel principal</i>
</button>
<div class="offcanvas offcanvas-start py-4 position-static" data-bs-scroll="true" data-bs-backdrop="false"
    tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title ms-3 p-3" id="offcanvasScrollingLabel">Panel principal</h4>
    </div>
    <div class="offcanvas-body">
        <div class="">
            <ul class="list-group list-group-flush">
                <li class="list-group-item background position-static">
                    <i class="fa-sharp fa-solid fa-graduation-cap"></i>
                    <label class="form-check-label label-text" for="firstRadio">Datos academicos</label>
                </li>

                <li class="list-group-item lis background position-static">
                    <label class="form-check-label" for="firstRadio"><a class="text-a ms-4"
                            href="../../components/DatosAcademicos/academicos.php">Escolar</a></label>
                </li>
                <?php
                if ($estadoUsuario != '') {
                    ?>
                    <li class="list-group-item lis background position-static">
                        <label class="form-check-label" for="firstRadio"><a class="text-a ms-4"
                                href="../../components/DatosLaborales/laborales.php">Laboral</a></label>
                    </li>
                    <?php
                }
                if ($estadoUsuario == 'A') {
                    ?>
                    <li class="list-group-item background position-static">
                        <i class="fa-solid fa-person"></i>
                        <label class="form-check-label label-text" for="firstRadio">Datos personales</label>
                    </li>

                    <li class="list-group-item lis background">
                        <label class="form-check-label" for="firstRadio"><a class="text-a ms-4"
                                href="../../components/perfil/perfil.php">Mi Perfil</a></label>
                    </li>
                    <li class="list-group-item lis background">
                        <label class="form-check-label" for="firstRadio"><a class="text-a ms-4"
                                href="../../components/datosSeguridad/datosSeguridad.php">Seguridad</a></label>
                    </li>
                    <?php
                }
                ?>
                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 20 && $estado == 'ON') { ?>
                        <li class="list-group-item background position-static">
                            <i class="fa-solid fa-square-check"></i>
                            <label class="form-check-label label-text" for="firstRadio">Evaluaciones</label>
                        </li>
                        <!---la funcion de asgnados solo se muestra si eres evaluador-->
                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/TrabajosAsignados/trabajosAsignados.php">Mis evaluaciones</a></label>
                        </li>
                        <!------------------------------------------------------------------>
                    <?php }
                }
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 23 && $estado == 'ON') {
                        ?>
                        <!--Extensos para el evaluador final-->
                        <li class="list-group-item lis background position-static">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4 "
                                    href="../../components/ExtensosFinales/extensosAsignados.php">Extensos finales</a></label>
                        </li>
                    <?php }
                } ?>
                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 15 && $estado == 'ON') { ?>
                        <li class="list-group-item background position-static">
                            <i class="fa fa-money background"></i>
                            <label class="form-check-label label-text" for="firstRadio">Asistencia</label>
                        </li>

                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/asistenciaPago/pagos.php">Pago</a></label>
                        </li>
                    <?php }
                } ?>


                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor >= 12 && $valor <= 14 && $estado == 'ON') { ?>

                        <li class="list-group-item background position-static">
                            <i class="fa-solid fa-pencil background"></i>
                            <label class="form-check-label label-text" for="firstRadio">Trabajos</label>
                        </li>
                        <?php break 1;
                    }
                }

                ?>

                <?php

                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 14 && $estado == 'ON') { ?>

                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/subirResumen/subirResumen.php">Subir resumen</a></label>
                        </li>
                    <?php }
                } ?>

                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 12 && $estado == 'ON') { ?>
                        <li class="list-group-item lis background">
                            <label class="form-check-label" for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/TrabajosRegistrados/trabajosRegistrados.php">Mis trabajos</a></label>
                        </li>
                    <?php }
                } ?>
                <!--estas 2 funciones son las que se muestran si eres evaluador
                <li class="list-group-item lis background">
                    <label class="form-check-label " for="firstRadio"><a class="text-a ms-4" href="">Trabajos Finales</a></label>
                </li>
                -->
                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 13 && $estado == 'ON') { ?>

                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/historial/historial.php">Historial</a></label>
                        </li>
                    <?php }
                } ?>

                <!---------------------------------------------------------------->
                <li class="list-group-item background">
                    <i class="fa-solid fa-circle-question"></i>
                    <label class="form-check-label label-text" for="firstRadio">Ayuda</label>
                </li>
                <!------------------------------- 
                <li class="list-group-item lis background">
                    <label class="form-check-label" for="firstRadio"><a class="text-a ms-3" href="../../components/GuiasYPlantillas/guias.php">Guias</a></label>
                </li>
                --------------------------------->
                <li class="list-group-item lis background">
                    <label class="form-check-label " for="firstRadio"><a class="text-a ms-3"
                            href="../../components/GuiasYPlantillas/plantilla.php">Plantillas</a></label>
                </li>

                <!-----FUNCIONES DEL ADMINISTRADOR-->

                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor >= 31 && $estado == 'ON') { ?>

                        <li class="list-group-item background">
                            <i class="fa-solid fa-gear"></i>
                            <label class="form-check-label label-text" for="firstRadio">Administrador</label>
                        </li>
                        <?php
                        break 1;
                    }
                } ?>
                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 41 && $estado == 'ON') { ?>
                        <li class="list-group-item lis background"><!-----FUNCION ASIGNACION DE EVALUADORES-->
                            <label class="form-check-label" for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/Administrador/Asignaciones.php">Asignaciones</a></label>
                        </li>
                    <?php }
                } ?>
                <!--
                <li class="list-group-item lis background">
                    <label class="form-check-label " for="firstRadio"><a class="text-a" href="">Ponencias Magistrales</a></label>
                </li> 
                -->
                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 43 && $estado == 'ON') { ?>
                        <li class="list-group-item lis background"><!-----FUNCION VER REGISTROS-->
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/Administrador/Registros.php">Registros</a></label>
                        </li>
                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4 "
                                    href="../../components/Administrador/Reportes.php">Reportes</a></label>
                        </li>
                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4 "
                                    href="../../components/Administrador/Memorias.php">Memorias</a></label>
                        </li>
                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4 "
                                    href="../../components/Administrador/tablaDeTrabajosHistorico.php">Historial de
                                    trabajos</a></label>
                        </li>

                    <?php }
                } ?>

                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 31 && $estado == 'ON') { ?>
                        <li class="list-group-item lis background"><!-----FUNCION VER REGISTROS DE PAGO-->
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/Administrador/RegistrosPagos.php">Registros de pago</a></label>
                        </li>
                    <?php }
                } ?>
                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 42 && $estado == 'ON') { ?>
                        <li class="list-group-item lis background"><!-----FUNCION DE ASIGNAR PRIVILEGIOS-->
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/Administrador/Privilegios.php">Privilegios</a></label>
                        </li>
                    <?php }
                }
                ?>
                <?php
                foreach (array_combine($privilegios, $estadoPrivilegio) as $valor => $estado) {
                    if ($valor == 44 && $estado == 'ON') { ?>
                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/nuevoCongreso/registrarCongreso.php">Congreso</a></label>
                        </li>
                        <li class="list-group-item lis background">
                            <label class="form-check-label " for="firstRadio"><a class="text-a ms-4"
                                    href="../../components/cambiarDiseño/cambiarDiseño.php">Diseño de página</a></label>

                        </li>
                    <?php }
                }
                ?>
            </ul>
        </div>

        <?php // Traer color automatizado
        $valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
        $color = mysqli_query($conexion, $valorColor);
        $rowColor = $color->fetch_assoc();
        $colorHex = $rowColor['color_congreso'];
        ?>
        <div class="d-grid gap-2 col-6 mx-auto my-5">
            <a href="../../modelo/cerrarSesion.php"><button class="btn btn-style" type="button"
                    style="background-color: <?php echo $colorHex; ?>!important;">Cerrar sesion</button></a>
        </div>
    </div>
</div>

<!-- FIX SIDEBAR - Se usa DOMContentLoaded para esperar a que Bootstrap JS se cargue desde la página principal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función para activar el offcanvas en pantallas md y sm
        function activateOffcanvas() {
            var offcanvasElement = document.getElementById('offcanvasScrolling');

            if (window.innerWidth < 992) {
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
            } else {
                offcanvasElement.classList.remove('offcanvas', 'offcanvas-start');
                offcanvasElement.classList.add('flex', 'flex-col');
            }
        }

        // Llama a la función cuando se hace clic en el botón
        document.querySelector('.background-lateral-boton').addEventListener('click', activateOffcanvas);

        activateOffcanvas();
    });
</script>

<style>
    /*  Inicio Fix sidebar 0.1 Kevin García */
    /* Corrige desplazamiento y display del sidebar */
    .offcanvas {
        display: none!important;
        visibility: visible!important; 
    }

    .offcanvas.show {
        display: block!important;
    }

    .offcanvas.hiding, .offcanvas.show, .offcanvas.showing {
        display: block!important;
    }
    /*  Fin Fix sidevar 0.1 Kevin García */
</style>

<!--</div>-->