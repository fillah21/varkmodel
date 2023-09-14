<?php
    require_once 'vendor/autoload.php';
    require_once 'controller/hasilController.php';
    validasi();
    $id = dekripsi($_GET['id']);

    $data_hasil = query("SELECT * FROM hasil WHERE idhasil = $id") [0];
    $waktu_tes = strftime('%H:%M:%S / %d %B %Y', strtotime($data_hasil['tanggal_tes']));
    $hasil = hasil($data_hasil);

    $iduser = $data_hasil['iduser'];
    $data_user = query("SELECT * FROM user WHERE iduser = $iduser") [0];

    $data_model = query("SELECT * FROM model WHERE model = '$hasil'")[0];

    $idmodel = $data_model['idmodel'];
    $data_rekomendasi = query("SELECT * FROM rekomendasi WHERE idmodel = $idmodel");
    $data_kriteria = query("SELECT * FROM kriteria WHERE idmodel = $idmodel");

    use Dompdf\Dompdf;

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Buat HTML yang akan diubah menjadi PDF
    $html =     '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Hasil Tes</title>
                    <style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        th, td {
                            border: 1px solid black;
                            padding: 8px;
                            text-align: center;
                        vertical-align: middle;
                        }

                        th {
                            background-color: #f2f2f2;
                        }

                        p {
                            text-align: justify; 
                            text-indent: 0.5in;
                        }
                        li {
                            text-align: justify;
                            padding: 0;
                            padding: 0;
                            margin: 0;
                            left: 0;
                        }
                    </style>
                </head>
                <body>
                    <h1 style="text-align: center;">LAPORAN HASIL TES</h1><br>

                    <h4>Biodata :</h4>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Waktu Tes</th>
                            <th>Hasil</th>
                        </tr>

                        <tr>';
                            $html .= "<td>" . $data_user['nama'] . "</td>".
                                    "<td>" . $data_user['instansi'] . "</td>".
                                    "<td>" . $waktu_tes . "</td>".
                                    "<td><b>" . $hasil . "</b></td>";
                $html .= '</tr>
                    </table><br>

                    <h4>Rincian hasil :</h4>

                    <table>
                        <tr>
                            <th>Visual</th>
                            <th>Auditory</th>
                            <th>Read/Write</th>
                            <th>Kinesthetic</th>
                        </tr>

                        <tr>';
                            $html .= "<td>" . $data_hasil['v'] . "%</td>".
                                    "<td>" . $data_hasil['a'] . "%</td>".
                                    "<td>" . $data_hasil['r'] . "%</td>".
                                    "<td>" . $data_hasil['k'] . "%</td>";

                $html .= '</tr>
                    </table><br>

                    <h4>Penjabaran hasil :</h4>

                    <table>
                        <tr>';
                            $html .= "<th>Tentang " . $hasil . "</th>";
                            $html .= '<th>Rekomendasi Belajar</th>
                        </tr>

                        <tr>';
                            $html .= "<td>
                                        <p>" . $data_model['deskripsi'] . "</p>
                                        <p>Kriteria " . $hasil . " : </p>
                                        <ul>";
                                            foreach($data_kriteria as $dk) {
                                                $html .= "<li>" . $dk['kriteria'] . "</li>";
                                            };
                            $html .= "</ul>
                                    </td>
                                    <td><ul>";
                                foreach ($data_rekomendasi as $dr) {
                                            $html .= "<li>" . $dr['rekomendasi'] . "</li>";
                                        };
                            $html .='</ul></td>
                        </tr>
                </body>
                </html>';

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

    // // Set header untuk menentukan nama file yang diunduh
    // header('Content-Type: application/octet-stream');
    // header('Content-Disposition: attachment; filename="hasil tes.pdf"');
    // header('Content-Length: ' . strlen($output));

    // // Tampilkan output PDF
    // echo $output;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hasil Tes</title>
    <link rel="Icon" href="img/Logo.png">
</head>
</html>
