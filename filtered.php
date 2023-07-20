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
    }
    
    if (isset($_SESSION['isLogin'])) {
        $sql = "SELECT * FROM users WHERE token = '{$_SESSION['user_token']}'";
        $run = mysqli_query($connection, $sql);
        $data = mysqli_fetch_array($run);
    
        if ($data['verified'] == 1) {
            echo '<i class="fa-regular fa-square-plus new__place"></i>';
        }
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style><?php include 'css/filtered.css'?></style>
<body>
    <header class="header">
        <div class="header__logo"><img src="img/logo.png" class="logoImg"></div>
        <nav class="header__nav">
            <form method="post" class="header__ul">
                <input type="submit" name="goLogin" class="header__li" value="Registrarse">
                <input type="submit" name="goLogin" class="header__li" value="Iniciar Sesión">
            </form>
        </nav>
        <div class="header__options">
            <a href="profile.php"><i class="fa-regular fa-circle-user"></i></a>
            <i class="fa-solid fa-globe"></i>
        </div>
    </header>

    <div class="hero">
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

        <img src="img/explora.png" alt="" class="hero__text">
        <i class="fa-solid fa-chevron-down"><a href="#filters"></a></i>
    </div>

    <div class="filters" id="filters">
        <select name="" id="">
            <option value="">Ordenar Por</option>
            <option value=""></option>
            <option value=""></option>
            <option value=""></option>
        </select>
        <select name="" id="department">
            <option value="">Departamento</option>
            <option value="Ahuachapán">Ahuachapán</option>
            <option value="Cabañas">Cabañas</option>
            <option value="Chalatenango">Chalatenango</option>
            <option value="Cuscatlán">Cuscatlán</option>
            <option value="La Libertad">La Libertad</option>
            <option value="La Paz">La Paz</option>
            <option value="La Unión">La Unión</option>
            <option value="Morazán">Morazán</option>
            <option value="San Miguel">San Miguel</option>
            <option value="San Salvador">San Salvador</option>
            <option value="San Vicente">San Vicente</option>
            <option value="Santa Ana">Santa Ana</option>
            <option value="Sonsonate">Sonsonate</option>
            <option value="Usulután">Usulután</option>
        </select>
        <select name="" id="type">
            <option value="">Tipo</option>
            <option value="Playa">Playa</option>
            <option value="Campo">Campo</option>
            <option value="Cabañas">Cabañas</option>
            <option value="Parque">Parque</option>
            <option value="Bosque">Bosque</option>
            <option value="Lago">Lago</option>
            <option value="Sitio Arqueológico">Sitio Arqueológico</option>
            <option value="Volcán">Volcán</option>
            <option value="Centro Comercial">Centro Comercial</option>
            <option value="Montaña">Montaña</option>
            <option value="Otro">Otro</option>
        </select>
        <select name="" id="public">
            <option value="">Público</option>
            <option value="Todo público">Todo público</option>
            <option value="Solo mayores de 18">Solo mayores de 18</option>
            <option value="Especial para niños">Especial para niños</option>
        </select>
        <!--<a href=""><i class="fa-solid fa-arrows-rotate"></i></a>-->
    </div>
    <div class="container">
        <?php
            $sql = "SELECT * FROM places";
            $run = mysqli_query($connection, $sql);
            
            $count = 0;

            ?>
            <div id="placesContainer" class="cards">
            <?php
            while ($data = mysqli_fetch_array($run)) {
                ?>
                    <a href="place.php" class="card">
                        <div class="card__img">
                            <?php echo '<img src="'.$data["img1"].'">'?>
                        </div>
                        <div class="card__info">
                            <h2><?php echo $data['name'] ?></h2>
                            <div class="card__info__stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </a>
                <?php
                $count++;

                if ($count == 6) {
                    echo '</div>';
                    echo '<div class="cards">';
                    $count = 0; 
                }
            }?>
            </div>
            <?php
        ?>
    </div>
    <div id="paginationContainer" class="pagination">
            <li class="page-item previous-page disable"><a class="page-link" href=""><i class="fa-sharp fa-solid fa-arrow-left"></i></a></li>
            <li class="page-item current-page active"><a class="page-link" href="">1</a></li>
            <li class="page-item dots"><a class="page-link" href="">...</a></li>
            <li class="page-item current-page"><a class="page-link" href="">5</a></li>
            <li class="page-item current-page"><a class="page-link" href="">6</a></li>
            <li class="page-item dots"><a class="page-link" href="">...</a></li>
            <li class="page-item current-page"><a class="page-link" href="">10</a></li>
            <li class="page-item next-page"><a class="page-link" href=""><i class="fa-sharp fa-solid fa-arrow-right"></i></a></li>
    </div>
    <div class="popup__container">
        <div class="popup">
            <i class="fa-solid fa-xmark"></i>
            <h2>Espera</h2>
            <p>Tienes que estar registrado para poder ver este lugar</p>
        </div>
    </div>
    <div class="newplace__container">
        <form method="post" class="newplace" enctype="multipart/form-data">
            <i class="fa-solid fa-xmark close__newplace"></i>
            <div class="newplace__img">
                <input type="file" name="images[]" id="upload-button" required multiple accept="image/*" />
                <label for="upload-button">
                    <i class="fa-solid fa-upload"></i>&nbsp; Escoge las fotos
                </label>
                <p>Recuerda que el total de fotografías es 3</p>
                <div id="error"></div>
                <div id="image-display"></div>
            </div>
            <div class="newplace__info">
                <div class="info__title">
                    <h1>Tú también puedes publicar lugares!</h1>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque molestias id culpa amet impedit? Vero consequatur ipsum earum iure odio?</p>
                </div>
                <div class="input__field">
                    <input type="text" name="name" required spellcheck="false"> 
                    <label>Nombre</label>
                </div>
                <div class="input__field">
                    <input type="text" name="description" required spellcheck="false"> 
                    <label>Descripción</label>
                </div>
                <div class="input__field">
                    <input type="text" name="url" required spellcheck="false"> 
                    <label>URL del mapa</label>
                </div>
                <div class="input__field">
                <select name="department">
                    <option value="">Departamento</option>
                    <option value="Ahuachapán">Ahuachapán</option>
                    <option value="Cabañas">Cabañas</option>
                    <option value="Chalatenango">Chalatenango</option>
                    <option value="Cuscatlán">Cuscatlán</option>
                    <option value="La Libertad">La Libertad</option>
                    <option value="La Paz">La Paz</option>
                    <option value="La Unión">La Unión</option>
                    <option value="Morazán">Morazán</option>
                    <option value="San Miguel">San Miguel</option>
                    <option value="San Salvador">San Salvador</option>
                    <option value="San Vicente">San Vicente</option>
                    <option value="Santa Ana">Santa Ana</option>
                    <option value="Sonsonate">Sonsonate</option>
                    <option value="Usulután">Usulután</option>
                </select>
                </div>
                <div class="input__field">
                    <select name="type" id="type">
                        <option value="" selected disabled>Tipo</option>
                        <option value="Playa">Playa</option>
                        <option value="Campo">Campo</option>
                        <option value="Cabañas">Cabañas</option>
                        <option value="Parque">Parque</option>
                        <option value="Bosque">Bosque</option>
                        <option value="Lago">Lago</option>
                        <option value="Sitio Arqueológico">Sitio Arqueológico</option>
                        <option value="Volcán">Volcán</option>
                        <option value="Centro Comercial">Centro Comercial</option>
                        <option value="Montaña">Montaña</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="input__field">
                    <select name="public" id="">
                        <option value="" selected disabled>Público</option>
                        <option value="Todo público">Todo público</option>
                        <option value="Solo mayores de 18">Solo mayores de 18</option>
                        <option value="Especial para niños">Especial para niños</option>
                    </select>
                </div>
                <input type="submit" value="Enviar" name="newPlace">
            </div>
        </form>
    </div>

    <script>
        
        $(document).ready(function() {
        var currentPage = 1; // Página actual
        var totalPlaces = 0; // Número total de lugares filtrados

        function getFilteredPlaces(page) {
            var department = $('#department').val();
            var type = $('#type').val();
            var public = $('#public').val();

            $.ajax({
            url: 'filters.php',
            method: 'POST',
            data: { department: department, type: type, public: public },
            success: function(response) {
                // Obtener los lugares filtrados
                var filteredPlaces = $(response).find('.card');

                // Actualizar el número total de lugares filtrados
                totalPlaces = filteredPlaces.length;

                // Calcular el número total de páginas
                var totalPages = Math.ceil(totalPlaces / 6);

                // Asegurarse de que la página actual no supere el límite de páginas
                if (page > totalPages) {
                page = totalPages;
                }

                // Calcular el índice de inicio y fin de los lugares en la página actual
                var startIndex = (page - 1) * 6;
                var endIndex = Math.min(startIndex + 5, totalPlaces - 1);

                // Obtener los lugares para la página actual
                var places = filteredPlaces.slice(startIndex, endIndex + 1);

                // Actualizar el contenido de los lugares y la paginación
                $('#placesContainer').html(places);
                generatePagination(totalPages, page);
            }
            });
        }

        function generatePagination(totalPages, currentPage) {
            var paginationHTML = '';

            if (totalPages > 1) {
            paginationHTML += '<li class="page-item previous-page' + (currentPage === 1 ? ' disabled' : '') + '"><a class="page-link" href="#"><i class="fa-sharp fa-solid fa-arrow-left"></i></a></li>';

            for (var i = 1; i <= totalPages; i++) {
                paginationHTML += '<li class="page-item' + (i === currentPage ? ' current-page active' : '') + '"><a class="page-link" href="#">' + i + '</a></li>';
            }

            paginationHTML += '<li class="page-item next-page' + (currentPage === totalPages ? ' disabled' : '') + '"><a class="page-link" href="#"><i class="fa-sharp fa-solid fa-arrow-right"></i></a></li>';
            }

            $('#paginationContainer').html(paginationHTML);
        }

        $('#paginationContainer').on('click', '.page-item', function(e) {
            e.preventDefault();
            var page = $(this).text();
            currentPage = parseInt(page);
            getFilteredPlaces(currentPage);
        });

        $('select').on('change', function() {
            currentPage = 1;
            getFilteredPlaces(currentPage);
        });

        getFilteredPlaces(currentPage);
        });

    </script>


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
    <!--<script>
        document.querySelector('.card').addEventListener('click', function(e){
            e.preventDefault();
            document.querySelector('.popup__container').classList.add('visible');
        })

        document.querySelector('fa-solid fa-xmark').addEventListener('click', function(){
            document.querySelector('.popup__container').classList.remove('visible');
        });
    </script>-->

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
        document.querySelector('.logoImg').addEventListener('click', function(){
            location.href = 'index.php';
        })
    </script>

    <script src="js/pagination.js"></script>
    <script src="js/newPlace.js"></script>
</body>
</html>