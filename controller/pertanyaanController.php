<?php 
    require_once 'mainController.php';

    function create($data) {
        global $conn;
        $pertanyaan = $data['pertanyaan'];
        $kode = $data['kode'];

        $query = "INSERT INTO pertanyaan
                    VALUES
                    (NULL, '$pertanyaan', '$kode')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update($data) {
        global $conn;
        $id = $data['idpertanyaan'];
        $pertanyaan = $data['pertanyaan'];
        $kode = $data['kode'];

        $query = "UPDATE pertanyaan SET 
                    pertanyaan = '$pertanyaan',
                    kode = '$kode'
                  WHERE idpertanyaan = '$id'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM pertanyaan WHERE idpertanyaan = $id");

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