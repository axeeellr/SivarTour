<?php
require_once 'php/controlador.php';

if (isset($_SESSION['user_token'])) {
    header("Location: profile.php");
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
<style><?php include('css/login.css') ?></style>
<body>
    <div class="loader__container">
        <div class="loader"></div>
    </div>
    <div class="translate">
        <input type="checkbox" id="cambiar">
        <label for="cambiar">aquí se cambia el idioma</label>
    </div>
    <div class="container">
        <div class="forms-container">
            <?php
                if ($error != "") {
                    ?>
                    <div class="notice" id="notification">
                        <p><?php echo $error; ?></p>
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
            <div class="signin-signup">
                <form method="post" class="sign-in-form">
                    <h2 class="title" data-section="Login" data-value="inicio">Iniciar Sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Correo" data-section="Login" data-value="correo" required/>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Contraseña" data-section="Login" data-value="password" required/>
                    </div>
                    <input type="submit" value="Entrar" name="login" data-section="Login" data-value="entrar" class="btn solid" />
                    <p class="social-text" data-section="Login" data-value="so">También puedes usar</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?php echo $client->createAuthUrl() ?>" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                </form>


                <form method="post" class="sign-up-form" enctype="multipart/form-data">
                    <h2 class="title" data-section="Login" data-value="registro">Registrarse</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Nombre" data-section="Login" data-value="name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Correo" data-section="Login" data-value="correo1" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Contraseña" data-section="Login" data-value="password1" required />
                    </div>
                    <div class="input-field-avatars">
                        <h2>Escoge un avatar o sube tu propia foto</h2>
                        <div class="avatars" id="avatarContainer">
                            <label class="labelAvatar">
                                <input type="radio" value="img/woman1.png" id="av1" name="avatar" required>
                                <img src="img/woman1.png" alt="">
                            </label>
                            <label class="labelAvatar">
                                <input type="radio" value="img/man1.png" id="av2" name="avatar" required>
                                <img src="img/man1.png" alt="">
                            </label>
                            <label class="labelAvatar">
                                <input type="radio" value="img/woman2.png" id="av3" name="avatar" required>
                                <img src="img/woman2.png" alt="Avatar 2">
                            </label>
                            <label class="labelAvatar">
                                <input type="radio" value="img/man2.png" id="av4" name="avatar" required>
                                <img src="img/man2.png" alt="">
                            </label>
                            <input type="file" id="upload" name="profilePic" accept="image/*" style="display: none;">
                            <label for="upload" class="upload-label">
                                <i class="fa-solid fa-plus"></i>
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn" name="register" data-section="Login" data-value="entrar1" value="Entrar" />
                    <p class="social-text" data-section="Login" data-value="so1">También puedes usar</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?php echo $client->createAuthUrl() ?>" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3 data-section="Login" data-value="primera">¿Primera vez?</h3>
                    <button class="btn_panel" id="sign-up-btn" data-section="Login" data-value="reg">
                        Registro
                    </button>
                </div>
                <img src="/img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3 data-section="Login" data-value="uno">¿Uno de nosotros?</h3>
                    <button class="btn_panel" id="sign-in-btn" data-section="Login" data-value="boton">
                        Iniciar Sesión
                    </button>
                </div>
                <img src="/img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>
    
    <!--<div class="error__container">
        <div class="error">
            <i class="fa-solid fa-xmark close"></i>
            <p>Los datos no coinciden</p>
        </div>
    </div>-->

    <script>
    const avatarContainer = document.getElementById('avatarContainer');
    const uploadInput = document.getElementById('upload');
    const uploadedImageElement = document.createElement('img');
    uploadedImageElement.id = 'uploadedImage';
    uploadedImageElement.alt = 'Uploaded Image';
    uploadedImageElement.style.display = 'none';
    avatarContainer.appendChild(uploadedImageElement);

    uploadInput.addEventListener('change', function (event) {
        const uploadedImage = event.target.files[0];

        // Mostrar la imagen subida en lugar de los avatares predefinidos
        uploadedImageElement.src = URL.createObjectURL(uploadedImage);
        uploadedImageElement.style.display = 'block';
        uploadedImageElement.style.maxWidth = '75px';
        uploadedImageElement.style.maxHeight = '75px';
        uploadedImageElement.style.order = '1';
        document.querySelector('.upload-label').style.order = '2';

        // Eliminar los avatares predefinidos (elementos con la clase "labelAvatar")
        const labelAvatars = document.querySelectorAll('.labelAvatar');
        labelAvatars.forEach(labelAvatar => {
            labelAvatar.remove();
        });
    });
</script>

    <script>
        document.querySelector('.close').addEventListener('click', function(){
            document.querySelector('.error__container').classList.add('invisiblee');
            window.history.replaceState(null,null,window.location.href);
        });
    </script>

    <script>
        // script.js
        const avatarLabels = document.querySelectorAll('.avatars label:not(.upload-label)');

        avatarLabels.forEach(label => {
            label.addEventListener('click', () => {
                avatarLabels.forEach(label => {
                    label.style.border = 'none';
                });
                label.style.border = '3px dashed #f0f4ef';
            });
        });

        const uploadLabel = document.querySelector('.upload-label');

        uploadLabel.addEventListener('click', () => {
            avatarLabels.forEach(label => {
                label.style.border = 'none';
            });
        });
    </script>

    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });
    </script>

    <script>
        var checkbox = document.getElementById('cambiar');
        var select = document.getElementById('department');
        var inputs = document.querySelectorAll('input[data-section][data-value]');

        // Función para cambiar el idioma
        async function cambiarIdioma(selectedLanguage) {
            const requestJson = await fetch(`languages/forms${selectedLanguage === 'en' ? 'Ingles' : 'Español'}.json`);
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
        document.addEventListener("DOMContentLoaded", function () {
        const loaderContainer = document.querySelector(".loader__container");
        loaderContainer.style.display = "none"; // Ocultar el loader después de que la página se haya cargado completamente
        });
    </script>
</body>

</html>