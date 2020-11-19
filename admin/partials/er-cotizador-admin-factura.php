<?php
include_once( plugin_dir_path( dirname( __FILE__ ) ) . '../includes/fpdf.php');

ob_end_clean();    header("Content-Encoding: None", true);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Cell(40,10,'¡Hola, Mundo!');$pdf->Ln(5);
$pdf->Output('reporte.pdf', 'I');
exit();
?>