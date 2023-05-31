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
    <title>VARK Test | Profile dan Riwayat Tes</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3><i class="bi bi-person-fill"></i> Data Diri dan Riwayat Tes</h3><hr>

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
    
            <div class="mt-4">
                <a href="" class="btn btn-success me-1">Ubah Data</a>
                <a href="" class="btn btn-danger me-1">Hapus Data</a>
                <a href="" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

        <h3 class="mt-5 mb-3"><i class="bi bi-clock-fill"></i> Riwayat Tes</h3><hr>

        <div class="mb-5">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Tes</th>
                        <th>Hasil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>10:34:21 / 21 November 2022</td>
                        <td>Visual</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>10:34:21 / 22 November 2022</td>
                        <td>Visual</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="../bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
  </body>
</html>