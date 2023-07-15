<?php
  require_once 'controller/hasilController.php';
  validasi();

  if(!isset($_GET['id'])) {
    echo "
      <script>
        document.location.href='index.php';
      </script>
    ";
  } else {
    $id = dekripsi($_GET['id']);

    $result = mysqli_query($conn, "SELECT * FROM hasil WHERE idhasil = '$id'");
        
    if (mysqli_num_rows($result) !== 1) {
        echo "<script>
                document.location.href='index.php';
              </script>";
        exit;
    }
  }

  $jumlah_model = jumlah_data("SELECT * FROM model");
  $data_pertanyaan = query("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'T%' ORDER BY kode ASC");

  if(isset($_POST['submit'])) {
    if (hitung_ulang($_POST, $id) > 0) {
      header("Location: hasil.php?id=" . $_GET['id']);
    } else {
      header("Location: tes2.php?id=" . $_GET['id']);
    }
  }

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
    <link rel="Icon" href="img/Logo.png">
  </head>

  <body class="font-style">
    <?php require_once ("navbar.php"); ?>

    <!-- Bagian Content -->
    <section class="pt-1 text-center container mb-3">
      <div class="row pt-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-bold">Tes Gaya Belajar</h1>
          <p class="lead" style="font-size: 24px;">Karena ada beberapa hasil yang sama, maka jawab pertanyaan dibawah ini</p>
        </div>
      </div>
    </section>

    <div class="container">
      <table class="table table-borderless">
        <tbody class="fs-6 fw-bold">
          <tr>
            <td style="width: 150px;">Nama</td>
            <td style="width: 1px;">:</td>
            <td><?= $nama; ?></td>
          </tr>
          <tr>
            <td>Asal Sekolah</td>
            <td>:</td>
            <td><?= $user['instansi']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Daftar Pertanyaan -->
    <form action="" method="post">
      <!-- <input type="hidden" name="nama" value="">
      <input type="hidden" name="sekolah" value=""> -->
        <div class="container">
            <?php 
                $i = 1;
                foreach($data_pertanyaan as $p1) : 
            ?>
                <div class="mb-5">
                    <label for="rolename" class="form-label"><?= $i . " " . $p1['pertanyaan']; ?></label>
                    <?php 
                        $idpertanyaan = $p1['idpertanyaan'];
                        $jawaban1 = query("SELECT * FROM jawaban WHERE idpertanyaan = $idpertanyaan ORDER BY RAND()");
                        foreach($jawaban1 as $j1) :
                    ?>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="<?= $p1['kode']; ?>" value="<?= $j1['kode']; ?>" id="<?= $j1['kode']; ?>" required>
                        <label class="form-check-label" for="<?= $j1['kode']; ?>"><?= $j1['jawaban']; ?></label>
                    </div>
                    <?php endforeach;?>
                </div>  
            <?php 
                $i++;
                endforeach;
            ?>
        <button type="submit" class="btn btn-lg btn-primary mb-5" name="submit">Submit</button>
        </div>
    </form>
    <!-- Daftar Pertanyaan Selesai-->

    <!-- Bagian Content Selesai -->

    <script src="bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>