<?php
    include 'php/connection.php';
    include 'php/controlador.php';

    if (!isset($_GET['collection'])) {
        header ('Location: login.php');
    }

    $sql = "SELECT * FROM collections WHERE url = {$_GET['collection']}";
    $run = mysqli_query($connection, $sql);

    if (mysqli_num_rows($run) == 0) {
        header ('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style><?php include 'css/join_collection.css' ?></style>
<body>
    <form method="post" class="container">
        <p><span>Pepito</span> te ha invitado a unirte a la colección <span>Playas vergonas</span></p><span></span>
        <div class="container__btn">
            <input type="submit" name="acceptJoin" value="Aceptar">
            <input type="submit" name="deniedJoin" value="Rechazar">
        </div>
    </form>
</body>
</html>