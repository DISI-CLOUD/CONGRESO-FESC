<HTML>
<HEAD>
  <TITLE>
    Script en HTML,PHP,JAVASCRIPT
  </TITLE>
</HEAD>

<BODY BACKGROUND="ACSUMIPT.GIF">
<?php
require("const.php");
require("utiles.php");
require("conexion.php");

mysqli_query("SET NAMES 'utf8'");

//echo "Pase 20 <BR>";
// $pServer = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
conectar_db($pServer);
//echo "Pase 21 <BR>";

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

//echo "<p>Consulta: ".$fcadena0."<BR>";

If (($fcadena0<>""))
{

$Consulta=$fcadena0;
//echo "Pase el if 3 <BR>";
If (consulta_tb($Consulta,$pServer,$pConsulta)==1)
{
echo "Llegue al GET 1<BR>";
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
