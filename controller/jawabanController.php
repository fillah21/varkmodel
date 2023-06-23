<?php 
    require_once 'mainController.php';

    function kode_jawaban($pertanyaan) {
        // Generate kode otomatis
        $jumlah_string = strlen($pertanyaan['kode']);
    
        if($jumlah_string == 2) {
            $kode = substr($pertanyaan['kode'], 1);
        } else {
            $kode = substr($pertanyaan['kode'], 1, 2);
        }
        // Kode otomatis selesai

        return $kode;
    }

    function create_jawaban($data) {
        global $conn;

        $idpertanyaan = $data['idpertanyaan'];
        $idmodel = $data['idmodel'];
        $jawaban = $data['jawaban'];
        $kode = $data['kode'];
        $bobot = $data['bobot'];

        for ($i = 0; $i < count($jawaban); $i++) {
            $query = "INSERT INTO jawaban
                    VALUES
                    (NULL, '$idpertanyaan[$i]', '$idmodel[$i]', '$jawaban[$i]', '$kode[$i]', '$bobot[$i]')";
            mysqli_query($conn, $query);
        }

        return mysqli_affected_rows($conn);
    }

    function create_single($data) {
        global $conn;
        $pertanyaan = htmlspecialchars($data['pertanyaan']);
        $kode = htmlspecialchars($data['kode']);

        $query = "INSERT INTO pertanyaan
                    VALUES
                    (NULL, '$pertanyaan', '$kode')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update_jawaban($data) {
        global $conn;

        $id = $data['idjawaban'];
        $jawaban = htmlspecialchars($data['jawaban']);
        $bobot = htmlspecialchars($data['bobot']);

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