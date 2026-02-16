<?php
 
require('fpdf/fpdf.php');
//require('script/conexion.php');
header("Content-Type: text/html; charset=iso-8859-1 ");
 
class PDF extends FPDF
{
    function Footer() 
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas'),'T',0,'C');
    }
 
    function Header() 
    {
        
        $this->SetFont('Arial','B',9);
         $this->Line(10,60,200,60);
        //logo del congreso dentro de lineas
     $conexion = mysqli_connect("localhost","desarrollo","Desarrollo","desarrollo");
 				$imagenSQL6 = "SELECT banner_congreso FROM recursos_pagprin WHERE idRecurso = '1'";
				$traerIMG6 = mysqli_query($conexion, $imagenSQL6);
				$rowImagen6 = $traerIMG6->fetch_assoc();
				$logo = $rowImagen6['banner_congreso'];
        $this->Cell(50,25,'',0,0,'C',$this->Image($logo, 10,8, 190));
            
        $this->Text(150,64,utf8_decode('Clave del trabajo:'));
        $this->Text(10,70,utf8_decode('Estimado(s):'));
        $this->Text(10,100,utf8_decode('Tenemos el agrado de comunicarle (s) que su Curso:'));
        $this->Text(10,115,utf8_decode('Presentado para este congreso, ha sido ACEPTADO.'));
        $this->Text(10,120,utf8_decode('El comité evaluador le (s) recomienda:'));
        
        $this->Text(10,135,utf8_decode('Se le sugiere cumplir con los lineamientos del congreso, mismos que puede seguir consultando en la página: '));
        $this->Text(10,140,utf8_decode('http://congresomatematicas.cuautitlan2.unam.mx'));
        $this->Text(10,165,utf8_decode('Sin más por el momento, quedamos de usted.'));
        $this->Text(10,180,utf8_decode('Atentamente:'));
        $this->Text(20,185,utf8_decode('El Comite Organizador del Evento'));
        $this->Text(20,190,utf8_decode('"Por mi Raza Hablará el Espíritu"'));
       
       $this->Ln(25);
    }
 
}
//BD
//$mysql = new mysql;
  //  $mysql->connect();
   //$mysql->select($data_base);
    


  
$id = $idPonencia;
$titulo = $titulo_trabajo;
$modalidad = $id_modalidad;
$categoria = $id_categoria;
$rfc = $RFC;
$aceptado = $comentarioGeneral;
$nombre = $nombre_usuario;
$apellidos= $apellidos_usuario;

      $h = date("j-m-Y");  // Fecha actual
   $h2 = date("G:i:s");  // Hora actual en 24 hr
 
        $pdf = new PDF();             
        //$pdf -> SetLeftMargin(30);
        $pdf->AddPage('P', 'Letter'); 
 //insertar datos de BD en pdf
 //$pdf->SetFont('Arial', 'B', 14);
//$pdf->Cell(70, 10, "Nombre de Quien Reporta", 1);
//$pdf->Cell(80,137, $describe, 1);
//$pdf->Ln(10);
//$pdf->SetFont('Arial', 'I', 12);
$pdf ->Text(180,64, utf8_decode($id));    
//
 $pdf -> SetXY(10,71);
for ($i=0; $i < 5 ; $i++) { 
    
    $pdf -> MultiCell(80,5, utf8_decode($primerap[$i].' '.$segundoap[$i].' '.$nombre[$i]),0,'L');
    //$pdf -> Ln(1);
}
//$pdf->Text(10,75, utf8_decode($rfc));
$pdf ->SetXY(10,106);
$pdf ->MultiCell(0,3,utf8_decode($titulo), 0, 'L');
$pdf ->SetXY(10,126);
$pdf ->MultiCell(0,3, utf8_decode($aceptado),0, 'L');

$pdf ->SetXY(65,240);
$pdf ->MultiCell(0,3, utf8_decode('Cuautitlán Izcalli, Edo. de México. '.$h.'  '.$h2),0, 'L');
//$pdf->Cell(50, 10, $falla, 0);

//$pdf->Output('mipdf.pdf','d');    

       $pdf->Output('extensos/'.$id.'.pdf', 'F'); //esta linea guarda el pdf en el navegador
      //$pdf->Output(); //esta linea solo muestra el pdf en el navegador    
//Cerramos la Conexion a MySQL si existe

if(isset($mysql))
  //$mysql->close();    
header("location: index.php");              
?>
