<?php 
  // if(isset($_COOKIE['hasil'])) {
  //   $nama = $_COOKIE['nama'];
  //   $sekolah = $_COOKIE['sekolah'];
  //   $hasil = $_COOKIE['hasil'];
  //   $v = $_COOKIE['v'];
  //   $a = $_COOKIE['a'];
  //   $r = $_COOKIE['r'];
  //   $k = $_COOKIE['k'];
  // } else {
  //   echo "<script>
  //           alert('Silahkan lakukan tes terlebih dahulu');
  //           document.location.href='index.php';
  //         </script>";
  //   exit;
  // }

  // $ada_hasil = false;
  
  // if($v > $a && $v > $r && $v > $k) {
  //   $result = "VISUAL";
  //   $ada_hasil = true;
  // } elseif ($a > $v && $a > $r && $a > $k) {
  //   $result = "AUDITORY";
  //   $ada_hasil = true;
  // } elseif ($r > $v && $r > $a && $r > $k) {
  //   $result = "READ / WRITE";
  //   $ada_hasil = true;
  // } elseif ($k > $v && $k > $r && $k > $a) {
  //   $result = "KINESTHETIC";
  //   $ada_hasil = true;
  // }
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Tes Gaya Belajar</title>
    <link href="style.css" rel="stylesheet">
    <link href="bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons-1.10.3/bootstrap-icons.css">
  </head>

  <body class="font-style" style="background-color: rgb(250, 251, 255);">
    <?php require_once ("layout/navbar.php"); ?>

    <!-- Bagian Content -->
    <div class="container text-white mt-5 shadow" style="background-color: rgb(110, 110, 197, 1); border-radius: 12px; border: 5px solid rgb(183, 183, 219, 0.3);">
      <section class="text-center container">
        <div class="row pt-lg-5">
          <div class="col-md mx-auto">
            <h3 class="fw-bold">Selamat Fillah Zaki Alhaqi, gaya belajar anda adalah :</h3>
            <h1 class="fw-bold my-5" style="font-size: 60px;">Visual</h1>
            <h4>Dengan kesimpulan sebagai berikut :</h4>
          </div>
        </div>
      </section>
  
      <div class="container">
        <h3 class="text-center mt-5">Hasil tes :</h3>
        <ul class="list-inline text-center fs-4">
          <li class="list-inline-item">Visual : 80%</li>
          <li class="list-inline-item mx-3">Auditory : 10%</li>
          <li class="list-inline-item me-3">Read/Write : 5%</li>
          <li class="list-inline-item pb-4">Kinesthetic : 5%</li>
        </ul>
      </div>
    </div>


    <div class="container">
      <h2 class="text-center mt-5">Rekomendasi Cara Belajar :</h2>
      <ul class="nav nav-tabs " role="tablist">
        <li class="nav-item">
          <a class="nav-link active text-dark" data-bs-toggle="tab" href="#v">Visual</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" data-bs-toggle="tab" href="#a">Auditory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" data-bs-toggle="tab" href="#r">Read/Write</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" data-bs-toggle="tab" href="#k">Kinesthetic</a>
        </li>
      </ul>

      <div class="tab-content">
        <div id="v" class="tab-pane active fs-5">
          <p class="mt-3" style="text-align: justify; text-indent: 0.5in;">Visual memiliki preferensi pada grafis, tabel, bagan sebagai representasi verbal daripada banyak kata. Visual lebih cenderung menangkap informasi dari apa yang mereka lihat (berbentuk bagan, grafik, tabel, dan lain-lain), dan merepresentasikannya ke dalam sebuah objek visual seperti grafik, power point, bagan, dan lain-lain.</p>
          <p>Rekomendasi cara belajar yang cocok untuk para Visual adalah : </p>

          <ul>
            <li>Belajar dengan melihat sesuatu yang menarik mata seperti bagan, grafik, dan lain-lain</li>
            <li>Membuat peta konsep atau semacamnya untuk merangkum dan menghubungkan informasi yang didapat</li>
            <li>Melihat presentasi yang slide nya terlihat interaktif dan menarik</li>
            <li>Melihat video tutorial berbentuk presentasi yang menarik</li>
          </ul>
        </div>

        <div id="a" class="tab-pane fade fs-5">
          <p class="mt-3" style="text-align: justify; text-indent: 0.5in;">Auditory ditandai dengan preferensi untuk mendengar informasi dalam bentuk rekaman audio, percakapan, atau bertukar pendapat. Auditory biasanya orang yang komunikatif karena untuk mendapatkan informasi mereka sangat suka berdiskusi.</p>
          <p>Rekomendasi cara belajar yang cocok untuk para Auditory adalah : </p>

          <ul>
            <li>Belajar dengan mendengarkan pendapat, rekaman audio pembelajaran, atau berdiskusi</li>
            <li>Mengulang informasi dengan cara berbicara dengan diri sendiri maupun orang lain agar informasi dapat diingat dengan baik</li>
            <li>Mendengarkan talk show, seminar, atau semacamnya untuk mendapatkan informasi</li>
            <li>Sering berdiskusi dengan orang lain</li>
          </ul>
        </div>

        <div id="r" class="tab-pane fade fs-5">
          <p class="mt-3" style="text-align: justify; text-indent: 0.5in;">Read/Write mencirikan orang yang lebih menyukai informasi dalam bentuk tertulis (buku, artikel) dan mereka menggunakan catatan dalam berbagai bentuk untuk merekam informasi tersebut.</p>
          <p>Rekomendasi cara belajar yang cocok untuk para Read/Write adalah : </p>

          <ul>
            <li>Belajar dengan membaca tulisan. Dapat berupa buku, artikel, jurnal, dan lain-lain</li>
            <li>Mengulang informasi dengan cara membaca ulang informasi yang didapat atau menulis informasi tersebut kedalam sebuah catatan kecil</li>
            <li>Menerima informasi secara tertulis</li>
          </ul>
        </div>

        <div id="k" class="tab-pane fade fs-5">
          <p class="mt-3" style="text-align: justify; text-indent: 0.5in;">Kinesthetic lebih menyukai contoh materi yang diajarkan untuk melihat hubungan dengan contoh nyata dan memiliki kecenderungan untuk bereksperimen. Kinesthetic lebih menyukai untuk melihat orang melakukan sesuatu dan akhirnya dia sendiri mencoba melakukan hal tersebut.</p>
          <p>Rekomendasi cara belajar yang cocok untuk para Kinesthetic adalah : </p>

          <ul>
            <li>Belajar dengan melihat contoh jadi atau seseorang melakukan sesuatu</li>
            <li>Mencoba hal secara langsung dan belajar dari kesalahan</li>
            <li>Mengulang informasi yang didapat dengan gerakan yang dapat membantu mengingat informasi tersebut</li>
          </ul>
        </div>
      </div>

      <div class="justify-content-center d-flex mb-5">
        <a href="" class="btn btn-success me-3">Cetak Hasil</a>
        <a href="" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>