<?php 
    require_once 'mainController.php';

    function kode() {
        global $conn;

        $query = "SELECT * FROM pertanyaan";
        $kode = "";

        $hasil = mysqli_query($conn, $query);
        $jumlah = jumlah_data($query);

        if($jumlah == 0) {
            $kode = "P1";
        } else {
            for($i = 1; $i <= $jumlah; $i++) { 
                $query1 = "SELECT COUNT(*) as total FROM pertanyaan WHERE kode = 'P{$i}'";
                $result = mysqli_query($conn, $query1);
                $row = mysqli_fetch_assoc($result);
                $totalP = $row['total'];

                if ($totalP == 0) {
                    $kode = "P{$i}";
                    break;
                } else {
                    $angka = $jumlah + 1;
                    $kode = "P{$angka}";
                }
            };
        }

        return $kode;
    }

    function create($data) {
        global $conn;
        $pertanyaan = htmlspecialchars($data['pertanyaan']);
        $kode = htmlspecialchars($data['kode']);

        $query = "INSERT INTO pertanyaan
                    VALUES
                    (NULL, '$pertanyaan', '$kode')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function update($data) {
        global $conn;
        $id = $data['idpertanyaan'];
        $pertanyaan = htmlspecialchars($data['pertanyaan']);
        $kode = htmlspecialchars($data['kode']);

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