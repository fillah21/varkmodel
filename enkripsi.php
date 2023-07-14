<?php 
  require_once 'controller/mainController.php';
  if(isset($_POST['submit'])) {
    $iduser = 1;
    $tanggal_tes = "Ehem";
    $sql_data = "INSERT INTO hasil VALUES (NULL, $iduser, $tanggal_tes, ";

    $model = query("SELECT * FROM model");

    foreach ($model as $mod) {
      $kecil[] = strtolower($mod['kode']);
    }

    foreach ($kecil as $k) {
      $value[] = "Ini" . $k;
    }

    $valuesString = implode(", ", $value);

    $sql_data .= $valuesString . ")";

    var_dump($sql_data);
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