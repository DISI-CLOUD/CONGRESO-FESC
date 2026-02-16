<?php

require '../../cartas/fpdf/fpdf.php';


//header("Content-Type: text/html; charset=iso-8859-1 ");

class PDF extends FPDF
{

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Congreso Internacional sobre la Enseñanza y Aplicación de las Matemáticas'), 'T', 0, 'C');
    }
    function Header()
    {
        require ('../../modelo/conexion.php');

        $id_evento = 8;
        $sql = "SELECT fecha_congreso_inicio FROM fecha_congreso WHERE id_evento = $id_evento AND id_congreso = (SELECT MAX(id_congreso) FROM fecha_congreso WHERE id_evento = $id_evento)";
        $result = $conexion->query($sql);
        $row = $result->fetch_assoc();
        $fecha = new DateTime($row["fecha_congreso_inicio"]);
        $locale = 'es_ES'; // Establece la configuración regional en español

        $dateFormatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::FULL, // Estilo completo de fecha y hora
            IntlDateFormatter::FULL, // Estilo completo de fecha y hora
            'UTC', // Zona horaria
            IntlDateFormatter::GREGORIAN
        );

        $dateFormatter->setPattern("EEEE d 'de' MMMM 'de' y"); // Define el patrón de formato

        $fecha_formateada = $dateFormatter->format($fecha);

        // Capitalizar la primera letra del día
        $fecha_formateada = ucfirst($fecha_formateada);

        $this->SetFont('Arial', 'B', 9);

        /* Líneas paralelas
         * Line(x1,y1,x2,y2)
         * El origen es la esquina superior izquierda
         * Cambien los parámetros y chequen las posiciones
         * */
        //$this->Line(10,10,206,10);


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

        $this->Line(10, 60, 200, 60);
        //logo del congreso dentro de lineas
        //$this->Cell(50,25,'',0,0,'C',$this->Image('imagenes/banner2.png', 10,8, 190));

        require_once 'traerImagenes.php';

        $this->Cell(50, 25, '', 0, 0, 'C', $this->Image($logo, 10, 8, 190));

        // clave,categoría y modalidad
        $this->Text(150, 68, utf8_decode('Clave del trabajo:'));

        //$this->Text(150,72,utf8_decode('Modalidad:'));

        //Cuerpo de la carta
        $this->Text(10, 75, utf8_decode('Estimado(s):'));
        //$this->Text(10,137,utf8_decode(''),0,0,'C');
        $this->Text(10, 105, utf8_decode('Tenemos el agrado de comunicarle(s) que el RESUMEN de                        :'));
        //$this->Cell(100,170,utf8_decode(' '),0,0,'C');
        $this->Text(10, 115, utf8_decode('Categoría:'));
        $this->Text(10, 120, utf8_decode('Registrada para este congreso, ha sido ACEPTADO.'));
        $this->Text(10, 125, utf8_decode('El comité evaluador le(s) solicita atender las siguientes indicaciones:'));

        $this->Text(10, 135, utf8_decode('1 - Subir o actualizar en el sitio su semblanza curricular en formato pdf. Máximo una cuartilla.'));
        $this->Text(10, 140, utf8_decode('2 - Realizar el extenso del trabajo para ser considerado en el programa y memorias del evento.'));
        $this->Text(10, 145, utf8_decode('3 - Leer la "Guía de Autores para Trabajos Extensos" que puede consultar en el sitio.'));
        $this->Text(10, 150, utf8_decode('4 - Utilizar la "Plantilla para Trabajos Extensos" para realizar el extenso.'));
        $this->Text(10, 155, utf8_decode('5 - Alumnos sin un grado académico que participan en los trabajos no podrán ser ponentes o expositores.'));
        $this->Text(10, 160, utf8_decode('6 - Realizar el pago correspondiente a partir del ' . $fecha_formateada . ' para ser incluido en el evento.'));
        // $this->Text(10, 165, utf8_decode('7 - Realizar y subir el vídeo de la ponencia en el siguiente sitio: '));
        //$this->Text(10,170,utf8_decode('    https://matematicasfesc.cuautitlan.unam.mx/ponencias/index.php/login'));

        $this->Text(10, 195, utf8_decode('Sin más por el momento, quedamos de usted.'));
        $this->Text(10, 200, utf8_decode('Atentamente:'));
        $this->Text(20, 205, utf8_decode('El Comité Organizador del Evento'));
        $this->Text(20, 215, utf8_decode('"Por mi Raza Hablará el Espíritu"'));




        $this->Ln(25);
    }
}




$h = date("j-m-Y");  // Fecha actual
$h2 = date("G:i:s");  // Hora actual en 24 hr

$pdf = new PDF();
$pdf->AddPage('P', 'Letter');

$pdf->Text(100, 105, utf8_decode($tipoPonencia));
$pdf->Text(180, 68, utf8_decode($idPonencia));
$pdf->Text(30, 115, utf8_decode($nombre_categoria));
$pdf->SetXY(10, 78);

$pdf->MultiCell(80, 5, utf8_decode($nombre_usuario . ' ' . $apellidos_usuario), 0, 'L');
if (count($coautores) != 0) {
    for ($i = 0; $i <= count($coautores) - 1; $i++) {
        $nombresCoautor = $coautores[$i]["nombres"];
        $apellidosCoautor = $coautores[$i]["apellidos"];
        $emailCoautor = $coautores[$i]["email"];

        $pdf->MultiCell(80, 5, utf8_decode($nombresCoautor . ' ' . $apellidosCoautor), 0, 'L');
        //$pdf -> Ln(1);
    }
}

$pdf->SetXY(10, 107);
$pdf->MultiCell(0, 2, utf8_decode($titulo_trabajo), 0, 'L');
$pdf->SetXY(10, 165);
$pdf->MultiCell(0, 3, utf8_decode('Comentario de la aprobación: ' . $comentarioGeneral), 0, 'L');


$pdf->SetXY(65, 240);
$pdf->MultiCell(0, 3, utf8_decode('Cuautitlán Izcalli, Edo. de México. ' . $h . '  ' . $h2), 0, 'L');

$pdf->Output('../../cartas/resumen/' . $idPonencia . '.pdf', 'F'); //esta linea guarda el pdf en el navegador

?>