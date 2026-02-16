<?php
  function Get_Tabla($pConsulta,&$aTable){
    $aTable=Get_Datos($pConsulta);
  }

  function Table_Head($Table_Caption){
    echo "<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=3 BORDERCOLORDARK=".t_BORDERCOLORDARK." > \n";
    echo "<CAPTION ALIGN=TOP>$Table_Caption</CAPTION>";
  }
  function Modulo($Numero,$Modulo)
  {
    $Result=$Numero;
    While($Result >= $Modulo)
    {
      $Result=$Result-$Modulo;
    }
    return $Result;
  }


  function Show_Table($aTable,$Table_Caption,$pConsulta,$Modo)
  {
    //$Modo=1 es para poner el nombre de los campos como
    //        encabezados a las tablas mostradas
    //$Modo=2 es para listas de extraordinarios
    //$Modo=3 es para listas de ordinarios
    //$NumSem es para indicar el numero de cuadros para asistencia
    //        en las listas
    

   conectar_db($pServer);

    reset($aTable);
    If ($Modo==1)
    {
     Table_Head($Table_Caption);
      echo "<td></td>";
    }
    while ($Campo=each($aTable))
      {
        $Campo=each($aTable);
        If ($Modo==1)
          echo "<td ALIGN=BOTTOM>".$Campo["key"]."</td>";
      }
      
    $i=1;
    $llave="idcuenta";
    $id_ponencia=NULL;

    reset($aTable);
    do
     {
      while ($Campo=each($aTable))
      {
        //Tomamos el id de la ponencia para la consulta
        //echo "Campo key ;".$Campo["key"];
        $Campo=each($aTable);
        if ($Campo["key"]=="id_ponencia_oral")
        {
        //echo "Entre";
         if ($id_ponencia<>$Campo["value"])
         {

          if (Modulo($i,2)==0)
          {
            echo "<tr bgcolor='#ADBDE7'>";
          }else{
            echo "<tr bgcolor='white'>";
          }
          echo "<td><font size=2>".$i."</font></td>";
          
          echo "<td><font size=2>".$Campo["value"];
          $id_ponencia= $Campo["value"];
         }else{break;}
        }else{
          echo "<td><font size=2>".$Campo["value"];
        }
        
        //Para juntar los nombre de ponentes
        if ($Campo["key"]=="Nombre")
        {
          $Nombre= $Campo["value"];
          //Ponencias oral

          $enunSQL = "
                       Select id_ponencia_oral,titulo_oral,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado,id_categoria,id_modalidad,aceptado_extenso_oral
                       from trayectoria_laboral t,ponencias_oral p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_oral=a.id_trabajo and u.id_usuario = t.id_usuario
                     
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_oral='".$id_ponencia."'  
                      and (aceptado_extenso_oral='SI' or id_ponencia_oral in ('POAP056','POAV070','POER086'))
                       order by id_modalidad,id_ponencia_oral,tipo_autor,nombre;";


          // Ponencias taller
           /*
           $enunSQL = "
                       Select id_ponencia_taller,titulo_taller,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado
                       from trayectoria_laboral t,ponencias_taller p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_taller=a.id_trabajo and u.id_usuario = t.id_usuario
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_taller='".$id_ponencia."'  
                       order by id_ponencia_taller,nombre;";
            */
          // Ponencias Cartel
/*                       
          $enunSQL = "
                      Select id_ponencia_cartel,titulo_cartel,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado,substring(id_ponencia_cartel,5,3) as num
                       from trayectoria_laboral t,ponencias_cartel p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_cartel=a.id_trabajo and u.id_usuario = t.id_usuario
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_cartel='".$id_ponencia."'  
                       order by num,tipo_autor;";
*/
          
          // Ponencias Curso
          
  
/*
          $enunSQL = "
                      Select id_ponencia_curso,titulo_curso,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado
                       from trayectoria_laboral t,ponencias_curso p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_curso=a.id_trabajo and u.id_usuario = t.id_usuario
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_curso='".$id_ponencia."'  order by id_ponencia_curso,nombre;";
*/
          


          $newTable = mysqli_query($pServer,$enunSQL);
          while ($aTable2=mysqli_fetch_array($newTable))
          {
            
            echo ", ".$aTable2['Nombre'];
          }
        }
        
        //$Campo=each($aTable);

        //Para juntar las instituciones de procedencia
        //echo "<br> Campo key: ".$Campo["key"]."<br>";
        
        if ($Campo["key"]=="id_institucion")
        {
          $Institucion= $Campo["value"];
        
        //echo "<br> Institucion: ".$Institucion."<br>";  
          //Ponencias oral

          $enunSQL = "
                       Select id_ponencia_oral,titulo_oral,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado
                       from trayectoria_laboral t,ponencias_oral p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_oral=a.id_trabajo and u.id_usuario = t.id_usuario
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_oral='".$id_ponencia."'  order by id_modalidad,id_ponencia_oral,tipo_autor,nombre;";


          // Ponencias taller
/*          
          $enunSQL = "
                       Select id_ponencia_taller,titulo_taller,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado
                       from trayectoria_laboral t,ponencias_taller p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_taller=a.id_trabajo and u.id_usuario = t.id_usuario
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_taller='".$id_ponencia."'  
                       order by id_ponencia_taller,nombre;";
  */      
          // Ponencias Cartel
  /*       
          $enunSQL = "
                       Select id_ponencia_cartel,titulo_cartel,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado,substring(id_ponencia_cartel,5,3) as num
                       from trayectoria_laboral t,ponencias_cartel p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_cartel=a.id_trabajo and u.id_usuario = t.id_usuario
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_cartel='".$id_ponencia."'  
                       order by num,tipo_autor;";
*/
          
          // Ponencias Curso
          
/*           
          $enunSQL = "
                       Select id_ponencia_curso,titulo_curso,upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))
                       as Nombre,id_institucion,id_estado
                       from trayectoria_laboral t,ponencias_curso p,usuarios u , autores a
                       where a.rfc=u.rfc and p.id_ponencia_curso=a.id_trabajo and u.id_usuario = t.id_usuario
                       and upper(concat(nombre_usuario,' ',apellido_paterno,' ',apellido_materno))<>'".$Nombre."'
                       and id_ponencia_curso='".$id_ponencia."'  order by id_ponencia_curso,nombre;";

        */


          $newTable = mysqli_query($pServer,$enunSQL);
          //echo "hola";
          
          while ($aTable2=mysqli_fetch_array($newTable))
          {           
           
            if ($Institucion<>$aTable2['id_institucion']){
              echo ",".$aTable2['id_institucion'];
            }
          }
        }

        echo "</font></td>";
        }

      If ($Modo==2)
        $NumSem=2;
      If ($Modo==3)
        $NumSem=28;

      for ($k=1;$k<=$NumSem;$k++)
        echo "<td>&nbsp </td>";
      echo "</tr>";
      if ($id_ponencia<>$Campo["value"]){
        $i=$i+1;
      }
      }   while ($aTable=Get_Datos($pConsulta));
      
      
      
    If ($Modo==1)
      echo "</table> \n";
  }

  function get_profesor($RFC)
  {
    conectar_db();
    selecciona_db();
    $Consulta="select nomprofesor from Profesores where idrfc='$RFC'";
    If (consulta_tb($Consulta)==1)
    {
      $cTable=Get_Datos($pConsulta);
      $cCampo=each($cTable);
      $cCampo=each($cTable);
      $cCampo=each($cTable);
      $cValor=$cCampo["value"];
    }
    else
    {
      $cValor='-----------------------';
    }
    cerrar_db();
    return $cValor;
  }

  function error($Numero){
    $numError=GetNumError();
    $descError=GetDescError();
    If (!$numError==0) 
    {
      echo "$Numero --- $numError : $descError <BR>";
    }
  }

?>
