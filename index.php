<?php include 'php/controlador.php'; ?>
<?php 
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
                .profile{
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <!--CSS-->

    <!--Frameworks-->
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.min.js"></script>
    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style><?php include 'css/index.css' ?></style>
<body>
    <header class="header">
        <div class="header__logo"><img src="img/logo.png"></div>
        <nav class="header__nav">
            <form method="post" class="header__ul">
                <input type="submit" name="goLogin" class="header__li" value="Registrarse">
                <input type="submit" name="goLogin" class="header__li" value="Iniciar Sesión">
            </form>
        </nav>
        <div class="header__options">
            <a href="profile.php" class="profile"><i class="fa-regular fa-circle-user"></i></a>
            <i class="fa-solid fa-globe"></i>
        </div>
    </header>

    <div class="hero">

        <div class="hero__container">
            <img src="img/explora.png" alt="" class="hero__text">
            <svg id="visual" viewBox="0 0 960 540"  xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
                <g transform="translate(447.1003487837197 265.51596821062077)">
                    <path id="blob1"
                        d="M150.6 -128.1C195.6 -105.6 232.8 -52.8 227.1 -5.7C221.5 41.5 173 83 128 111.6C83 140.3 41.5 156.2 3.8 152.4C-33.9 148.6 -67.9 125.2 -96.7 96.5C-125.5 67.9 -149.3 33.9 -158.1 -8.8C-167 -51.6 -160.9 -103.2 -132.1 -125.7C-103.2 -148.2 -51.6 -141.6 0.6 -142.2C52.8 -142.8 105.6 -150.6 150.6 -128.1"
                        fill="#ED735C">
                    </path>
                </g>
                <g transform="translate(483.8593365141332 273.18306880966463)" style="visibility: hidden;">
                    <path id="blob2"
                        d="M142.8 -144.5C178.1 -107.5 195.1 -53.7 200 4.9C205 63.6 197.9 127.3 162.6 160.3C127.3 193.3 63.6 195.6 15.9 179.7C-31.8 163.8 -63.6 129.6 -107.1 96.6C-150.6 63.6 -205.8 31.8 -209 -3.2C-212.2 -38.2 -163.4 -76.4 -119.9 -113.4C-76.4 -150.4 -38.2 -186.2 7.8 -194C53.7 -201.7 107.5 -181.5 142.8 -144.5"
                        fill="#ED735C">
                    </path>
                </g>
            </svg>
        </div>
        <button class="hero__button">COMENZAR &nbsp;<i class="fa-sharp fa-solid fa-arrow-right"></i></button>
    </div>
    <div class="body__squares">
        <div class="square">
            <div class="square__title">
                <i class="fa-solid fa-map-location-dot"></i>
                <h2>Misión</h2>
            </div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut quae veniam, dolores, dicta est quas iste.</p>
        </div>
        <div class="square">
            <div class="square__title">
                <i class="fa-solid fa-map-location-dot"></i>
                <h2>Valores</h2>
            </div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut quae veniam, dolores, dicta est quas iste.</p>
        </div>
        <div class="square">
            <div class="square__title">
                <i class="fa-solid fa-map-location-dot"></i>
                <h2>Visión</h2>
            </div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aut quae veniam, dolores, dicta est quas iste.</p>
        </div>
    </div>
    <div class="body__info">
        <div class="body__info__text">
            <h1>Descubre El Salvador: Donde Aventura y Playa se Abrazan</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro repellat dolore optio, impedit quos distinctio quaerat voluptatem vel minima explicabo?</p>
        </div>
        <div class="body__info__img">
            <img src="https://viasatelital.com/mapas/images/el-salvador001.jpg" alt="">
        </div>
    </div>
    <div class="body__title">
        <h1>Más Sobre</h1>
        <img src="img/title.png" alt="">
    </div>
    <div class="body__info">
        <div class="body__info__img">
            <img src="https://elsalvador.travel/system/wp-content/uploads/2021/04/Santa-Tecla-3-scaled.jpg" alt="">
        </div>
        <div class="body__info__text">
            <h1>El Salvador: Tu Destino, Nuestra Pasión. ¡Aventura sin límites!</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro repellat dolore optio, impedit quos distinctio quaerat voluptatem vel minima explicabo?</p>
        </div>
    </div>

    <script>
        const tween = KUTE.fromTo(
          '#blob1',
          { path: '#blob1' },
          { path: '#blob2' },
          { repeat: 999, duration: 3000, yoyo: true }
        ).start();
    </script>
    <script>
        document.querySelector('.hero__button').addEventListener('click', function(e){
            location.href = 'filtered.php';
        });
    </script>
</body>

</html>