<?php 
    require_once 'mainController.php';

    function create($data) {
        global $conn;
        $model = htmlspecialchars($data['model']);
        $kode = htmlspecialchars($data['kode']);
        $deskripsi = htmlspecialchars($data['deskripsi']);

        if($model == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Model tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } else {
            $result = mysqli_query($conn, "SELECT model FROM model WHERE model = '$model'") or die(mysqli_error($conn));
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Model sudah ada, silahkan pakai model lain',
                            'error'
                        )
                    </script>";
                exit();
            }
        }

        if($kode == "") {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Kode tidak boleh kosong',
                        'error'
                    )
                  </script>";
            exit();
        } else {
            $result = mysqli_query($conn, "SELECT kode FROM model WHERE kode = '$kode'") or die(mysqli_error($conn));
            if (mysqli_fetch_assoc($result)) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Kode sudah ada, silahkan pakai kode lain',
                            'error'
                        )
                    </script>";
                exit();
            }
        }

        
        if (strpos($kode, ' ') !== false) {
            echo "<script>
                    Swal.fire(
                        'Gagal!',
                        'Kode tidak boleh mengandung spasi',
                        'error'
                    )
                </script>";
            exit();
        }

        $query = "INSERT INTO model
                    VALUES 
                    (NULL, '$model', '$kode', '$deskripsi')";
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
        
    }



    function create_field($data) {
        global $conn;
        $kode = htmlspecialchars($data['kode']);
        $kode_kecil = strtolower($kode);

        mysqli_query($conn, "ALTER TABLE hasil ADD $kode_kecil DOUBLE");
    }



    function update($data) {
        global $conn;

        $idmodel = $data['idmodel'];
        $oldmodel = $data['oldmodel'];
        $oldkode = $data['oldkode'];
        $model = htmlspecialchars($data['model']);
        $kode = htmlspecialchars($data['kode']);
        $deskripsi = htmlspecialchars($data['deskripsi']);

        if($model != $oldmodel) {
            if($model == "") {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Model tidak boleh kosong',
                            'error'
                        )
                      </script>";
                exit();
            } else {
                $result = mysqli_query($conn, "SELECT model FROM model WHERE model = '$model'") or die(mysqli_error($conn));
                if (mysqli_fetch_assoc($result)) {
                    echo "<script>
                            Swal.fire(
                                'Gagal!',
                                'Model sudah ada, silahkan pakai model lain',
                                'error'
                            )
                        </script>";
                    exit();
                }
            }
        }

        if($kode != $oldkode) {
            if($kode == "") {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Kode tidak boleh kosong',
                            'error'
                        )
                      </script>";
                exit();
            } else {
                $result = mysqli_query($conn, "SELECT kode FROM model WHERE kode = '$kode'") or die(mysqli_error($conn));
                if (mysqli_fetch_assoc($result)) {
                    echo "<script>
                            Swal.fire(
                                'Gagal!',
                                'Kode sudah ada, silahkan pakai kode lain',
                                'error'
                            )
                        </script>";
                    exit();
                }
            }

            if (strpos($kode, ' ') !== false) {
                echo "<script>
                        Swal.fire(
                            'Gagal!',
                            'Kode tidak boleh mengandung spasi',
                            'error'
                        )
                    </script>";
                exit();
            }
        }

        $query = "UPDATE model SET 
                    model = '$model',
                    kode = '$kode',
                    deskripsi = '$deskripsi'
                  WHERE idmodel = '$idmodel'
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }



    function update_field($data) {
        global $conn;

        $oldkode = $data['oldkode'];
        $kode = htmlspecialchars($data['kode']);
        $oldkode_kecil = strtolower($oldkode);
        $kode_kecil = strtolower($kode);

        if($kode != $oldkode) {
            mysqli_query($conn, "ALTER TABLE hasil CHANGE $oldkode_kecil $kode_kecil DOUBLE");
        }
    }



    function delete($id) {
        global $conn;
        $data = query("SELECT * FROM model WHERE idmodel = $id") [0];
        $kode = $data['kode'];
        $kode_kecil = strtolower($kode);

        mysqli_query($conn, "ALTER TABLE hasil DROP COLUMN $kode_kecil");
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