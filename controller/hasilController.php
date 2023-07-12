<?php 
    require_once 'mainController.php';

    function jumlah_pertanyaan() {
      $jumlah_model = jumlah_data("SELECT * FROM model");
    
      $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'P%'");

      return $jumlah_pertanyaan;
    }


    function hitung($data) {
      global $conn;
      $jumlah_pertanyaan = jumlah_pertanyaan();
      $model = query("SELECT * FROM model");
      $jumlah_model = jumlah_data("SELECT * FROM model");
      $pertanyaan = query("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'P%'");

      foreach ($pertanyaan as $per) {
        $angka_per = preg_replace('/\D/', '', $per['kode']);
        $id_pertanyaan = $per['idpertanyaan'];

        $angka_pertanyaan[] = $angka_per;
        $idpertanyaan[] = $id_pertanyaan;
      }

      foreach($model as $m) {
        $kodeModel = $m['kode'];
    
        $huruf_model = substr($kodeModel, 0, 1);
        $kode_model[] = $huruf_model;
      }

      // Bagian Forward Chaining
      foreach($angka_pertanyaan as $ap) {
        $inputName = 'P' . $ap;

        foreach($kode_model as $q) {
          ${$q . $ap} = 0;
        }

        if (isset($data[$inputName])) {
          $inputValue = $data[$inputName];

          $data_jawaban = query("SELECT * FROM jawaban WHERE kode = '$inputValue'")[0];
          $first_code = substr($data_jawaban['kode'],0, 1);

          foreach($kode_model as $mod) {
            if($first_code == $mod) {
              ${$mod . $ap} = $data_jawaban['bobot'];
            }

            echo "Bobot dari " . $mod . $ap ." adalah " . ${$mod . $ap} . "<br>";
          }

          echo "Dari pertanyaan " . $inputName . " jawabannya " . $inputValue . " dan bobotnya " . $data_jawaban['bobot'] . "<br><br>";
        }
      }

      foreach($kode_model as $mo) {
        foreach ($angka_pertanyaan as $angper) {
          ${"cf_user_" . $mo}[] = ${$mo . $angper};
        }
      }

      // Forward Chaining Selesai

      // Bagian Certainty Factor
        // Ambil seluruh CF Pakar dari setiap model belajar
          foreach($kode_model as $km) {
            foreach ($idpertanyaan as $ip) {
              $sqlJawaban = query("SELECT * FROM jawaban WHERE kode LIKE '$km%' AND idpertanyaan = $ip") [0];
              ${"cf_pakar_" . $km}[] = $sqlJawaban['bobot'];
            }
          }
        // Ambil CF Pakar Selesai
        

        // Hitung CF HE dari setiap model belajar
          foreach($kode_model as $md) {
            for($ko = 0; $ko < count(${"cf_user_" . $md}); $ko++) {
              $angka = $ko + 1;
              ${"cf_he_" . $md . $angka} = ${"cf_user_" . $md}[$ko] * ${"cf_pakar_" . $md}[$ko];

              echo "Hasil CF HE " . $md . $angka . " dari " . ${"cf_user_" . $md}[$ko] . " dikali " . ${"cf_pakar_" . $md}[$ko] . " Adalah " . ${"cf_he_" . $md . $angka} . "<br>";
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

      $iduser = dekripsi($_COOKIE['VRK21ZA']);
      $v = $nilai_terbesar_V;
      $a = $nilai_terbesar_A;
      $r = $nilai_terbesar_R;
      $k = $nilai_terbesar_K;

      $query = "INSERT INTO hasil
                    VALUES
                    (NULL, '$iduser', '$v', '$a', '$r', '$k', CURRENT_TIMESTAMP())";
        
      mysqli_query($conn, $query);

      return mysqli_affected_rows($conn);
    }


    function hitung_ulang($data, $id) {
      global $conn;
      $jumlah_model = jumlah_data("SELECT * FROM model");
    
      $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'T%'");
      
      $model = query("SELECT * FROM model");

      $hasil = query("SELECT * FROM hasil WHERE idhasil = $id") [0];

      foreach($model as $m) {
        $kodeModel = $m['kode'];
    
        $huruf_model = substr($kodeModel, 0, 1);
        $kode_model[] = $huruf_model;
      }

      // Bagian Forward Chaining
      $inputName = 'T99';

      foreach($kode_model as $q) {
        ${$q . 99} = 0;
      }

      if (isset($data[$inputName])) {
        $inputValue = $data[$inputName];

        $data_jawaban = query("SELECT * FROM jawaban WHERE kode = '$inputValue'")[0];
        $first_code = substr($data_jawaban['kode'],0, 1);

        foreach($kode_model as $mod) {
          if($first_code == $mod) {
            ${$mod . 99} = $data_jawaban['bobot'];
          }

          echo "Bobot dari " . $mod . 99 ." adalah " . ${$mod . 99} . "<br>";
        }

        echo "Dari pertanyaan " . $inputName . " jawabannya " . $inputValue . " dan bobotnya " . $data_jawaban['bobot'] . "<br><br>";
      }

      foreach($kode_model as $mo) {
        ${"cf_user_" . $mo}[] = ${$mo . 99};
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
            for($ko = 0; $ko < count(${"cf_user_" . $md}); $ko++) {
              $angka = $ko + 1;
              ${"cf_he_" . $md . $angka} = ${"cf_user_" . $md}[$ko] * ${"cf_pakar_" . $md}[$ko];

              echo "Hasil CF HE " . $md . $angka . " dari " . ${"cf_user_" . $md}[$ko] . " dikali " . ${"cf_pakar_" . $md}[$ko] . " Adalah " . ${"cf_he_" . $md . $angka} . "<br>";
            }
            echo "<br>";
          }
        // Hitung CF HE selesai

        // Hitung CF Combine dari setiap model
        foreach($kode_model as $komo) {
          $huruf_kecil = strtolower($komo);

          ${$komo} = $hasil[$huruf_kecil];
          ${"cf_old_" . $komo . 0} = ${$komo};

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

      // $iduser = dekripsi($_COOKIE['VRK21ZA']);
      // $v = $nilai_terbesar_V;
      // $a = $nilai_terbesar_A;
      // $r = $nilai_terbesar_R;
      // $k = $nilai_terbesar_K;

      // $query = "INSERT INTO hasil
      //               VALUES
      //               (NULL, '$iduser', '$v', '$a', '$r', '$k', CURRENT_TIMESTAMP())";
        
      // mysqli_query($conn, $query);

      // return mysqli_affected_rows($conn);
    }

    function hasil($data) {
      $v = $data['v'];
      $a = $data['a'];
      $r = $data['r'];
      $k = $data['k'];

      if ($v > $a && $v > $r && $v > $k) {
          $hasil = 'Visual';
      } elseif ($a > $v && $a > $r && $a > $k) {
          $hasil = 'Auditory';
      } elseif ($r > $v && $r > $a && $r > $k) {
          $hasil = 'Read/Write';
      } elseif ($k > $v && $k > $a && $k > $r) {
          $hasil = 'Kinesthetic';
      } else {
          $hasil = false;
      }

      return $hasil;
    }
?>