<?php 
    require_once 'mainController.php';

    function jumlah_pertanyaan() {
      $jumlah_model = jumlah_data("SELECT * FROM model");
    
      $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model");

      return $jumlah_pertanyaan;
    }

    function hitung($data) {
      $jumlah_pertanyaan = jumlah_pertanyaan();

      // Bagian Forward Chaining
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

          $cf_user_v[] = ${"v" . $i};
          $cf_user_a[] = ${"a" . $i};
          $cf_user_r[] = ${"r" . $i};
          $cf_user_k[] = ${"k" . $i};

          echo "Bobot dari v" . $i ."adalah " . ${"v" . $i} . "<br>";
          echo "Bobot dari a" . $i ."adalah " . ${"a" . $i} . "<br>";
          echo "Bobot dari r" . $i ."adalah " . ${"r" . $i} . "<br>";
          echo "Bobot dari k" . $i ."adalah " . ${"k" . $i} . "<br>";
          echo "Dari pertanyaan " . $inputName . " jawabannya " . $inputValue . " dan bobotnya " . $data_jawaban['bobot'] . "<br><br>";

        }
      }
      // Forward Chaining Selesai

      // Bagian Certainty Factor
        // Ambil seluruh CF Pakar dari setiap model belajar
          $model = query("SELECT * FROM model");
          foreach($model as $m) {
            $kodeModel = $m['kode'];
    
            $huruf_model = substr($kodeModel, 0, 1);
            $kode_model[] = $huruf_model;
          }

          foreach($kode_model as $km) {
            $sqlJawaban = query("SELECT * FROM jawaban WHERE kode LIKE '$km%' ORDER BY kode ASC");
            $jumlahSql = jumlah_data("SELECT * FROM jawaban WHERE kode LIKE '$km%' ORDER BY kode ASC");

            for ($j = 0; $j < $jumlahSql; $j++) {
              ${"cf_pakar_" . $km}[] = $sqlJawaban[$j]["bobot"];
            }
          }
        // Ambil CF Pakar Selesai

      

      

      // Certainty Factor Selesai
    }

    // function certainty_factor($data) {

    // }
?>