<?php 
    require_once 'mainController.php';

    function create($data) {
        global $conn;

        $idpertanyaan = $data['idpertanyaan'];
        $jawaban = $data['jawaban'];
        $kode = $data['kode'];
        $bobot = $data['bobot'];

        for ($i = 0; $i < count($jawaban); $i++) {
            // echo "Data ke-$i <br>" ;
            // var_dump($idpertanyaan[$i]);
            // var_dump($jawaban[$i]);
            // var_dump($kode[$i]);
            // var_dump($bobot[$i]);

            $query = "INSERT INTO jawaban
                    VALUES
                    (NULL, '$idpertanyaan[$i]', '$jawaban[$i]', '$kode[$i]', '$bobot[$i]')";
            mysqli_query($conn, $query);
        }

        return mysqli_affected_rows($conn);
    }
?>