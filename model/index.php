<?php 
    session_start();
    require_once '../controller/modelController.php';
    
    $model = query("SELECT * FROM model");
    $jumlah = jumlah_data("SELECT * FROM model");
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Data Model</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3 class="mb-3"><i class="bi bi-clipboard-data-fill"></i> Data Model</h3><hr>

        <div class="d-flex">
            <div class="card me-5" style="width: 18rem;">
                <h5 class="ms-3 mt-3 card-title">Jumlah Model</h5>
                <div class="d-flex justify-content-between align-items-center mx-3">
                    <h1><?= $jumlah; ?></h1>
                    <i class="bi bi-clipboard-data-fill" style="font-size: 100px;"></i>
                </div>
                <a href="create.php" class="btn btn-primary mx-1 mb-1">Tambah Data Model</a>
            </div>
        </div>

        <div class="my-5">
            <h1 class="mb-3">Data Model</h1>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Model</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($model as $data) :?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $data['model']; ?></td>
                            <td><?= $data['kode']; ?></td>
                            <td><?= $data['deskripsi']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $data['idmodel']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" id="button">Hapus</button>

                                <script>
                                    document.getElementById("button").addEventListener("click", function() {
                                        // Menampilkan Sweet Alert dengan tombol Save dan Cancel
                                        Swal.fire({
                                            title: "Konfirmasi",
                                            text: "Apakah Anda yakin ingin menyimpan?",
                                            icon: "warning",
                                            buttons: {
                                                cancel: "Batal",
                                                confirm: "Simpan"
                                            },
                                            dangerMode: true,
                                        })
                                        .then((willSave) => {
                                            if (willSave) {
                                                // Memanggil fungsi PHP menggunakan AJAX saat tombol Save diklik
                                                $.ajax({
                                                    url: "nama_file_php.php",
                                                    type: "POST",
                                                    data: {
                                                        parameter: "nilai_parameter"
                                                    },
                                                    success: function(response) {
                                                        // Menampilkan pesan sukses jika fungsi PHP berhasil dieksekusi
                                                        swal("Sukses", "Data berhasil disimpan!", "success");
                                                    },
                                                    error: function(xhr, status, error) {
                                                        // Menampilkan pesan error jika terjadi kesalahan dalam eksekusi fungsi PHP
                                                        swal("Error", "Terjadi kesalahan: " + error, "error");
                                                    }
                                                });
                                            } else {
                                                // Menampilkan pesan jika tombol Cancel diklik
                                                swal("Batal", "Data tidak disimpan", "info");
                                            }
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
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

        // document.getElementById("button").addEventListener("click", function() {
        //     // Memunculkan Sweet Alert saat button diklik
        //     Swal.fire({
        //         title: 'Do you want to save the changes?',
        //         showDenyButton: true,
        //         showCancelButton: true,
        //         confirmButtonText: 'Save',
        //         denyButtonText: `Don't save`,
        //         }).then((result) => {
        //         /* Read more about isConfirmed, isDenied below */
        //         if (result.isConfirmed) {
        //             Swal.fire('Saved!', '', 'success')
        //         } else if (result.isDenied) {
        //             Swal.fire('Changes are not saved', '', 'info')
        //         }
        //     })
        // });

        // Menambahkan event listener pada button
        
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