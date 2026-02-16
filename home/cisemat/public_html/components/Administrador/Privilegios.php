<?php

/** 
 *******************************************************************************************************
 * Apartado Privilegios, modifica los privilegios de cada usuario.
 * Cualquier duda o sugerencia:
 * @author Marco Antonio Vargas Ledesma mvargas750@gmail.com 
 *******************************************************************************************************
 **/

session_start();
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    echo "<script>alert('Acceso inválido.'); window.location.href='../../components/inicioSesion/sesion.php';</script>";
    exit;
}

require_once "../../modelo/conexion.php";
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
    if ($valor == 42 && $estado == 'ON') {
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
            <title>Privilegios</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="../../styles.css">
            <link rel="stylesheet" href="../../Layouts/NavbarYPestaña/pestaña.css">
            <link rel="stylesheet" href="./admin.css">
            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        </head>

        <body>
            <header>
                <?php
                require_once('../../Layouts/nav.php');
                ?>
            </header>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                        <?php
                        require_once('../../Layouts/sidebar.php');
                        ?>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                        <div class="container">
                            <h2 class="mt-5 mb-5">Administrar Privilegios</h2>
                            <!-------------------------------------------------------------------------------------------->
                            <form method="post">
                                <div class="row">
                                    <?php require "../../modelo/asignacionPrivilegios.php"; ?>
                                    <div class="col-sm-3 col-lg-8">
                                        <label for="buscador" class="titulo my-2">Usuario</label>
                                        <select id="buscador" name="buscador" class="form-control sm">
                                            <option value="0"> Selecciona un usuario</option>
                                            <?php
                                            while ($fetchUsuario = mysqli_fetch_assoc($resUsuario)) {
                                                $id_usuario = $fetchUsuario["id_usuario"];
                                                $nombresUsuario = $fetchUsuario["nombres_usuario"];
                                                $apellidosUsuario = $fetchUsuario['apellidos_usuario'];
                                                $rfc_usuario = $fetchUsuario['rfc_usuario'];

                                            ?>
                                                <option value="<?php echo $id_usuario; ?>" name="<?php echo $id_usuario; ?>"><?php echo $id_usuario . ' | ' . $apellidosUsuario . ' ' . $nombresUsuario.' | '.$rfc_usuario; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <?php
                                    if (strlen($_SESSION['info']) > 1) {
                                    ?>
                                        <div id="informacionExito" class="alert alert-success text-center">
                                            <?php echo $_SESSION['info']; ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (count($errores) > 0) {
                                    ?>
                                        <div id="informacionError" class="alert alert-danger text-center">
                                            <?php
                                            foreach ($errores as $showerror) {
                                                echo $showerror;
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <!--Contenedor Paquetes de Privilegio--->
                                <div id="divRoles" class="mt-5 pt-2 px-2 pb-5 border border-success border-opacity-10 rounded" style="max-width:950px; background-color: white">
                                    <div class="form-check">
                                        <input class="form-check-input m-2 Privilegios" checked="checked" type="radio" value="roles" name="Privilegios" id="Privilegios">
                                        <label class="titulo" for="Privilegios">Asignar Rol</label>
                                        <hr style="max-width: 250px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="card-sm border border-opacity-50 py-3 rounded m-2">
                                                <div class="form-check">
                                                    <input class="form-check-input m-1 rol1" type="radio" value="usuarioNormal" name="rol" id="rol1">
                                                    <label class="subTitulo" for="usuarioNormal">Usuario</label>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item" style="background-color: transparent" style="background-color: transparent">11-Inicio de Sesión</li>
                                                        <li class="list-group-item" style="background-color: transparent">12-Ver sus trabajos</li>
                                                        <li class="list-group-item" style="background-color: transparent">13-Ver su Historial</li>
                                                        <li class="list-group-item" style="background-color: transparent">14-Subir trabajo</li>
                                                        <li class="list-group-item" style="background-color: transparent">15-Solicitar orden de pago</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="card-sm border border-opacity-50 py-3 rounded m-2">
                                                <div class="form-check">
                                                    <input class="form-check-input m-1 rol2" type="radio" value="memorias" name="rol" id="rol2">
                                                    <label class="subTitulo" for="memorias">Memorias</label>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item" style="background-color: transparent">11-Inicio de Sesión</li>
                                                        <li class="list-group-item" style="background-color: transparent">43-Ver todos los registros</li>
                                                        <li class="list-group-item" style="background-color: transparent">51-Descargar trabajos</li>
                                                        <li class="list-group-item" style="background-color: transparent">52-Crear Memoria</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="card-sm border border-opacity-50 py-3 rounded m-2">
                                                <div class="form-check">
                                                    <input class="form-check-input m-1 rol3" type="radio" value="evaluador" name="rol" id="rol3">
                                                    <label class="subTitulo" for="evaluador">Evaluador</label>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item" style="background-color: transparent">11-Inicio de Sesión</li>
                                                        <li class="list-group-item" style="background-color: transparent">12-Ver sus trabajos</li>
                                                        <li class="list-group-item" style="background-color: transparent">13-Ver su Historial</li>
                                                        <li class="list-group-item" style="background-color: transparent">14-Subir trabajo</li>
                                                        <li class="list-group-item" style="background-color: transparent">15-Solicitar orden de pago</li>
                                                        <li class="list-group-item" style="background-color: transparent">20-Ser evaluador</li>
                                                        <li class="list-group-item" style="background-color: transparent">21-Evaluar trabajos</li>
                                                        <li class="list-group-item" style="background-color: transparent">22-Ver historial de sus evaluaciones</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="card-sm border border-opacity-50 py-3 rounded m-2">
                                                <div class="form-check">
                                                    <input class="form-check-input m-1 rol4" type="radio" value="administrador1" name="rol" id="rol4">
                                                    <label class="subTitulo" for="administrador1">Administrador 1</label><!--Web Master--->
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item" style="background-color: transparent">11-Inicio de Sesión</li>
                                                        <li class="list-group-item" style="background-color: transparent">12-Ver sus trabajos</li>
                                                        <li class="list-group-item" style="background-color: transparent">13-Ver su Historial</li>
                                                        <li class="list-group-item" style="background-color: transparent">14-Subir trabajo</li>
                                                        <li class="list-group-item" style="background-color: transparent">15-Solicitar orden de pago</li>
                                                        <li class="list-group-item" style="background-color: transparent">20-Ser evaluador</li>
                                                        <li class="list-group-item" style="background-color: transparent">21-Evaluar trabajos</li>
                                                        <li class="list-group-item" style="background-color: transparent">22-Ver historial de sus evaluaciones</li>
                                                        <li class="list-group-item" style="background-color: transparent">31-Ver registro de pago</li>
                                                        <li class="list-group-item" style="background-color: transparent">41-Asignar evaluador</li>
                                                        <li class="list-group-item" style="background-color: transparent">42-Cambiar Privilegios</li>
                                                        <li class="list-group-item" style="background-color: transparent">43-Ver reportes</li>
                                                        <li class="list-group-item" style="background-color: transparent">44-Crear Congreso</li>
                                                        <li class="list-group-item" style="background-color: transparent">51-Descargar trabajos</li>
                                                        <li class="list-group-item" style="background-color: transparent">52-Crear Memoria</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="card-sm border border-opacity-50 py-3 rounded m-2">
                                                <div class="form-check">
                                                    <input class="form-check-input m-1 rol5" type="radio" value="administrador2" name="rol" id="rol5">
                                                    <label class="subTitulo" for="administrador2">Administrador 2</label>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item" style="background-color: transparent">11-Inicio de Sesión</li>
                                                        <li class="list-group-item" style="background-color: transparent">31-Ver registros pagos</li>
                                                        <li class="list-group-item" style="background-color: transparent">43-Ver Registros</li>
                                                        <li class="list-group-item" style="background-color: transparent">51-Descargar registros</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--Contenedor Privilegios por tipo--->
                                <div id="divFunciones" class="mt-5 pt-2 px-2 pb-5 border border-success border-opacity-10 rounded" style="max-width:950px; background-color:#D9D9D9">
                                    <div class="form-check">
                                        <input class="form-check-input m-2 Privilegios" value="funcion" type="radio" name="Privilegios" id="Privilegios">
                                        <label class="titulo" for="Privilegios">Privilegios</label>
                                        <hr style="max-width: 250px;">
                                    </div>
                                    <div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Función</th>
                                                    <th scope="col">ON/OFF</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="fila" scope="row">11-Inicio de Sesión</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="11" name="11" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">12-Ver sus trabajos</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="12" name="12" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">13-Ver su Historial</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="13" name="13" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">14-Subir trabajo</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="14" name="14" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">15-Solicitar orden de pago</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="15" name="15" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">20-Ser evaluador</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="20" name="20" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">21-Evaluar trabajos</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="21" name="21" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">22-Ver historial de sus evaluaciones</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="22" name="22" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">31-Ver registro de pago</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="31" name="31" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">41-Asignar evaluador</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="41" name="41" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">42-Cambiar Privilegios</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="42" name="42" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">43-Ver reportes</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="43" name="43" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">44-Crear Congreso</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="44" name="44" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">51-Descargar trabajos</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="51" name="51" disabled></td>
                                                </tr>
                                                <tr>
                                                    <th class="fila" scope="row">52-Crear Memoria</th>
                                                    <td><input class="form-check-input" type="checkbox" value="1" id="52" name="52" disabled></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="m-3">
                                    <input class="btn btn-style block px-4 mx-2" value="Guardar" type="submit" id="actualizar" name="actualizar">
                                </div>
                            </form>
                            <!----------------------------------------------------------------------------------------------->
                        </div><!--container-->
                    </div><!--col-9-->
                </div><!--row-->
            </div><!--fluid-->



            <footer>
                <?php
                require_once('../../Layouts/footer.php');
                ?>
            </footer>

            <script>
                $('#buscador').select2();
            </script>
            <script>
                $(document).ready(function() {
                    $(".Privilegios").click(function(evento) {

                        var valor = $(this).val();
                        var rol1 = document.getElementById('rol1');
                        var rol1 = document.getElementById('rol2');
                        var rol1 = document.getElementById('rol3');
                        var rol1 = document.getElementById('rol4');
                        var rol1 = document.getElementById('rol5');

                        var InSe = document.getElementById('11');
                        var VeTr = document.getElementById('12');
                        var VeHi = document.getElementById('13');
                        var SuTr = document.getElementById('14');
                        var SoOr = document.getElementById('15');
                        var SeEv = document.getElementById('20');
                        var EvTr = document.getElementById('21');
                        var VeHE = document.getElementById('22');
                        var VeRP = document.getElementById('31');
                        var AsEv = document.getElementById('41');
                        var CaPr = document.getElementById('42');
                        var VeRe = document.getElementById('43');
                        var CrCo = document.getElementById('44');
                        var DeTr = document.getElementById('51');
                        var CrMe = document.getElementById('52');
                        if (valor == 'roles') {
                            $("#divRoles").css("background-color", "#FFFFFF");
                            $("#divFunciones").css("background-color", "#D9D9D9");
                            rol1.disabled = false;
                            rol2.disabled = false;
                            rol3.disabled = false;
                            rol4.disabled = false;
                            rol5.disabled = false;
                            InSe.disabled = true;
                            VeTr.disabled = true;
                            VeHi.disabled = true;
                            SuTr.disabled = true;
                            SoOr.disabled = true;
                            SeEv.disabled = true;
                            EvTr.disabled = true;
                            VeHE.disabled = true;
                            VeRP.disabled = true;
                            AsEv.disabled = true;
                            CaPr.disabled = true;
                            VeRe.disabled = true;
                            CrCo.disabled = true;
                            DeTr.disabled = true;
                            CrMe.disabled = true;

                        } else if (valor == 'funcion') {
                            $("#divRoles").css("background-color", "#D9D9D9");
                            $("#divFunciones").css("background-color", "#FFFFFF");
                            rol1.disabled = true;
                            rol2.disabled = true;
                            rol3.disabled = true;
                            rol4.disabled = true;
                            rol5.disabled = true;
                            InSe.disabled = false;
                            VeTr.disabled = false;
                            VeHi.disabled = false;
                            SuTr.disabled = false;
                            SoOr.disabled = false;
                            SeEv.disabled = false;
                            EvTr.disabled = false;
                            VeHE.disabled = false;
                            VeRP.disabled = false;
                            AsEv.disabled = false;
                            CaPr.disabled = false;
                            VeRe.disabled = false;
                            CrCo.disabled = false;
                            DeTr.disabled = false;
                            CrMe.disabled = false;
                        }
                    });
                });
            </script>

            <script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
            <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
        </body>

        </html>
<?php
    }
}
?>