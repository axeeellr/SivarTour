<?php 
require_once 'php/connection.php';
require_once 'php/controlador.php';

if (!isset($_SESSION['user_token'])) {
    header('Location: filtered.php');
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
    <!--Frameworks-->
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>
    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style><?php include 'css/place.css'?></style>
<body>
    <header class="header">
        <img src="img/logo.png" class="header__logo">
        <a href="profile.php"><i class="fa-regular fa-circle-user"></i></a>
    </header>
    <div class="place__hero">
        <div class="place__hero__text">
            <h1>Playa El Tunco</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam sit atque corrupti sapiente nam a ea veritatis.</p>
            <form class="hero__text__button">
                <button type="submit"><i class="fa-regular fa-star"></i></button>
                <button type="submit"><i class="fa-regular fa-rectangle-list"></i></button>
            </form>
        </div>
        <div class="place__hero__img">
            <img class="hero__img" src="https://live.staticflickr.com/7842/46038993015_11978f4826_b.jpg" alt="">
            <img class="hero__img" src="https://images.mnstatic.com/bb/95/bb95475cbbbba206ddac6ef12a8f5984.jpg" alt="">
            <img class="hero__img one" src="https://i0.wp.com/passporterapp.com/es/blog/wp-content/uploads/2022/05/que-ver-en-el-tunco-scaled.jpg?fit=2560%2C1707&ssl=1" alt="">
        </div>
    </div>
    <div class="place__body">
        <div class="place__body__left">
            <div class="body__left__map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15518.822923180502!2d-89.39168865541143!3d13.492221739967512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f7cd59f22c8da2b%3A0xc9cb9224ff2461d7!2sPlaya%20El%20Tunco!5e0!3m2!1ses-419!2ssv!4v1687746316597!5m2!1ses-419!2ssv" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="body__left__review">
                <form class="review__comment">
                    <input type="text" name="" id="" placeholder="Escribe tu comentario">
                    <input type="submit" value="">
                </form>
                <div class="slider">
                    <div class="slider__container active">
                        <div class="slider__user">
                            <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="">
                            <h2>Christian Daniel</h2>
                            <div class="user__info">
                                <h3>Maestro viajero</h3>
                                <div class="info__points">
                                    <i class="fa-solid fa-heart"></i>
                                    <p>4.96</p>
                                </div>
                            </div>
                        </div>
                        <div class="slider__text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat deleniti in aut iste eius culpa odio.</p>
                        </div>
                    </div>
                    <div class="slider__container">
                        <div class="slider__user">
                            <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="">
                            <h2>Axel Ramírez</h2>
                            <div class="user__info">
                                <h3>Maestro viajero</h3>
                                <div class="info__points">
                                    <i class="fa-solid fa-heart"></i>
                                    <p>4.96</p>
                                </div>
                            </div>
                        </div>
                        <div class="slider__text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat deleniti in aut iste eius culpa odio.</p>
                        </div>
                    </div>
                    <div class="slider__container">
                        <div class="slider__user">
                            <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="">
                            <h2>Bad Bunny</h2>
                            <div class="user__info">
                                <h3>Maestro viajero</h3>
                                <div class="info__points">
                                    <i class="fa-solid fa-heart"></i>
                                    <p>4.96</p>
                                </div>
                            </div>
                        </div>
                        <div class="slider__text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat deleniti in aut iste eius culpa odio.</p>
                        </div>
                    </div>
                    <div class="slider__container">
                        <div class="slider__user">
                            <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="">
                            <h2>El Fercho</h2>
                            <div class="user__info">
                                <h3>Maestro viajero</h3>
                                <div class="info__points">
                                    <i class="fa-solid fa-heart"></i>
                                    <p>4.96</p>
                                </div>
                            </div>
                        </div>
                        <div class="slider__text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat deleniti in aut iste eius culpa odio.</p>
                        </div>
                    </div>
                    <div class="slider__container">
                        <div class="slider__user">
                            <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="">
                            <h2>Manfredo Quintanilla</h2>
                            <div class="user__info">
                                <h3>Maestro viajero</h3>
                                <div class="info__points">
                                    <i class="fa-solid fa-heart"></i>
                                    <p>4.96</p>
                                </div>
                            </div>
                        </div>
                        <div class="slider__text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat deleniti in aut iste eius culpa odio.</p>
                        </div>
                    </div>
                </div>
                <nav class="slider-nav">
                    <ul>
                        <li class="arrow">
                            <button class="previous"><span><i class="fa-sharp fa-solid fa-arrow-left"></i></span></button>
                        </li>
                        <li class="arrow">
                            <button class="next"><span><i class="fa-sharp fa-solid fa-arrow-right"></i></span></button>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="body__left__route">
                <a href="routes.html"><div class="route">
                    <i class="fa-solid fa-route"></i>
                    <h2>Agregar a la ruta</h2>
                </div></a>
            </div>
        </div>
        <div class="line"></div>
        <div class="place__body__right">
            <div class="body__restaurant">
                <div class="circle"></div>
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                <h2>Rock & Roe´s</h2>
            </div>
            <div class="body__restaurant">
                <div class="circle"></div>
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                <h2>Rock & Roe´s</h2>
            </div>
            <div class="body__restaurant">
                <div class="circle"></div>
                <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                <h2>Rock & Roe´s</h2>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class="popup">
            <i class="fa-solid fa-xmark close"></i>
            <h2>Agrega El Tunco a tus colecciones</h2>
            <button>Playas</button>
            <button>Malls</button>
            <i class="fa-solid fa-plus"></i>
        </div>
    </div>

    <script>
        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })
    </script>
</body>
<script src="js/reviews.js"></script>
</html>