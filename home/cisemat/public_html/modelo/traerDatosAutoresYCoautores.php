<?php

require '../../modelo/traerCongresoActual.php';

$consDatosPonencia="SELECT * FROM ponencia WHERE id_ponencia = '$idPonencia' AND id_congreso='$idCongreso'";
//echo "<br>consDatosPonencia : ".$consDatosPonencia."<br>";

$resDatosPonencia=mysqli_query($conexion,$consDatosPonencia);
$fetchDatosPonencia=mysqli_fetch_assoc($resDatosPonencia);
$idAutor=$fetchDatosPonencia['id_usuario_registra'];
$idCategoria=$fetchDatosPonencia['id_categoria'];
$titulo_trabajo=$fetchDatosPonencia['titulo_ponencia'];
$idTipoPonencia=$fetchDatosPonencia['id_tipo_ponencia'];

$consCategoria="SELECT * FROM categoria WHERE id_categoria='$idCategoria'";
$resCategoria=mysqli_query($conexion,$consCategoria);
$fetchCategoria=mysqli_fetch_assoc($resCategoria);
$nombre_categoria=$fetchCategoria['categoria'];


$consTipoPonencia="SELECT * FROM tipo_ponencia WHERE id_tipo_ponencia='$idTipoPonencia'";
$resTipoPonencia=mysqli_query($conexion,$consTipoPonencia);
$fetchTipoPonencia=mysqli_fetch_assoc($resTipoPonencia);
$tipoPonencia=$fetchTipoPonencia['categoria_ponencia'];

$consDatosAutor="SELECT * FROM usuario WHERE id_usuario='$idAutor'";
$resDatosAutor=mysqli_query($conexion,$consDatosAutor);
$fetchDatosAutor=mysqli_fetch_assoc($resDatosAutor);
$nombre_usuario=$fetchDatosAutor['nombres_usuario'];
$apellidos_usuario=$fetchDatosAutor['apellidos_usuario'];
$emailAutor=$fetchDatosAutor['email_usuario'];
//echo "<br>consDatosAutor : ".$consDatosAutor."<br>";

//Trae los datos de coautores de la ponencia
$consCoautores = "SELECT * FROM  usuario_colabora_ponencia_18012024 
INNER JOIN usuario ON usuario_colabora_ponencia_18012024.id_usuario=usuario.id_usuario 
WHERE usuario_colabora_ponencia_18012024.id_ponencia='$idPonencia' AND usuario_colabora_ponencia_18012024.id_congreso='$idCongreso'";
//echo "<br>consCoautores : ".$consCoautores."<br>";

//echo "<br>".$consCoautores."<br>";
$resCoautores = mysqli_query($conexion, $consCoautores);
//$fetch=mysqli_fetch_assoc($resCoautores);
$coautores=array();
if(mysqli_num_rows($resCoautores)>0){
    $i=0;
    while($fetchCoautores = mysqli_fetch_assoc($resCoautores)){
        $coautores[$i]['nombres']=$fetchCoautores['nombres_usuario'];
        $coautores[$i]['apellidos']=$fetchCoautores['apellidos_usuario'];
        $coautores[$i]['email']=$fetchCoautores['email_usuario'];
        $i=$i+1;
    }
}

?>