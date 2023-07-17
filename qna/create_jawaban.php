<!doctype html>
<?php
    require_once '../controller/jawabanController.php';
    session_start(); 
    validasi_admin();
        $idpertanyaan = $_POST['pertanyaan'];
        
        $pertanyaan = query("SELECT * FROM pertanyaan WHERE idpertanyaan = $idpertanyaan") [0];
    
        $kode = kode_jawaban($pertanyaan);
    
        // Ambil data dari model dan dibagi 2
        $jumlah_model = jumlah_data("SELECT * FROM model");
    
        $jumlah_model2 = ceil($jumlah_model / 2);
        $jumlah_model3 = $jumlah_model - $jumlah_model2;
    
        $model1 = query("SELECT * FROM model LIMIT $jumlah_model2");
        $model2 = query("SELECT * FROM model LIMIT $jumlah_model3 OFFSET $jumlah_model2");
    
    
  
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Tambah Jawaban</title>
    <link href="../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="Icon" href="../img/Logo.png">
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3><i class="bi bi-bar-chart-steps"></i> Tambah Data Jawaban</h3><hr>

        <form action="" method="post">
            <input type="hidden" name="pertanyaan" value="<?= $idpertanyaan; ?>">
            <div class="row">
                <div class="col-lg me-5">
                    <?php foreach($model1 as $m1) : ?>
                        <input type="hidden" name="idpertanyaan[]" value="<?= $idpertanyaan; ?>">
                        <input type="hidden" name="idmodel[]" value="<?= $m1['idmodel']; ?>">

                        <h4 class="mt-4 bg-primary-subtle p-1"><?= $m1['model']; ?></h4>
                        <div class="mb-3 row">
                            <label for="kode_pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
                
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="<?= $pertanyaan['pertanyaan']; ?>" aria-label="Disabled input example" disabled readonly>
                            </div>
                        </div>
    
                        <div class="mb-3 row">
                            <label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
                
                            <div class="col-sm-10">
                                <textarea class="form-control" id="jawaban" name="jawaban[]" rows="10"></textarea>
                            </div>
                        </div>
                
                
    
                        <div class="mb-3 row">
                            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="<?= $m1['kode'].$kode; ?>" aria-label="Disabled input example" readonly name="kode[]">
                            </div>
                        </div>
                
                        <div class="mb-3 row">
                            <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="bobot" value="" name="bobot[]" step="0.01" max="1">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-lg">
                    <?php foreach($model2 as $m2) : ?>
                        <input type="hidden" name="idpertanyaan[]" value="<?= $idpertanyaan; ?>">
                        <input type="hidden" name="idmodel[]" value="<?= $m2['idmodel']; ?>">

                        <h4 class="mt-4 bg-primary-subtle p-1"><?= $m2['model']; ?></h4>
                        <div class="mb-3 row">
                            <label for="kode_pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
                
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="<?= $pertanyaan['pertanyaan']; ?>" aria-label="Disabled input example" disabled readonly>
                            </div>
                        </div>
    
                        <div class="mb-3 row">
                            <label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
                
                            <div class="col-sm-10">
                                <textarea class="form-control" id="jawaban" name="jawaban[]" rows="10"></textarea>
                            </div>
                        </div>
                
                
    
                        <div class="mb-3 row">
                            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                
                            <div class="col-sm-10">
                                <input class="form-control" type="text" value="<?= $m2['kode'].$kode; ?>" aria-label="Disabled input example" readonly name="kode[]">
                            </div>
                        </div>
                
                        <div class="mb-3 row">
                            <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="bobot" value="" name="bobot[]" step="0.01" max="1">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="my-4">
                <button type="submit" class="btn btn-primary me-1" name="submit">Tambah Data</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
    if(isset($_POST['submit'])) {
        if (create_jawaban($_POST) > 0) {
            $_SESSION["berhasil"] = "Data Jawaban Berhasil Ditambahkan!";
      
            echo "
                <script>
                  document.location.href='index.php';
                </script>
            ";
          } else {
            $_SESSION["gagal"] = "Data Jawaban Gagal Ditambahkan!";
      
            echo "
                <script>
                  document.location.href='index.php';
                </script>
            ";
          }
    }
?>