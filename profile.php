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

$sql = "SELECT * FROM users WHERE token = '{$_SESSION['user_token']}'";
$run = mysqli_query($connection, $sql);
$data = mysqli_fetch_array($run);

function recursiveUrlDecode($str) {
    while (urldecode($str) !== $str) {
        $str = urldecode($str);
    }
    return $str;
}

$cookieName = 'ultimos_lugares_' . $data['id'];

if (isset($_COOKIE[$cookieName])) {
    $lugaresVisitadosIDs = explode(',', recursiveUrlDecode($_COOKIE[$cookieName]));
} else {
    $lugaresVisitadosIDs = array();
}

if ($data['verified'] == 1) {
    ?>
        <style type="text/css">
            #validar{
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

    <!--Otros-->
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>
    <link rel=&quot;canonical&quot; href=&quot;https://codepen.io/supah/pen/VweRLrQ&quot; />
    <link rel=&quot;stylesheet&quot; href=&quot;https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css&quot;>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi-1W4L7N7-cIt4IClUTcZcJXTlHsdUGU&libraries=places"></script>
    <!--JQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style><?php include 'css/profile.css'; ?></style>
<body>
    <header class="header">
        <div class="header__logo"><img src="img/Logo SivarTour BN web.png"></div>
        <div class="options__menu">
            <div class="option notifications">
                <div class="option__title">
                    <i class="fa-regular fa-bell"></i>
                    <h3 data-section="Profile" data-value="Notificaciones">Notificaciones</h3>
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
                                        <h4 data-section="Profile" data-value="Noti Aceptada">Publicación aceptada</h4>
                                        <p data-section="Profile" data-value="Mesg acepto">¡Enhorabuena! ¡Tu publicación ha sido aceptada!</p>
                                    </form>
                                    <?php
                                break;
                                case 2:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="Profile" data-value="Noti Rechazada">Publicación rechazada</h4>
                                        <p  data-section="Profile" data-value="Mesg rechazo">¡Lo sentimos! ¡Tu publicación ha sido rechazada!</p>
                                    </form>
                                    <?php
                                break;
                                case 3:
                                    ?>
                                    <form method="post" class="option__info">
                                        <button type="button" class="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                        <h4 data-section="Profile" data-value="Noti Eliminada">Publicación eliminada</h4>
                                        <p data-section="Profile" data-value="Mesg acepto">¡Vaya! ¡Tu publicación ha sido eliminada!</p>
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
                <h3 data-section="Profile" data-value="perfil">Mi perfil</h3>
            </div>
            <div class="option favorites">
                <i class="fa-regular fa-star"></i>
                <h3 data-section="Profile" data-value="favs">Mis favoritos</h3>
            </div>
            <form method="post" class="option link">
                <i class="fa-solid fa-route"></i>
                <a id="link" href="#" target="_blank" data-section="Profile" data-value="ruta">Mi ruta</a>
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
    <?php
        if ($notice != "") {
            ?>
            <div class="notice" id="notification">
                <p><?php echo $notice; ?></p>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
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
                });
            </script>
            <?php
        }
    ?>
    <div class="profile__container">
        <div class="profile__left">
            <div class="left__lately">
                <div class="lately__title">
                    <h1 data-section="Profile" data-value="vistos">Vistos recientemente</h1>
                </div>
                <div class="lately__content">
                    <?php
                        foreach ($lugaresVisitadosIDs as $idLugar) {
                            $sqll = "SELECT * FROM places WHERE id = $idLugar";
                            $runn = mysqli_query($connection, $sqll);

                            if (mysqli_num_rows($runn)) {
                                $row = $runn->fetch_assoc();
                                ?>
                                <h2><?php echo $row['name']; ?></h2>
                                <?php
                            }
                        }
                        if (empty($lugaresVisitadosIDs)) {
                            echo "<h3 class='noData' data-section='Profile' data-value='no hay'>Aún no hay lugares por mostrar :c</h3>";
                        }
                    ?>
                </div>
            </div>
            <div class="left__saved">
                <div class="saved__title">
                    <h1 data-section="Profile" data-value="colecciones">Mis colecciones</h1>
                </div>
                <div class="saved__content">
                    <form method="post" class="saved__collection">
                        <button type="submit" name="favoritePage" data-section="Profile" data-value="favos">Favoritos</button>
                    </form>
                    <?php
                    $sql = "SELECT * FROM collections WHERE id_user = {$data['id']}";
                    $run = mysqli_query($connection, $sql);
                    
                    $sqlll = "SELECT collections_share.id_collection, collections_share.id_user, collections.id, collections.name, collections.id_user, collections_share.owner FROM collections_share INNER JOIN collections ON collections_share.id_collection = collections.id WHERE collections_share.id_user = {$data['id']} AND collections_share.owner != 1";
                    $runnn = mysqli_query($connection, $sqlll);

                    while ($dataCollec = mysqli_fetch_assoc($run)){
                        ?>
                            <form method="post" class="saved__collection">
                                <input type="hidden" name="collectionId" value="<?php echo $dataCollec['id'] ?>">
                                <button type="submit" name="collectionPage"><?php echo $dataCollec['name'] ?></button>
                            </form>
                        <?php
                    }

                    if (mysqli_num_rows($runnn)) {
                        while ($dataCollecShare = mysqli_fetch_assoc($runnn)){
                            ?>
                                <form method="post" class="saved__collection">
                                    <input type="hidden" name="collectionId" value="<?php echo $dataCollecShare['id'] ?>">
                                    <button type="submit" name="collectionPage"><?php echo $dataCollecShare['name'] ?></button>
                                </form>
                            <?php
                        }
                    }
                    ?>
                    <i class="fa-solid fa-plus newCollection"></i>
                </div>
            </div>
        </div>
        <div class="profile__right">
            <div class="right__info">
                <div class="right__info__img"><?php echo '<img src="'.$data['img'].'">' ?></div>
                <h1><?php echo $data['name'] ?></h1>
                <h3><?php echo $data['email'] ?></h3>
                <form method="post" class="info__buttons">
                    <button type="submit" name="activeEmail" id="validar" data-section="Profile" data-value="validar">Validar correo</button>
                    <button type="submit" class="logout" data-section="Profile" data-value="sessionclose">Cerrar Sesión</button>
                </form>
            </div>
            <form method="post" class="right__edit">
                <div class="input-field">
                    <input type="number" data-section="Profile" data-value="age" min="10" max="99" name="age" spellcheck="false" onfocus="this.placeholder = 'Edad'" onblur="this.placeholder = ''"> 
                    <label data-section="Profile" data-value="age"><?php echo empty($data['age']) ? "Edad" : $data['age'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" data-section="Profile" data-value="sex" name="sex" spellcheck="false" onfocus="this.placeholder = 'Sexo'" onblur="this.placeholder = ''"> 
                    <label data-section="Profile" data-value="sex"><?php echo empty($data['sex']) ? "Sexo" : $data['sex'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="number" data-section="Profile" data-value="number" name="number" spellcheck="false" onfocus="this.placeholder = 'Número telefónico'" onblur="this.placeholder = ''"> 
                    <label data-section="Profile" data-value="number"><?php echo empty($data['number']) ? "Número telefónico" : $data['number'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" data-section="Profile" data-value="idioma" name="language" spellcheck="false"onfocus="this.placeholder = 'Idioma'" onblur="this.placeholder = ''"> 
                    <label data-section="Profile" data-value="idioma"><?php echo empty($data['language']) ? "Idioma" : $data['language'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="instagram" spellcheck="false"onfocus="this.placeholder = 'Instagram'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['instagram']) ? "Instagram" : $data['instagram'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="twitter" spellcheck="false"onfocus="this.placeholder = 'Twitter'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['twitter']) ? "Twitter" : $data['twitter'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="whatsapp" spellcheck="false"onfocus="this.placeholder = 'Whatsapp'" onblur="this.placeholder = ''"> 
                    <label><?php echo empty($data['whatsapp']) ? "Whatsapp" : $data['whatsapp'];?></label>
                    <i class="fa-solid fa-pen"></i>
                </div>
                <input type="submit" name="userData" data-section="Profile" data-value="guardar" value="Guardar">
            </form>
        </div>
    </div>
    <div class="right__code">
        <h1 data-section="Profile" data-value="txt1">Ingresa el código de verificación</h1>
        <p data-section="Profile" data-value="txt2">Se ha enviado un código de verificación a: <?php echo $data['email']; ?></p>
        <form method="post" class="form__code">
            <input type="text" name="code" id="">
            <input type="submit" data-section="Profile" data-value="aceptar" name="veriCode" value="Aceptar">
        </form>
    </div>
    <div class="popup__container__collection">
        <div class="popup__collection">
            <i class="fa-solid fa-xmark closePop"></i>
            <form method="post" class="popup__field">
                <div class="popu">
                    <div class="popupName">
                        <input type="text" name="name" spellcheck="false"> 
                        <label class="label" data-section="place" data-value="nombre">Nombre de la colección</label>
                    </div>
                    <div class="popupType">
                        <div class="type">
                            <input type="radio" class="checkType" name="type" id="private" value="1">
                            <label for="private" data-section="place" data-value="privada">Privada</label>
                        </div>
                        <div class="type">
                            <input type="radio" class="checkType" name="type" id="public" value="2">
                            <label for="public" data-section="place" data-value="publica">Pública</label>
                        </div>
                    </div>
                </div>
                <div class="field__btn">
                    <input type="submit" name="newCollectionP" value="Añadir">
                </div>
            </form>
        </div>
    </div>
    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-regular fa-envelope"></i></a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#" data-section="Profile" data-value="inicio">Inicio</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="Profile" data-value="sobre nosotros">Sobre nosotros</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="Profile" data-value="faq">FAQ</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="Profile" data-value="contacto">Contáctanos</a></li>
        </ul>
    </footer>

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
        var inputs = document.querySelectorAll('input[data-section][data-value]');
        var labels = document.querySelectorAll('label[data-section][data-value]');

        // Función para cambiar el idioma
        async function cambiarIdioma(selectedLanguage) {
            const requestJson = await fetch(`languages/perfil${selectedLanguage === 'en' ? 'Ingles' : 'Español'}.json`);
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

            inputs.forEach(input => {
                const section = input.dataset.section;
                const value = input.dataset.value;
                if (textos[section] && textos[section][value]) {
                    input.placeholder = textos[section][value];
                }
            });

            labels.forEach(label => {
                const section = label.dataset.section;
                const value = label.dataset.value;
                if (textos[section] && textos[section][value]) {
                    label.textContent = textos[section][value];
                }
            });

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
        document.querySelector('.newCollection').addEventListener('click', function(){
            document.querySelector('.popup__container__collection').classList.add('visible');
            document.querySelector('.popup__field__collections').classList.add('visiblew');
            document.querySelectorAll('.collections').forEach(function(elemento) {
                elemento.classList.add('invisiblew');
            });
        });

        document.querySelector('.closePop').addEventListener('click', function(){
            document.querySelector('.popup__container__collection').classList.remove('visible');
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

        document.querySelector('.showMenu').addEventListener('click', function(e){
            document.querySelector('.options__menu').classList.toggle('show');
            document.querySelector('.showMenu').classList.toggle('black');
        });

        document.querySelector('.hideNotis').addEventListener('click', function(e){
            document.querySelector('.option__info__container').classList.toggle('hide');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-down');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-right');
        });

        document.querySelector('.logout').addEventListener('click', function(e){
            e.preventDefault();
            localStorage.setItem("lugares" , "[]")
            console.log(localStorage.getItem("lugares"))
            location.href = 'php/logout.php';
        });

        document.querySelector('#validar').addEventListener('click', function(){
            document.querySelector('.right__code').classList.add('see');
        });

        document.querySelector('.closeP').addEventListener('click', function(e){
            e.preventDefault();
            document.querySelector('.popup__container').classList.add('invisiblee');
            window.history.replaceState(null,null,window.location.href);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const loaderContainer = document.querySelector(".loader__container");
        loaderContainer.style.display = "none"; // Ocultar el loader después de que la página se haya cargado completamente
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#validar').click(function(event) { // Cambia '#enviar-correo' al ID de tu botón o campo de entrada
                event.preventDefault();

                // Obtener los datos del formulario
                var datosFormulario = $('#formulario').serialize();

                // Enviar los datos mediante AJAX
                $.ajax({
                type: 'POST',
                url: 'mail.php?email=<?php echo $data['email']?>', // Archivo PHP que contiene el código para enviar el correo
                data: datosFormulario,
                success: function(response) {
                    // Manejar la respuesta del servidor después del envío del correo
                    if (response == 'si') {
                        $('#formulario')[0].reset(); // Limpiar el formulario si es necesario
                    } else {
                        alert('Error en el envío del correo. Por favor, inténtalo de nuevo.');
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores en caso de que ocurra algún problema
                    alert('Error en el envío del correo: ' + error);
                }
                });
            });
        });

    </script>
</body>
</html>