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
    <title>VARK Test | Edit Pengguna</title>
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
        <h3><i class="bi bi-person-fill"></i> Edit Data Pengguna</h3><hr>

        <form action="">
            <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" value="" name="username">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
    
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Passowrd</label>
    
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password2" name="password2">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" value="" name="nama">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="instansi" value="" name="instansi">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
    
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" value="" name="email">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
    
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="user" value="user">
                        <label class="form-check-label" for="user">User</label>
                    </div>
                </div>
            </div>
    
            <div class="mt-4">
                <a href="" class="btn btn-success me-1">Ubah Data</a>
                <a href="" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="../bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>