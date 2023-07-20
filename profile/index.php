<?php 
    require_once '../controller/userController.php';
    require_once '../controller/hasilController.php';
    validasi();

    $iduser = dekripsi($_COOKIE['VRK21ZA']);
    $hasil = query("SELECT * FROM hasil WHERE iduser = $iduser");
    setlocale(LC_TIME, 'id_ID');  // Mengatur lokal ke bahasa Indonesia
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Profile dan Riwayat Tes</title>
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
        <h3><i class="bi bi-person-fill"></i> Data Diri dan Riwayat Tes</h3><hr>

        <form action="" method="post">
            <input type="hidden" name="iduser" value="<?= $user['iduser']; ?>">
            <input type="hidden" name="oldpassword" value="<?= $user['pwd']; ?>">
            <input type="hidden" name="oldusername" value="<?= $user['username']; ?>">
            <input type="hidden" name="oldemail" value="<?= $user['email']; ?>">
            <input type="hidden" name="oldrole" value="<?= $user['role']; ?>">
            <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" value="<?= $user['username']; ?>" name="username">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
    
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value="<?= $user['pwd']; ?>">
                    <div id="emailHelp" class="form-text">*jika tidak ingin mengubah password, tidak perlu merubah form password dan konfirmasi password</div>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Passowrd</label>
    
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password2" name="password2" value="<?= $user['pwd']; ?>">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" value="<?= $user['nama']; ?>" name="nama">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
    
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="instansi" value="<?= $user['instansi']; ?>" name="instansi">
                </div>
            </div>
    
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
    
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" value="<?= $user['email']; ?>" name="email">
                </div>
            </div>
    
            <div class="mt-4">
                <button type="submit" class="btn btn-success me-1" name="update">Ubah Data</button>
                <a class="btn btn-danger me-1" id="delete" onclick="confirmDelete(<?= $user['iduser']; ?>)">Hapus Data</a>
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
                    <?php 
                        $i = 1;
                        foreach ($hasil as $h) :
                            $waktu_tes = strftime('%H:%M:%S / %d %B %Y', strtotime($h['tanggal_tes']));
                            $hasil = hasil($h);
                            $idhasil = enkripsi($h['idhasil'])
                     ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $waktu_tes; ?></td>
                            <td><?= $hasil; ?></td>
                            <td>
                                <a href="../hasil.php?id=<?= $idhasil; ?>" class="btn btn-primary btn-sm">Detail</a>
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
                            title: 'Data User Berhasil Dihapus!',
                            confirmButtonText: 'Ok',
                            }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                document.location.href='../logout.php';
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
  if(isset($_POST['update'])) {
    if (update($_POST) > 0) {
      echo "
          <script>
            Swal.fire({
                icon : 'success',
                title: 'Data Pengguna Berhasil Diperbaharui!',
                confirmButtonText: 'Ok',
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href='index.php';
                }
            })
          </script>
      ";
    } else {
      echo "
          <script>
              Swal.fire(
                'Gagal!',
                'Data Pengguna Gagal Diperbaharui!',
                'error'
            )
          </script>
      ";
    }
  }
?>