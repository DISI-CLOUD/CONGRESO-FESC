
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
    reset($aTable);
    do
    {
      if (Modulo($i,2)==0)
      {
        //#ADBDE7 y #99CCFF
        echo "<tr bgcolor='#ADBDE7'>";
      }
      else
      {
        echo "<tr bgcolor='white'>";
      }
      echo "<td><font size=2>$i</font></td>";
      while ($Campo=each($aTable))
      {
        each($aTable);
        echo "<td><font size=2>".$Campo["value"]."</font></td>";
      }
      If ($Modo==2)
        $NumSem=2;
      If ($Modo==3)
        $NumSem=28;

      for ($k=1;$k<=$NumSem;$k++)
        echo "<td>&nbsp </td>";
      echo "</tr>";
      $i=$i+1;
      }while ($aTable=Get_Datos($pConsulta));
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
