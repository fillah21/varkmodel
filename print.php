<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

// Buat objek Dompdf
$dompdf = new Dompdf();

// Buat HTML yang akan diubah menjadi PDF
$html = '<html><body><h1>Tampilan Pratinjau PDF</h1><p>Ini adalah konten PDF.</p></body></html>';

// Muat HTML ke Dompdf
$dompdf->loadHtml($html);

// Render HTML menjadi PDF
$dompdf->render();

// Ambil output PDF
$output = $dompdf->output();

// Konversi output PDF menjadi data URI
$pdfDataUri = 'data:application/pdf;base64,' . base64_encode($output);

// Tampilkan pratinjau PDF di browser
echo '<embed src="' . $pdfDataUri . '" type="application/pdf" width="100%" height="100%">';
?>
