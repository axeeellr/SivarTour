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
        echo '<i class="fa-regular fa-square-plus new__place"></i>';
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
    <link rel="stylesheet" href="css/filtered.css">
    <!--Otros-->
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>
    <link rel=&quot;canonical&quot; href=&quot;https://codepen.io/supah/pen/VweRLrQ&quot; />
    <link rel=&quot;stylesheet&quot; href=&quot;https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css&quot;>
    <!--JQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style><?php include 'css/filtered.css'?></style>
<body>
    <header class="header">
        <img src="img/logo.png" alt="" class="header__logo">
        <nav class="header__nav">
            <form method="post" class="header__ul">
                <input type="submit" name="goLogin" class="header__li" value="Registrarse">
                <input type="submit" name="goLogin" class="header__li" value="Iniciar Sesión">
            </form>
        </nav>
        <a href="profile.php"><i class="fa-regular fa-circle-user"></i></a>
    </header>

    <div class="hero">

        <svg id="visual" viewBox="0 0 900 600" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
            <g transform="translate(468.33061402365865 277.80104108680837)">
                <path id="blob1"
                    d="M166.4 -173.1C191.4 -141.4 170.7 -70.7 170 -0.7C169.3 69.3 188.6 138.6 163.6 183.3C138.6 227.9 69.3 248 9.9 238.1C-49.5 228.2 -99 188.3 -140 143.7C-181 99 -213.5 49.5 -215.3 -1.8C-217 -53 -188.1 -106.1 -147.1 -137.7C-106.1 -169.4 -53 -179.7 8.8 -188.5C70.7 -197.4 141.4 -204.8 166.4 -173.1"
                    fill="#F0F4EF">
                </path>
            </g>
            <g transform="translate(442.1587426736651 248.8769763985242)" style="visibility: hidden;">
                <path id="blob2"
                    d="M151.2 -132C195.3 -107 230.2 -53.5 230.3 0.1C230.4 53.7 195.8 107.5 151.6 155.3C107.5 203.1 53.7 245.1 -8.5 253.6C-70.7 262 -141.4 237.1 -178.8 189.3C-216.1 141.4 -220 70.7 -209.7 10.4C-199.3 -50 -174.6 -99.9 -137.3 -124.9C-99.9 -149.9 -50 -150 1.8 -151.7C53.5 -153.5 107 -157 151.2 -132"
                    fill="#F0F4EF">
                </path>
            </g>
        </svg>

        <img src="img/playas.png" alt="" class="hero__text">
        <i class="fa-solid fa-chevron-down"><a href="#filters"></a></i>
    </div>

    <div class="filters" id="filters">
        <select name="" id="">
            <option value="">Ordenar Por</option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select>
        <select name="" id="">
            <option value="">¿Dónde?</option>
            <option value="">San Salvador</option>
            <option value="">San Miguel</option>
            <option value="">La Libertad</option>
        </select>
        <select name="" id="">
            <option value="">Tipo</option>
            <option value="">Playa</option>
            <option value="">Montaña</option>
            <option value="">Bosque</option>
        </select>
        <select name="" id="">
            <option value="">Público</option>
            <option value="">Todo público</option>
            <option value="">Solo mayores de 18</option>
            <option value="">Especial para niños</option>
        </select>
        <input type="submit" value="">
        <!--<a href=""><i class="fa-solid fa-arrows-rotate"></i></a>-->
    </div>
    <div class="container">
        <div class="cards">
            <a class="card" href="place.php">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://elsalvadorviajar.com/wp-content/uploads/2021/09/Visita-Playa-la-Costa-del-Sol.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://elsalvadorviajar.com/wp-content/uploads/2021/09/Visita-Playa-la-Costa-del-Sol.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
        </div>


        <div class="cards">
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa San Diego</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://elsalvadorviajar.com/wp-content/uploads/2021/09/Visita-Playa-la-Costa-del-Sol.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa Cocos</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://elsalvadorviajar.com/wp-content/uploads/2021/09/Visita-Playa-la-Costa-del-Sol.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
            <a href="place.php" class="card">
                <div class="card__img">
                    <img src="https://turismo.sv/wp-content/uploads/2019/06/el-tunco-1.jpg" alt="">
                </div>
                <div class="card__info">
                    <h2>Playa El Tunco</h2>
                    <div class="card__info__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="pagination">
        <li class="page-item previous-page disable"><a class="page-link" href="#"><i class="fa-sharp fa-solid fa-arrow-left"></i></a></li>
        <li class="page-item current-page active"><a class="page-link" href="#">1</a></li>
        <li class="page-item dots"><a class="page-link" href="#">...</a></li>
        <li class="page-item current-page"><a class="page-link" href="#">5</a></li>
        <li class="page-item current-page"><a class="page-link" href="#">6</a></li>
        <li class="page-item dots"><a class="page-link" href="#">...</a></li>
        <li class="page-item current-page"><a class="page-link" href="#">10</a></li>
        <li class="page-item next-page"><a class="page-link" href="#"><i class="fa-sharp fa-solid fa-arrow-right"></i></a></li>
    </div>
    <div class="popup__container">
        <div class="popup">
            <i class="fa-solid fa-xmark"></i>
            <h2>Espera</h2>
            <p>Tienes que estar registrado para poder ver este lugar</p>
        </div>
    </div>
    <div class="newplace__container">
        <div class="newplace">
            <i class="fa-solid fa-xmark close__newplace"></i>
            <div class="newplace__img">
                <input type="file" id="upload-button" multiple accept="image/*" />
                <label for="upload-button">
                    <i class="fa-solid fa-upload"></i>&nbsp; Escoge las fotos
                </label>
                <div id="error"></div>
                <div id="image-display"></div>
            </div>
            <div class="newplace__info">
                <div class="newplace__info__top">
                    <input type="text" placeholder="Nombre" name="" id="">
                    <input type="text" placeholder="Descripción" name="" id="">
                    <input type="text" placeholder="URL del mapa" name="" id="">
                </div>
                <div class="newplace__info__bottom">
                    <div class="info__bottom__restaurant">
                        <input type="text" name="" placeholder="Nombre del restaurante" id="">
                        <input type="file" id="files" name="files[]">
                        <output id="list"></output>
                    </div>
                    <div class="info__bottom__restaurant">
                        <input type="text" placeholder="Nombre del restaurante" name="" id="">
                        <input type="file" id="files" name="files[]">
                        <output id="list"></output>
                    </div>
                    <div class="info__bottom__restaurant">
                        <input type="text" name="" placeholder="Nombre del restaurante" id="">
                        <input type="file" id="files" name="files[]">
                        <output id="list"></output>
                    </div>
                    <input type="submit" class="send" value="Aceptar">
                </div>
            </div>
        </div>
    </div>


    <script>
        const tween = KUTE.fromTo(
          '#blob1',
          { path: '#blob1' },
          { path: '#blob2' },
          { repeat: 999, duration: 3000, yoyo: true }
        ).start();

        const twiin = KUTE.fromTo(
          '#blob3',
          { path: '#blob3' },
          { path: '#blob4' },
          { repeat: 999, duration: 3000, yoyo: true }
        ).start();
    </script>

    <!-- pagina place cuando estoy logueado -->
    <script>
        document.querySelector('card').addEventListener('click', function(){
            document.querySelector('popup__container').classList.add('visible');
        })

        document.querySelector('fa-solid fa-xmark').addEventListener('click', function(){
            document.querySelector('popup__container').classList.remove('visible');
        });
    </script>

    <!-- previsualizar imagen subida en el form de subir -->
    <script>
        function archivo(evt) {
            var files = evt.target.files; // FileList object
        
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.
                if (!f.type.match('image.*')) {
                    continue;
                }
        
                var reader = new FileReader();
        
                reader.onload = (function(theFile) {
                    return function(e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    };
                })(f);
        
                reader.readAsDataURL(f);
            }
        }
        
        document.getElementById('files').addEventListener('change', archivo, false);
    </script>

    <!-- agregar lugar -->
    <script>
        document.querySelector('.new__place').addEventListener('click', function(){
            document.querySelector('.newplace__container').classList.remove('close');
            document.querySelector('.newplace__container').classList.add('see');
        })

        document.querySelector('.close__newplace').addEventListener('click', function(){
            document.querySelector('.newplace__container').classList.remove('see');
            document.querySelector('.newplace__container').classList.add('close');
        })
    </script>

    <script>
        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })
    </script>

    <script src="js/pagination.js"></script>
    <script src="js/newPlace.js"></script>
</body>
</html>