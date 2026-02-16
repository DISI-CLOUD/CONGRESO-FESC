<?php
session_start();
ob_start();
$nombreImagen = "../../src/Banner-Oficial.jpg";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../../favicon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<div style="text-align: center;"><img src="<?php echo $imagenBase64 ?>" style= "max-width: 600px;margin-top:2cm;" /></div>
<p style='margin-top:0cm;margin-right:2cm;margin-bottom:10.0pt;margin-left:2cm;line-height:107%; font-size:11px;font-family:"Calibri",sans-serif; '>&nbsp;</p>
<p style='margin-top:0cm;margin-right:2cm;margin-bottom:10.0pt;margin-left:2cm;line-height:107%; font-size:13px;font-family:"Calibri",sans-serif;'>Orden de pago en cajas de C4.</p>
<p style='margin-top:0cm;margin-right:2cm;margin-bottom:10.0pt;margin-left:2cm;line-height:107%;font-size:13px;font-family:"Calibri",sans-serif;'>No. UR <u>5120</u></p>
<p style='margin-top:0cm;margin-right:2cm;margin-bottom:10.0pt;margin-left:2cm;line-height:107%;font-size:13px;font-family:"Calibri",sans-serif;'>Concepto: &ldquo;Decimoquinto congreso internacional sobre la ense&ntilde;anza y aplicaci&oacute;n de las matem&aacute;ticas&rdquo;.</p>
<p style='margin-top:0cm;margin-right:2cm;margin-bottom:20.0pt;margin-left:2cm;line-height:107%;font-size:13px;font-family:"Calibri",sans-serif;'>Seleccione el importe:<br></p>

<input class="form-check-input" type="checkbox"style="margin-left:3cm; vertical-align: middle;"><label class="form-check-label"  style='margin-top:0cm;margin-right:2cm;margin-bottom:10.0pt;line-height:107%;font-size:18px;font-family:"Calibri",sans-serif;'>$1400. Ponentes (Internos y externos que presentan trabajos).<br></label>
<input class="form-check-input" type="checkbox"style="margin-left:3cm; vertical-align: middle;"><label class="form-check-label"  style='margin-top:0cm;margin-right:2cm;margin-bottom:10.0pt;line-height:107%;font-size:18px;font-family:"Calibri",sans-serif;'>$1000. Asistentes (Internos y externos que no presentan trabajos).<br></label>
<input class="form-check-input" type="checkbox" style="margin-left:3cm; vertical-align: middle;"><label class="form-check-label"  style='margin-top:0cm;margin-right:2cm;margin-bottom:10.0pt;line-height:107%;font-size:18px;font-family:"Calibri",sans-serif;'>$200. Estudiantes<br></label>

<p style='margin-top:1cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:11px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
<p style='margin-right:2cm;margin-left:2cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:10px;font-family:"Verdana",sans-serif;color:black;'>A partir del 10 de marzo de 2023, se podrá realizar el pago de la inscripción. En caso de requerir factura solicitarla en caja directamente al momento de realizar el pago.</span></p>
<p style='margin-right:2cm;margin-left:2cm;font-size:16px;font-family:"Times New Roman",serif;'><span style='font-size:10px;font-family:"Verdana",sans-serif;color:black;'>Una vez realizado el pago correspondiente, enviar el comprobante de pago escaneado con su nombre completo para registrar su pago al correo altamira@unam.mx.</span></p>

</body>                  
</html>
<?php
$html=ob_get_clean();

require_once 'dompdf/autoload.inc.php'; 

use Dompdf\Dompdf;

$dompdf = new Dompdf();
echo "PDF en mantenimiento, esperar por la solucion";
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);


$dompdf->setPaper('letter', 'potrait');

$dompdf->render();

$dompdf->stream("orden.pdf",array("Attachment"=>false));

exit;

?>