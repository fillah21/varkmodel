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
    <title>VARK Test | Data Pertanyaan dan Jawaban</title>
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
        <h3 class="mb-3"><i class="bi bi-bar-chart-steps"></i> Data Pertanyaan da Jawaban</h3><hr>

        <div class="d-flex">
            <div class="card me-5" style="width: 18rem;">
                <h5 class="ms-3 mt-3 card-title">Jumlah Pertanyaan</h5>
                <div class="d-flex justify-content-between align-items-center mx-3">
                    <h1>3</h1>
                    <i class="bi bi-patch-question-fill" style="font-size: 100px;"></i>
                </div>
                <a href="" class="btn btn-primary mx-1 mb-1">Tambah Data Pertanyaan</a>
            </div>

            
            <div class="card" style="width: 18rem;">
                <h5 class="ms-3 mt-3 card-title">Jumlah Jawaban</h5>
                <div class="cardo d-flex justify-content-between align-items-center mx-3">
                    <h1>5</h1>
                    <i class="bi bi-bar-chart-steps" style="font-size: 100px;"></i>
                </div>
                <a href="" class="btn btn-primary mx-1 mb-1">Tambah Data Jawaban</a>
            </div>
        </div>

        <div class="my-5">
            <h1 class="mb-3">Data Pertanyaan</h1>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Saya akan.............</td>
                        <td>P1</td>
                        <td>
                            <a href="" class="btn btn-success btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="my-5">
            <h1 class="mb-3">Data Jawaban</h1>
            <table id="example2" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Kode</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>P1</td>
                        <td>Apakah...............?</td>
                        <td>V1</td>
                        <td>0.8</td>
                        <td>
                            <a href="" class="btn btn-success btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>P1</td>
                        <td>Apakah...............?</td>
                        <td>A1</td>
                        <td>0,6</td>
                        <td>
                            <a href="" class="btn btn-success btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Hapus</a>
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
        $(document).ready(function () {
            $('#example2').DataTable();
        });
    </script>
  </body>
</html>