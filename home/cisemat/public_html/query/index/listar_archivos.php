<HTML>
<HEAD>
 <TITLE>New Document</TITLE>
</HEAD>
<BODY>
<?
  require('const.php');
require('utiles.php');
require('conexion.php');


conectar_db();
selecciona_db();
	mysql_query("SET NAMES utf8");
$qry = "SELECT id, nombre, titulo, tipo FROM archivos";
$res = mysql_query($qry);

while($fila = mysql_fetch_array($res))
{
print "$fila[titulo]<br>$fila[nombre] ($fila[tipo])<br> <a href='descargar_archivo.php?id=$fila[id]'>Descargar</a><br><br>";
}
?>
</BODY>
</HTML>
