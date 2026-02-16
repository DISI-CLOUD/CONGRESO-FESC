<HTML>
<HEAD>
  <TITLE>
    Script en HTML,PHP,JAVASCRIPT
  </TITLE>
</HEAD>

<BODY BACKGROUND="ACSUMIPT.GIF">
<?php
  require('../index/const.php');
  require('../index/utiles.php');
  //require('../index/conexion.php');
  $pServer=mysqli_connect(SERVER,USER,PASSWORD,DATABASE);
  if (!$pServer) 
    die("Error en la conexión: " . mysqli_connect_error());
  else 
    echo "Conexión exitosa!";

  $IP="132.248.102.254";
  echo "<br>".$IP."<br>";

  if ($IP<>"132.248.249.249")
  {

    $fcadena0='';
    $fcadena0=stripslashes($_POST["fCadena"]);
    echo "<p> Consulta : ".$fcadena0;

    if ($fcadena0 <>"")
    {
      $Consulta=$fcadena0;
     
      if ($pConsulta=mysqli_query($pServer,$Consulta))
      {
      
        $row_cnt= mysqli_num_rows($pConsulta);
        $aTable=mysqli_fetch_array($pConsulta);
        echo "<br> numero de rengloes : ".$row_cnt."<br>";
        show_Table($aTable,"Tabla",$pConsulta,1);
      }
     else
     {
        echo "<H4>Los datos no son correctos";
     }
      echo "</BLOCKQUOTE></BLOCKQUOTE>";
    }
  }  
  else
    echo "No autorizado";
?>
</BODY>
</HTML>
