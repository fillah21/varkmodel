<!doctype html>
<?php 
  // if(isset($_COOKIE['v']) || isset($_COOKIE['a']) || isset($_COOKIE['r']) || isset($_COOKIE['k']) || isset($_COOKIE['hasil'])) {
  //   setcookie('v', '', time()-3600);
  //   setcookie('a', '', time()-3600);
  //   setcookie('r', '', time()-3600);
  //   setcookie('k', '', time()-3600);
  //   setcookie('hasil', '', time()-3600);
  // }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Edit Rekomendasi Belajar</title>
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
        <h3><i class="bi bi-grid"></i> Edit Data Rekomendasi Belajar</h3><hr>

        <form action="">
            <div class="mb-3 row">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
    
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="model">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                <a href="" class="btn btn-success me-1">Edit Data</a>
                <a href="" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="../bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>