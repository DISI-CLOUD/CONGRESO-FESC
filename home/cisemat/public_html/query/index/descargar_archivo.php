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
 //$qry = "SELECT tipo, contenido FROM archivos WHERE id=$id";
 $qry = "SELECT tipo, contenido,nombre FROM archivos WHERE id={$_REQUEST['id']}";
 $res = mysql_query($qry);
 $obj   = mysql_fetch_object($res);
 
 //$tipo = mysql_result($res, 0, "tipo");
 //$nombre =   mysql_result($res, 0, "nombre");
 //$contenido = mysql_result($res, 0, "contenido");
 // header("Content-type: docx");
 //echo "<br> Tipo : ".$obj->tipo." <br>";
//  header("Content-type: ". $tipo);
//  header("Content-type: {$obj->tipo}");

// Content_Types].xml
 //header("Content-type: doc");
 //echo "<br> Nombre : ".$obj->nombre." <br>";
 //header("Content-Disposition: attachment; filename='".$nombre."'");
 header('Content-Disposition: attachment; filename="'.$obj->nombre.'"');
// header("Content-type: $obj->tipo");
   header('Content-type: "'.$obj->tipo.'"');
// echo $contenido;
 print $obj->contenido;
 
?>

