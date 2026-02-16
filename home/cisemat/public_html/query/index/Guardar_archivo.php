<?php
    require ('script/utiles.php');
    require('script/conexion.php');
    require('script/bd.php');

    //conectar con el servidor
    $conn = mysql_connect("$host", "$user", "$pass");

    if (!$conn) {
        echo "No se posible conectar al servidor. <br>";
        trigger_error(mysql_error(), E_USER_ERROR);
    }
    mysql_query("SET NAMES utf8");
    # seleccionar BD
    $rdb = mysql_select_db($db);

    if (!$rdb) {
        echo "No se puede seleccionar la BD. <br>";
        trigger_error(mysql_error(), E_USER_ERROR);
    }
////////////////////////// FUNCIÓN PARA EJECUTAR QUERY

    function exe_query($query){
        $r = mysql_query($query);
        if (!$r) {
            echo "No se ejecutó el query: $query <br>";
            trigger_error(mysql_error(), E_USER_ERROR);
        }
        return $r;
    }

    $documento = $_FILES["archivo"]["tmp_name"]; 
    $tamanio   = $_FILES["archivo"]["size"];
    $tipo      = $_FILES["archivo"]["type"];
    $nombre    = $_FILES["archivo"]["name"];
    $id_ponencia_oral = $_POST['id_ponencia_oral'];
    $id_ponencia_cartel = $_POST['id_ponencia_cartel'];
    $docx = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
    $doc = "application/msword";
    // $pdf = "application/pdf";
    

    if($documento != "none"){
        $fp = fopen($documento, "rb");
        $contenido = fread($fp, $tamanio);
        $contenido = addslashes($contenido);
        fclose($fp); 

        if ($id_ponencia_oral != '') {
            if (($tipo != $docx)&&($tipo != $doc)){
            echo "<script>
                    window.alert ('No se admiten este tipo de archivos'); 
                    window.location.href = 'registro_extensos.php';
                </script>";
            }
            else{
                if($tipo = $docx){
                    $tipo=".docx";
                }
                else if($tipo = $doc){
                    $tipo=".doc";
                }

                if($tamanio<=2097152){
                    $query_oral = "UPDATE ponencias_oral SET extenso_oral = '$contenido', formato_extenso_oral = '$tipo' WHERE id_ponencia_oral = '".$id_ponencia_oral."'";
                    // echo $query_oral;
                    // echo exe_query($query_oral);
                    exe_query($query_oral);

                    $query_comprobacion = "SELECT COUNT(*) FROM ponencias_oral WHERE id_ponencia_oral = '".$id_ponencia_oral."' AND extenso_oral != '' AND formato_extenso_oral != ''";
                    $r_comprobacion = exe_query($query_comprobacion);
                    $row_comprobacion = mysql_fetch_assoc($r_comprobacion);

                    if($row_comprobacion['COUNT(*)']>0)
                        print "Su archivo se ha guardado con éxito. <br>Le pedimos que consulte su perfil
                                durante el periodo de evaluación de trabajos extensos, ya que ahí 
                                se enviará la respuesta por parte de los evaluadores<br>";
                    else
                        print "No se ha podido guardar el archivo en la base de datos.";
                }
                else{
                    echo "<script>
                        window.alert ('El tamaño del archivo supera los 2048 KB (2 MB)'); 
                        window.location.href = 'registro_extensos.php';
                        </script>";
                }
            }
        }


        // if ($id_ponencia_cartel != '') {
        //     if (($tipo != $pdf)){
        //     echo "<script>
        //             window.alert ('No se admiten este tipo de archivos'); 
        //             window.location.href = 'registro_extensos.php';
        //         </script>";
        //     }
        //     else{
        //         if($tipo = $pdf){
        //             $tipo=".pdf";
        //         }

        //         if($tamanio<=2097152){
        //             $query_cartel = "UPDATE ponencias_cartel SET archivo_cartel = '$contenido', formato_archivo_cartel = '$tipo' WHERE id_ponencia_cartel = '".$id_ponencia_cartel."'";
        //             // echo $query_cartel;
        //             // echo exe_query($query_cartel);
        //             exe_query($query_cartel);

        //             $query_comprobacion = "SELECT COUNT(*) FROM ponencias_cartel WHERE id_ponencia_cartel = '".$id_ponencia_cartel."' AND archivo_cartel != '' AND formato_archivo_cartel != ''";
        //             $r_comprobacion = exe_query($query_comprobacion);
        //             $row_comprobacion = mysql_fetch_assoc($r_comprobacion);

        //             if($row_comprobacion['COUNT(*)']>0)
        //                 print "Se ha guardado el archivo en la base de datos.";
        //             else
        //                 print "No se ha podido guardar el archivo en la base de datos.";
        //         }
        //         else{
        //             echo "<script>
        //                 window.alert ('El tamaño del archivo supera los 2048 KB (2 MB)'); 
        //                 window.location.href = 'registro_extensos.php';
        //                 </script>";
        //         }
        //     }
        // }

        
    }else
        print "No se ha podido subir el archivo al servidor";
?>
<br/>
<script>
function back(){
    window.location.href = 'registro_extensos.php'
}
</script>
<input type='button' name='regresar' value='Regresar' onClick='back()'>