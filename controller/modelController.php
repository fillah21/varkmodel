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
        $model = $data['model'];
        $kode = $data['kode'];
        $deskripsi = $data['deskripsi'];

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
        
    }
?>