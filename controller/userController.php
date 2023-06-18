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
     
    function register_admin($data) {
        global $conn;

        $username = strtolower(stripslashes ($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $nama = htmlspecialchars($data['nama']);
        $instansi = htmlspecialchars($data['instansi']);
        $email = htmlspecialchars($data['email']);
        $role = "Admin";

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

    function login($data) {
        global $conn;

        $username = $data["username"];
        $password = $data["password"];

        //cek username apakah ada di database atau tidak
        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        if (mysqli_num_rows($result) === 1) {
            //cek password
            $row = mysqli_fetch_assoc($result);
            //password_verify() untuk mengecek apakah sebuah password itu sama atau tidak dengan hash nya
            //parameternya yaitu string yang belum diacak dan string yang sudah diacak
            if (password_verify($password, $row["pwd"])) {
                $enkripsi = enkripsi($row['iduser']);

                setcookie('VRK21ZA', $enkripsi, time() + 10800);
                echo "<script>
                        document.location.href='index.php';
                    </script>";
                exit;
            }
        }

        $error = true;

        return $error;
    }
     
    function update($data) {
        global $conn;

        $iduser = $data['iduser'];
        $oldpassword = $data['oldpassword'];
        $oldusername = $data['oldusername'];
        $username = strtolower(stripslashes ($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $nama = htmlspecialchars($data['nama']);
        $instansi = htmlspecialchars($data['instansi']);
        $email = htmlspecialchars($data['email']);

        if(isset($data['oldrole'])) {
            $role = $data['oldrole'];
        } else {
            $role = $data['role'];
        }

        
        if($username !== $oldusername) {
            $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

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
        }

        if($password !== $oldpassword) {
            if ($password !== $password2) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Password tidak sesuai',
                            'error'
                        )
                      </script>";
                exit();
            }

            $password = password_hash($password2, PASSWORD_DEFAULT);
        }

        $query = "UPDATE user SET 
                    username = '$username',
                    pwd = '$password',
                    nama = '$nama',
                    instansi = '$instansi',
                    email = '$email',
                    role = '$role'
                  WHERE iduser = '$iduser'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM user WHERE iduser = $id");

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