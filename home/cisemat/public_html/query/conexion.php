<?php 

  //////////////////////////////////////////////////
  ///Funcion para conectar una base de datos 2312
  //////////////////////////////////////////////////
  function conectar_db(&$pServer)
  { 
    //global  $pServer;
    //global  $pConsulta; 

    $pServer = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
/*
    if (!$pServer) {
       echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
       echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
       echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
       exit;
     }
     */
//mysqli_close($pServer); 
//echo "Prueba 1- Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
//echo "Información del host: " . mysqli_get_host_info($pServer) . PHP_EOL;
   
}

  //////////////////////////////////////////////////
  ////Funcion para seleccionar una base de datos
  //////////////////////////////////////////////////
  function selecciona_db()
  {
    mysql_select_db(DATABASE);
    error("2");
  }

  //////////////////////////////////////////////////
  ////Funcion para ejectur consultas en Mysql
  ////
  //////////////////////////////////////////////
  
  function consulta_tb($Sql,&$pServer,&$pConsulta){

    echo "<br>consulta_tb : ",$Sql;
    //$pServer = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);    
    $pConsulta=mysqli_query($pServer,$Sql); 
   
    // printf("Error: %s\n", mysqli_error($pConsulta))
    
     Echo "<br> paso el query <br>";
    
    $row_cnt= mysqli_num_rows($pConsulta);
    echo "Numero de filas : ",$row_cnt,"<br>";
   
    If ($row_cnt>0){
      //error("4");
      return 1;
    }
    else{ 
      //error("4"); 
      return 0;
    }


  }


  //////////////////////////////////////////////////
  ///Funcion para cerrar una base de datos
  //////////////////////////////////////////////////
  function cerrar_db()
  {
    mysqli_close();
    //error("4");
  }
  //////////////////////////////////////////////////
  ///Funcion para regresar el valor del campo
  ///indicado de la consulta indicada
  ///para : utiles.php function Get_Tabla()
  //////////////////////////////////////////////////
  function Get_Datos(&$pConsulta){   
   $aDatos=mysqli_fetch_array($pConsulta);
    // error("5");
   return $aDatos;
  }

  //////////////////////////////////////////////////
  ///Funcion que devuelve el numero del error  
  ///obtenido en un a consulta
  ///para : utiles.php function error()
  /////////////////////////////////////////////////
  function GetNumError(){
    $numError=mysql_errno();
    return $numError;
  }
   

  ///////////////////////////////////////////////////
  ///Funcion que devuelve la descripción del error  
  ///obtenido en un a consulta
  ///para : Utiles.php function error()
  ///////////////////////////////////////////////////
  function GetDescError(){ 
    $descError=mysql_error();
    return $descError;
  }


  ///////////////////////////////////////////////////
  ///Funcion que crea una tabla temporal 
  ///para trabajar con ella
  ///para : general
  ///////////////////////////////////////////////////
  function CrearTable($Nomtabla,$Campos,$Tablas,$Condicion)
  {
    global  $tmpTable; 

               $enunSQL = " CREATE TEMPORARY TABLE ";
    $enunSQL = $enunSQL . $Nomtabla;
    $enunSQL = $enunSQL . " TYPE=HEAP ";
    $enunSQL = $enunSQL . " SELECT ";
    $enunSQL = $enunSQL . $Campos;
    $enunSQL = $enunSQL . " FROM ";
    $enunSQL = $enunSQL . $Tablas;
    $enunSQL = $enunSQL . $Condicion;
    $enunSQL = $enunSQL . ";";
    $tmpTable=mysql_query($enunSQL); 
  }
?>
