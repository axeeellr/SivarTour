<?php

include 'php/connection.php';
include 'php/controlador.php';

if (isset($_SESSION['host'])) {
    unset($_SESSION['host']);
    header('Location: ' . $_SESSION['url']);
}

if (!isset($_SESSION['user_token'])) {
    header('Location: login.php');
}

if (isset($_SESSION['isLogin'])) {
    ?>
        <style type="text/css">
            .header__nav{
                display: none;
            }
        </style>
    <?php
}else {
    ?>
        <style type="text/css">
            .option:nth-child(2), .option:nth-child(3){
                display: none;
            }
        </style>
    <?php
}

$sql = "SELECT * FROM users WHERE id = '{$_SESSION['idUserComment']}'";
$run = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($run);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<style><?php include 'css/user.css'; ?></style>
<body>
    <header class="header">
        <div class="header__logo"><img src="img/Logo SivarTour BN web.png"></div>
        <nav class="header__nav">
            <form method="post" class="header__ul">
                <input type="submit" name="goLogin" class="header__li" data-section="Filtered" data-value="Registro" value="Registrarse" >
                <input type="submit" name="goLogin" class="header__li" data-section="Filtered" data-value="Inicio Sesion" value="Iniciar Sesión">
            </form>
        </nav>
        <div class="options__menu">
            <div class="option notifications">
                <div class="option__title">
                    <i class="fa-regular fa-bell"></i>
                    <h3 data-section="Filtered" data-value="Notificaciones">Notificaciones</h3>
                    <i class="fa-solid fa-chevron-down hideNotis"></i>
                </div>
                <div class="option__info__container hide">
                    <?php
                        $noti = "SELECT * FROM notifications WHERE id_user = {$_SESSION['user_id']} LIMIT 5";
                        $runNoti = mysqli_query($connection, $noti);

                        if (mysqli_num_rows($runNoti) == 0) {
                            echo "<h4 class='noData'>No tienes notificaciones :c</h4>";
                        }

                        while ($rowNoti = mysqli_fetch_array($runNoti)) {
                            switch ($rowNoti['type']) {
                                case 1:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="submit" name="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="Filtered" data-value="Noti Aceptada">Publicación aceptada</h4>
                                        <p data-section="Filtered" data-value="Mesg acepto">¡Enhorabuena! ¡Tu publicación ha sido aceptada!</p>
                                    </form>
                                    <?php
                                break;
                                case 2:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="submit" name="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="Filtered" data-value="Noti Rechazada">Publicación rechazada</h4>
                                        <p  data-section="Filtered" data-value="Mesg rechazo">¡Lo sentimos! ¡Tu publicación ha sido rechazada!</p>
                                    </form>
                                    <?php
                                break;
                                case 3:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="submit" name="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="Filtered" data-value="Noti Eliminada">Publicación eliminada</h4>
                                        <p data-section="Filtered" data-value="Mesg acepto">¡Vaya! ¡Tu publicación ha sido eliminada!</p>
                                    </form>
                                    <?php
                                break;
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="option profile">
                <i class="fa-regular fa-circle-user"></i>
                <h3 data-section="Filtered" data-value="perfil">Mi perfil</h3>
            </div>
            <div class="option favorites">
                <i class="fa-regular fa-star"></i>
                <h3 data-section="Filtered" data-value="favs">Mis favoritos</h3>
            </div>
            <form method="post" class="option link">
                <i class="fa-solid fa-route"></i>
                <a id="link" href="#" target="_blank">Mi ruta</a>
                <button type="submit" name="deleteRoute"><i class="fa-regular fa-trash-can" id="delete"></i></button>
            </form>
            <div class="option translate">
                <input type="checkbox" id="cambiar">
                <label for="cambiar">aquí se cambia el idioma</label>
            </div>
        </div>
        <div class="header__options">
            <i class="fa-solid fa-bars-staggered showMenu"></i>
        </div>
    </header>
    <div class="user__container">
        <div class="user__head">
            <div class="head__img"><?php echo substr($row['name'], 0, 1); ?></div>
            <h1><?php echo $row['name']; ?></h1>
            <p><?php echo $row['email']; ?></p>
            <div class="head__socials">
                <a href="<?php echo isset($row['instagram']) ? 'https://www.instagram.com/' . $row['instagram'] : ''; ?>"><i class="fa-brands fa-instagram"></i></a>
                <a href="<?php echo isset($row['twitter']) ? 'https://www.twitter.com/' . $row['twitter'] : ''; ?>"><i class="fa-brands fa-twitter"></i></a>
                <a href="<?php echo isset($row['whatsapp']) ? 'https://wa.me/' . $row['whatsapp'] : ''; ?>"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="user__collections">
            <?php
                $sqll = "SELECT * FROM collections WHERE id_user = {$row['id']}";
                $runn = mysqli_query($connection, $sqll);

                if (mysqli_num_rows($runn) == 0) {
                    echo "<h3 class='noData'>No hay colecciones por mostrar :(</h3>";
                }

                while ($dataCollec = mysqli_fetch_assoc($runn)){
                    ?>
                        <form method="post" class="collection">
                            <input type="hidden" name="collectionId" value="<?php echo $dataCollec['id'] ?>">
                            <button type="submit" name="collectionPage"><?php echo $dataCollec['name'] ?></button>
                        </form>
                    <?php
                }
            ?>
        </div>
    </div>

    <!-- eliminar ruta -->
    <script>
        const del = document.getElementById('delete');
        del.addEventListener('click', function() {
            localStorage.setItem("lugares" , "[]")
            console.log(localStorage.getItem("lugares"))
        });
    </script>


    <!-- ruta -->
    <script defer>
        const lugares = JSON.parse(localStorage.getItem("lugares") ?? "[]");
        const lugaresDatos = [...new Set(lugares)]
        const link = document.getElementById("link")

        const lugaresLinks = [...new Set(lugaresDatos)].join("/");

        console.log(lugaresLinks)

        link.href = "https://www.google.com/maps/dir/" + lugaresLinks
    </script>

    <script>
        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })

        document.querySelector('.profile').addEventListener('click', function(e){
            location.href = 'profile.php';
        });

        document.querySelector('.favorites').addEventListener('click', function(e){
            location.href = 'collections.php?favorites';
        });

        document.querySelector('.showMenu').addEventListener('click', function(e){
            document.querySelector('.options__menu').classList.toggle('show');
            document.querySelector('.showMenu').classList.toggle('black');
        });

        document.querySelector('.hideNotis').addEventListener('click', function(e){
            document.querySelector('.option__info__container').classList.toggle('hide');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-down');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-right');
        });
    </script>
</body>
</html>