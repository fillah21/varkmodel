<?php 
  require_once 'controller/userController.php';
  session_start();
  setcookie('VRK21ZA', '', time() - 3600);

  if(isset($_GET['key'])) {
    $email = dekripsi($_GET['key']);

    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if (!mysqli_fetch_assoc($result)) {
      $_SESSION["gagal"] = "Email tidak ditemukan";
      echo "
          <script>
              document.location.href='login.php';
          </script>";
      exit();
    } else {
        $data = query("SELECT * FROM user WHERE email = '$email'") [0];
  
        $enkripsi_email = enkripsi($data['email']);
    }
  } else {
    echo "<script>
            document.location.href='login.php';
          </script>";
  }
?>



<!DOCTYPE html>
<html class="background" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VARK Test | Ubah Password</title>
    <link href="bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="bootstrap-icons-1.10.3/bootstrap-icons.css" />
    <link rel="stylesheet" href="login.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="Icon" href="img/Logo.png">
  </head>

  <body class="background">

    <!-- Membuat Form Login -->
    <div class="login-item">
      <div class="card login-form mx-3">
        <div class="card-body">
          <h2 class="card-title text-center mb-2 login fw-bold">UBAH PASSWORD</h2>
          <p class="text-center mb-3">Masukkan password baru untuk mengganti password yang lama</p>

          <form action="" method="POST">
            <input type="hidden" name="iduser" value="<?= $data['iduser']; ?>">

            <div class="input-group mb-2">
                <input class="form-control" type="text" placeholder="<?= $data['nama']; ?>" aria-label="Disabled input example" disabled>
                <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>

            <div class="input-group mb-2">
              <input type="password" class="form-control" placeholder="Password" name="password" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="bi bi-lock-fill"></i>
                </div>
              </div>
            </div>

            <div class="input-group mb-2">
              <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password2" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="bi bi-lock-fill"></i>
                </div>
              </div>
            </div>

            <div class=" input-group">
              <button type="submit" class="btn btn-primary justify-content-center panjang" name="submit">Submit</button>
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
  if(isset($_POST['submit'])) {
    if (update_password($_POST) > 0) {
      $_SESSION["berhasil"] = "Ubah Password Berhasil!";
      
      echo "
        <script>
          document.location.href='login.php';
        </script>
        ";
    } else {
      $_SESSION["gagal"] = "Ubah Password Gagal!";

      echo "
          <script>
            document.location.href='login.php';
          </script>
      ";
      }
  }
?>