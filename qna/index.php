<!doctype html>
<?php 
    session_start();
    require_once '../controller/pertanyaanController.php';

    $pertanyaan = query("SELECT * FROM pertanyaan");
    $jumlah_pertanyan = jumlah_data("SELECT * FROM pertanyaan");
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <h1><?= $jumlah_pertanyan; ?></h1>
                    <i class="bi bi-patch-question-fill" style="font-size: 100px;"></i>
                </div>
                <a href="create_pertanyaan.php" class="btn btn-primary mx-1 mb-1">Tambah Data Pertanyaan</a>
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
                    <?php $i = 1; ?>
                    <?php foreach ($pertanyaan as $data) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $data['pertanyaan']; ?></td>
                        <td><?= $data['kode']; ?></td>
                        <td>
                            <a href="edit_pertanyaan.php?id=<?= $data['idpertanyaan']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" id="deletePertanyaan" onclick="deletePertanyaan(<?= $data['idpertanyaan']; ?>)">Hapus</button>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
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

        function deletePertanyaan(id) {
            // Menampilkan Sweet Alert dengan tombol Yes dan No
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Memanggil fungsi PHP menggunakan AJAX saat tombol Yes diklik
                    $.ajax({
                        url: '../controller/pertanyaanController.php',
                        type: 'POST',
                        data: {
                        action: 'delete',
                        id: id
                    },
                    success: function(response) {
                        // Menampilkan pesan sukses jika data berhasil dihapus 
                        Swal.fire({
                            icon : 'success',
                            title: 'Data Pertanyaan Berhasil Dihapus!',
                            confirmButtonText: 'Ok',
                            }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                document.location.href='index.php';
                            }
                        })
                    },
                    error: function(xhr, status, error) {
                    // Menampilkan pesan error jika terjadi kesalahan dalam penghapusan data
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan dalam menghapus data: ' + error,
                            icon: 'error'
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Menampilkan pesan jika tombol No diklik
                    Swal.fire('Batal', 'Penghapusan data dibatalkan', 'info');
                }
            });
        }
    </script>
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