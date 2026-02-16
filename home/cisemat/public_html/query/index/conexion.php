<?php 

  //////////////////////////////////////////////////
  ///Funcion para conectar una base de datos
  //////////////////////////////////////////////////
  function conectar_db()
  { 
    $pServer=mysql_connect(SERVER,USER,PASSWORD);
    If (!$pServer)
      echo("No se pudo conectar al servidor en este momento");
      error("1");
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
  //////////////////////////////////////////////////
  function consulta_tb($Sql){
    global  $pConsulta; 
    $pConsulta=mysql_query($Sql); 
    error("3");
    If (mysql_numrows($pConsulta)>0){
      error("4");
      return 1;
    }
    else{ 
      error("4"); 
      return 0;
    }
  }

  //////////////////////////////////////////////////
  ///Funcion para cerrar una base de datos
  //////////////////////////////////////////////////
  function cerrar_db()
  {
    mysql_close();
    error("4");
  }
  //////////////////////////////////////////////////
  ///Funcion para regresar el valor del campo
  ///indicado de la consulta indicada
  ///para : utiles.php function Get_Tabla()
  //////////////////////////////////////////////////
  function Get_Datos($pConsulta){   
   $aDatos=mysql_fetch_array($pConsulta);
     error("5");
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
