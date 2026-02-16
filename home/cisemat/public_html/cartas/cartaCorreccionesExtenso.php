<?php
  require '../../cartas/fpdf/fpdf.php';

  class PDF extends FPDF
  {
    // Cabecera de página
    function Header()
    {
      $this->SetFont('Arial','B',9);

      $this->Line(10,10,206,10);
      require('traerImagenes.php');
     $this->Cell(50,25,'',0,0,'C',$this->Image($logo, 10,8, 190));

      //$this->Line(10,35.5,206,35.5);
      // $this->Cell(30,25,'',0,0,'C',$this->Image('imagenes/logomate.jpeg', 182,12, 19));
      //$this->Cell(140,20,utf8_decode('Universidad Nacional Autónoma de México'),0,0,'C');
      //$this->Cell(-140,28,utf8_decode('Facultad de Estudios Superiores Cuautitlán'),0,0,'C');
      //$this->Cell(140,38,utf8_decode('Departamento de Matemáticas'),0,0,'C');
      //$this->Cell(40,25,'',0,0,'C',$this->Image('imagenes/logo_unam2.png', 12, 12, 19 ));
      //$this->Line(10,40,206,40);
      $this->Line(10,60,206,60);
      // //logo del congreso dentro de lineas
     // $this->Cell(35,25,'',0,0,'C',$this->Image('imagenes/Banner_k.jpg', 50,41, 105));
    }

  //   Pie de página
    function Footer()
    {
      $this->SetY(-15);
      $this->SetFont('Arial','I',8);
      $this->Cell(0,10,utf8_decode('Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas'),'T',0,'C');
    }
  }


  // // Creación del objeto de la clase heredada
  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $h = date("j-m-Y");  // Fecha actual
  $h2 = date("G:i:s");  // Hora actual en 24 hr

      
      
   // clave,categoría y modalidad
  $pdf->Text(150,64,utf8_decode('Clave del trabajo:'));
  $pdf->Text(10,125,utf8_decode('Categoría:'));
  //$pdf->Text(150,72,utf8_decode('Modalidad:'));
  
  $pdf ->Text(180,64, utf8_decode($idPonencia));    
  $pdf ->Text(30,125, utf8_decode($nombre_categoria));  
  //$pdf ->Text(180,72, utf8_decode($modalidad));
  $pdf -> SetXY(10,84);

  $pdf -> MultiCell(80,5, utf8_decode($nombre_usuario.' '.$apellidos_usuario),0,'L');
if(count($coautores)!=0){
    for ($i=0; $i <=count($coautores)-1; $i++) { 
    $nombresCoautor=$coautores[$i]["nombres"];
    $apellidosCoautor=$coautores[$i]["apellidos"];
    $emailCoautor=$coautores[$i]["email"];

    $pdf -> MultiCell(80,5, utf8_decode($nombresCoautor.' '.$apellidosCoautor),0,'L');
    //$pdf -> Ln(1);
}
}

  $pdf ->SetXY(10,115);
  $pdf ->MultiCell(0,3,utf8_decode($titulo_trabajo), 0, 'L');

  // Cuerpo de la carta
  $pdf->SetXY(10, 80);
  $pdf->MultiCell(0,5,utf8_decode('Estimado(s):'), 0, 'L');

  $pdf->SetXY(10, 110);
  $pdf->MultiCell(0,5,utf8_decode('La PONENCIA ORAL presentada para este Congreso:'), 0, 'L');
  
  $pdf->SetXY(10, 135);
  $pdf->MultiCell(0,5,utf8_decode('Necesita correcciones en uno o mas aspectos, de acuerdo a las observaciones emitidas por el Comité Evaluador. Estas observaciones se detallan en la página siguiente de éste documento.'), 0, 'L');

  $pdf->MultiCell(0,5,utf8_decode("Usted podrá subir nuevamente su trabajo en extenso en la misma página en donde lo subió anteriormente."), 0, 'L');
  
  $pdf->SetXY(10, 156);
  $pdf->MultiCell(0,5,utf8_decode('El formato y plantilla de los trabajos extensos podrá consultarlos en la página:'), 0, 'L');
  //$pdf->MultiCell(0,5,utf8_decode('https://congresomatematicas.cuautitlan2.unam.mx/src/GuiasYPlantillas/Plantilla_extenso_2024.docx'), 0, 'L');

  $pdf->SetXY(10, 170);
  $pdf->MultiCell(0,5,utf8_decode('ingresando al sistema en el menú del perfil opción "plantillas".'), 0, 'L');

  $pdf->Text(12,185,utf8_decode('Sin más por el momento, quedamos de usted.'));
  $pdf->Text(12,200,utf8_decode('Atentamente'));
  $pdf->Text(12,205,utf8_decode('"Por mi Raza Hablará el Espíritu"'));
  //$pdf->Text(12,215,utf8_decode('Cuautitlán Izcalli, Edo, Méx. Marzo 2014'));
  //$pdf->Text(35,270,utf8_decode("Dr. Juan Alfonso Oaxaca Luna                                      Dra. María del Carmen Valderrama Bravo"));
  $pdf->Text(72,280,utf8_decode('El Comite Organizador'));

  // //firmas
  //$pdf->Cell(200,100,'',0,0,'C',$pdf->Image('imagenes/firma_oaxaca.jpeg', 10,228, 100));
  //$pdf->Cell(200,100,'',0,0,'C',$pdf->Image('imagenes/firma_2.jpeg', 140,238, 20));
  
  $pdf->Ln(25);


// PÁGINA CON OBSERVACIONES
      $pdf->AddPage();
      $pdf->Text(10,65,utf8_decode('Observaciones del Comité Evaluador:'));

      $renglon = 75;

      $pdf ->SetXY(10,$renglon);
      if ($comentarioPunto1!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("El trabajo se encuentra incluido en la plantilla de extensos:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto1),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto2!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("El trabajo cumple con el formato solicitado (Tipo y tamaño de letra, márgenes, tamaño de hoja, datos correctos, alineación, etc):"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto2),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto3!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("El resumen cumple con un máximo de 250 palabras con la estructura requerida. Incluye palabras clave (Máximo 6).:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto3),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto4!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("El trabajo está descrito ordenadamente como corresponde a la categoría de investigación o experiencia en aula:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto4),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto5!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("El trabajo lleva orden en la numeración de ecuaciones, tablas y figuras. Los títulos de figuras y tablas están correctamente:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto5),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto6!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("Las referencias siguieron el estilo APA.:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto6),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto7!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("Las referencias citadas en el texto corresponden a las reportadas al final del trabajo:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto7),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto8!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("La redacción es congruente:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto8),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioPunto9!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("Presentación del trabajo general, ortografía, lenguaje apropiado, etc.:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioPunto9),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);

          // $pdf ->MultiCell(0,5,utf8_decode($y), 0, 'L');
      }
      if ($comentarioGeneral!='') {
          $y = $pdf->GetY();
          if ($y>250) {
            $pdf->AddPage();
            $pdf->SetXY(10,50);
            }
          $pdf ->MultiCell(0,5,utf8_decode("Observaciones generales:"), 0, 'L');
          $pdf ->MultiCell(0,5, utf8_decode($comentarioGeneral),0, 'L');
          $y = $pdf->GetY();
          $pdf ->SetXY(10,$y+5);
      }

	    $pdf ->SetXY(20,215);
        $pdf ->MultiCell(0,3, utf8_decode('Cuautitlán Izcalli, Edo. de México. '.$h.'  '.$h2),0, 'L');


      // $pdf->Ln(25);
      $pdf->Output('../../cartas/extensos/'.$idPonencia.'.pdf','F'); //esta linea guarda el pdf en el navegador
  // $pdf->Output();
?>
