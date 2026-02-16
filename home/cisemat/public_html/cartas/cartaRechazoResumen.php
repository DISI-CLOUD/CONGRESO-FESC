<?php
 

 require '../../cartas/fpdf/fpdf.php';


//header("Content-Type: text/html; charset=iso-8859-1 ");
 
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

        $this->Text(10,100,utf8_decode('Por este medio le (s) comunicamos que su RESUMEN propuesto:'));

        $this->Text(10,115,utf8_decode('Presentado para este congreso, requiere correciones para ser aprobado.'));
        $this->Text(10,120,utf8_decode('Los motivos que originan la decisión son los siguientes:'));

       
        $this->Text(10,160,utf8_decode('El sitio del congreso sigue abierto para sus correciones')); 
        $this->Text(10,165,utf8_decode('Sin más por el momento, quedamos de usted.'));
        $this->Text(10,180,utf8_decode('Atentamente:'));
        $this->Text(20,185,utf8_decode('El Comite Organizador del Evento'));
        $this->Text(20,190,utf8_decode('"Por mi Raza Hablará el Espíritu"'));



       
       $this->Ln(25);
    }
 
}


   $h = date("j-m-Y");  // Fecha actual
   $h2 = date("G:i:s");  // Hora actual en 24 hr

 
        $pdf = new PDF();             
        //$pdf -> SetLeftMargin(30);
        $pdf->AddPage('P', 'Letter'); 
        
$pdf ->Text(180,64, utf8_decode($idPonencia));    
//
 $pdf -> SetXY(10,71);
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
//$pdf->Text(10,75, utf8_decode($rfc));
$pdf -> SetXY(10,102);
$pdf ->MultiCell(0,3, utf8_decode($titulo_trabajo),0,'L');
$pdf -> SetXY(10,122);
$pdf ->MultiCell(0,3,utf8_decode($comentarioGeneral),0,'L'); //Text(10,105, utf8_decode($rechazado));


$pdf ->SetXY(65,240);
$pdf ->MultiCell(0,3, utf8_decode('Cuautitlán Izcalli, Edo. de México. '.$h.'  '.$h2),0, 'L');
 

$pdf->Output('../../cartas/resumen/'.$idPonencia.'.pdf','F'); //esta linea guarda el pdf en el navegador            
?>
