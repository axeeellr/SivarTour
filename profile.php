<?php

require_once 'php/connection.php';
require_once 'php/controlador.php';

if (isset($_SESSION['host'])) {
    unset($_SESSION['host']);
    header('Location: ' . $_SESSION['url']);
}

if (!isset($_SESSION['user_token'])) {
    header('Location: login.php');
}

$sql = "SELECT * FROM users WHERE token = '{$_SESSION['user_token']}'";
$run = mysqli_query($connection, $sql);
$data = mysqli_fetch_array($run);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<style><?php include 'css/profile.css' ?></style>
<body>
    <header class="header">
        <img src="img/logo.png" alt="" class="header__logo">
        <i class="fa-regular fa-circle-question"></i>
    </header>
    <div class="profile__header">
        <div class="profile__info">
            <img src="<?php echo $data['img']; ?>">
            <h1><?php echo $data['name']; ?></h1>
        </div>
        <div class="profile__collections">
            <div class="collection__favs">
                <h1>Mis colecciones</h1>
                <p>Malls</p>
                <p>Playas de La Libertad</p>
                <p>Playas de Sonsonate</p>
            </div>
            <div class="collection__see">
                <h1>Recientemente vistos</h1>
                <p>El Tunco</p>
                <p>Centro Comercial Las Cascadas</p>
                <p>Parque El Principito</p>
                <p>Playa Las Hojas</p>
                <p>Ciudadela Don Bosco</p>
            </div>
        </div>
        <a href="php/logout.php">Salir</a>
    </div>
    <div class="profile__body">

    </div>
    <script>
        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })
    </script>
</body>
</html>