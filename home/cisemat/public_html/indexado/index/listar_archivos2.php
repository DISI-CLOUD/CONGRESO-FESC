<?

//require('mysqli/const.php');
//require('mysqli/utiles.php');
//require('mysqli/conexion.php');


//conectar_db();
//selecciona_db();
//mysql_query("SET NAMES utf8");
$qry = "SELECT id_ponencia_oral, titulo_oral, extenso_oral FROM ponencias_oral_20210107 where id_ponencia_oral='POER031'";
echo $qry; 
//$res = mysqli_query ($pServer,$qry);

//while($fila = mysqli_fetch_array($res))
//{
// echo "$fila[id_ponencia_oral]<br>$fila[titulo_oral] <br> <a href='descargar_archivo.php?id=$fila[extenso_oral]'>Descargar</a><br><br>";
//}
?>

</BODY>
</HTML>
