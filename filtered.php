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
                .option:nth-child(2), .option:nth-child(3), .option:nth-child(4){
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
<style><?php include 'css/filtered.css'?></style>
<body>
    <div class="areaC" >
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div >
    <div class="loader__container">
        <div class="loader"></div>
    </div>
    <header class="header">
        <div class="header__logo"><img src="img/Logo SivarTour BN web.png"></div>
        <nav class="header__nav">
            <form method="post" class="header__ul">
                <input type="submit" name="goLogin" class="header__li" data-section="Filtered" data-value="Registro" value="Registrarse" >
                <input type="submit" name="goLogin" class="header__li" data-section="Filtered" data-value="Inicio Sesion" value="Iniciar Sesión">
            </form>
        </nav>
        <div class="options__menu">
            <div class="option notifications">
                <div class="option__title">
                    <i class="fa-regular fa-bell"></i>
                    <h3 data-section="Filtered" data-value="Notificaciones">Notificaciones</h3>
                    <i class="fa-solid fa-chevron-down hideNotis"></i>
                </div>
                <div class="option__info__container hide">
                    <?php
                        if (isset($_SESSION['user_id'])) {
                            $noti = "SELECT * FROM notifications WHERE id_user = {$_SESSION['user_id']} LIMIT 5";
                            $runNoti = mysqli_query($connection, $noti);
    
                            while ($rowNoti = mysqli_fetch_array($runNoti)) {
                                switch ($rowNoti['type']) {
                                    case 1:
                                        ?>
                                        <form method="post" class="option__info">
                                            <button type="submit" name="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                            <h4 data-section="Filtered" data-value="Noti Aceptada">Publicación aceptada</h4>
                                            <p data-section="Filtered" data-value="Mesg acepto">¡Enhorabuena! ¡Tu publicación ha sido aceptada!</p>
                                        </form>
                                        <?php
                                    break;
                                    case 2:
                                        ?>
                                        <form method="post" class="option__info">
                                            <button type="submit" name="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                            <h4 data-section="Filtered" data-value="Noti Rechazada">Publicación rechazada</h4>
                                            <p  data-section="Filtered" data-value="Mesg rechazo">¡Lo sentimos! ¡Tu publicación ha sido rechazada!</p>
                                        </form>
                                        <?php
                                    break;
                                    case 3:
                                        ?>
                                        <form method="post" class="option__info">
                                            <button type="submit" name="closeNoti" value="<?php echo $rowNoti['id'] ?>"><i class="fa-solid fa-xmark closeN"></i></button>
                                            <h4 data-section="Filtered" data-value="Noti Eliminada">Publicación eliminada</h4>
                                            <p data-section="Filtered" data-value="Mesg eliminado">¡Vaya! ¡Tu publicación ha sido eliminada!</p>
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
                <h3 data-section="Filtered" data-value="perfil">Mi perfil</h3>
            </div>
            <div class="option favorites">
                <i class="fa-regular fa-star"></i>
                <h3 data-section="Filtered" data-value="favs">Mis favoritos</h3>
            </div>
            <form method="post" class="option link">
                <i class="fa-solid fa-route"></i>
                <a id="link" href="#" target="_blank">Mi ruta</a>
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
    <hr>

    <div class="filters" id="filters">
        <select name="" id="department">
            <option data-section="Filtered" data-value="Departamento" value="">Departamento</option>
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
            <option data-section="Filtered" data-value="Tipo" value="">Tipo</option>
            <option data-section="Filtered" data-value="Playa" value="Playa">Playa</option>
            <option data-section="Filtered" data-value="Campo" value="Campo">Campo</option>
            <option data-section="Filtered" data-value="Cabañas" value="Cabañas">Cabañas</option>
            <option data-section="Filtered" data-value="Parques" value="Parque">Parque</option>
            <option data-section="Filtered" data-value="Bosque" value="Bosque">Bosque</option>
            <option data-section="Filtered" data-value="Lago" value="Lago">Lago</option>
            <option data-section="Filtered" data-value="Sitio" value="Sitio Arqueológico">Sitio Arqueológico</option>
            <option data-section="Filtered" data-value="Volcán" value="Volcán">Volcán</option>
            <option data-section="Filtered" data-value="Centro" value="Centro Comercial">Centro Comercial</option>
            <option data-section="Filtered" data-value="Montaña" value="Montaña">Montaña</option>
            <option data-section="Filtered" data-value="Otro" value="Otro">Otro</option>
        </select>
        <select name="" id="public">
            <option data-section="Filtered" data-value="Público" value="">Público</option>
            <option data-section="Filtered" data-value="Todo" value="Todo público">Todo público</option>
            <option data-section="Filtered" data-value="Solo" value="Solo mayores de 18">Solo mayores de 18</option>
            <option data-section="Filtered" data-value="Especial"value="Especial para niños">Especial para niños</option>
        </select>
    </div>
    <div class="container">
 
            <div id="placesContainer" class="cards">
            
            </div>

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
            <h2 data-section="Filtered">Espera</h2>
            <p data-section="Filtered">Tienes que estar registrado para poder ver este lugar</p>
        </div>
    </div>
    <div class="newplace__container">
        <form method="post" id="newPlaceForm" class="newplace" enctype="multipart/form-data">
            <i class="fa-solid fa-xmark close__newplace"></i>
            <div class="newplace__img">
                <input type="file" name="images[]" id="upload-button" required multiple accept="image/*" />
                <label for="upload-button">
                    <i class="fa-solid fa-upload" data-section="Filtered"></i>&nbsp; Escoge las fotos
                </label>
                <p data-section="Filtered">Recuerda que el total de fotografías es 3</p>
                <div id="error"></div>
                <div id="image-display"></div>
            </div>
            <div class="newplace__info">
            <div class="info__title">
                    <h1 data-section="Filtered">Tú también puedes publicar lugares!</h1>
                    <p data-section="Filtered">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque molestias id culpa amet impedit? Vero consequatur ipsum earum iure odio?</p>
                </div>
                <div class="input__field">
                    <input type="text" name="name" required spellcheck="false">
                    <label data-section="Filtered">Nombre</label>
                </div>
                <div class="input__field">
                    <input type="text" name="description" required spellcheck="false">
                    <label data-section="Filtered">Descripción</label>
                </div>
                <div class="input__field">
                    <input type="text" id="search-place" name="direction" placeholder="" required spellcheck="false">
                    <input type="hidden" name="location" id="location">
                    <label data-section="Filtered">Ubicación</label>
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
                    <select name="type" id="">
                        <option data-section="Filtered" value="" selected disabled>Tipo</option>
                        <option data-section="Filtered" value="Playa">Playa</option>
                        <option data-section="Filtered" value="Campo">Campo</option>
                        <option data-section="Filtered" value="Cabañas">Cabañas</option>
                        <option data-section="Filtered" value="Parque">Parque</option>
                        <option data-section="Filtered"value="Bosque">Bosque</option>
                        <option data-section="Filtered" value="Lago">Lago</option>
                        <option data-section="Filtered" value="Sitio Arqueológico">Sitio Arqueológico</option>
                        <option data-section="Filtered" value="Volcán">Volcán</option>
                        <option data-section="Filtered" value="Centro Comercial">Centro Comercial</option>
                        <option data-section="Filtered" value="Montaña">Montaña</option>
                        <option data-section="Filtered" value="Otro">Otro</option>
                    </select>
                </div>
                <div class="input__field">
                    <select name="public" id="">
                        <option data-section="Filtered" value="" selected disabled>Público</option>
                        <option data-section="Filtered" value="Todo público">Todo público</option>
                        <option data-section="Filtered" value="Solo mayores de 18">Solo mayores de 18</option>
                        <option data-section="Filtered" value="Especial para niños">Especial para niños</option>
                    </select>
                </div>
                <input type="submit" data-section="Filtered" value="Enviar" name="newPlace">
            </div>
        </form>
    </div>
    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-regular fa-envelope"></i></a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#" data-section="Filtered">Inicio</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="Filtered">Acerca de</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="Filtered">FAQ</a></li>
            <li class="menu__item"><a class="menu__link" href="#" data-section="Filtered">Contáctanos</a></li>
        </ul>
    </footer>


    <script>
        var checkbox = document.getElementById('cambiar');
        var select = document.getElementById('department');

        checkbox.addEventListener('change', async function (){
            var checked = checkbox.checked;
            if(checked){
                const requestJson = await fetch(`languages/filteredIngles.json`);
                const textosCambioIdioma = document.querySelectorAll("[data-section]");
                const textos = await requestJson.json();
                for (let i = 0; i < select.options.length; i++) {
                        const option = select.options[i];
                            const valor = option.value;
                            if (textos[valor]) {
                    option.innerHTML = textos[valor];
                    }
                }
                    
                //For para hacer el cambio de valores
                for (const textosCambioIdiomaVariable of textosCambioIdioma) {
                    const secciones = textosCambioIdiomaVariable.dataset.section;
                    const valor = textosCambioIdiomaVariable.dataset.value;
                    // 
                    //Condicion para cambiar los valores
                    if (textos[secciones] && textos[secciones][valor]) {
                        if (textosCambioIdiomaVariable.value) {
                            textosCambioIdiomaVariable.value = textos[secciones][valor];
                        }
                        textosCambioIdiomaVariable.innerHTML = textos[secciones][valor];
                    }
                }
                //Target para el cambio de elementos por los del json
                elements.addEventListener("click", function (e) {
                    cambioIdioma(e.target.parentElement.dataset.language);
                    language = e.target.parentElement.dataset.language;
                });
            }else{
                const requestJson = await fetch(`languages/filteredEspañol.json`);
                const textosCambioIdioma = document.querySelectorAll("[data-section]");
                const textos = await requestJson.json();
                for (let i = 0; i < select.options.length; i++) {
                        const option = select.options[i];
                            const valor = option.value; if (textos[valor]) {
                    option.innerHTML = textos[valor];
                    }
                    }

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
                    language = e.target.parentElement.dataset.language;
                });
            }
        });
    </script>


    <script>
        window.addEventListener("DOMContentLoaded", function() {
            var urlParams = new URLSearchParams(window.location.search);
            var selectedDepartment = urlParams.get('selected_department');
            
            if (selectedDepartment) {
                var departmentSelect = document.querySelector('#department');
                var selectedOption = departmentSelect.querySelector('option[value="' + selectedDepartment + '"]');
                
                if (selectedOption) {
                    selectedOption.selected = true;
                }
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            const itemsPerPage = 6; // Número de lugares por página
            let currentPage = 1;
            let filteredData = []; // Almacenar los lugares filtrados

            // Función para cargar y mostrar los lugares en la página actual
            function loadPlaces() {
                const start = (currentPage - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const placesToShow = filteredData.slice(start, end);

                const placesContainer = $('#placesContainer');
                placesContainer.empty();

                placesToShow.forEach((place) => {
                    const ratingHTML = generateRatingStars(place.rating);
                    const card = `
                    <a href="place.php?place=${place.id}" class="card">
                        <div class="card__img">
                            <img src="${place.img1}">
                        </div>
                        <div class="card__info">
                            <h2>${place.name}</h2>
                            <div class="card__info__stars">
                                ${ratingHTML}
                            </div>
                        </div>
                    </a>
                    `;
                    placesContainer.append(card);
                });
            }

            // Función para generar el HTML de las estrellas de calificación según la calificación del lugar
            function generateRatingStars(rating) {
                const maxRating = 5; // Máximo número de estrellas
                const fullStar = '<i class="fa-solid fa-star"></i>';
                const emptyStar = '<i class="fa-regular fa-star"></i>';

                const fullStars = Math.floor(rating); // Número de estrellas llenas
                const hasHalfStar = rating % 1 !== 0; // Si hay un número decimal, agregar media estrella

                let ratingHTML = '';

                for (let i = 0; i < fullStars; i++) {
                    ratingHTML += fullStar;
                }

                if (hasHalfStar) {
                    ratingHTML += '<i class="fa-solid fa-star-half"></i>';
                }

                const emptyStars = maxRating - Math.ceil(rating);
                for (let i = 0; i < emptyStars; i++) {
                    ratingHTML += emptyStar;
                }

                return ratingHTML;
            }

            // Función para cargar y mostrar la paginación
            function loadPagination() {
                const paginationContainer = $('#paginationContainer');
                paginationContainer.empty();

                // Número de páginas según la cantidad de lugares filtrados
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);

                // Crear la estructura de la paginación
                let paginationHTML = `
                    <li class="page-item previous-page"><a class="page-link" href="#">&lt;</a></li>
                `;

                for (let i = 1; i <= totalPages; i++) {
                    paginationHTML += `<li class="page-item current-page"><a class="page-link" href="#">${i}</a></li>`;
                }

                paginationHTML += `
                    <li class="page-item next-page"><a class="page-link" href="#">&gt;</a></li>
                `;

                paginationContainer.html(paginationHTML);

                // Agregar clases "active" y "disable" a los botones de paginación según la página actual
                $('.page-item').removeClass('active');
                $('.current-page:eq(' + (currentPage - 1) + ')').addClass('active');

                if (currentPage === 1) {
                    $('.previous-page').addClass('disable');
                }

                if (currentPage === totalPages) {
                    $('.next-page').addClass('disable');
                }
            }

            // Función para obtener los lugares filtrados mediante AJAX
            function getFilteredPlaces() {
                const department = $('#department').val();
                const type = $('#type').val();
                const publicOption = $('#public').val();

                $.ajax({
                    method: 'POST',
                    url: 'filters.php', // Archivo PHP que realizará la consulta a la base de datos
                    data: { department, type, public: publicOption },
                    dataType: 'json',
                    success: function (response) {
                    filteredData = response;
                    currentPage = 1;
                    loadPagination();
                    loadPlaces();
                    },
                    error: function (error) {
                    console.error('Error al obtener los lugares filtrados:', error);
                    },
                });
            }

            // Evento para cambiar de página
            $(document).on('click', '.current-page', function (e) {
                e.preventDefault();
                currentPage = parseInt($(this).text());
                loadPagination();
                loadPlaces();
            });

            // Eventos para cambiar a la página anterior o siguiente
            $(document).on('click', '.previous-page', function (e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    loadPagination();
                    loadPlaces();
                }
            });

            $(document).on('click', '.next-page', function (e) {
                e.preventDefault();
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    loadPagination();
                    loadPlaces();
                }
            });

            // Eventos para actualizar los lugares filtrados al cambiar alguna opción del filtro
            $('#department, #type, #public').on('change', function () {
            getFilteredPlaces();
            });

            // Cargar los lugares iniciales al cargar la página
            getFilteredPlaces();
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
        document.addEventListener("DOMContentLoaded", function () {
        const loaderContainer = document.querySelector(".loader__container");
        loaderContainer.style.display = "none"; // Ocultar el loader después de que la página se haya cargado completamente
        });
    </script>

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
    $(document).ready(function() {
        // Obtener el campo de entrada
        var input = document.getElementById('search-place');

        // Crear el objeto de autocompletado de Google Maps con restricciones para El Salvador
        var autocomplete = new google.maps.places.Autocomplete(input, {
            componentRestrictions: { country: 'sv' } // 'sv' es el código ISO 3166-1 alfa-2 de El Salvador
        });

        // Variable para almacenar la dirección formateada del lugar seleccionado
        var selectedAddress = null;

        // Evento que se ejecuta cuando se selecciona un lugar en el campo de autocompletado
        autocomplete.addListener('place_changed', function() {
        // Obtener el lugar seleccionado
        var place = autocomplete.getPlace();

        // Verificar si se seleccionó un lugar válido
        if (place.formatted_address) {
            // Obtener la dirección formateada del lugar
            selectedAddress = place.formatted_address;
        } else {
            // Si el lugar no es válido, reiniciar la variable
            selectedAddress = null;
        }
        });

        // Agregar un evento al formulario para enviar la dirección al servidor cuando se envíe
        $('#newPlaceForm').on('submit', function(event) {
        // Asignar la dirección formateada al campo oculto en el formulario
        $('#location').val(selectedAddress);
        });
    });
    </script>

    <scripts src="js/pagination.js"></script>
    <script src="js/newPlace.js"></script>
</body>
</html>