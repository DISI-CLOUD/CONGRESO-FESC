<?php 
/** 
    * Este modulo lee y guarda los privilegios del usuario.
    * Cualquier duda o sugerencia:
    * @author Marco Vargas mvargas750@gmail.com
    **/ 

require "conexion.php";

$privilegios = array(); //Es un arreglo que guarda todos los privilegios
$estadoPrivilegio = array(); //Es un arreglo que guarda los estados del privilegio
$cont=0; //Es para recorrer las posiciones del primer arreglo
$cont2=0; //Es para recorrer las posiciones del segundo arreglo

if(!empty($_SESSION['privilegios'])){ //Lee si ya existen los privilegios 
    $privilegios=$_SESSION['privilegios']; //Si existen los acomoda dentro del primer arreglo
}else{//De no existir privilegios en la sesion actual realiza la siguiente consulta
    $consPrivilegios="SELECT * FROM funcion_usuario WHERE id_usuario='$_SESSION[id]'"; //Consulta la tabla de funciones
    $resPrivilegios = mysqli_query($conexion,$consPrivilegios);//realiza la conexion
    while($row=mysqli_fetch_array($resPrivilegios)){//Ciclo mientras encuentre filas con funciones ligadas al id
        $privilegios[$cont]= $row['id_funcion'];//Cada dato de la columna de id_funcion lo acomoda en el primer arreglo
        $cont++;
    }

    $_SESSION['privilegios']=$privilegios;//Guarda el arreglo de las funciones en la sesion

}


if(!empty($_SESSION['estadoPrivilegio'])){
    $estadoPrivilegio=$_SESSION['estadoPrivilegio'];
    }else{
        $consPrivilegiosEstado="SELECT * FROM funcion_usuario WHERE id_usuario='$_SESSION[id]'";
        $resPrivilegiosEstado = mysqli_query($conexion,$consPrivilegiosEstado);
        while($row2=mysqli_fetch_array($resPrivilegiosEstado)){
            $estadoPrivilegio[$cont2]=$row2['estado_funcion'];
            $cont2++;
            }
            $_SESSION['estadoPrivilegio']=$estadoPrivilegio;
    }
?>