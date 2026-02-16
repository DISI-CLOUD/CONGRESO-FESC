<HTML>
<HEAD>
  <TITLE>
    Script en HTML,PHP,JAVASCRIPT
  </TITLE>
</HEAD>

<BODY BACKGROUND="ACSUMIPT.GIF">
<?php
//mysqli_query("SET NAMES 'utf8'");

echo "<br>Antes de const <br>"; 
require('../indexado/const.php');
echo "<br>Pase const.php<br>";

require('../indexado/utiles.php');
require('../indexado/conexion.php');

echo "<br>Inicia Conecta - 39 <br>";

conectar_db($pServer);
echo "<br>Termina Conecta<br>";

consulta_tb("show tables",$pServer,$pConsulta);
echo "Al salir de la consulta_tb";

$IP="0000000";
echo "<br>".$IP."<br>";

If ($IP<>"132.248.249.249")
{
  //selecciona_db();
  //echo "$IP<BR>";
  //.stripslashes($_POST["fCadena"])."";
  $fcadena0='';
  $fcadena0=stripslashes($_POST["fCadena"]);
  //$fcadena0=$_POST["fCadena"];
  echo "<p>Entre al primer IF - Consulta: ".$fcadena0;
  
  If (($fcadena0<>""))
    {
      //consulta_tb("SET CHARACTER SET utf8",$pServer,$pConsulta);
      //echo "Sali de SET CHARACTER SET utf8";
      $Consulta=$fcadena0;
      echo "<p>Antes de segudo if";
      If (consulta_tb($fcadena0,$pServer,$pConsulta)==1)
        {
          echo "<br>Voy para get tabla<br>"; 	
          get_Tabla($pConsulta,$aTable);
          show_Table($aTable,"Tabla",$pConsulta,1);
        }
      else
        {
          echo "<H4>Los datos no son correctos";
          //cerrar_db();
         }
      echo "</BLOCKQUOTE></BLOCKQUOTE>"; 
    }
}
else
  {
  	echo "No autorizado";
  }


?>
</BODY>
</HTML>
