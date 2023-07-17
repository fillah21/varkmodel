<?php 
  require_once 'controller/hasilController.php';
  validasi();
  $id = dekripsi($_COOKIE['VRK21ZA']);

  if(isset($_GET['id'])) {
    $idhasil = dekripsi($_GET['id']);

    $data_cek = query("SELECT * FROM hasil WHERE idhasil = $idhasil") [0];
    cek_null($data_cek);

    $data = query("SELECT * FROM hasil WHERE idhasil = $idhasil") [0];
    $hasil = hasil($data);
  } else {
    $data_cek = query("SELECT * FROM hasil WHERE iduser = $id AND idhasil = (SELECT MAX(idhasil) FROM hasil WHERE iduser = $id)") [0];
    cek_null($data_cek);
    
    $data = query("SELECT * FROM hasil WHERE iduser = $id AND idhasil = (SELECT MAX(idhasil) FROM hasil WHERE iduser = $id)") [0];
    $hasil = hasil($data);
  }

  if($hasil != false) {
    $idhasil_enkripsi = enkripsi($data['idhasil']);
    $model_detail = query("SELECT * FROM model WHERE model = '$hasil'") [0];
    $idmodel = $model_detail['idmodel'];
    $data_hasil = query("SELECT * FROM rekomendasi WHERE idmodel = $idmodel");

    $data_kriteria = query("SELECT * FROM kriteria WHERE idmodel = $idmodel");

    $model = query("SELECT * FROM model");

    foreach ($model as $mod) {
      $nama_model[] = $mod['model'];
      $kode_kecil[] = strtolower($mod['kode']);
    }
  } else {
    $idhasil_enkripsi = enkripsi($data['idhasil']);
    header("Location: tes2.php?id=" . $idhasil_enkripsi);
  }
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
    <link rel="Icon" href="img/Logo.png">
  </head>

  <body class="font-style" style="background-color: rgb(250, 251, 255);">
    <?php require_once ("navbar.php"); ?>

    <!-- Bagian Content -->
    <div class="container text-white mt-5 shadow" style="background-color: rgb(110, 110, 197, 1); border-radius: 12px; border: 5px solid rgb(183, 183, 219, 0.3);">
      <section class="text-center container">
        <div class="row pt-lg-5">
          <div class="col-md mx-auto">
            <h3 class="fw-bold">Selamat <?= $nama; ?>, gaya belajar anda adalah :</h3>
            <h1 class="fw-bold my-5" style="font-size: 60px;"><?= $hasil; ?></h1>
            <h4>Dengan kesimpulan sebagai berikut :</h4>
          </div>
        </div>
      </section>
  
      <div class="container">
        <h3 class="text-center mt-5">Hasil tes :</h3>
        <ul class="list-inline text-center fs-4">
          <?php for($i = 0; $i < count($nama_model); $i++) : ?>
            <li class="list-inline-item me-3 pb-4"><?= $nama_model[$i]; ?> : <?= $data[$kode_kecil[$i]]; ?>%</li>
          <?php endfor; ?>
        </ul>
      </div>
    </div>


    <div class="container">
      <h2 class="text-center mt-5">Rekomendasi Cara Belajar :</h2>

      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              Tentang <?= $hasil; ?>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <p class="mt-3 fs-5" style="text-align: justify; text-indent: 0.5in;"><?= $model_detail['deskripsi']; ?></p>

              <h5>Kriteria <?= $hasil; ?> :</h5>
              <ul>
                <?php foreach($data_kriteria as $dk) : ?>
                  <li class="fs-5"><?= $dk['kriteria']; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              Rekomendasi belajar yang cocok untuk para <?= $hasil; ?>
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul>
                <?php foreach ($data_hasil as $dh) :?>
                  <li class="fs-5"><?= $dh['rekomendasi']; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="justify-content-center d-flex my-5">
        <a href="print.php?id=<?= $idhasil_enkripsi; ?>" class="btn btn-success me-3" target="_blank">Cetak Hasil</a>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>