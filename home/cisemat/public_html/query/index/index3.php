<HTML>
<HEAD>
  <TITLE>
    Script en HTML,PHP,JAVASCRIPT
  </TITLE>
</HEAD>

<BODY BACKGROUND="ACSUMIPT.GIF">
<?php
mysqli_query("SET NAMES 'utf8'");
require('const.php');
require('utiles.php');
require('conexion.php');


conectar_db();

consulta_tb("set names UTF8");

$IP=getenv(REMOTE_ADDR);
echo $IP;
echo "<BR>";

If ($IP<>"132.248.249.249")
{

selecciona_db();

echo "$IP<BR>";
//.stripslashes($_POST["fCadena"])."";
$fcadena0='';
$fcadena0=stripslashes($_POST["fCadena"]);

echo "<p>Consulta: ".$fcadena0;

If (($fcadena0<>""))
{




$Consulta=$fcadena0;
If (consulta_tb($Consulta)==1)
{
get_Tabla($pConsulta,$aTable);
show_Table($aTable,"Tabla",$pConsulta,1);
}
else
{

echo "<H4>Los datos no son correctos";
cerrar_db();
}

echo "</BLOCKQUOTE></BLOCKQUOTE>";
}

}
else
{echo "No autorizado";}

?>
</BODY>
</HTML>
