<?php
    include 'php/connection.php';
    include 'php/controlador.php';

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

    $sql = "SELECT * FROM places WHERE department = '{$_GET['places']}'";
    $run = mysqli_query($connection, $sql);

    if (!mysqli_num_rows($run)) {
        header("Location: index.php");
    }

    if (isset($_SESSION['isLogin'])) {
        $sql = "SELECT * FROM users WHERE token = '{$_SESSION['user_token']}'";
        $runUser = mysqli_query($connection, $sql);
        $dataUser = mysqli_fetch_array($runUser);
    }
?>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="header__logo"><img src="img/Logo SivarTour BN web.png"></div>
        <div class="options__menu">
            <div class="option notifications">
                <div class="option__title">
                    <i class="fa-regular fa-bell"></i>
                    <h3 data-section="department" data-value="Notificaciones">Notificaciones</h3>
                    <i class="fa-solid fa-chevron-down hideNotis"></i>
                </div>
                <div class="option__info__container hide">
                    <?php
                    if (isset($_SESSION['user_id'])){
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
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="department" data-value="Noti Aceptada">Publicación aceptada</h4>
                                        <p data-section="department" data-value="Mesg acepto">¡Enhorabuena! ¡Tu publicación ha sido aceptada!</p>
                                    </form>
                                    <?php
                                break;
                                case 2:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="department" data-value="Noti Rechazada">Publicación rechazada</h4>
                                        <p  data-section="department" data-value="Mesg rechazo">¡Lo sentimos! ¡Tu publicación ha sido rechazada!</p>
                                    </form>
                                    <?php
                                break;
                                case 3:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="department" data-value="Noti Eliminada">Publicación eliminada</h4>
                                        <p data-section="department" data-value="Mesg acepto">¡Vaya! ¡Tu publicación ha sido eliminada!</p>
                                    </form>
                                    <?php
                                break;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="option profile">
                <i class="fa-regular fa-circle-user"></i>
                <h3 data-section="department" data-value="perfil">Mi perfil</h3>
            </div>
            <div class="option favorites">
                <i class="fa-regular fa-star"></i>
                <h3 data-section="department" data-value="favs">Mis favoritos</h3>
            </div>
            <form method="post" class="option link">
                <i class="fa-solid fa-route"></i>
                <a id="link" href="#" target="_blank" data-section="department" data-value="ruta">Mi ruta</a>
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
    <div class="container">
        <div class="container__left">
            <div class="left__info">
                <h1><?php echo $_GET['places'] ?></h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis, voluptatum! Laborum veniam eum nostrum sit harum fugit distinctio corrupti aut?</p>
            </div>
            <button id="explorarButton" data-section="department" data-value="boton">EXPLORAR</button>
        </div>
        <div class="container__right">
            <div class="right__cards">
                <?php
                    while ($dataPlace = mysqli_fetch_array($run)){
                        ?>
                        <a href="place.php?place=<?php echo $dataPlace['id']; ?>" class="card__container">
                            <div class="card__title">
                                <h2><?php echo $dataPlace['name'] ?></h2>
                                <div class="card__title__stars">
                                    <?php
                                    // Validar que el rating esté entre 1 y 5
                                        $rating = max(1, min(5, $dataPlace['rating']));

                                        // Definir la cantidad de iconos sólidos y regulares
                                        $iconosSolidos = $dataPlace['rating'];
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
                            <div class="card__img">
                                <?php echo '<img src="'.$dataPlace["img1"].'">' ?>
                            </div>
                        </a>
                        <?php
                    }
                ?>
            </div>
            <div class="right__arrows">
                <i class="fa-solid fa-circle-chevron-left prevArrow"></i>
                <i class="fa-solid fa-circle-chevron-right nextArrow"></i>
            </div>
        </div>
    </div>
    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-regular fa-envelope"></i></a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#" data-section="department" data-value="inicio">Inicio</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="department" data-value="sobre nosotros">Sobre nosotros</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="department" data-value="faq">FAQ</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="department" data-value="contacto">Contáctanos</a></li>
        </ul>
    </footer>

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

    <script>
        var checkbox = document.getElementById('cambiar');
        var select = document.getElementById('department');

        // Función para cambiar el idioma
        async function cambiarIdioma(selectedLanguage) {
            const requestJson = await fetch(`languages/department${selectedLanguage === 'en' ? 'Ingles' : 'Español'}.json`);
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



    <script>
        document.getElementById("explorarButton").addEventListener("click", function() {
            var selectedDepartment = document.querySelector('#department option[value="<?php echo $_GET['places'] ?>"]');
            if (selectedDepartment) {
                selectedDepartment.selected = true;
            }
            window.location.href = "filtered.php?selected_department=<?php echo $_GET['places'] ?>";
        });
    </script>
    <script>
        document.querySelector('.showMenu').addEventListener('click', function(e){
            document.querySelector('.options__menu').classList.toggle('show');
            document.querySelector('.showMenu').classList.toggle('black');
        });

        document.querySelector('.hideNotis').addEventListener('click', function(e){
            document.querySelector('.option__info__container').classList.toggle('hide');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-down');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-right');
        });

        document.querySelector('.header__logo').addEventListener('click', function(){
            location.href = 'index.php';
        })

        document.querySelector('.profile').addEventListener('click', function(e){
            location.href = 'profile.php';
        });

        document.querySelector('.favorites').addEventListener('click', function(e){
            location.href = 'collections.php?favorites';
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