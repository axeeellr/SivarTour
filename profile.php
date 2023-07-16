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

if ($data['verified'] == 1) {
    ?>
        <style type="text/css">
            #validar{
                display: none;
            }
        </style>
    <?php
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<style><?php include 'css/profile.css' ?></style>
<body>
    <header class="header">
        <img src="img/logo.png" alt="" class="header__logo">
        <i class="fa-regular fa-circle-question"></i>
    </header>
    <?php
        if($mensaje != ""){
            ?>
                <div class="popup__container">
                    <div class="popup">
                        <h2><?php echo $mensaje; ?></h2>
                        <p><?php echo $submensaje; ?></p>
                        <button class="close">Aceptar</button>
                    </div>
                </div>
            <?php
        }
    ?>
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
                    <button type="submit" name="activeEmail" id="validar">Validar correo</button>
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
    <div class="right__code">
        <h1>Ingresa el código de verificación</h1>
        <p>Se ha enviado un código de verificación a <?php echo $data['email'] ?></p>
        <form method="post" class="form__code">
            <input type="text" name="code" id="">
            <input type="submit" name="veriCode" value="Aceptar">
        </form>
    </div>


    <script>
        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })

        document.querySelector('.logout').addEventListener('click', function(e){
            e.preventDefault();
            location.href = 'php/logout.php';
        })

        document.querySelector('#validar').addEventListener('click', function(){
            document.querySelector('.right__code').classList.add('see');
        })

        document.querySelector('.close').addEventListener('click', function(e){
            e.preventDefault();
            document.querySelector('.popup__container').classList.add('invisiblee');
            window.history.replaceState(null,null,window.location.href);
        });

    </script>

    <script>
        $(document).ready(function() {
            $('#validar').click(function(event) { // Cambia '#enviar-correo' al ID de tu botón o campo de entrada
                event.preventDefault();

                // Obtener los datos del formulario
                var datosFormulario = $('#formulario').serialize();

                // Enviar los datos mediante AJAX
                $.ajax({
                type: 'POST',
                url: 'mail.php', // Archivo PHP que contiene el código para enviar el correo
                data: datosFormulario,
                success: function(response) {
                    // Manejar la respuesta del servidor después del envío del correo
                    if (response == 'si') {
                        $('#formulario')[0].reset(); // Limpiar el formulario si es necesario
                    } else {
                        alert('Error en el envío del correo. Por favor, inténtalo de nuevo.');
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores en caso de que ocurra algún problema
                    alert('Error en el envío del correo: ' + error);
                }
                });
            });
        });

    </script>
</body>
</html>