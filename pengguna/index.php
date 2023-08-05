<?php 
    session_start();
    require_once '../controller/userController.php';
    validasi_admin();

    $jumlah_user = jumlah_data("SELECT * FROM user WHERE role = 'User'");
    $jumlah_admin = jumlah_data("SELECT * FROM user WHERE role = 'Admin'");

    $pengguna = query("SELECT * FROM user");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Data Pengguna</title>
    <link href="../style.css" rel="stylesheet">
    <link href="../bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="Icon" href="../img/Logo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3 class="mb-3"><i class="bi bi-people-fill"></i> Data Pengguna</h3><hr>

        <div class="d-flex">
            <div class="card me-5" style="width: 18rem;">
                <h5 class="ms-3 mt-3 card-title">Jumlah User</h5>
                <div class="d-flex justify-content-between align-items-center mx-3">
                    <h1><?= $jumlah_user; ?></h1>
                    <i class="bi bi-people-fill" style="font-size: 100px;"></i>
                </div>
                <a href="../register.php" class="btn btn-primary mx-1 mb-1">Tambah Data User</a>
            </div>

            
            <div class="card" style="width: 18rem;">
                <h5 class="ms-3 mt-3 card-title">Jumlah Admin</h5>
                <div class="cardo d-flex justify-content-between align-items-center mx-3">
                    <h1><?= $jumlah_admin; ?></h1>
                    <i class="bi bi-person-fill" style="font-size: 100px;"></i>
                </div>
                <a href="register_admin.php" class="btn btn-primary mx-1 mb-1">Tambah Data Admin</a>
            </div>
        </div>

        <div class="my-5">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $i = 1;
                        foreach ($pengguna as $p) :
                        $enkripsi = enkripsi($p['iduser']);
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $p['username']; ?></td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['instansi']; ?></td>
                            <td><?= $p['email']; ?></td>
                            <td><?= $p['role']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $enkripsi; ?>" class="btn btn-success btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" id="delete" onclick="confirmDelete(<?= $p['iduser']; ?>)">Hapus</button>
                            </td>
                        </tr>
                    <?php 
                        $i++;
                        endforeach;
                    ?>
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

        function confirmDelete(id) {
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
                        url: '../controller/userController.php',
                        type: 'POST',
                        data: {
                        action: 'delete',
                        id: id
                    },
                    success: function(response) {
                        // Menampilkan pesan sukses jika data berhasil dihapus 
                        Swal.fire({
                            icon : 'success',
                            title: 'Data Pengguna Berhasil Dihapus!',
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