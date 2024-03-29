<?php 
    require_once 'mainController.php';

    function jumlah_pertanyaan() {
      $jumlah_model = jumlah_data("SELECT * FROM model");
    
      $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'P%' ORDER BY CAST(SUBSTRING(kode, 2) AS UNSIGNED)" );

      return $jumlah_pertanyaan;
    }



    function hitung($data) {
      global $conn;
      $jumlah_pertanyaan = jumlah_pertanyaan();
      $model = query("SELECT * FROM model");
      $jumlah_model = jumlah_data("SELECT * FROM model");
      $pertanyaan = query("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'P%' ORDER BY CAST(SUBSTRING(kode, 2) AS UNSIGNED)");

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
              // ${$mod . $ap} = $data_jawaban['bobot'];
              ${$mod . $ap} = 0.5;
            }

            // echo "Bobot dari " . $mod . $ap ." adalah " . ${$mod . $ap} . "<br>";
          }

          // echo "Dari pertanyaan " . $inputName . " jawabannya " . $inputValue . " dan bobotnya " . $data_jawaban['bobot'] . "<br><br>";
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

              // echo "Hasil CF HE " . $md . $angka . " dari " . ${"cf_user_" . $md}[$ko] . " dikali " . ${"cf_pakar_" . $md}[$ko] . " Adalah " . ${"cf_he_" . $md . $angka} . "<br>";
            }
            // echo "<br>";
          }
        // Hitung CF HE selesai

        // Hitung CF Combine dari setiap model
        foreach($kode_model as $komo) {
          ${"cf_old_" . $komo . 0} = ${"cf_he_" . $komo . 1};

          for($n = 1; $n < $jumlah_pertanyaan; $n++) {
            ${"cf_old_" . $komo . $n} = ${"cf_old_" . $komo . $n - 1} + ${"cf_he_" . $komo . $n + 1} * (1 - ${"cf_old_" . $komo . $n - 1});

            ${"cf_old_" . $komo}[] = number_format(${"cf_old_" . $komo . $n} * 100, 2);
            // echo "Hasil CF OLD ". $komo . $n . " dari perkalian " . ${"cf_old_" . $komo . $n - 1} . " + " . ${"cf_he_" . $komo . $n + 1} . " * (1 - " . ${"cf_old_" . $komo . $n - 1} . ") adalah " . ${"cf_old_" . $komo . $n} . "<br>";
          }
          ${"nilai_terbesar_" . $komo} = ${"cf_old_" . $komo}[0];

          for ($o = 1; $o < count(${"cf_old_" . $komo}); $o++) {
            if (${"cf_old_" . $komo}[$o] > ${"nilai_terbesar_" . $komo}) {
              ${"nilai_terbesar_" . $komo} = ${"cf_old_" . $komo}[$o];
            }
          }
          // echo "Nilai terbesar dari " . $komo . " adalah ". ${"nilai_terbesar_" . $komo} . "%<br><br>";
        }
        // Hitung CF Combine Selesai
      // Certainty Factor Selesai

      $iduser = dekripsi($_COOKIE['VRK21ZA']);

      foreach($kode_model as $koel) {
        $value[] = ${"nilai_terbesar_" . $koel};
      }

      $valuesString = implode(", ", $value);

      $query = "INSERT INTO hasil
                    VALUES
                    (NULL, '$iduser', CURRENT_TIMESTAMP(), ";
      
      $query .= $valuesString . ")";

      mysqli_query($conn, $query);

      return mysqli_affected_rows($conn);
    }



    function hitung_ulang($data, $id) {
      global $conn;
      $jumlah_model = jumlah_data("SELECT * FROM model");
      $jumlah_pertanyaan = jumlah_data("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'T%' ORDER BY CAST(SUBSTRING(kode, 2) AS UNSIGNED)");
      $model = query("SELECT * FROM model");
      $pertanyaan = query("SELECT * FROM pertanyaan WHERE (SELECT COUNT(*) FROM jawaban WHERE jawaban.idpertanyaan = pertanyaan.idpertanyaan) = $jumlah_model AND kode LIKE 'T%' ORDER BY CAST(SUBSTRING(kode, 2) AS UNSIGNED)");
      $hasil = query("SELECT * FROM hasil WHERE idhasil = $id") [0];

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

      foreach($kode_model as $kodel) {
        $kodekecil = strtolower($kodel);
        $kode_kecil[] = strtolower($kodel);


        ${'old' . $kodel} = $hasil[$kodekecil] / 100;
      }

      // Bagian Forward Chaining
      foreach($angka_pertanyaan as $ap) {
        $inputName = 'T' . $ap;

        foreach($kode_model as $q) {
          ${$q . $ap} = 0;
        }

        if (isset($data[$inputName])) {
          $inputValue = $data[$inputName];

          $data_jawaban = query("SELECT * FROM jawaban WHERE kode = '$inputValue'")[0];
          $first_code = substr($data_jawaban['kode'],0, 1);

          foreach($kode_model as $mod) {
            if($first_code == $mod) {
              // ${$mod . $ap} = $data_jawaban['bobot'];
              ${$mod . $ap} = 0.5;
            }

            // echo "Bobot dari " . $mod . $ap ." adalah " . ${$mod . $ap} . "<br>";
          }

          // echo "Dari pertanyaan " . $inputName . " jawabannya " . $inputValue . " dan bobotnya " . $data_jawaban['bobot'] . "<br><br>";
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

              // echo "Hasil CF HE " . $md . $angka . " dari " . ${"cf_user_" . $md}[$ko] . " dikali " . ${"cf_pakar_" . $md}[$ko] . " Adalah " . ${"cf_he_" . $md . $angka} . "<br>";
            }
            // echo "<br>";
          }
        // Hitung CF HE selesai

        // Hitung CF Combine dari setiap model
        foreach($kode_model as $komo) {
          ${"cf_old_" . $komo . 0} = ${"old" . $komo};
          ${"cf_old_" . $komo}[] = ${"old" . $komo} * 100;

          for($n = 0; $n < $jumlah_pertanyaan; $n++) {
            ${"cf_old_" . $komo . $n + 1} = ${"cf_old_" . $komo . $n} + ${"cf_he_" . $komo . $n + 1} * (1 - ${"cf_old_" . $komo . $n});

            ${"cf_old_" . $komo}[] = number_format(${"cf_old_" . $komo . $n + 1} * 100, 2);
            // echo "Hasil CF OLD ". $komo . $n + 1 . " dari perkalian " . ${"cf_old_" . $komo . $n} . " + " . ${"cf_he_" . $komo . $n + 1} . " * (1 - " . ${"cf_old_" . $komo . $n} . ") adalah " . ${"cf_old_" . $komo . $n + 1} . "<br>";
          }

          ${"nilai_terbesar_" . $komo} = ${"cf_old_" . $komo}[0];

          for ($o = 1; $o < count(${"cf_old_" . $komo}); $o++) {
            if (${"cf_old_" . $komo}[$o] > ${"nilai_terbesar_" . $komo}) {
              ${"nilai_terbesar_" . $komo} = ${"cf_old_" . $komo}[$o];
            }
          }
          // echo "Nilai terbesar dari " . $komo . " adalah ". ${"nilai_terbesar_" . $komo} . "%<br><br>";
        }
        // Hitung CF Combine Selesai
      // Certainty Factor Selesai

      foreach($kode_model as $koel) {
        $value[] = ${"nilai_terbesar_" . $koel};
      }

      for($i = 0; $i < count($value); $i++) {
        $query_hasil[] = $kode_kecil[$i] . " = " . $value[$i];
      }

      $valuesString = implode(", ", $query_hasil);

      $query = "UPDATE hasil SET ";

      $query .= $valuesString . " WHERE idhasil = '$id'";
      
      mysqli_query($conn, $query);

      return mysqli_affected_rows($conn);
    }



    function hasil($data) {
      $model = query("SELECT * FROM model");

      foreach ($model as $m) {
        $kode_model[] = $m['kode'];
        $nama_model[] = $m['model'];
      }

      foreach ($kode_model as $km) {
        $hasil_tes[] = $data[strtolower($km)];
      }

      $nilai_terbesar = $hasil_tes[0]; 
      $jumlah_terbesar = 1; 

      for ($i = 1; $i < count($hasil_tes); $i++) {
        if ($hasil_tes[$i] > $nilai_terbesar) {
            $nilai_terbesar = $hasil_tes[$i];
            $jumlah_terbesar = 1;
        } elseif ($hasil_tes[$i] === $nilai_terbesar) {
            $jumlah_terbesar++;
        }
      }

      for ($j=0; $j < count($hasil_tes); $j++) { 
        if($jumlah_terbesar == 1) {
          if ($hasil_tes[$j] === $nilai_terbesar) {
            $hasil = $nama_model[$j];
          }
        } else {
          $hasil = false;
        }
      }

      return $hasil;
    }



    function cek_null($data){
      global $conn;
      $model = query("SELECT * FROM model");
      $idhasil = $data['idhasil'];

      foreach ($model as $m) {
        $kode_model[] = $m['kode'];
        $nama_model[] = $m['model'];
      }

      foreach ($kode_model as $km) {
        $kode_kecil[] = strtolower($km);
      }

      foreach ($kode_kecil as $kokel) {
        if ($data[$kokel] === NULL) {
          $query = "UPDATE hasil SET 
                    $kokel = 0
                  WHERE idhasil = '$idhasil'
                ";
        mysqli_query($conn, $query);
        }
      }
    }
?>