<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/department.css">
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="header__logo"><img src="img/logo.png"></div>
        <nav class="header__nav">
            <form method="post" class="header__ul">
                <input type="submit" name="goLogin" class="header__li" value="Registrarse">
                <input type="submit" name="goLogin" class="header__li" value="Iniciar Sesión">
            </form>
        </nav>
        <div class="options__menu">
            <div class="option notifications">
                <div class="option__title">
                    <i class="fa-regular fa-bell"></i>
                    <h3>Notificaciones</h3>
                    <i class="fa-solid fa-chevron-down hideNotis"></i>
                </div>
                <div class="option__info__container">
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
    <div class="container">
        <div class="container__left">
            <div class="left__info">
                <h1>SAN MIGUEL</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis, voluptatum! Laborum veniam eum nostrum sit harum fugit distinctio corrupti aut?</p>
            </div>
            <button>EXPLORAR</button>
        </div>
        <div class="container__right">
            <div class="right__cards">
                <div class="card__container">
                    <div class="card__title">
                        <h2>Teatro Francisco Gavidia</h2>
                        <div class="card__title__stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <div class="card__img">
                        <img src="https://www.cultura.gob.sv/wp-content/uploads/2022/02/IMG-20220202-WA0186.jpg" alt="">
                    </div>
                </div>
                <div class="card__container">
                    <div class="card__title">
                        <h2>Metrocentro San Miguel</h2>
                        <div class="card__title__stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <div class="card__img">
                        <img src="https://lh5.googleusercontent.com/p/AF1QipP3sIkcXkQC6shSQbzXISHaU9rc80c-oRNEZIZa=w500-h500-k-no" alt="">
                    </div>
                </div>
                <div class="card__container">
                    <div class="card__title">
                        <h2>Catedral Nuestra Señora de La Paz</h2>
                        <div class="card__title__stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <div class="card__img">
                        <img src="https://media-cdn.tripadvisor.com/media/photo-s/10/07/01/2c/fb-img-1501086382958.jpg" alt="">
                    </div>
                </div>
                <div class="card__container">
                    <div class="card__title">
                        <h2>Cuevas de Moncagua</h2>
                        <div class="card__title__stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <div class="card__img">
                        <img src="https://cdn-pro.elsalvador.com/wp-content/uploads/2022/02/CUEVAS-MONCAGUA.jpg" alt="">
                    </div>
                </div>
                <div class="card__container">
                    <div class="card__title">
                        <h2>Laguna de Olomega</h2>
                        <div class="card__title__stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <div class="card__img">
                        <img src="https://www.elsalvadormipais.com/wp-content/uploads/2018/11/laguna-de-olomega.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="right__arrows">
                <i class="fa-solid fa-circle-chevron-left prevArrow"></i>
                <i class="fa-solid fa-circle-chevron-right nextArrow"></i>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.showMenu').addEventListener('click', function(e){
            document.querySelector('.options__menu').classList.toggle('show');
            document.querySelector('.showMenu').classList.toggle('black');
        });

        document.querySelector('.hideNotis').addEventListener('click', function(e){
            document.querySelector('.option__info__container').classList.toggle('hide');
        });
    </script>
    <script>
        $(document).ready(function () {
            // Al cargar la página, aseguramos que el primer card__container tenga la clase "active"
            $('.right__cards .card__container:first-child .card__img').addClass('active');
    
            // Función para manejar el clic en la flecha de "next"
            $('.nextArrow').on('click', function () {
                // Obtener el primer card__container
                const firstCard = $('.right__cards .card__container:first-child');

                
                // Mover el primer card__container al final
                $('.right__cards').append(firstCard);
                
                // Remover la clase "active" de todos los card__img
                $('.card__img').removeClass('active');
                
                // Añadir la clase "active" al card__img del primer card__container
                $('.right__cards .card__container:first-child .card__img').addClass('active');
                firstCard.style.opacity = 0.6;
            });
    
            // Función para manejar el clic en la flecha de "prev"
            $('.prevArrow').on('click', function () {
                // Obtener el último card__container
                const lastCard = $('.right__cards .card__container:last-child');
    
                // Mover el último card__container al principio
                $('.right__cards').prepend(lastCard);
    
                // Remover la clase "active" de todos los card__img
                $('.card__img').removeClass('active');
    
                // Añadir la clase "active" al card__img del primer card__container
                $('.right__cards .card__container:first-child .card__img').addClass('active');
            });
        });
    </script>   
</body>
</html>