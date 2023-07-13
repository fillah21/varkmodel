<?php 
  session_start();
  require_once '../controller/modelController.php';
  validasi_admin();

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Tambah Model</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="Icon" href="../img/Logo.png">
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3><i class="bi bi-clipboard-data-fill"></i> Tambah Data Model</h3><hr>

        <form action="" method="post">
            <div class="mb-3 row">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="model" value="" name="model">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="kode" class="col-sm-2 col-form-label">Kode</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kode" value="" name="kode">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
    
                <div class="col-sm-10">
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10"></textarea>
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

<?php 
  if(isset($_POST['submit'])) {
    if (create($_POST) > 0) {
      create_field($_POST);

      $_SESSION["berhasil"] = "Data Model Berhasil Ditambahkan!";

      echo "
          <script>
            document.location.href='index.php';
          </script>
      ";
    } else {
      $_SESSION["gagal"] = "Data Model Gagal Ditambahkan!";

      echo "
          <script>
            document.location.href='index.php';
          </script>
      ";
    }
  }
?>
