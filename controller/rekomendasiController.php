<?php 
    require_once 'mainController.php';

    function create($data) {
        global $conn;
        $idmodel = htmlspecialchars($data['model']);
        $rekomendasi = htmlspecialchars($data['rekomendasi']);

        if($idmodel == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Model tidak boleh kosong, silahkan pilih model',
                        'error'
                    )
                  </script>";
            exit();
        }

        if($rekomendasi == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Rekomendasi tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        }

        $query = "INSERT INTO rekomendasi
                    VALUES
                    (NULL, '$idmodel', '$rekomendasi')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update($data) {
        global $conn;

        $id = $data['idrekomendasi'];
        $idmodel = htmlspecialchars($data['model']);
        $rekomendasi = htmlspecialchars($data['rekomendasi']);

        if($rekomendasi == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Rekomendasi tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        }

        $query = "UPDATE rekomendasi SET 
                idmodel = '$idmodel',
                rekomendasi = '$rekomendasi'
            WHERE idrekomendasi = '$id'
            ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM rekomendasi WHERE idrekomendasi = $id");

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