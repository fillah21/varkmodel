<?php
  // if(isset($_POST['nama']) && isset($_POST['sekolah'])) {
  //   $nama = $_POST['nama'];
  //   $sekolah = $_POST['sekolah'];
  // } else {
  //   echo "<script>
  //           alert('Silahkan isi nama dan asal sekolah terlebih dahulu');
  //           document.location.href='index.php';
  //         </script>";
  //   exit;
  // }

  // $hasil = false;
  // $v = 0;
  // $a = 0;
  // $r = 0;
  // $k = 0;

  // if(isset($_POST['submit'])) {

  //   if($_POST['P1'] == 'V1') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P1'] == 'A1') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P1'] == 'R1') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P1'] == 'K1') {
  //     $k = $k + 1;
  //   } 

  //   if($_POST['P2'] == 'V2') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P2'] == 'A2') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P2'] == 'R2') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P2'] == 'K2') {
  //     $k = $k + 1;
  //   }

  //   if($_POST['P3'] == 'V3') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P3'] == 'A3') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P3'] == 'R3') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P3'] == 'K3') {
  //     $k = $k + 1;
  //   }
    
  //   if($_POST['P4'] == 'V4') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P4'] == 'A4') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P4'] == 'R4') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P4'] == 'K4') {
  //     $k = $k + 1;
  //   }
  //   if($_POST['P5'] == 'V5') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P5'] == 'A5') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P5'] == 'R5') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P5'] == 'K5') {
  //     $k = $k + 1;
  //   }
  //   if($_POST['P6'] == 'V6') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P6'] == 'A6') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P6'] == 'R6') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P6'] == 'K6') {
  //     $k = $k + 1;
  //   }
  //   if($_POST['P7'] == 'V7') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P7'] == 'A7') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P7'] == 'R7') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P7'] == 'K7') {
  //     $k = $k + 1;
  //   }
  //   if($_POST['P8'] == 'V8') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P8'] == 'A8') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P8'] == 'R8') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P8'] == 'K8') {
  //     $k = $k + 1;
  //   }
  //   if($_POST['P9'] == 'V9') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P9'] == 'A9') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P9'] == 'R9') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P9'] == 'K9') {
  //     $k = $k + 1;
  //   }
  //   if($_POST['P10'] == 'V10') {
  //     $v = $v + 1;
  //   } elseif ($_POST['P10'] == 'A10') {
  //     $a = $a + 1;
  //   } elseif ($_POST['P10'] == 'R10') {
  //     $r = $r + 1;
  //   } elseif ($_POST['P10'] == 'K10') {
  //     $k = $k + 1;
  //   }

  //   $v = ($v / 10) * 100;
  //   $a = ($a / 10) * 100;
  //   $r = ($r / 10) * 100;
  //   $k = ($k / 10) * 100;

  //   $hasil = true;

  //   $array = [$v, $a, $r, $k, $hasil];

  //   setcookie('hasil', $hasil, time()+10800);
  //   setcookie('v', $v, time()+10800);
  //   setcookie('a', $a, time()+10800);
  //   setcookie('r', $r, time()+10800);
  //   setcookie('k', $k, time()+10800);
  //   setcookie('nama', $nama, time()+10800);
  //   setcookie('sekolah', $sekolah, time()+10800);

  //   echo "<script>
  //           document.location.href='hasil.php';
  //         </script>";
  // }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kuisioner Tes</title>
    <link href="style.css" rel="stylesheet">
    <link href="bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons-1.10.3/bootstrap-icons.css">
  </head>

  <body class="font-style">
    <?php require_once ("layout/navbar.php"); ?>

    <!-- Bagian Content -->
    <section class="pt-1 text-center container mb-3">
      <div class="row pt-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-bold">Tes Gaya Belajar</h1>
          <p class="lead" style="font-size: 24px;">Jawab pertanyaan dibawah ini dan cari tahu gaya belajar apa yang cocok untukmu</p>
        </div>
      </div>
    </section>

    <div class="container">
      <table class="table table-borderless">
        <tbody class="fs-6 fw-bold">
          <tr>
            <td style="width: 150px;">Nama</td>
            <td style="width: 1px;">:</td>
            <td>Fillah Zaki Alhaqi</td>
          </tr>
          <tr>
            <td>Asal Sekolah</td>
            <td>:</td>
            <td>SMAN 1 Cilimus</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Daftar Pertanyaan -->
    <form action="hasil.php" method="post">
      <!-- <input type="hidden" name="nama" value="">
      <input type="hidden" name="sekolah" value=""> -->
      <div class="container">
        <div class="row">
          <div class="col-md mt-3">
            <div class="mb-4">
              <label for="rolename" class="form-label">1.	Saat belajar, saya ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P1" value="A1" required>
                <label class="form-check-label">Belajar dengan berdiskusi</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P1" value="R1" required>
                <label class="form-check-label">Membaca buku, artikel, dan jurnal</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P1" value="V1" required>
                <label class="form-check-label">Mencari pola grafis tertentu</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P1" value="K1" required>
                <label class="form-check-label">Menggunakan contoh dan penerapan</label>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="rolename" class="form-label">2.	Saya diberi tugas yang baru oleh guru, saya akan meminta ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P2" value="R2" required>
                <label class="form-check-label">Laporan tertulis yang menjelaskan garis besar tugas tersebut</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P2" value="A2" required>
                <label class="form-check-label">Kesempatan berdiskusi dengan guru yang bersangkutan</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P2" value="K2" required>
                <label class="form-check-label">Contoh-contoh tugas serupa</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P2" value="V2" required>
                <label class="form-check-label">Diagram yang berisi tahap-tahap pengerjaan tugas itu</label>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="rolename" class="form-label">3.	Ketika belajar sesuatu dari internet, saya menyukai ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P3" value="A3" required>
                <label class="form-check-label">Situs dengan suara, siaran, atau wawancara</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P3" value="K3" required>
                <label class="form-check-label">Video cara melakukan atau membuat sesuatu</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P3" value="R3" required>
                <label class="form-check-label">Uraian tertulis, daftar, dan penjelasannya</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P3" value="V3" required>
                <label class="form-check-label">Desain dan fitur visual yang menarik</label>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="rolename" class="form-label">4.	Saya ingin merakit satu set meja yang belum jadi, saya paling mengerti jika ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P4" value="R4" required>
                <label class="form-check-label">Membaca penjelasan tertulis yang dilampirkan</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P4" value="K4" required>
                <label class="form-check-label">Menonton video orang merakit meja yang serupa</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P4" value="V4" required>
                <label class="form-check-label">Mengikuti diagram instruksi yang dilampirkan</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P4" value="A4" required>
                <label class="form-check-label">Mendengarkan saran dari orang yang pernah merakitnya</label>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="rolename" class="form-label">5.	Saya ingin mempelajari suatu jenis permainan papan atau kartu yang baru, saya akan ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P5" value="R5" required>
                <label class="form-check-label">Membaca petunjuk tertulis tentang permainan tersebut</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P5" value="K5" required>
                <label class="form-check-label">Melihat orang lain bermain sebelum saya ikut mencoba</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P5" value="V5" required>
                <label class="form-check-label">Memakai diagram yang menjelaskan tahap, langkah, dan strategi permainannya</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P5" value="A5" required>
                <label class="form-check-label">Mendengarkan penjelasan orang serta bertanya padanya</label>
              </div>
            </div>
            
          </div>
    
          <div class="col-md mt-3 justify-content-center">
            <div class="mb-4">
              <label for="rolename" class="form-label">6.	Sebuah grup wisatawan ingin berwisata di wilayah saya, saya akan ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P6" value="A6" required>
                <label class="form-check-label">Berbicara dan memberitahu informasi tentang itu</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P6" value="R6" required>
                <label class="form-check-label">Memberikan buku petunjuk tentang objek wisata area itu</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P6" value="K6" required>
                <label class="form-check-label">Mengajak para wisatawan untuk terjun langsung</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P6" value="V6" required>
                <label class="form-check-label">Menunjukkan peta dan gambar-gambar dari internet</label>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="rolename" class="form-label">7.	Saya lebih suka pembicara yang dalam presentasinya menggunakan ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P7" value="K7" required>
                <label class="form-check-label">Peragaan, model peraga, atau kesempatan mencoba langsung</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P7" value="R7" required>
                <label class="form-check-label">Jurnal, buku, atau bacaan lain</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P7" value="A7" required>
                <label class="form-check-label">Kesempatan tanya jawab, atau diskusi kelompok</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P7" value="V7" required>
                <label class="form-check-label">Diagram, bagan, peta, atau grafik</label>
              </div>
            </div>

            <div class="mb-4">
              <label for="rolename" class="form-label">8.	Saya berkendara ke tempat asing dan melalui jalan yang belum pernah dilalui, untuk sampai dan mengingat jalannya, saya akan ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P8" value="V8" required>
                <label class="form-check-label">Menggunakan peta yang menunjukkan jalan dan lokasi</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P8" value="K8" required>
                <label class="form-check-label">Mencari lokasi tersebut berdasarkan tempat lain di sekitar situ yang sudah saya tahu</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P8" value="R8" required>
                <label class="form-check-label">Menuliskan alamat lengkap dan daftar belokan yang harus saya ingat</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P8" value="A8" required>
                <label class="form-check-label">Bertanya pada orang lain yang tahu lokasi tersebut</label>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="rolename" class="form-label">9.	Saya ingin mempelajari suatu teknologi atau aplikasi baru di sebuah perangkat, saya akan ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P9" value="K9" required>
                <label class="form-check-label">Langsung mencoba dan belajar dari kesalahan</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P9" value="R9" required>
                <label class="form-check-label">Membaca instruksi tertulis pada petunjuknya</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P9" value="V9" required>
                <label class="form-check-label">Mencari dan mengikuti diagram tentang hal tersebut</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P9" value="A9" required>
                <label class="form-check-label">Bicara dengan orang yang paham tentang hal tersebut</label>
              </div>
            </div>
            <div class="mb-4">
              <label for="rolename" class="form-label">10.	Saya akan memberikan pidato yang penting di sebuah acara, saya akan ...</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P10" value="A10" required>
                <label class="form-check-label">Berdiskusi dengan yang sudah berpengalaman</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P10" value="V10" required>
                <label class="form-check-label">Membuat diagram dan grafik yang akan membantu menjelaskan sesuatu</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P10" value="K10" required>
                <label class="form-check-label">Mengumpulkan contoh-contoh dan cerita agar mudah dalam berpidato</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" name="P10" value="R10" required>
                <label class="form-check-label">Menulis poin-poin penting dan menghafal</label>
              </div>
            </div>

            <button type="submit" class="btn btn-lg btn-primary mb-5" name="submit">Submit</button>
          </div>
        </div>
      </div>
    </form>
    <!-- Daftar Pertanyaan Selesai-->

    <!-- Bagian Content Selesai -->

    <script src="bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>