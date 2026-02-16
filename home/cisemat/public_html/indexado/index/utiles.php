
<?php

  function Get_Tabla($pConsulta,&$aTable){
    $aTable=Get_Datos($pConsulta);
  }
//echo "<br>Pase Get_tabla<br>";
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

//echo "<br>Pase Get_Head<br>";

  function Show_Table($aTable,$Table_Caption,$pConsulta,$Modo)
  {
    //$Modo=1 es para poner el nombre de los campos como
    //        encabezados a las tablas mostradas
    //$Modo=2 es para listas de extraordinarios
    //$Modo=3 es para listas de ordinarios
    //$NumSem es para indicar el numero de cuadros para asistencia
    //        en las listas
   // echo "llegue a sow table";
    If ($Modo==1)
    {
     Table_Head($Table_Caption);
      echo "<td></td>";
    }

     while ($finfo = mysqli_fetch_field($pConsulta)) {
       If ($Modo==1)
          echo "<td ALIGN=BOTTOM>".$finfo->name."</td>";
    }
    $i=1;

    if (Modulo($i,2)==0)
        echo "<tr bgcolor='#ADBDE7'>";
      else
        echo "<tr bgcolor='white'>";

    echo "<td><font size=2>$i</font></td>";
    $p=0;
    foreach ( $aTable as $minombre => $mivalor) {
         $m= Modulo($p,2);
         if ($m==0){
            echo "<td><font size=2>".$mivalor."</font></td>";
         }
        $p++;
        }
    $i++;


    while ($aTable=mysqli_fetch_row($pConsulta))
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
      
      
      foreach ( $aTable as $mivalor) {
            echo "<td><font size=2>".$mivalor."</font></td>";
            $j++;
        }
    

      If ($Modo==2)
        $NumSem=2;
      If ($Modo==3)
        $NumSem=28;

      for ($k=1;$k<=$NumSem;$k++)
        echo "<td>&nbsp </td>";
      echo "</tr>";
      $i=$i+1;  
    }
      
    If ($Modo==1)
      echo "</table> \n";
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
