<?php
  require('fpdf/fpdf.php');

  class PDF extends FPDF
  {
    // Cabecera de página
    function Header()
    {
      $this->SetFont('Arial','B',9);

      $this->Line(10,10,206,10);
      //$this->Line(10,35.5,206,35.5);
      require('traerImagenes.php');
      $this->Cell(50,25,'',0,0,'C',$this->Image($logo, 10,8, 190));

      //$this->Cell(30,25,'',0,0,'C',$this->Image('imagenes/logomate.jpeg', 182,12, 19));
      //$this->Cell(140,20,utf8_decode('Universidad Nacional Autónoma de México'),0,0,'C');
      //$this->Cell(-140,28,utf8_decode('Facultad de Estudios Superiores Cuautitlán'),0,0,'C');
      //$this->Cell(140,38,utf8_decode('Departamento de Matemáticas'),0,0,'C');
      //$this->Cell(40,25,'',0,0,'C',$this->Image('imagenes/', 12, 12, 19 ));
      //$this->Line(10,40,206,40);
      $this->Line(10,60,206,60);
      // //logo del congreso dentro de lineas
     // $this->Cell(35,25,'',0,0,'C',$this->Image('imagenes/Banner_k.jpg', 50,41, 105));
    }

    // Pie de página
    function Footer()
    {
      $this->SetY(-15);
      $this->SetFont('Arial','I',8);
      $this->Cell(0,10,utf8_decode('Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas'),'T',0,'C');
    }
  }

  // Creación del objeto de la clase heredada
  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();

   $h = date("j-m-Y");  // Fecha actual
   $h2 = date("G:i:s");  // Hora actual en 24 hr
      
      
  // clave,categoría y modalidad
  $pdf->Text(150,64,utf8_decode('Clave del trabajo:'));
  $pdf->Text(10,68,utf8_decode('Categoría:'));
  //$pdf->Text(150,72,utf8_decode('Modalidad:'));

  //Cuerpo de la carta
  $pdf->Text(10,80,utf8_decode('Estimado(s):'));
  $pdf->Text(10,110,utf8_decode('Tenemos el agrado de comunicarle(s) que su trabajo en extenso:'));

     

  //$pdf->Text(10,125,utf8_decode('Ha sido aceptado para ser publicado en las Memorias del Undécimo Congreso Internacional'));
  //$pdf->Text(10,130,utf8_decode('sobre la Enseñanza y Aplicación de las Matemáticas.'));

  $pdf->Text(10,125,utf8_decode('Ha sido aceptado para ser presentado como video ponencia y en las memorias del Congreso Internacional'));
  $pdf->Text(10,130,utf8_decode('Sobre la Enseñanza y Aplicación de las Matemáticas.'));
  $pdf->Text(10,135,utf8_decode('El comité le(s) recomienda lo siguiente: '));

  $pdf->Text(10,145,utf8_decode('La ponencia será presentada en formato de vídeo el día del evento en el siguiente sitio:'));
  $pdf->Text(10,150,utf8_decode('https://congresomatematicas.cuautitlan.unam.mx/ponenciasv/'));

  require('../../modelo/conexion.php');
  require('../../librerias/PHPMailer/src/traerCorreoCongreso.php');

  $pdf->Text(10,160,utf8_decode('Es necesario mandar el enlace del vídeo de la presentación de la ponencia al correo del congreso: '));
  $pdf->Text(10,165,utf8_decode(strtolower($correoCongreso)));
  //$pdf->Text(10,165,utf8_decode('https://matematicasfesc.cuautitlan.unam.mx/ponencias/index.php/login'));
  //$pdf->Text(10,170,utf8_decode('Para acceder utilice el mismo usuario y contraseña de este sitio'));
  $pdf->Text(10,170,utf8_decode('El vídeo debe ser cargado en la nube mediante plataformas como Google Drive, OneDrive u otro servicio de preferencia. '));
  $pdf->Text(10,175,utf8_decode('Favor de asegurarse de configurar el vídeo para que sea accesible a través del enlace proporcionado.'));
  $pdf->Text(10,185,utf8_decode('Consulte las características del vídeo en el menú del sitio en la opción:'));
  $pdf->Text(10,190,utf8_decode('¿Cuáles son los elementos que debe de tener un video para ponencia oral?'));
  $pdf->Text(10,195,utf8_decode('https://congresomatematicas.cuautitlan2.unam.mx/components/GuiasYPlantillas/guias.php'));
 
  $pdf->Text(10,205,utf8_decode('Le informamos que su extenso pudiera tener ajustes en el diseño para integrarlo en las memorias. '));
  $pdf->Text(10,210,utf8_decode('Las memorias serán publicadas cuatro semanas después de terminado el evento.'));
  $pdf->Text(10,215,utf8_decode('Recuerde realizar el pago correspondiente para que su trabajo sea incluido en las memorias del congreso.'));
  
  $pdf->Text(10,225,utf8_decode('Sin más por el momento, quedamos de usted.'));
  $pdf->Text(10,235,utf8_decode('Atentamente'));
  $pdf->Text(10,240,utf8_decode('"Por mi Raza Hablará el Espíritu"'));
  
 
  $pdf->Text(72,250,utf8_decode('El Comité Organizador'));
  //$pdf->Text(10,235,utf8_decode('http://congresomatematicas.cuautitlan2.unam.mx'));

  //firmas
  //$pdf->Cell(200,100,'',0,0,'C',$pdf->Image('imagenes/firma_oaxaca.jpeg', 10,228, 100));
  //$pdf->Cell(200,100,'',0,0,'C',$pdf->Image('imagenes/firma_2.jpeg', 140,238, 20));
  
  $pdf ->Text(180,64, utf8_decode($idPonencia));    
  $pdf ->Text(30,68, utf8_decode($nombre_categoria));  
  //$pdf ->Text(180,72, utf8_decode($modalidad));
  $pdf -> SetXY(10,81);

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

  $pdf ->SetXY(10,112);
  $pdf ->MultiCell(0,3,utf8_decode($titulo_trabajo), 0, 'L');

  $pdf ->SetXY(20,260);
  $pdf ->MultiCell(0,3, utf8_decode('Cuautitlán Izcalli, Edo. de México. '.$h.'  '.$h2),0, 'L');


  $pdf->Ln(25);

  $pdf->Output('../../cartas/extensos/'.$idPonencia.'.pdf', 'F'); //esta linea guarda el pdf en el navegador
  // // $pdf->Output();
?>
