<?php 
    require '../../modelo/traerCongresoActual.php';
    
    $conscorreoAprobado = "SELECT * FROM ponencia WHERE id_ponencia = '$idPonencia'";
    $resCorreoAprobado =mysqli_query($conexion, $conscorreoAprobado);
    $fetchCorreoAprobado = mysqli_fetch_assoc($resCorreoAprobado);

    $titulo_trabajo = $fetchCorreoAprobado['titulo_ponencia'];
    $id_TPonencia = $fetchCorreoAprobado['id_tipo_ponencia'];

    $consTipoPonencia="SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia = '$id_TPonencia'";
    $resTipoPonencia=mysqli_query($conexion,$consTipoPonencia);
    $fetchTipoPonencia=mysqli_fetch_assoc($resTipoPonencia);

    $tipoPonencia = $fetchTipoPonencia['categoria_ponencia'];

    $categoria = $fetchCorreoAprobado['id_categoria'];

    $consCategoria = "SELECT * FROM categoria WHERE id_categoria = '$categoria'";
    $resCategoria = mysqli_query($conexion,$consCategoria);
    $fetchCategoria = mysqli_fetch_assoc($resCategoria);
    
    $id_categoria = $fetchCategoria['categoria'];

    $consModalidad = "SELECT * FROM congreso WHERE id_congreso = '$idCongreso'";
    $resModalidad = mysqli_query($conexion,$consModalidad);
    $fetchModalidad = mysqli_fetch_assoc($resModalidad);
    
    $id_modalidad=$fetchModalidad['modalidad_congreso'];

    $id_autor = $fetchCorreoAprobado['id_usuario_registra'];

    $consUsuario = "SELECT * FROM usuario WHERE id_usuario = '$id_autor'";
    $resUsuario = mysqli_query($conexion,$consUsuario);
    $fetchUsuario = mysqli_fetch_assoc($resUsuario);

    $nombre_usuario = $fetchUsuario['nombres_usuario'];
    $apellidos_usuario = $fetchUsuario['apellidos_usuario'];
    $RFC = $fetchUsuario['rfc_usuario'];
    $correo_usuario=$fetchUsuario['correo_usuario'];

?>




