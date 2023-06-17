<?php 
    require_once 'mainController.php';

    function create($data) {
        global $conn;
        $model = htmlspecialchars($data['model']);
        $kode = htmlspecialchars($data['kode']);
        $deskripsi = htmlspecialchars($data['deskripsi']);

        $query = "INSERT INTO model
                    VALUES 
                    (NULL, '$model', '$kode', '$deskripsi')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update($data) {
        global $conn;

        $idmodel = $data['idmodel'];
        $model = htmlspecialchars($data['model']);
        $kode = htmlspecialchars($data['kode']);
        $deskripsi = htmlspecialchars($data['deskripsi']);

        $query = "UPDATE model SET 
                    model = '$model',
                    kode = '$kode',
                    deskripsi = '$deskripsi'
                  WHERE idmodel = '$idmodel'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM model WHERE idmodel = $id");

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