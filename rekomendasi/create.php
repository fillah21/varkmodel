<!doctype html>
<?php 
  require_once '../controller/rekomendasiController.php';
  validasi_admin();

  $model = query("SELECT * FROM model");

  if(isset($_POST['submit'])) {
    if (create($_POST) > 0) {
      session_start();

      $_SESSION["berhasil"] = "Data Rekomendasi Belajar Berhasil Ditambahkan!";

      echo "
          <script>
            document.location.href='index.php';
          </script>
      ";
    } else {
      session_start();

      $_SESSION["gagal"] = "Data Rekomendasi Belajar Gagal Ditambahkan!";

      echo "
          <script>
            document.location.href='index.php';
          </script>
      ";
    }
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Tambah Rekomendasi Belajar</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3><i class="bi bi-grid"></i> Tambah Data Rekomendasi Belajar</h3><hr>

        <form action="" method="post">
            <div class="mb-3 row">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
    
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="model">
                      <option value="" disabled selected hidden>--Pilih Model--</option>
                      <?php foreach ($model as $data) : ?>
                        <option value="<?= $data['idmodel']; ?>"><?= $data['model']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="rekomendasi" class="col-sm-2 col-form-label">Rekomendasi Belajar</label>
    
                <div class="col-sm-10">
                    <textarea class="form-control" id="rekomendasi" name="rekomendasi" rows="10"></textarea>
                </div>
            </div>
    
            <div class="mt-4">
              <button class="btn btn-primary me-1" name="submit">Tambah Data</button>
              <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="../bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>