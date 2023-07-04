<?php 
    require_once 'mainController.php';

    function jumlah_pertanyaan() {
      $jumlah_model = jumlah_data("SELECT * FROM model");
    
      $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model");

      return $jumlah_pertanyaan;
    }

    function hitung($data) {
      $jumlah_pertanyaan = jumlah_pertanyaan();
      $model = query("SELECT * FROM model");

      foreach($model as $m) {
        $kodeModel = $m['kode'];
    
        $huruf_model = substr($kodeModel, 0, 1);
        $kode_model[] = $huruf_model;
      }

      // Bagian Forward Chaining
      for ($i = 1; $i <= $jumlah_pertanyaan; $i++) {
        $inputName = 'P' . $i;

        foreach($kode_model as $q) {
          ${$q . $i} = 0;
        }

        if (isset($data[$inputName])) {
          $inputValue = $data[$inputName];

          $data_jawaban = query("SELECT * FROM jawaban WHERE kode = '$inputValue'")[0];
          $first_code = substr($data_jawaban['kode'],0, 1);

          foreach($kode_model as $mod) {
            if($first_code == $mod) {
              ${$mod . $i} = $data_jawaban['bobot'];
            }

            echo "Bobot dari " . $mod . $i ." adalah " . ${$mod . $i} . "<br>";
          }

          echo "Dari pertanyaan " . $inputName . " jawabannya " . $inputValue . " dan bobotnya " . $data_jawaban['bobot'] . "<br><br>";
        }
      }

      foreach($kode_model as $mo) {
        for ($l = 1; $l <= $jumlah_pertanyaan; $l++) {
          ${"cf_user_" . $mo}[] = ${$mo . $l};
        }
      }

      // Forward Chaining Selesai

      // Bagian Certainty Factor
        // Ambil seluruh CF Pakar dari setiap model belajar
          foreach($kode_model as $km) {
            $sqlJawaban = query("SELECT * FROM jawaban WHERE kode LIKE '$km%' ORDER BY kode ASC");
            $jumlahSql = jumlah_data("SELECT * FROM jawaban WHERE kode LIKE '$km%' ORDER BY kode ASC");

            for ($j = 0; $j < $jumlahSql; $j++) {
              ${"cf_pakar_" . $km}[] = $sqlJawaban[$j]["bobot"];
            }
          }
        // Ambil CF Pakar Selesai
        

        // Hitung CF HE dari setiap model belajar
          foreach($kode_model as $md) {
            for($k = 0; $k < count(${"cf_user_" . $md}); $k++) {
              $angka = $k + 1;
              ${"cf_he_" . $md . $angka} = ${"cf_user_" . $md}[$k] * ${"cf_pakar_" . $md}[$k];

              echo "Hasil CF HE " . $md . $angka . " dari " . ${"cf_user_" . $md}[$k] . " dikali " . ${"cf_pakar_" . $md}[$k] . " Adalah " . ${"cf_he_" . $md . $angka} . "<br>";
            }
            echo "<br>";
          }
        // Hitung CF HE selesai

        // Hitung CF Combine dari setiap model
        foreach($kode_model as $komo) {
          ${"cf_old_" . $komo . 0} = ${"cf_he_" . $komo . 1};

          for($n = 1; $n < $jumlah_pertanyaan; $n++) {
            ${"cf_old_" . $komo . $n} = ${"cf_old_" . $komo . $n - 1} + ${"cf_he_" . $komo . $n + 1} * (1 - ${"cf_old_" . $komo . $n - 1});

            ${"cf_old_" . $komo}[] = ${"cf_old_" . $komo . $n} * 100;
            echo "Hasil CF OLD ". $komo . $n . " dari perkalian " . ${"cf_old_" . $komo . $n - 1} . " + " . ${"cf_he_" . $komo . $n + 1} . " * (1 - " . ${"cf_old_" . $komo . $n - 1} . ") adalah " . ${"cf_old_" . $komo . $n} . "<br>";
          }
          ${"nilai_terbesar_" . $komo} = ${"cf_old_" . $komo}[0];

          for ($o = 1; $o < count(${"cf_old_" . $komo}); $o++) {
            if (${"cf_old_" . $komo}[$o] > ${"nilai_terbesar_" . $komo}) {
              ${"nilai_terbesar_" . $komo} = ${"cf_old_" . $komo}[$o];
            }
          }
          echo "Nilai terbesar dari " . $komo . " adalah ". ${"nilai_terbesar_" . $komo} . "%<br><br>";
        }
        // Hitung CF Combine Selesai

      

      

      // Certainty Factor Selesai
    }

    // function certainty_factor($data) {

    // }
?>