<?php
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


    // Contoh penggunaan
    $string = "Hello, world!";
    $encrypted = enkripsi($string);
    $decrypted = dekripsi($encrypted);

    echo "String Asli: " . $string . "\n <br>";
    echo "String Terenkripsi: " . $encrypted . "\n <br>";
    echo "String Terdekripsi: " . $decrypted . "\n";
?>
