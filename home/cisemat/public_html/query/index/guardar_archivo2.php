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


 $archivo = $_FILES["archivito"]["tmp_name"];
 $tamanio = $_FILES["archivito"]["size"];
 $tipo    = $_FILES["archivito"]["type"];
 $nombre  = $_FILES["archivito"]["name"];
 $titulo  = $_POST["titulo"];

 if ( $archivo != "none" )
 {
    $fp = fopen($archivo, "rb");
    $contenido = fread($fp, $tamanio);
    $contenido = addslashes($contenido);
    fclose($fp);

    $qry = "INSERT INTO archivos VALUES
            (0,'$nombre','$titulo','$contenido','$tipo')";

   selecciona_db();
  	mysql_query("SET NAMES utf8");

    mysql_query($qry);

    if(mysql_affected_rows($conn) > 0)
       print "Se ha guardado el archivo en la base de datos.";
    else
       print "NO se ha podido guardar el archivo en la base de datos.";
 }
 else
    print "No se ha podido subir el archivo al servidor";
?>
</BODY>
</HTML>
