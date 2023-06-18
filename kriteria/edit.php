<!doctype html>
<?php 
  require_once '../controller/kriteriaController.php';
  validasi_admin();
  
  $id = $_GET['id'];

  $dekripsi = dekripsi($id);

  $model = query("SELECT * FROM model");

  $data = query("SELECT * FROM kriteria WHERE idkriteria = $dekripsi") [0];

  $idmodel = $data['idmodel'];
  
  $nama_model = query("SELECT * FROM model WHERE idmodel = $idmodel") [0];
  
  if(isset($_POST['submit'])) {
    if (update($_POST) > 0) {
      session_start();

      $_SESSION["berhasil"] = "Data Kriteria Berhasil Diubah!";

      echo "
          <script>
            document.location.href='index.php';
          </script>
      ";
    } else {
      session_start();

      $_SESSION["gagal"] = "Data Kriteria Gagal Diubah!";

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
    <title>VARK Test | Edit Kriteria</title>
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
        <h3><i class="bi bi-columns-gap"></i> Edit Data Kriteria</h3><hr>

        <form action="" method="post">
            <input type="hidden" name="idkriteria" value="<?= $data['idkriteria']; ?>">
            <div class="mb-3 row">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
    
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" name="model">
                    <option value="<?= $data['idmodel']; ?>" selected hidden><?= $nama_model['model']; ?></option>
                    <?php foreach ($model as $m) : ?>
                      <option value="<?= $m['idmodel']; ?>"><?= $m['model']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="kriteria" class="col-sm-2 col-form-label">Kriteria</label>
    
                <div class="col-sm-10">
                    <textarea class="form-control" id="kriteria" name="kriteria" rows="10"><?= $data['kriteria']; ?></textarea>
                </div>
            </div>
    
            <div class="mt-4">
              <button class="btn btn-success me-1" name="submit">Edit Data</button>
              <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="../bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>