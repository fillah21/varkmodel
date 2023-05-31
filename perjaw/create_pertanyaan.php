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
    <title>VARK Test | Tambah Pertanyaan</title>
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
        <h3><i class="bi bi-patch-question-fill"></i> Tambah Data Pertanyaan</h3><hr>

        <form action="">
            <div class="mb-3 row">
                <label for="pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
    
                <div class="col-sm-10">
                    <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="10"></textarea>
                </div>
            </div>
    
    
            <div class="mb-3 row">
                <label for="kode" class="col-sm-2 col-form-label">Kode</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kode" value="" name="kode">
                </div>
            </div>
    
            <div class="mt-4">
                <a href="" class="btn btn-primary me-1">Tambah Data</a>
                <a href="" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="../bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>