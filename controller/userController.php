<?php 
    require_once 'mainController.php';

    function register($data) {
        global $conn;

        $username = strtolower(stripslashes ($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $nama = htmlspecialchars($data['nama']);
        $instansi = htmlspecialchars($data['instansi']);
        $email = htmlspecialchars($data['email']);
        $role = "User";

        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'") or die(mysqli_error($conn));
        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Username sudah digunakan, silahkan pakai username lain',
                        'error'
                    )
                </script>";
            exit();
        }

        if($password !== $password2) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Password tidak sesuai',
                        'error'
                    )
                </script>";
            exit();
        }
        
        
        //enskripsi password
        $password = password_hash($password2, PASSWORD_DEFAULT);
        
        //jika password sama, masukkan data ke database
        mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password', '$nama', '$instansi', '$email', '$role')");
        return mysqli_affected_rows($conn);
    }
?>