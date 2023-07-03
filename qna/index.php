<!doctype html>
<?php 
    session_start();
    require_once '../controller/pertanyaanController.php';
    validasi_admin();

    $pertanyaan = query("SELECT * FROM pertanyaan ORDER BY kode ASC");
    $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan");

    $per = query("SELECT * FROM pertanyaan WHERE idpertanyaan NOT IN (SELECT DISTINCT idpertanyaan FROM jawaban) ORDER BY kode ASC");

    $jawaban = query("SELECT * FROM jawaban ORDER BY idpertanyaan DESC");
    $jumlah_jawaban = jumlah_data("SELECT * FROM jawaban");
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
        <h3 class="mb-3"><i class="bi bi-bar-chart-steps"></i> Data Pertanyaan dan Jawaban</h3><hr>

        <div class="d-flex">
            <div class="card me-5" style="width: 18rem;">
                <h5 class="ms-3 mt-3 card-title">Jumlah Pertanyaan</h5>
                <div class="d-flex justify-content-between align-items-center mx-3">
                    <h1><?= $jumlah_pertanyaan; ?></h1>
                    <i class="bi bi-patch-question-fill" style="font-size: 100px;"></i>
                </div>
                <a href="create_pertanyaan.php" class="btn btn-primary mx-1 mb-1">Tambah Data Pertanyaan</a>
            </div>

            
            
            <div class="card" style="width: 18rem;">
                <h5 class="ms-3 mt-3 card-title">Jumlah Jawaban</h5>
                <div class="cardo d-flex justify-content-between align-items-center mx-3">
                    <h1><?= $jumlah_jawaban; ?></h1>
                    <i class="bi bi-bar-chart-steps" style="font-size: 100px;"></i>
                </div>
                <button type="button" class="btn btn-primary mx-1 mb-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah Data Jawaban
                </button>
            </div>
            
            <!-- Modal Jawaban -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Pertanyaan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="create_jawaban.php" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kode_pertanyaan" class="form-label">Pilih pertanyaan sebelum memasukkan data jawaban</label>
                            
                                    <div class="">
                                        <select class="form-select" aria-label="Default select example" name="pertanyaan">
                                            <?php foreach ($per as $p) : ?>
                                                <option value="<?= $p['idpertanyaan']; ?>"><?= $p['pertanyaan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Pilih</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Jawaban Selesai -->
        </div>

        <div class="my-5">
            <h1 class="mb-3">Data Pertanyaan</h1>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th style="width: 700px;">Pertanyaan</th>
                        <th>Kode</th>
                        <th>Jumlah Jawaban</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php 
                        foreach ($pertanyaan as $data) : 
                        $enkripsi = enkripsi($data['idpertanyaan']);
                        $iddata = $data['idpertanyaan'];
                        $jum = jumlah_data("SELECT * FROM jawaban WHERE idpertanyaan = $iddata");
                        $model = jumlah_data("SELECT * FROM model");
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $data['pertanyaan']; ?></td>
                        <td><?= $data['kode']; ?></td>
                        <td><?= $jum; ?> dari <?= $model; ?> Jawaban</td>
                        <td>
                            <?php
                                if($jum > 0) : 
                                    if($jum < $model) : 
                            ?>
                                <form action="create.php" method="post" class="d-inline">
                                    <input type="hidden" name="idpertanyaan" value="<?= $data['idpertanyaan']; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Pilih</button>
                                </form>
                            <?php 
                                    endif;
                                endif; 
                            ?>
                            <a href="edit_pertanyaan.php?id=<?= $enkripsi; ?>" class="btn btn-success btn-sm">Edit</a>
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
                    <?php 
                        $k = 1;
                        foreach ($jawaban as $j) :
                        $enkripsi_jawaban = enkripsi($j['idjawaban']);
                     ?>
                        <tr>
                            <td><?= $k; ?></td>
                            <?php
                                $idpertanyaan =  $j['idpertanyaan'];
                                $nama = query("SELECT kode FROM pertanyaan WHERE idpertanyaan = $idpertanyaan") [0];
                            ?>
                            <td><?= $nama['kode']; ?></td>
                            <td><?= $j['jawaban']; ?></td>
                            <td><?= $j['kode']; ?></td>
                            <td><?= $j['bobot']; ?></td>
                            <td>
                                <a href="edit_jawaban.php?id=<?= $enkripsi_jawaban; ?>" class="btn btn-success btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" id="deleteJawaban" onclick="deleteJawaban(<?= $j['idjawaban']; ?>)">Hapus</button>
                            </td>
                        </tr>
                    <?php 
                        $k++;
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
        $(document).ready(function () {
            $('#example2').DataTable();
        });

        function deletePertanyaan(id) {
            // Menampilkan Sweet Alert dengan tombol Yes dan No
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data? Seluruh data yang terkait dengan data ini (jawaban) akan ikut terhapus',
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

        function deleteJawaban(id) {
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
                        url: '../controller/jawabanController.php',
                        type: 'POST',
                        data: {
                        action: 'delete',
                        id: id
                    },
                    success: function(response) {
                        // Menampilkan pesan sukses jika data berhasil dihapus 
                        Swal.fire({
                            icon : 'success',
                            title: 'Data Jawaban Berhasil Dihapus!',
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