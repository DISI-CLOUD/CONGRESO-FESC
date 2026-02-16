<?php
//session_start();
//Verifica si ha iniciado sesión e instancia el modulo para consultar la foto del usuario.
if (!empty($_SESSION['correoElectronico'])) {
  require_once $_SERVER["DOCUMENT_ROOT"] . "/modelo/traerFoto.php";
  require_once $_SERVER["DOCUMENT_ROOT"] . "/modelo/completarPerfil.php";
}

?>

<?php
//traer color al nav de la BD
$valorColor = "SELECT color_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$color = mysqli_query($conexion, $valorColor);
$rowColor = $color->fetch_assoc();
$colorHex = $rowColor['color_congreso'];

// traer nombre congreso de la BD

$nombreC = "SELECT nombre_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
$queryNom = mysqli_query($conexion, $nombreC);
$rowNombre = $queryNom->fetch_assoc();
$congresoNombre = $rowNombre['nombre_congreso'];
?>

<div class="container-fluid text-center py-4 backgronund col-xl-12 col-lg-12 col-md-12" style="background-color: <?php echo $colorHex; ?>;">
  <!-- 
<span style="color: #FBC16B">XV</span><span class="texto"> CONGRESO INTERNACIONAL SOBRE LA ENSEÑANZA Y APLICACIÓN DE LAS MATEMÁTICAS </span>
 -->
  <span class="texto"><?php echo $congresoNombre; ?></span>
  <hr class="container linea mt-3">
</div>


<nav class="navbar navbar-expand-lg backgronund pb-2 z-index-2" style="background-color: <?php echo $colorHex; ?>;">
  <div class="container-fluid">
  <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <div class="d-flex flex-row py-1 mb-1">
      <div class="px-1 a-toggle"><i class="fa-solid fa-house"></i></div>
      <div class="a-toggle"> Menú</div>
    </div>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavDropdown">
    <ul class="navbar-nav centrar sinEspacio">
      <li class="nav-item">
        <a id="inicio" class="nav-link active a-nav mt-2" aria-current="page" href="../../index.php">Inicio</a>
      </li>

      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle a-nav mt-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Información
        </a>
        <ul class="dropdown-menu super">
        <li><a class="dropdown-item " href="../../src/convocatoria/XVII.pdf" target="_blank">Convocatoria</a></li>
          <li><a class="dropdown-item " href="../../components/registroInscripcion/inscripcion.php">Inscripción</a></li>
          <li><a class="dropdown-item " href="../../components/Lugar/lugar.php">Lugar</a></li>
          <li><a class="dropdown-item " href="../../components/registroCuotas/cuotas.php">Cuotas</a></li>
          <li><a class="dropdown-item " href="../../components/GuiasYPlantillas/guias.php">Guías</a></li>
          <li><a class="dropdown-item " href="../../components/acercaDe/acercaDe.php">Acerca de...</a></li>
          <li><a class="dropdown-item " href="../../components/avisoPrivacidad/avisoPrivacidad.php">Aviso de privacidad</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle a-nav mt-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Programa
        </a>
        <ul class="dropdown-menu super">
        <li><a class="dropdown-item " href="../../components/actividadesFechas/fechas.php">Fechas importantes</a></li>
        <li><a class="dropdown-item disabled" href="">Programa general</a></li>
        <li><a class="dropdown-item disabled" href="">Programa específico (por definir)</a></li>
          <!--  <li><a class="dropdown-item" href="../../components/programaMemorias/programaMemorias.php">Memorias</a></li>
          <li><a class="dropdown-item " href="../../components/programa/programa.php">Programa</a></li>  -->
          
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle a-nav mt-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Actividades
        </a>
        <ul class="dropdown-menu super">

        <li><a class="dropdown-item" href="../../components/ponenciasOrales/ponenciasOrales.php">Ponencias orales</a></li>
          <li><a class="dropdown-item" href="../../components/Talleres/talleres.php">Talleres</a></li>
          <li><a class="dropdown-item" href="../../components/ConcursodeCarteles/concursoCarteles.php">Concurso de carteles</a></li>
          <!-- <li><a class="dropdown-item disabled" href="../../components/actividadesConcursoC/concursoC.php">Concurso de carteles</a></li> -->
          <li><a class="dropdown-item" href="../../components/PrototiposyProyectos/prototiposyp.php">Presentación de prototipos robóticos y aplicaciones de IA</a></li>
          <li><a class="dropdown-item" href="../../components/MesaRedonda/mesaRedonda.php">Mesa redonda</a></li>
          <li><a class="dropdown-item" href="../../components/ConferenciasMagistrales/conferenciasMagistrales.php">Conferencias magistrales</a></li>
          <!-- <li><a class="dropdown-item disabled" href="../../components/programaMagistrales/programaMagistral.php">Ponencias magistrales</a></li> -->

         <!--  <li><a class="dropdown-item " href="../../components/actividadesCategorias/categorias.php">Categorias</a></li>  -->

        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle a-nav mt-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Organizadores
        </a>
        <ul class="dropdown-menu super">
          <li><a class="dropdown-item " href="../../components/organizadoresComites/cOrganizador.php">Comité organizador</a></li>
          <li><a class="dropdown-item " href="../../components/organizadoresComites/cTecnico.php">Comité técnico</a></li>
          <li><a class="dropdown-item " href="../../components/organizadoresComites/cEvaluador.php">Comité evaluador</a></li>
          <li><a class="dropdown-item " href="../../components/organizadoresComites/cTalleres.php">Comité de talleres </a></li>
        </ul>
      </li>
      <?php
      
      //Hace un if para comprobar que la sesión está abierta y y muestra los elementos.
      if (!empty($_SESSION['correoElectronico']) && $estadoUsuario == 'A') {
      ?>
        <li class="nav-item">
          <a class="nav-link a-nav mt-2" href="../../components/subirResumen/subirResumen.php">Registrar trabajos</a>
        </li>
      <?php }

      ?>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle a-nav mt-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php
          //Hace un if para comprobar que la sesión está abierta y y muestra los elementos.
          if (!empty($_SESSION['correoElectronico'])) {
          ?>
            Panel Principal
          <?php }
          if (empty($_SESSION['correoElectronico'])) {
          ?>
            Iniciar Sesión

          <?php
          }
          ?></a>
        <ul class="dropdown-menu super">
          <?php
          //Hace un if para comprobar que la sesión está abierta y y muestra los elementos.
          if (!empty($_SESSION['correoElectronico'])) {
          ?>
            <li><a class="dropdown-item" href="../../components/perfil/perfil.php">Mi perfil</a></li>
            <li><a class="dropdown-item" href="../../components/TrabajosRegistrados/trabajosRegistrados.php">Mis trabajos</a></li>
            <li><a class="dropdown-item" href="../../modelo/cerrarSesion.php">Cerrar sesión</a></li>
          <?php
          }
          ?>
          <?php
          //Hace un if para comprobar que la sesión está cerrada y muestra los elementos.
          if (empty($_SESSION['correoElectronico'])) {
          ?>
            <li><a class="dropdown-item" href="../../components/inicioSesion/sesion.php">Iniciar sesión</a></li>
            <li><a class="dropdown-item" href="../../components/crearCuenta/cuenta.php">Regístrarse</a></li>
          <?php
          }
          ?>
        </ul>
      </li>


      <li class="nav-item">
        <a class="nav-link " href="../../components/perfil/perfil.php" role="button" aria-expanded="false">
          <?php
          //Verifica si existe una sesion activa y muestra la foto del usuario
          if (!empty($_SESSION["correoElectronico"])) {

            if (!empty($index)) {
          ?>
              <img src="<?php echo $_SESSION["foto"] //Consulta el arreglo de la ruta
                        ?>" class="rounded-circle" alt="Foto de Perfil" width="40" height="40" vertical-align="middle">

            <?php
            } else { ?>
              <img src="<?php echo $_SESSION["foto"] //Consulta el arreglo de la ruta
                        ?>" class="rounded-circle" alt="Foto de Perfil" width="40" height="40" vertical-align="middle">
            <?php
            }
          } else {
            //Verifica si existe una sesion cerrada y muestra la foto por defecto
            ?>
            <img src="../../src/fotos_usuarios/picProfileNull.png" class="rounded-circle" alt="Foto de Perfil" width="40" height="40" vertical-align="middle">
          <?php
          }
          ?>
        </a>
      </li>

    </ul>
  </div>
  </div>
</nav>
