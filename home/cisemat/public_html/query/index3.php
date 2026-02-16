<HTML>
<HEAD>
  <TITLE>
    Script en HTML,PHP,JAVASCRIPT
  </TITLE>
</HEAD>

<BODY BACKGROUND="ACSUMIPT.GIF">
<?php
//mysqli_query("SET NAMES 'utf8'");

 
require('const.php');
require('utiles.php');
require('conexion.php');

echo "<br>Inicia Conecta - 39 <br>";

conectar_db($pServer);
echo "<br>Termina Conecta<br>";

consulta_tb("select * from usuarios",$pServer,$pConsulta);

$IP=getenv(REMOTE_ADDR);
echo $IP;
echo "<BR>";

If ($IP<>"132.248.249.249")
{
  //selecciona_db();
  //echo "$IP<BR>";
  //.stripslashes($_POST["fCadena"])."";
  $fcadena0='';
  $fcadena0=stripslashes($_POST["fCadena"]);
  //$fcadena0=$_POST["fCadena"];
  echo "<p>Consulta: ".$fcadena0;
  
  If (($fcadena0<>""))
    {
      consulta_tb("SET CHARACTER SET utf8",$pServer,$pConsulta);
      $Consulta=$fcadena0;
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
