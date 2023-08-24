<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
    session_start();
    require_once 'controller/mainController.php';

    if(isset($_POST['email'])) {
        $email = $_POST['email'];

        $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

        if (!mysqli_fetch_assoc($result)) {
            $_SESSION["gagal"] = "Email tidak ditemukan";

            echo "
                <script>
                    document.location.href='login.php';
                </script>";
            exit();
        } else {
            $data = query("SELECT email FROM user WHERE email = '$email'") [0];

            $enkripsi_email = enkripsi($data['email']);
        }
    } else {
        echo "<script>
                document.location.href='login.php';
              </script>";
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'fillah.alhaqi11@gmail.com';                     //SMTP username
        $mail->Password   = 'sctaczebxhqacaqm';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('varkmodel@gmail.com', 'Vark Model');
        $mail->addAddress($data['email']);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Ubah Password VARK Model';
        $mail->Body    = '<p>Klik link ini untuk ubah password (jangan sampai orang lain tahu link ini).</p><a href="http://localhost/varkmodel/ubah_password.php?key=' . $enkripsi_email . '">Klik ini untuk ubah password</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $_SESSION["berhasil"] = "Berhasil kirim email, silahkan check email " . $data['email'];

        echo "
            <script>
                document.location.href='login.php';
            </script>
        ";
    } catch (Exception $e) {
        $_SESSION["gagal"] = "Email gagal dikirim";

        echo "
            <script>
                document.location.href='login.php';
            </script>
        ";
    }

?>