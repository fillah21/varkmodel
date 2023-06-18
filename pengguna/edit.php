<?php 
    require_once '../controller/userController.php';
    session_start();

    $dekripsi = dekripsi($_GET['id']);
    
    $data = query("SELECT * FROM user WHERE iduser = $dekripsi") [0];


?>

<!doctype html>
  
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Edit Pengguna</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3><i class="bi bi-person-fill"></i> Edit Data Pengguna</h3><hr>

        <form action="" method="post">
            <input type="hidden" name="iduser" value="<?= $data['iduser']; ?>">
            <input type="hidden" name="oldpassword" value="<?= $data['pwd']; ?>">
            <input type="hidden" name="oldusername" value="<?= $data['username']; ?>">

            <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" value="<?= $data['username']; ?>" name="username">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
    
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value="<?= $data['pwd']; ?>">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Passowrd</label>
    
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password2" name="password2" value="<?= $data['pwd']; ?>">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" value="<?= $data['nama']; ?>" name="nama">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="instansi" value="<?= $data['instansi']; ?>" name="instansi">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
    
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" value="<?= $data['email']; ?>" name="email">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
    
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="admin" value="Admin" <?php if($data['role'] === 'Admin'){ echo 'checked'; } ?>>
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="user" value="User" <?php if($data['role'] === 'User'){ echo 'checked'; } ?>>
                        <label class="form-check-label" for="user">User</label>
                    </div>
                </div>
            </div>
    
            <div class="mt-4">
                <button type="submit" class="btn btn-success me-1" name="submit">Ubah Data</button>
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
        if (update($_POST) > 0) {
    
          $_SESSION["berhasil"] = "Data Pengguna Berhasil Diubah!";
    
          echo "
              <script>
                document.location.href='index.php';
              </script>
          ";
        } else {
    
          $_SESSION["gagal"] = "Data Pengguna Gagal Diubah!";
    
          echo "
              <script>
                document.location.href='index.php';
              </script>
          ";
        }
    }
?>