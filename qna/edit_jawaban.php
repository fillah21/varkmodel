<?php 
    require_once '../controller/jawabanController.php';
    validasi_admin();

    $id = dekripsi($_GET['id']);

    $data = query("SELECT * FROM jawaban WHERE idjawaban = $id") [0];

    $idpertanyaan = $data['idpertanyaan'];
    $pertanyaan = query("SELECT * FROM pertanyaan WHERE idpertanyaan = $idpertanyaan") [0];

    if(isset($_POST['submit'])) {
        if (update_jawaban($_POST) > 0) {
          session_start();
    
          $_SESSION["berhasil"] = "Data Jawaban Berhasil Diubah!";
    
          echo "
              <script>
                document.location.href='index.php';
              </script>
          ";
        } else {
          session_start();
    
          $_SESSION["gagal"] = "Data Jawaban Gagal Diubah!";
    
          echo "
              <script>
                document.location.href='index.php';
              </script>
          ";
        }
      }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Edit Jawaban</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
    <link rel="Icon" href="../img/Logo.png">
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3><i class="bi bi-bar-chart-steps"></i> Edit Data Jawaban</h3><hr>

        <form action="" method="post">
            <input type="hidden" name="idjawaban" value="<?= $data['idjawaban']; ?>">
            <div class="mb-3 row">
                <label for="kode_pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
    
                <div class="col-sm-10">
                    <input class="form-control" type="text" value="<?= $pertanyaan['pertanyaan']; ?>" aria-label="Disabled input example" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
    
                <div class="col-sm-10">
                    <textarea class="form-control" id="jawaban" name="jawaban" rows="10"><?= $data['jawaban']; ?></textarea>
                </div>
            </div>
    
    

            <div class="mb-3 row">
                <label for="kode" class="col-sm-2 col-form-label">Kode</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kode" value="<?= $data['kode']; ?>" name="kode" readonly>
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
    
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="bobot" value="<?= $data['bobot']; ?>" name="bobot" step="0.01" max="1">
                </div>
            </div>
    
            <div class="mt-4">
                <button name="submit" class="btn btn-success me-1">Ubah Data</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="../bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>