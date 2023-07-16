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
    <div class="profile__container">
        <div class="profile__left">
            <div class="left__lately">
                <div class="lately__title">
                    <h1>Vistos recientemente</h1>
                </div>
                <div class="lately__content">
                    <h2>Playa El Tunco</h2>
                    <h2>El Boquerón</h2>
                    <h2>Furesa</h2>
                    <h2>Plaza Mundo</h2>
                </div>
            </div>
            <div class="left__saved">
                <div class="saved__title">
                    <h1>Mis colecciones</h1>
                </div>
                <div class="saved__content">
                    <h2>Playas</h2>
                    <h2>Malls</h2>
                </div>
            </div>
        </div>
        <div class="profile__right">
            <div class="right__info">
                <img src="<?php echo $data['img']?>">
                <h1><?php echo $data['name'] ?></h1>
                <h3><?php echo $data['email'] ?></h3>
                <form method="post" class="info__buttons">
                    <button type="submit" name="activeEmail">Validar correo</button>
                    <button class="logout">Cerrar Sesión</button>
                </form>
            </div>
            <div class="right__edit">
                <div class="input-field">
                    <input type="text" required spellcheck="false"> 
                    <label>Nombre de usuario</label>
                </div>
                <div class="input-field">
                    <input type="text" required spellcheck="false"> 
                    <label>Edad</label>
                </div>
                <div class="input-field">
                    <input type="text" required spellcheck="false"> 
                    <label>Sexo</label>
                </div>
                <div class="input-field">
                    <input type="text" required spellcheck="false"> 
                    <label>Número telefónico</label>
                </div>
                <div class="input-field">
                    <input type="text" required spellcheck="false"> 
                    <label>Dirección</label>
                </div>
                <div class="input-field">
                    <input type="text" required spellcheck="false"> 
                    <label>Idioma</label>
                </div>
                <input type="submit" value="Guardar">
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })

        document.querySelector('.logout').addEventListener('click', function(e){
            e.preventDefault();
            location.href = 'php/logout.php';
        })
    </script>
</body>
</html>