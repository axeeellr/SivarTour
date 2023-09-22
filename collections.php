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
            .option:nth-child(2), .option:nth-child(3), .option:nth-child(4){
                display: none;
            }
        </style>
    <?php
}

if (isset($_SESSION['collectionId'])) {
    $sql = "SELECT * FROM collections WHERE id = {$_SESSION['collectionId']}";
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
                    <h3 data-section="coll" data-value="Notificaciones">Notificaciones</h3>
                    <i class="fa-solid fa-chevron-down hideNotis"></i>
                </div>
                <div class="option__info__container hide">
                    <?php
                        $noti = "SELECT * FROM notifications WHERE id_user = {$_SESSION['user_id']} LIMIT 5";
                        $runNoti = mysqli_query($connection, $noti);

                        if (mysqli_num_rows($runNoti) == 0) {
                            echo "<h4 class='noDataN'>No tienes notificaciones :c</h4>";
                        }

                        while ($rowNoti = mysqli_fetch_array($runNoti)) {
                            switch ($rowNoti['type']) {
                                case 1:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="coll" data-value="Noti Aceptada">Publicación aceptada</h4>
                                        <p data-section="coll" data-value="Mesg acepto">¡Enhorabuena! ¡Tu publicación ha sido aceptada!</p>
                                    </form>
                                    <?php
                                break;
                                case 2:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="coll" data-value="Noti Rechazada">Publicación rechazada</h4>
                                        <p  data-section="coll" data-value="Mesg rechazo">¡Lo sentimos! ¡Tu publicación ha sido rechazada!</p>
                                    </form>
                                    <?php
                                break;
                                case 3:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="coll" data-value="Noti Eliminada">Publicación eliminada</h4>
                                        <p data-section="coll" data-value="Mesg acepto">¡Vaya! ¡Tu publicación ha sido eliminada!</p>
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
                <h3 data-section="coll" data-value="perfil">Mi perfil</h3>
            </div>
            <div class="option favorites">
                <i class="fa-regular fa-star"></i>
                <h3 data-section="coll" data-value="favs">Mis favoritos</h3>
            </div>
            <form method="post" class="option link">
                <i class="fa-solid fa-route"></i>
                <a id="link" href="#" target="_blank" data-section="coll" data-value="ruta">Mi ruta</a>
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
    <div class="collections__container">
        <div class="collections__header">
            <h1><?php echo isset($_GET['favorites']) ? "<span data-section='coll' data-value='mis'>Mis Favoritos</span>" : $row['name']; ?>&nbsp;<?php echo (isset($_GET['favorites']) || $row['type'] == 1) ? '' : '<i class="fa-solid fa-link url" onclick="copyToClipboard(\''.$row['url'].'\')"></i>'; ?></h1>
            <p><?php echo (isset($_GET['favorites']) || $row['type'] == 1) ? "<span data-section='coll' data-value='priv'>Colección privada</span>" : "<span data-section='coll' data-value='publi'>Colección pública</span>"; ?></p>
            
            <?php 
                if (!isset($_GET['favorites']) && $row['type'] == 2) {
                    ?>
                    <div class="collections__header__users">
                        <?php
                        $sqlCollections = "SELECT * FROM collections_share INNER JOIN users ON collections_share.id_user = users.id WHERE collections_share.id_collection = {$_SESSION['collectionId']}";
                        $runCollections = mysqli_query($connection, $sqlCollections);
        
                        $totalResults = mysqli_num_rows($runCollections); // Obtener el total de resultados
                        $displayedResults = 0; // Contador de resultados mostrados
        
                        while ($dataCollectionsUsers = mysqli_fetch_array($runCollections)) {
                            $letter = substr($dataCollectionsUsers['name'], 0, 1);
                            echo '<div class="user" style="z-index: '.($displayedResults + 1).'; margin-left: calc(-1.2px - 1.2vw);"><img src="'.$dataCollectionsUsers['img'].'" alt=""></div>';
        
                            $displayedResults++;
                            
                            if ($displayedResults == 4 && $totalResults > 4) {
                                $remainingResults = $totalResults - 4;
                                echo '<div class="userMore">+' . $remainingResults . '</div>';
                                break;
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="collections__body">
            <?php 
                if (isset($_GET['favorites'])) {
                    $getFavorites = "SELECT * FROM user_ratings INNER JOIN places ON user_ratings.place_id = places.id WHERE user_ratings.user_id = {$_SESSION['user_id']}";
                    $runFavorites = mysqli_query($connection, $getFavorites);

                    if (mysqli_num_rows($runFavorites) == 0) {
                        echo "<h3 class='noData' data-section='coll' data-value='no hay'>No hay lugares por mostrar :c</h3>";
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
                        echo "<h3 class='noData' data-section='coll' data-value='no hay'>No hay lugares por mostrar :c</h3>";
                    }
    
                    while($dataPlaces = mysqli_fetch_assoc($runPlaces)){
                        ?>
                            <a href="place.php?place=<?php echo $dataPlaces['id']; ?>"><div class="collection">
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
                            </div></a>
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
            <li class="menu__item"><a class="menu__link" data-section='coll' data-value='inicio' href="#">Inicio</a></li>
            <li class="menu__item"><a class="menu__link" data-section='coll' data-value='sobre nosotros' href="#">Acerca de</a></li>
            <li class="menu__item"><a class="menu__link" data-section='coll' data-value='faq' href="#">FAQ</a></li>
            <li class="menu__item"><a class="menu__link" data-section='coll' data-value='contacto' href="#">Contáctanos</a></li>
        </ul>
    </footer>

    <div class="container__popup">
        <div class="popup">
            <i class="fa-solid fa-xmark closePop"></i>
            <?php
                if (!isset($_GET['favorites']) || $row['type'] == 2) {
                    $sqlCollectionss = "SELECT * FROM collections_share INNER JOIN users ON collections_share.id_user = users.id WHERE collections_share.id_collection = {$_SESSION['collectionId']}";
                    $runCollectionss = mysqli_query($connection, $sqlCollectionss);
    
                    while ($dataCollectionsUserss = mysqli_fetch_assoc($runCollectionss)) {
                        ?>
                            <form method="post" class="popup__user">
                                <?php
                                    $letterr = substr($dataCollectionsUserss['name'], 0, 1);
                                    echo '<input type="hidden" name="idUserComment" value='.$dataCollectionsUserss['id_user'].'>';
                                    echo ($dataCollectionsUserss['img'] == "") ? '<div class="popup__user__img"><h1>'.$letterr.'</h1></div>' : '<div class="popup__user__img"><img src="'.$dataCollectionsUserss['img'].'" alt=""></div>';
                                    echo '<button type="submit" name="goUser"><h1 class="popup__user__name">'.$dataCollectionsUserss["name"].'</h1></button>';
                                ?>
                            </form>
                        <?php
                    }
                }


            ?>
        </div>
    </div>

    <div class="notice" id="notification">
        <p>Enlace copiado al portapapeles!</p>
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
        document.querySelector('.collections__header__users').addEventListener('click', function(){
            document.querySelector('.container__popup').classList.add('visible');
        })

        document.querySelector('.closePop').addEventListener('click', function(){
            document.querySelector('.container__popup').classList.remove('visible');
        });

        document.querySelector('.new').addEventListener('click', function(){
            document.querySelector('.popup__field').classList.add('visiblew');
            document.querySelectorAll('.collections').forEach(function(elemento) {
                elemento.classList.add('invisiblew');
            });
            document.querySelector('.new').classList.add('invisiblew');
        });
    </script>

    <script>
        function copyToClipboard(text) {
            var tempInput = document.createElement("input");
            document.body.appendChild(tempInput);
            tempInput.value = text;
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            console.log("Texto copiado al portapapeles: " + text);

            const notice = document.getElementById('notification');
            
            // Mostrar la notificación después de un retraso
            setTimeout(function () {
                notice.classList.add('active');
            }, 10);

            // Ocultar la notificación después de 3 segundos
            setTimeout(function () {
                notice.classList.remove('active');
                window.history.replaceState(null,null,window.location.href);
            }, 3000);
        }
    </script>

    <script>
        $(document).ready(function () {
            // Evento para cerrar una notificación
            $(document).on('click', '.closeNoti', function (e) {
                e.preventDefault();
                const notificationId = $(this).val();
                const $notificationContainer = $(this).closest('.option__info');

                $.ajax({
                    method: 'POST',
                    url: 'notis.php',
                    data: { notificationId },
                    success: function () {
                        // Eliminar la notificación visualmente
                        $notificationContainer.remove();
                    },
                    error: function (error) {
                        console.error('Error al eliminar la notificación:', error);
                    }
                });
            });
        });
    </script>

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

    <!-- Traductor -->
    <script>
        var checkbox = document.getElementById('cambiar');
        var select = document.getElementById('department');

        // Función para cambiar el idioma
        async function cambiarIdioma(selectedLanguage) {
            const requestJson = await fetch(`languages/collections${selectedLanguage === 'en' ? 'Ingles' : 'Español'}.json`);
            const textosCambioIdioma = document.querySelectorAll("[data-section]");
            const textos = await requestJson.json();

            for (const textosCambioIdiomaVariable of textosCambioIdioma) {
                const secciones = textosCambioIdiomaVariable.dataset.section;
                const valor = textosCambioIdiomaVariable.dataset.value;

                if (textos[secciones] && textos[secciones][valor]) {
                    if (textosCambioIdiomaVariable.value) {
                        textosCambioIdiomaVariable.value = textos[secciones][valor];
                    }
                    textosCambioIdiomaVariable.innerHTML = textos[secciones][valor];
                }
            }

            elements.addEventListener("click", function (e) {
                cambioIdioma(e.target.parentElement.dataset.language);
                localStorage.setItem('selectedLanguage', selectedLanguage); // Guardar el idioma seleccionado
            });
        }

        // Event listener para el cambio de idioma
        checkbox.addEventListener('change', function () {
            const checked = checkbox.checked;
            const selectedLanguage = checked ? 'en' : 'es';
            cambiarIdioma(selectedLanguage);
            if (checked) {
                localStorage.setItem('selectedLanguage', selectedLanguage);
            } else {
                localStorage.removeItem('selectedLanguage');
            }
        });

        // Al cargar la página, cargar el idioma guardado si es inglés
        window.addEventListener('load', function () {
            const selectedLanguage = localStorage.getItem('selectedLanguage');
            if (selectedLanguage === 'en') {
                checkbox.checked = true;
                cambiarIdioma('en');
            } else if (selectedLanguage === 'es') {
                checkbox.checked = false;
                cambiarIdioma('es');
            }
        });
    </script>
</body>
</html>