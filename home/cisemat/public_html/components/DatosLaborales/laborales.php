<?php

/** 
 *******************************************************************************************************
 * Apartado donde muestran la informacion de la trayectoria laboral del usuario
 * Cualquier duda o sugerencia:
 * @author Alison Michelle Rubio Garcia allyssonrg@gmail.com, Marina sanchez.
 *******************************************************************************************************
 **/

 require "../../modelo/conexion.php";

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
    exit();
}

require "../../modelo/actualizarDatosLaborales.php";
require "../../modelo/traerTrayectoriaLaboral.php";

// Realizar la conexión a la base de datos
try {
    // Es una conexion orientada a un objeto en PHP, por lo que la estructura es la siguiente:
    // $pdo = new PDO("mysql:host=$servidor;dbname=nombreDeTuBaseDeDatos", $usuario, $password);
    $pdo = new PDO('mysql:host=localhost;dbname='.$db.'', ''.$user.'', ''.$pass.'');
} catch (PDOException $exception) {
    die($exception->getMessage());
}

// Consulta para obtener la información de países y estados
$sql = 'SELECT co.id AS CountryID, co.name AS CountryName, ci.id AS CityID, ci.name AS CityName FROM countries co INNER JOIN cities ci ON ci.country_id = co.id ORDER BY co.name, ci.name';

try {
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    die($exception->getMessage());
}

// Obtener nombres y IDs únicos de países
$countryNames = array_unique(array_column($data, 'CountryName'));
$countryIds = array_unique(array_column($data, 'CountryID'));
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
    <title>Mis datos laborales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./laborales.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
</head>

<body>
    <header>
        <!-- Cargar jQuery primero -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- Luego, cargar Bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        <?php
        require_once('../../Layouts/nav.php');
        require '../../modelo/completarPerfil.php';
        //Verifica que el usuario tenga su perfil completado
        
        if ($estadoUsuario == 'B') {
            $info = "Completa el perfil laboral, tú país de orígen y la institución a la que perteneces.";
            $_SESSION['datosAdicionales'] = $info;
        } else if ($estadoUsuario == 'I') {
            $info = "La vigencia de tu semblanza ha expirado. Debes ir a tus datos académicos para actualizar tu semblanza para acceder a todas las funciones del sitio. Al completar tu perfil debes cerrar la sesión y volverla a iniciar para habilitar las funciones.";
            $_SESSION['datosAdicionales'] = $info;
        } else {
            $info = '';
            $_SESSION['datosAdicionales'] = $info;
        }
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
                        <?php
                        if ($estadoUsuario == 'B') {
                            ?>
                            <div class="my-5 d-flex justify-content align-items-center">
                                <span class="h1 text-secondary"><u>Registro 4/4</u></span>
                                <img id="rfcInformacion" style="cursor: pointer; width: 25px; height: 25px;"
                                    class="mx-3 rfcInformacion viewPassword imagenQuestion" src="../../src/question.png"
                                    alt="" data-toggle="tooltip" data-placement="right"
                                    title="El registro consta de 4 pasos, te encuentras en el 4/4, registrar tus datos laborales.">
                            </div>
                            <?php
                        }
                        ?>
                        <h2 class="mt-5 "><span class="text-danger">*</span> Mis datos Laborales</h2>
                        <span class="mt-1 mb-3 texto-laborales">Experiencia</span><br>
                        <?php

                        if (strlen($_SESSION['datosAdicionales']) > 1) {
                            ?>
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading">Completar Registro</h4>
                                <p>Aún no has completado tu perfil.</p>
                                <hr>
                                <p class="mb-0">
                                    <?php echo $_SESSION['datosAdicionales']; ?>
                                </p>
                                <!--<a href="../DatosAcademicos/academicos.php"> Datos Académicos</a>-->
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row mt-3 ">
                            <div class="col-lg-6 col-md-6">

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
                                <span class="mt-1 mb-2 texto-laborales"><span class="text-danger">*</span> País</span>
                                <select name="country" id="country" class="form-select texto-laborales fw-semibold"
                                    aria-label="Default select example">
                                    <?php
                                    foreach ($countryNames as $k => $countryName) {
                                        if ($countryIds[$k] == $idPaisUsuario) {
                                            echo $countryName;
                                            ?>

                                            <option selected value="<?php echo $countryIds[$k]; ?>">
                                                <?php echo $countryName; ?>
                                            </option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $countryIds[$k]; ?>">
                                                <?php echo $countryName; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                                <span class="mt-3 mb-2 texto-laborales"><span class="text-danger">*</span> Estado</span>
                                <select name="city" id="city" class="form-select texto-laborales fw-semibold mt-1"
                                    aria-label="Default select example">

                                    <?php

                                    $nombreEstado = $fetcIdEstadoUsuario["name"];
                                    $idEstado = $fetcIdEstadoUsuario["id"];
                                    echo $idEstado;

                                    ?>
                                    <option value="<?php echo $idEstado ?>" id="<?php echo $idEstado ?>"
                                        name="<?php echo $idEstado ?>">
                                        <?php echo $nombreEstado ?>
                                    </option>


                                    <php ?>


                                </select>
                                <span class="mt-3 mb-2 texto-laborales"><span class="text-danger">*</span>
                                    Institución</span>
                                <select name="institucion" id="institucion"
                                    class="form-select texto-laborales fw-semibold mt-1 uppercase"
                                    aria-label="Default select example">
                                    <?php
                                    while ($fetchTrayectoriaLaboral = mysqli_fetch_assoc($resTrayectoriaLaboral)) {
                                        $idInstitucion = $fetchTrayectoriaLaboral["id_institucion"];
                                        $nombreInstitucion = $fetchTrayectoriaLaboral["nombre_institucion"];
                                        if ($idInstitucionUsuario == $idInstitucion) {

                                            ?>
                                            <option selected value="<?php echo $idInstitucion ?>"
                                                id="<?php echo $idInstitucion ?>" name="<?php echo $idInstitucion ?>">
                                                <?php echo $nombreInstitucion ?>
                                            </option>
                                        <?php } else {
                                            ?>
                                            <option value="<?php echo $idInstitucion ?>" id="<?php echo $idInstitucion ?>"
                                                name="<?php echo $idInstitucion ?>">
                                                <?php echo $nombreInstitucion ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <!-- <option value="otra">OTRA INSTITUCIÓN...</option>    PARTEL DEL PARCHE OTRA INSTITUCIÓN   -->
                                </select>

                                <div id="institutoHelp" class="form-text">
                                    <?php
                                    $consCongreso = "SELECT * FROM congreso WHERE id_congreso=(SELECT MAX(id_congreso) FROM congreso)";
                                    $stmt = $conexion->prepare($consCongreso);

                                    if ($stmt) {
                                        $stmt->execute();
                                        $resCongreso = $stmt->get_result();
                                        $fetchCongreso = $resCongreso->fetch_assoc();
                                        $correoCongreso = $fetchCongreso['correo_congreso'];

                                        // Escapar el valor del correo para prevenir la inyección de SQL
                                        $correoEscapado = htmlspecialchars(strtolower($correoCongreso), ENT_QUOTES, 'UTF-8');
                                    }
                                    ?>

                                    <strong style="font-size: 20px;">¿No encontraste tu institución? Envía correo a:
                                        <br> <br>
                                        <a class="text-secondary" style="text-decoration:none; font-size:16px;"
                                            id="correo" href="mailto:<?php echo $correoEscapado; ?>">
                                            <?php echo $correoEscapado; ?>
                                        </a><br><br>
                                    </strong>
                                    <p style="font-size: 18px;">Con el asunto: <b>"SOLICITUD REGISTRO DE
                                            INSTITUCIÓN"</b> y nombre completo de la institución para registrarla en el
                                        congreso. Una vez completado el registro de la institución podrás terminar de
                                        completar los datos laborales.</p>
                                </div>
                                <!--  PARTEL DEL PARCHE OTRA INSTITUCIÓN 

                                <div id="otroCampo" style="display: none;">
                                    <span class="mt-3 mb-2 texto-laborales"><span class="text-danger">*</span></span>
                                    <input type="text" class="form-control" id="otraIns" name="otraIns">
                                    <div id="emailHelp" class="form-text">EN CASO DE HABER SELECCIONADO OTRA
                                        INSTITUCIÓN...</div>
                                </div>

                                      -->

                                <div class="col-lg-5 d-grid gap-2 mt-5 mb-5 ">
                                    <input class="btn btn-style-chico shadow p-1" type="submit" value="Subir"
                                        name="botonSubir">
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 d-none d-sm-block">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>


    <!-----------------------------------------------------------  PARTEL DEL PARCHE OTRA INSTITUCIÓN 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var institucionSelect = document.getElementById('institucion');
            institucionSelect.addEventListener('change', function () {
                var selectedOption = institucionSelect.options[institucionSelect.selectedIndex].value;
                mostrarOtro(selectedOption);
            });

            // Agregamos un evento para convertir a mayúsculas cuando se escriba en el campo de texto
            document.getElementById('otraIns').addEventListener('input', function () {
                this.value = this.value.toUpperCase();
            });

            // Validamos al inicio para mostrar u ocultar según la opción seleccionada
            var selectedOption = institucionSelect.options[institucionSelect.selectedIndex].value;
            mostrarOtro(selectedOption);
        });

        function mostrarOtro(valor) {
            var otroCampo = document.getElementById('otroCampo');
            var otraInsInput = document.getElementById('otraIns');

            if (valor.toLowerCase() === 'otra') {
                mostrarCampo(otroCampo, true);
                otraInsInput.required = true;
            } else {
                mostrarCampo(otroCampo, false);
                otraInsInput.required = false;
            }
        }

        function mostrarCampo(elemento, mostrar) {
            if (mostrar) {
                elemento.style.display = 'block';
            } else {
                elemento.style.display = 'none';
            }
        }
    </script>
 ----------------------------------------------------------------------------------------------------------->



    <!-- el script para traer el arreglo de la base de datos de paises y estado-->
    <script type="application/javascript">
        const cities = Array(); //se declara el array de la ciudades
        <?php
        foreach ($countryIds as $countryId) {
            $cities = array_values(array_filter($data, function ($row) use ($countryId) { //te perimite solo sacar las filas del arregloe
                return $row['CountryID'] === $countryId;
            }));
            ?>
            cities[<?php echo $countryId; ?>] = [<?php //crea una entrada en el arreglo el indice = pais que corresponde y se va llenando
                   for ($i = 0; $i < count($cities) - 1; $i++) { //aqui se va llenando con las ciudades que le corresponde 
                       ?> {
                        id: <?php echo $cities[$i]['CityID']; ?>,
                        name: "<?php echo $cities[$i]['CityName']; ?>"
                    }, <?php //se crea un objeto con los dos id de pais y su respectiva ciudad
                   }
                   ?> {
                    id: <?php echo $cities[$i]['CityID']; ?>,
                    name: "<?php echo $cities[$i]['CityName']; ?>"
                }]; //areglo ciudades
            <?php
        }
        ?>

        document.getElementById('country').addEventListener('change', function (e) { //toma el despegable de paises y agrega un listenner para que responda a los eventos
            let ownCities = cities[e.target.value];

            let cityDropdown = document.getElementById('city');
            cityDropdown.innerText = null;

            ownCities.forEach(function (c) { //recorre cada uno de los elementos del arreglo
                var option = document.createElement('option'); //crea un nuevo elemento tipo opcion
                option.text = c.name;
                option.value = c.id;
                cityDropdown.appendChild(option);
            })
        });
    </script>

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

<script>
    //Valida que no se reenvie el formulario
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>