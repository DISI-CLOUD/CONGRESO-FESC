<?php
 
require('fpdf/fpdf.php');
//require('script/conexion.php');
// header("Content-Type: text/html; charset=iso-8859-1 ");
 
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
 
        /* Líneas paralelas
         * Line(x1,y1,x2,y2)
         * El origen es la esquina superior izquierda
         * Cambien los parámetros y chequen las posiciones
         * */
        //$this->Line(10,10,206,10);
        //$this->Line(10,35.5,206,35.5);
 
        /* Explicaré el primer Cell() (Los siguientes son similares)
         * 30 : de ancho
         * 25 : de alto
         * ' ' : sin texto
         * 0 : sin borde
         * 0 : Lo siguiente en el código va a la derecha (en este caso la segunda celda)
         * 'C' : Texto Centrado
         * $this->Image('images/logo.png', 152,12, 19) Método para insertar imagen
         *     'images/logo.png' : ruta de la imagen
         *     152 : posición X (recordar que el origen es la esquina superior izquierda)
         *     12 : posición Y
         *     19 : Ancho de la imagen (w)
         *     Nota: Al no especificar el alto de la imagen (h), éste se calcula automáticamente
         * */

         $this->Line(10,60,200,60);
        //logo del congreso dentro de lineas
        
        require_once 'traerImagenes.php';

        $this->Cell(50,25,'',0,0,'C',$this->Image($logo, 10,8, 190));
        
        
        // clave,categoría y modalidad
        $this->Text(150,64,utf8_decode('Clave del trabajo:'));
        //Cuerpo de la carta
        $this->Text(10,70,utf8_decode('Estimado(s):'));
        $this->Text(10,100,utf8_decode('Tenemos el agrado de comunicarle (s) que su TALLER:'));
        $this->Text(10,115,utf8_decode('Presentado para este congreso, ha sido ACEPTADO.'));
        $this->Text(10,120,utf8_decode('La comisión de talleres le(s) comenta lo siguiente:'));
        
        $this->Text(10,150,utf8_decode('1.- El taller se presentará en formato virtual o presencial'));
        $this->Text(10,155,utf8_decode('2.- Es necesario preparar su material para exponerlo'));
        $this->Text(10,160,utf8_decode('3.- El contacto es Alejandro Valdez Santamaría : 74valsan@gmail.com'));
        $this->Text(10,165,utf8_decode('4.- Exponer sus necesidades y metodología relacionada con el taller al contacto'));
        $this->Text(10,170,utf8_decode('5.- Realizar las pruebas necesarias solicitando apoyo al contacto'));
        $this->Text(10,175,utf8_decode('6.- Realizar el pago correspondiente relacionado con su participación'));             
        $this->Text(10,185,utf8_decode('Sin más por el momento, quedamos de usted.'));
        $this->Text(10,195,utf8_decode('Atentamente:'));
        $this->Text(20,215,utf8_decode('El Comite Organizador del Evento'));
        $this->Text(20,220,utf8_decode('"Por mi Raza Hablará el Espíritu"'));
        //$this->Text(20,160,utf8_decode('Cuautitlán Izcalli, Edo, Méx. a 10 de diciembre de 2013'));
       
        //$this->Text(20,225,utf8_decode("Dr. Juan Alfonso Oaxaca Luna                                                                    Dra. María del Carmen Valderrama Bravo"));
        //$this->Text(65,240,utf8_decode('Coordinadores generales del congreso'));
       
       //firmas
        //$this->Cell(200,100,'',0,0,'C',$this->Image('imagenes/firma_oaxaca.jpeg', 10,180, 100));
        //$this->Cell(200,100,'',0,0,'C',$this->Image('imagenes/firma_2.jpeg', 140,180, 20));



       
       $this->Ln(25);
    }
 
}

   
// $id = $idPonencia;
// $titulo = $titulo_trabajo;
// $modalidad = $id_modalidad;
// $categoria = $id_categoria;
// $rfc = $RFC;
// $aceptado = $comentarioGeneral;
// $nombre = $nombre_usuario;
// $apellidos= $apellidos_usuario;

    $h = date("j-m-Y");  // Fecha actual
   $h2 = date("G:i:s");  // Hora actual en 24 hr
      
 
        $pdf = new PDF();             
        //$pdf -> SetLeftMargin(30);
        $pdf->AddPage('P', 'Letter'); 

$pdf ->Text(180,64, utf8_decode($idPonencia));    
//
 $pdf -> SetXY(10,71);
// for ($i=0; $i < 5 ; $i++) { 
    
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
    //$pdf -> Ln(1);
// }
//$pdf->Text(10,75, utf8_decode($rfc));
$pdf ->SetXY(10,106);
$pdf ->MultiCell(0,3,utf8_decode($titulo_trabajo), 0, 'L');
$pdf ->SetXY(10,123);
$pdf ->MultiCell(0,3, utf8_decode($comentarioGeneral),0, 'L');

$pdf ->SetXY(65,240);
$pdf ->MultiCell(0,3, utf8_decode('Cuautitlán Izcalli, Edo. de México. '.$h.'  '.$h2),0, 'L');
//$pdf->Cell(50, 10, $falla, 0);

//$pdf->Output('mipdf.pdf','d');    

    $pdf->Output('../../cartas/resumen/'.$idPonencia.'.pdf', 'F'); //esta linea guarda el pdf en el navegador

// if(isset($mysql))
    //$mysql->close();    
// header("location: index.php");              
?>
