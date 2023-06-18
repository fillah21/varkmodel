<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Gaya Belajar Dengan VARK Model</title>
    <link href="style.css" rel="stylesheet">
    <link href="bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-icons-1.10.3/bootstrap-icons.css">
</head>
<body>
    <?php 
      require_once ('navbar.php');
    ?>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-sm ">
          <h1 class="fw-bold">Tes Gaya Belajar Dengan VARK Model</h1>
          <p class="lead" style="font-size: 24px;">Cek gaya belajar yang cocok untukmu, agar mendapatkan metode belajar yang terbaik menurut VARK Model</p>
          <a href="tes.php" class="btn btn-primary btn-lg px-4 py-2">Mulai Tes</a>
        </div>
      </div>
    </section>

    <div class="container-fluid py-5" style="background-color: #5075cc;">
        <div class="container">
            <div class="row text-center">
                <div class="col text-white">
                    <h1 style="font-weight: 300;" class="mb-5">Apa Itu VARK Model?</h1>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-5 mt-3">
                    <p class="fs-4 text-white" style="text-align: justify;">VARK Model merupakan cara identifikasi empat gaya belajar utama yaitu:</p>
                    <ul class="text-white" style="font-size: 24px;">
                      <li>
                        <p style="text-align: justify;">Visual memiliki preferensi pada grafis, tabel, bagan sebagai representasi verbal daripada banyak kata</p>
                      </li>

                      <li>
                        <p style="text-align: justify;">Auditory ditandai dengan preferensi untuk mendengar informasi dalam bentuk, rekaman audio, percakapan atau bertukar pendapat</p>
                      </li>

                      <li>
                        <p style="text-align: justify;">Read/Write mencirikan orang yang lebih menyukai informasi dalam bentuk tertulis (buku, artikel) dan mereka menggunakan catatan dalam berbagai bentuk</p>
                      </li>

                      <li>
                        <p style="text-align: justify;">Kinesthetic lebih menyukai contoh materi yang diajarkan untuk melihat hubungan dengan contoh nyata dan memiliki kecenderungan untuk bereksperimen</p>
                      </li>
                    </ul>
                </div>

                <div class="col-md mt-3">
                  <img class="img-fluid" src="img/visual2.png" alt="" width="900">
                </div>
            </div>
            
        </div>
    </div>

    <script src="bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>