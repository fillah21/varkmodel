<?php 
    require_once 'mainController.php';

    function create($data) {
        global $conn;

        $idmodel = $data['model'];
        $kriteria = $data['kriteria'];

        $query = "INSERT INTO kriteria
                    VALUES
                    (NULL, '$idmodel', '$kriteria')";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update($data){ 
        global $conn;

        $id = $data['idkriteria'];
        $idmodel = $data['model'];
        $kriteria = $data['kriteria'];

        $query = "UPDATE kriteria SET 
                idmodel = '$idmodel',
                kriteria = '$kriteria'
            WHERE idkriteria = '$id'
            ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM kriteria WHERE idkriteria = $id");

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