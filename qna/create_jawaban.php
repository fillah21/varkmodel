<!doctype html>
<?php
    require_once '../controller/pertanyaanController.php'; 
    $idpertanyaan = $_POST['pertanyaan'];

    $pertanyaan = query("SELECT * FROM pertanyaan WHERE idpertanyaan = $idpertanyaan") [0];

    $jumlah_string = strlen($pertanyaan['kode']);

    if($jumlah_string == 2) {
        $kode = substr($pertanyaan['kode'], 1);
    } else {
        $kode = substr($pertanyaan['kode'], 1, 2);
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
  </head>

  <body class="font-style">
    <?php 
      require_once ('../layout/navbar.php');
    ?>

    <!-- Bagian Content -->
    <div class="container mt-3">
        <h3><i class="bi bi-bar-chart-steps"></i> Tambah Data Jawaban</h3><hr>

        <form action="../enkripsi.php" method="post">
            <input type="hidden" name="idpertanyaan[]" value="<?= $idpertanyaan; ?>">
            <input type="hidden" name="idpertanyaan[]" value="<?= $idpertanyaan; ?>">
            <input type="hidden" name="idpertanyaan[]" value="<?= $idpertanyaan; ?>">
            <input type="hidden" name="idpertanyaan[]" value="<?= $idpertanyaan; ?>">

            <div class="row">
                <div class="col-md me-5">
                    <h4 class="mt-4 bg-primary-subtle p-1">Visual</h4>
                    <div class="mb-3 row">
                        <label for="kode_pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
            
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= $pertanyaan['pertanyaan']; ?>" aria-label="Disabled input example" readonly>
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
                            <input class="form-control" type="text" value="V<?= $kode; ?>" aria-label="Disabled input example" readonly name="kode[]">
                        </div>
                    </div>
            
                    <div class="mb-3 row">
                        <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
            
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="bobot" value="" name="bobot[]">
                        </div>
                    </div>
            
                    <h4 class="mt-5 p-1 bg-primary-subtle">Auditory</h4>
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
                            <input class="form-control" type="text" value="A<?= $kode; ?>" aria-label="Disabled input example" readonly name="kode[]">
                        </div>
                    </div>
            
                    <div class="mb-3 row">
                        <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
            
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="bobot" value="" name="bobot">
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <h4 class="mt-4 p-1 bg-primary-subtle">Read/Write</h4>
                    <div class="mb-3 row">
                        <label for="kode_pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
            
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= $pertanyaan['pertanyaan']; ?>" aria-label="Disabled input example" disabled readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
            
                        <div class="col-sm-10">
                            <textarea class="form-control" id="jawaban" name="jawaban" rows="10"></textarea>
                        </div>
                    </div>
            
            

                    <div class="mb-3 row">
                        <label for="kode" class="col-sm-2 col-form-label">Kode</label>
            
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="R<?= $kode; ?>" aria-label="Disabled input example" disabled readonly>
                        </div>
                    </div>
            
                    <div class="mb-3 row">
                        <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
            
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="bobot" value="" name="bobot">
                        </div>
                    </div>
            
                    <h4 class="mt-5 p-1 bg-primary-subtle">Kinesthetic</h4>
                    <div class="mb-3 row">
                        <label for="kode_pertanyaan" class="col-sm-2 col-form-label">Pertanyaan</label>
            
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?= $pertanyaan['pertanyaan']; ?>" aria-label="Disabled input example" disabled readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jawaban" class="col-sm-2 col-form-label">Jawaban</label>
            
                        <div class="col-sm-10">
                            <textarea class="form-control" id="jawaban" name="jawaban" rows="10"></textarea>
                        </div>
                    </div>
            
            

                    <div class="mb-3 row">
                        <label for="kode" class="col-sm-2 col-form-label">Kode</label>
            
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="K<?= $kode; ?>" aria-label="Disabled input example" disabled readonly>
                        </div>
                    </div>
            
                    <div class="mb-3 row">
                        <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
            
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="bobot" value="" name="bobot">
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <button type="submit" class="btn btn-primary me-1">Tambah Data</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bagian Content Selesai -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>