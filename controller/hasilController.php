<?php 
    require_once 'mainController.php';

    function jumlah_pertanyaan() {
      $jumlah_model = jumlah_data("SELECT * FROM model");
    
      $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model");

      return $jumlah_pertanyaan;
    }

    function forward_chaining($data) {
      global $conn;
      $jumlah_pertanyaan = jumlah_pertanyaan();

      for ($i = 1; $i <= $jumlah_pertanyaan; $i++) {
        $inputName = 'P' . $i;

        if (isset($data[$inputName])) {
          $inputValue = $data[$inputName];

          $data_jawaban = query("SELECT * FROM jawaban WHERE kode = '$inputValue'")[0];
          $first_code = substr($data_jawaban['kode'],0, 1);

          if($first_code == "V") {
            ${"v" . $i} = $data_jawaban['bobot'];
            ${"a" . $i} = 0;
            ${"r" . $i} = 0;
            ${"k" . $i} = 0;
          } elseif($first_code == "A") {
            ${"v" . $i} = 0;
            ${"a" . $i} = $data_jawaban['bobot'];
            ${"r" . $i} = 0;
            ${"k" . $i} = 0;
          } elseif($first_code == "R") {
            ${"v" . $i} = 0;
            ${"a" . $i} = 0;
            ${"r" . $i} = $data_jawaban['bobot'];
            ${"k" . $i} = 0;
          } elseif($first_code == "K") {
            ${"v" . $i} = 0;
            ${"a" . $i} = 0;
            ${"r" . $i} = 0;
            ${"k" . $i} = $data_jawaban['bobot'];
          }

          echo "Bobot dari v" . $i ."adalah " . ${"v" . $i} . "<br>";
          echo "Bobot dari a" . $i ."adalah " . ${"a" . $i} . "<br>";
          echo "Bobot dari r" . $i ."adalah " . ${"r" . $i} . "<br>";
          echo "Bobot dari k" . $i ."adalah " . ${"k" . $i} . "<br>";
          echo "Dari pertanyaan " . $inputName . " jawabannya " . $inputValue . " dan bobotnya " . $data_jawaban['bobot'] . "<br><br>";

          // $result = mysqli_query($conn, $sql);

          // if (mysqli_num_rows($result) > 0) {
          //     $row = mysqli_fetch_assoc($result);
          //     $bobot = $row['bobot'];
          //     $totalBobot += $bobot;
          //     echo "Nilai dari $inputName: $inputValue<br>";
          //     echo "Bobot untuk $inputName: $bobot<br>";
          // }
        }
      }
    }
?>