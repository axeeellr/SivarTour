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

if (isset($_SESSION['collectionId'])) {
    $sql = "SELECT * FROM collections WHERE id = '{$_SESSION['collectionId']}'";
    $run = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($run);
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
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style><?php include 'css/collections.css'; ?></style>
<body>
    <header class="header">
        <div class="header__logo"><img src="img/Logo SivarTour BN web.png"></div>
        <div class="options__menu">
            <div class="option notifications">
                <div class="option__title">
                    <i class="fa-regular fa-bell"></i>
                    <h3>Notificaciones</h3>
                    <i class="hideNotis fa-solid fa-chevron-down"></i>
                </div>
                <div class="option__info__container hide">
                    <div class="option__info">
                        <i class="fa-solid fa-xmark close"></i>
                        <h4>Publicación rechazada</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi maiores ipsum dolorum.</p>
                    </div>
                    <div class="option__info">
                        <i class="fa-solid fa-xmark close"></i>
                        <h4>Publicación aceptada</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi maiores ipsum dolorum.</p>
                    </div>
                </div>
            </div>
            <div class="option profile">
                <i class="fa-regular fa-circle-user"></i>
                <h3>Mi perfil</h3>
            </div>
            <div class="option favorites">
                <i class="fa-regular fa-star"></i>
                <h3>Mis favoritos</h3>
            </div>
            <div class="option translate">
                <input type="checkbox" id="cambiar">
                <label for="cambiar">aquí se cambia el idioma</label>
            </div>
        </div>
        <div class="header__options">
            <!--<a href="profile.php" class="profile"><i class="fa-regular fa-circle-user"></i></a>-->
            <!--<i class="fa-solid fa-globe"></i>-->
            <i class="fa-solid fa-bars-staggered showMenu"></i>
        </div>
    </header>
    <div class="collections__container">
        <div class="collections__header">
            <h1><?php echo isset($_GET['favorites']) ? "Mis Favoritos" : $row['name']; ?></h1>
            <p>Colección pública</p>
        </div>
        <div class="collections__body">
            <?php 
                if (isset($_GET['favorites'])) {
                    $getFavorites = "SELECT * FROM user_ratings INNER JOIN places ON user_ratings.place_id = places.id WHERE user_ratings.user_id = {$_SESSION['user_id']}";
                    $runFavorites = mysqli_query($connection, $getFavorites);

                    if (mysqli_num_rows($runFavorites) == 0) {
                        echo "<h3 class='noData'>No hay lugares por mostrar :(</h3>";
                    }

                    while($dataFavorites = mysqli_fetch_assoc($runFavorites)){
                        ?>
                            <div class="collection">
                                <div class="collection__place">
                                    <?php echo '<img src="'.$dataFavorites["img1"].'">' ?>
                                    <div class="collection__info">
                                        <h2><?php echo $dataFavorites['name']; ?></h2>
                                        <div class="info__stars">
                                            <?php
                                            // Validar que el rating esté entre 1 y 5
                                                $rating = max(1, min(5, $dataFavorites['rating']));
    
                                                // Definir la cantidad de iconos sólidos y regulares
                                                $iconosSolidos = $dataFavorites['rating'];
                                                $iconosRegulares = 5 - $rating;
    
                                                // Imprimir los iconos sólidos
                                                for ($i = 0; $i < $iconosSolidos; $i++) {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
    
                                                if ($iconosSolidos == 0) {
                                                    $iconosRegulares = 5;
                                                }
    
                                                // Imprimir los iconos regulares
                                                for ($i = 0; $i < $iconosRegulares; $i++) {
                                                    echo '<i class="fa-regular fa-star"></i>';
                                                }
    
                                            ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }else {
                    $getPlaces = "SELECT * FROM collections_places INNER JOIN places ON collections_places.id_place = places.id WHERE id_collection = '{$_SESSION['collectionId']}' ";
                    $runPlaces = mysqli_query($connection, $getPlaces);
    
                    if (mysqli_num_rows($runPlaces) == 0) {
                        echo "<h3 class='noData'>No hay lugares por mostrar :(</h3>";
                    }
    
                    while($dataPlaces = mysqli_fetch_assoc($runPlaces)){
                        ?>
                            <div class="collection">
                                <div class="collection__place">
                                    <?php echo '<img src="'.$dataPlaces["img1"].'">' ?>
                                    <div class="collection__info">
                                        <h2><?php echo $dataPlaces['name']; ?></h2>
                                        <div class="info__stars">
                                            <?php
                                            // Validar que el rating esté entre 1 y 5
                                                $rating = max(1, min(5, $dataPlaces['rating']));
    
                                                // Definir la cantidad de iconos sólidos y regulares
                                                $iconosSolidos = $dataPlaces['rating'];
                                                $iconosRegulares = 5 - $rating;
    
                                                // Imprimir los iconos sólidos
                                                for ($i = 0; $i < $iconosSolidos; $i++) {
                                                    echo '<i class="fa-solid fa-star"></i>';
                                                }
    
                                                if ($iconosSolidos == 0) {
                                                    $iconosRegulares = 5;
                                                }
    
                                                // Imprimir los iconos regulares
                                                for ($i = 0; $i < $iconosRegulares; $i++) {
                                                    echo '<i class="fa-regular fa-star"></i>';
                                                }
    
                                            ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }

            ?>
        </div>
    </div>
    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-regular fa-envelope"></i></a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Inicio</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Acerca de</a></li>
            <li class="menu__item"><a class="menu__link" href="#">FAQ</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Contáctanos</a></li>
        </ul>
    </footer>

    <div class="popup__container">
        <div class="popup">
            <i class="fa-solid fa-xmark closePop"></i>
            <h2>Agrega El Tunco a tus colecciones</h2>
            <form method="post" class="collections__container__pop">
            <?php
                $sqll = "SELECT * FROM collections WHERE id_user = '{$_SESSION['user_id']}'";
                $runn = mysqli_query($connection, $sqll);

                while ($dataCollec = mysqli_fetch_assoc($runn)) {
                    ?>
                        <button type="submit" name="collection" class="collections" value="<?php echo $dataCollec['id']; ?>"><?php echo $dataCollec['name']; ?></button>
                    <?php
                }
            ?>
            </form>
            <form method="post" class="popup__field">
                <input type="text" name="name" spellcheck="false"> 
                <label class="label">Nombre de la colección</label>
                <input type="submit" name="newCollection" value="Añadir">
            </form>
            <i class="fa-solid fa-plus new"></i>
        </div>
    </div>



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
    <script>
        document.querySelector('.collection__add').addEventListener('click', function(){
            document.querySelector('.popup__container').classList.add('visible');
        })

        document.querySelector('.closePop').addEventListener('click', function(){
            document.querySelector('.popup__container').classList.remove('visible');
        });

        document.querySelector('.new').addEventListener('click', function(){
            document.querySelector('.popup__field').classList.add('visiblew');
            document.querySelectorAll('.collections').forEach(function(elemento) {
                elemento.classList.add('invisiblew');
            });
            document.querySelector('.new').classList.add('invisiblew');
        });
    </script>
</body>
</html>