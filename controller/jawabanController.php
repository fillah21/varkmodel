<?php 
    require_once 'mainController.php';

    function kode_jawaban($pertanyaan) {
        $kodper = $pertanyaan['kode'];
        
        preg_match('/\d+/', $kodper, $matches);
        
        $kode = $matches[0];

        return $kode;
    }

    function create_jawaban($data) {
        global $conn;

        $idpertanyaan = $data['idpertanyaan'];
        $idmodel = $data['idmodel'];
        $jawaban = $data['jawaban'];
        $kode = $data['kode'];
        $bobot = $data['bobot'];

        for($j = 0; $j < count($bobot); $j++) {
            if($jawaban[$j] == "") {
                echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Jawaban tidak boleh kosong',
                        'error'
                    )
                  </script>";
                exit();
            } elseif($bobot[$j] == "") {
                echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Bobot tidak boleh kosong',
                        'error'
                    )
                  </script>";
                exit();
            } elseif($bobot[$j] == 0) {
                echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Bobot tidak boleh bernilai 0',
                        'error'
                    )
                  </script>";
                exit();
            }
        }

        for ($i = 0; $i < count($jawaban); $i++) {
            $query = "INSERT INTO jawaban
                    VALUES
                    (NULL, '$idpertanyaan[$i]', '$idmodel[$i]', '$jawaban[$i]', '$kode[$i]', '$bobot[$i]')";
            mysqli_query($conn, $query);
        }

        return mysqli_affected_rows($conn);
    }


    function update_jawaban($data) {
        global $conn;

        $id = $data['idjawaban'];
        $jawaban = htmlspecialchars($data['jawaban']);
        $bobot = htmlspecialchars($data['bobot']);

        if($jawaban == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Jawaban tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } elseif($bobot == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Bobot tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } elseif($bobot == 0) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Bobot tidak boleh bernilai 0',
                        'error'
                    )
                  </script>";
            exit();
        }

        $query = "UPDATE jawaban SET 
                jawaban = '$jawaban',
                bobot = '$bobot'
            WHERE idjawaban = '$id'
            ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM jawaban WHERE idjawaban = $id");

        $deleted = true;

        return $deleted;
    }

    // Mengecek apakah ada permintaan penghapusan data
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Mengambil nilai parameter id dari data POST
        $id = $_POST['id'];

        // Memanggil fungsi delete untuk menghapus data
        $status = delete($id);

        // Mengirimkan respons ke JavaScript
        if ($status) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
?>