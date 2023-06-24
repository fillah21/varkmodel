<?php 
    if(isset($_POST['submit'])) {
        // for($i = 0; $i < count($_POST['nama']); $i++ ) {
        //     var_dump($_POST["nama"] [$i]);
        // }
        ini_set("SMTP", "smtp.gmail.com");
        ini_set("smtp_port", "587");
        
        $to = "fillah.alhaqi11@gmail.com";
        $subject = "Subjek Email";
        $message = "Ini adalah pesan email.";

        // Header email
        $headers = "From: pengirim@example.com\r\n";
        $headers .= "Reply-To: pengirim@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // Mengirim email
        if (mail($to, $subject, $message, $headers)) {
            echo "Email berhasil dikirim.";
        } else {
            echo "Gagal mengirim email.";
        }
    }
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
  </head>
  <body>
    <h1>Coba Multiple Input</h1>

    <form action="" method="post">
        <input type="text" name="nama[]"> <br>
        <input type="text" name="nama[]"> <br>
        <input type="text" name="nama[]"> <br>

        <button name="submit">Submit</button>
    </form>
  </body>
</html>