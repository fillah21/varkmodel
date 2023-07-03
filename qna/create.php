<!doctype html>
<?php
    require_once '../controller/jawabanController.php'; 
    validasi_admin();

    if(isset($_POST['submit'])) {
        if (create_jawaban($_POST) > 0) {
            session_start();
      
            $_SESSION["berhasil"] = "Data Jawaban Berhasil Ditambahkan!";
      
            echo "
                <script>
                  document.location.href='index.php';
                </script>
            ";
          } else {
            session_start();
      
            $_SESSION["gagal"] = "Data Jawaban Gagal Ditambahkan!";
      
            echo "
                <script>
                  document.location.href='index.php';
                </script>
            ";
          }
    } else {
        $idpertanyaan = $_POST['idpertanyaan'];
        $pertanyaan = query("SELECT * FROM pertanyaan WHERE idpertanyaan = $idpertanyaan") [0];
        $kode = kode_jawaban($pertanyaan);

        $jawaban = query("SELECT * FROM jawaban WHERE idpertanyaan = $idpertanyaan");
        foreach($jawaban as $j) {
            $kodeJawaban = $j['kode'];
            $huruf_jawaban = substr($kodeJawaban, 0, 1);
            $kode_jawaban[] = $huruf_jawaban;
        }

        $model = query("SELECT * FROM model");

        foreach($model as $m) {
            $kodeModel = $m['kode'];

            $huruf_model = substr($kodeModel, 0, 1);
            // $kode_model[] = $huruf_model;
            
            if (!in_array($huruf_model, $kode_jawaban)) {
                $use_kode[] = $huruf_model;
            }
        }

        foreach ($use_kode as $u) {
            $search_idmodel = query("SELECT * FROM model WHERE kode = '$u'")[0];

            $idmodel[] = $search_idmodel['idmodel'];
            $nama_model[] = $search_idmodel['model'];
        }
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VARK Test | Tambah Jawaban</title>
    <link href="../style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap-icons-1.10.3/bootstrap-icons.css">
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
            <?php foreach($idmodel as $im) : ?>
                <input type="hidden" name="idmodel[]" value="<?= $im; ?>">
            <?php endforeach; ?>

            <?php
                $i = 0;
                foreach($use_kode as $uk) : 
            ?>
                <input type="hidden" name="idpertanyaan[]" value="<?= $idpertanyaan; ?>">

                <h4 class="mt-4 bg-primary-subtle p-1"><?= $nama_model[$i]; ?></h4>
                <div class="mb-3 row">
                    <label for="kode_pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
                
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="<?= $pertanyaan['pertanyaan']; ?>" aria-label="Disabled input example" readonly disabled>
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
                        <input class="form-control" type="text" value="<?= $uk.$kode; ?>" aria-label="Disabled input example" readonly name="kode[]">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="bobot" value="" name="bobot[]" step="0.01" max="1">
                    </div>
                </div>
            <?php 
                $i++;
                endforeach; 
            ?>

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