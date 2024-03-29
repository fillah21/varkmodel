<?php 
    //koneksi ke database mysql, isi parameter sesuai web server masing-masing
    $conn = mysqli_connect("localhost","root","","vark");

    //cek jika koneksi ke mysql gagal, maka akan tampil pesan error
    if (mysqli_connect_errno()){
        echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
    }

    // Fungsi query fetch
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    // Fungsi query fetch selesai

    function jumlah_data($data) {
        global $conn;
        $query = mysqli_query($conn, $data);

        $jumlah_data = mysqli_num_rows($query);

        return $jumlah_data;
    }

    function generateRandomKey()
    {
        $keyLength = 32;
        $randomBytes = openssl_random_pseudo_bytes($keyLength, $strong);
        
        if (!$strong) {
            // Jika openssl_random_pseudo_bytes() tidak menghasilkan kunci yang kuat, Anda bisa menggunakan alternatif lain.
            $randomBytes = random_bytes($keyLength);
        }
        
        return base64_encode($randomBytes);
    }

    function enkripsi($kata)
    {
        $key = generateRandomKey();
        $string = openssl_encrypt($kata, 'AES-256-CBC', $key, 0, substr($key, 0, 16));
        $hasilEnkripsi = base64_encode($key . $string);
        
        return $hasilEnkripsi;
    }

    function dekripsi($kata)
    {
        $string = base64_decode($kata);
        $key = substr($string, 0, 44); // Panjang kunci enkripsi adalah 44 (dalam base64)
        $enkripsi = substr($string, 44);
        $hasil = openssl_decrypt($enkripsi, 'AES-256-CBC', $key, 0, substr($key, 0, 16));
        
        return $hasil;
    }

    function validasi() {
        global $conn;
        if (!isset($_COOKIE['VRK21ZA'])) {
            echo "<script>
                    document.location.href='logout.php';
                  </script>";
            exit;
        }
        
        $id = dekripsi($_COOKIE['VRK21ZA']);
        
        $result = mysqli_query($conn, "SELECT * FROM user WHERE iduser = '$id'");
        
        if (mysqli_num_rows($result) !== 1) {
            echo "<script>
                    document.location.href='logout.php';
                  </script>";
            exit;
        }
    }

    function validasi_admin() {
        global $conn;
        if (!isset($_COOKIE['VRK21ZA'])) {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }
        
        $id = dekripsi($_COOKIE['VRK21ZA']);

        $cek = query("SELECT * FROM user WHERE iduser = $id") [0];
        
        $result = mysqli_query($conn, "SELECT * FROM user WHERE iduser = '$id'");
    
        if (mysqli_num_rows($result) !== 1) {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        } elseif($cek['role'] !== "Admin") {
            echo "<script>
                    document.location.href='../logout.php';
                  </script>";
            exit;
        }
    }
?>