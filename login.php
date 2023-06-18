<?php 
  session_start();
  require_once 'controller/userController.php';

  if (isset($_POST["login"])) {
    if(login($_POST) == 1) {
      $error = true;
    }
    
  }
?>
<!DOCTYPE html>
<html class="background" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VARK Test | Login</title>
    <link href="bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="bootstrap-icons-1.10.3/bootstrap-icons.css" />
    <link rel="stylesheet" href="login.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>

  <body class="background">

    <!-- Membuat Form Login -->
    <div class="login-item">
      <div class="card login-form">
        <div class="card-body">
          <h1 class="card-title text-center mb-2 login fw-bold">LOGIN</h1>
          <h5 class="card-title text-center mb-2 login">TES GAYA BELAJAR DENGAN VARK MODEL</h5>
          <p class="text-center mb-3">Silahkan Login untuk masuk ke aplikasi</p>

          <form action="" method="POST">
            <?php if (isset ($error)) : ?>
              <p style="color: red; font-style: italic;">Username / Password Salah</p>
            <?php endif;?>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="bi bi-person-fill"></i>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="bi bi-lock-fill"></i>
                </div>
              </div>
            </div>

            <div class="input-group mb-3 justify-content-end">
              <a href="register.php">Daftar Disini</a>
            </div>

            <div class=" input-group">
              <button type="submit" class="btn btn-primary justify-content-center panjang" name="login">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Form Login Selesai -->

    <!-- Membuat Footer -->
    <footer class="text-center bg-secondary text-light fw-bold lebar">
      <p class="mt-2">Copyright &copy; 2023 Create By Fillah Zaki Alhaqi</p>
    </footer>
    <!-- Footer Selesai -->

    <script src="bootstrap-5.2.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="bootstrap-5.2.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
    if(isset($_SESSION["berhasil"])) {
        $pesan = $_SESSION["berhasil"];

        echo "
              <script>
                Swal.fire(
                  'Berhasil!',
                  '$pesan',
                  'success'
                )
              </script>
          ";
        $_SESSION = [];
        session_unset();
        session_destroy();


    } elseif(isset($_SESSION['gagal'])) {
        $pesan = $_SESSION["gagal"];
        
        echo "
            <script>
                Swal.fire(
                    'Gagal!',
                    '$pesan',
                    'error'
                )
            </script>
        ";
        $_SESSION = [];
        session_unset();
        session_destroy();

    }

?>