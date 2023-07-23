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

function recursiveUrlDecode($str) {
    while (urldecode($str) !== $str) {
        $str = urldecode($str);
    }
    return $str;
}

$cookieName = 'ultimos_lugares_' . $_SESSION['user_id'];

if (isset($_COOKIE[$cookieName])) {
    $lugaresVisitadosIDs = explode(',', recursiveUrlDecode($_COOKIE[$cookieName]));
}

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
    <div class="loader__container">
        <div class="loader"></div>
    </div>
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
                    <?php
                        foreach ($lugaresVisitadosIDs as $idLugar) {
                            $sqll = "SELECT * FROM places WHERE id = $idLugar";
                            $runn = mysqli_query($connection, $sqll);

                            if (mysqli_num_rows($runn)) {
                                $row = $runn->fetch_assoc();
                                ?>
                                <h2><?php echo $row['name']; ?></h2>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="left__saved">
                <div class="saved__title">
                    <h1>Mis colecciones</h1>
                </div>
                <div class="saved__content">
                <?php
                $sql = "SELECT * FROM collections WHERE id_user = {$_SESSION['user_id']}";
                $run = mysqli_query($connection, $sql);

                while ($dataCollec = mysqli_fetch_assoc($run)){
                    ?>
                        <h2><?php echo $dataCollec['name'] ?></h2>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
        <div class="profile__right">
            <div class="right__info">
                <div class="right__info__img"><?php echo substr($data['name'], 0, 1); ?></div>
                <h1><?php echo $data['name'] ?></h1>
                <h3><?php echo $data['email'] ?></h3>
                <form method="post" class="info__buttons">
                    <button type="submit" name="activeEmail" id="validar">Validar correo</button>
                    <button class="logout">Cerrar Sesión</button>
                </form>
            </div>
            <form method="post" class="right__edit">
                <div class="input-field">
                    <input type="text" name="username" spellcheck="false" onfocus="this.placeholder = 'Nombre de usuario'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['username']) ? "Nombre de usuario" : $data['username'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="number" min="10" max="99" name="age" spellcheck="false" onfocus="this.placeholder = 'Edad'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['age']) ? "Edad" : $data['age'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="sex" spellcheck="false" onfocus="this.placeholder = 'Sexo'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['sex']) ? "Sexo" : $data['sex'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="number" name="number" spellcheck="false" onfocus="this.placeholder = 'Número telefónico'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['number']) ? "Número telefónico" : $data['number'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="address" spellcheck="false" onfocus="this.placeholder = 'Dirección'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['address']) ? "Dirección" : $data['address'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="language" spellcheck="false"onfocus="this.placeholder = 'Idioma'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['language']) ? "Idioma" : $data['language'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <input type="submit" name="userData" value="Guardar">
            </form>
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
                url: 'mail.php?email=<?php echo $data['email']?>', // Archivo PHP que contiene el código para enviar el correo
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const loaderContainer = document.querySelector(".loader__container");
        loaderContainer.style.display = "none"; // Ocultar el loader después de que la página se haya cargado completamente
        });
    </script>
</body>
</html>