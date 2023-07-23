<?php 
require_once 'php/connection.php';
require_once 'php/controlador.php';

    if (!isset($_SESSION['user_token'])) {
        header('Location: filtered.php');
    }

    $sql = "SELECT * FROM places WHERE id = '{$_GET['place']}'";
    $run = mysqli_query($connection, $sql);
    $dataPlace = mysqli_fetch_array($run)
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
            <h1><?php echo $dataPlace['name'] ?></h1>
            <p><?php echo $dataPlace['description'] ?></p>
            <form class="hero__text__button">
                <i class="fa-regular fa-star rating"></i>
                <i class="fa-regular fa-rectangle-list collection"></i>
            </form>
        </div>
        <div class="place__hero__img">
            <?php echo '<img class="hero__img" src="'.$dataPlace["img1"].'">'?>
            <?php echo '<img class="hero__img" src="'.$dataPlace["img2"].'">'?>
            <?php echo '<img class="hero__img one" src="'.$dataPlace["img3"].'">'?>
        </div>
    </div>
    <div class="place__body">
        <div class="place__body__left">
            <div class="body__left__map">
                <?php echo $dataPlace['url'] ?>
            </div>
            <div class="body__left__review">
                <form method="post" class="review__comment">
                    <input type="text" name="comment" id="" placeholder="Escribe tu comentario">
                    <input type="submit" value="" name="newComment">
                </form>

                <div class="slider">
                    <?php
                        $query = "SELECT * FROM comments INNER JOIN users ON comments.id_user = users.id WHERE comments.id_place = '{$_GET['place']}'";
                        $resultado = mysqli_query($connection, $query);

                        $x = 0;

                        while ($data = mysqli_fetch_assoc($resultado)) {
                        $claseActiva = ($x === 0) ? 'active' : '';
                        ?>
                        <div class="slider__container <?php echo $claseActiva?>">
                            <div class="slider__user">
                                <img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="">
                                <h2><?php echo $data['name']; ?></h2>
                                <div class="user__info">
                                    <h3>Maestro viajero</h3>
                                    <div class="info__points">
                                        <i class="fa-solid fa-heart"></i>
                                        <p>4.96</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slider__text">
                                <p><?php echo $data['comment']; ?></p>
                            </div>
                        </div>
                    <?php
                    $x++;
                    }
                    ?>
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
                <img src="https://images.trvl-media.com/lodging/24000000/23080000/23072000/23071905/4fa808ce.jpg?impolicy=resizecrop&rw=500&ra=fit" alt="">
                <h2>Casa 1800</h2>
            </div>
            <div class="body__restaurant">
                <div class="circle"></div>
                <img src="https://diarioelsalvador.com/wp-content/uploads/2020/11/f4.png" alt="">
                <h2>Pipiris Nais</h2>
            </div>
        </div>
    </div>
    <div class="popup__container">
        <div class="popup">
            <i class="fa-solid fa-xmark close"></i>
            <h2>Agrega <?php echo $dataPlace['name']; ?> a tus colecciones</h2>
            <form method="post" class="collections__container">
            <?php
                $sql = "SELECT * FROM collections WHERE id_user = {$_SESSION['user_id']}";
                $run = mysqli_query($connection, $sql);

                while ($dataCollec = mysqli_fetch_assoc($run)) {
                    ?>
                        <button type="submit" name="collection" class="collections" value="<?php echo $dataCollec['id']; ?>"><?php echo $dataCollec['name']; ?></button>
                    <?php
                }
            ?>
            </form>
            <form method="post" class="popup__field">
                <input type="text" name="name" spellcheck="false"> 
                <label>Nombre de la colección</label>
                <input type="submit" name="newCollection" value="Añadir">
            </form>
            <i class="fa-solid fa-plus new"></i>
        </div>
    </div>
    <?php
        if($notice != ""){
            ?>
                <div class="notice__container">
                    <div class="notice">
                        <i class="fa-solid fa-xmark closeee"></i>
                        <p><?php echo $notice; ?></p>
                    </div>
                </div>
            <?php
        }
    ?>


    <script>
        document.querySelector('.collection').addEventListener('click', function(){
            document.querySelector('.popup__container').classList.add('visible');
        })

        document.querySelector('.close').addEventListener('click', function(){
            document.querySelector('.popup__container').classList.remove('visible');
        });

        document.querySelector('.new').addEventListener('click', function(){
            document.querySelector('.popup__field').classList.add('visiblew');
            document.querySelectorAll('.collections').forEach(function(elemento) {
                elemento.classList.add('invisiblew');
            });
            document.querySelector('.new').classList.add('invisiblew');
        });

        document.querySelector('.rating').addEventListener('click', function(){
            document.querySelector('.rating').classList.toggle('fa-regular');
            document.querySelector('.rating').classList.toggle('fa-solid');
        })
    </script>


    <script>
        document.querySelector('.closeee').addEventListener('click', function(){
            document.querySelector('.notice__container').classList.add('invisiblee');
            window.history.replaceState(null,null,window.location.href);
        });
    </script>

    <script>
        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })
    </script>

</body>
<script src="js/reviews.js"></script>
</html>