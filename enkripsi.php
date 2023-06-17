<?php 
    if(isset($_POST['submit'])) {
        for($i = 0; $i < count($_POST['nama']); $i++ ) {
            var_dump($_POST["nama"] [$i]);
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