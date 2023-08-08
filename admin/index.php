<?php include '../php/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>
    <link rel=&quot;canonical&quot; href=&quot;https://codepen.io/supah/pen/VweRLrQ&quot; />
    <link rel=&quot;stylesheet&quot; href=&quot;https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css&quot;>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi-1W4L7N7-cIt4IClUTcZcJXTlHsdUGU&libraries=places"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<style><?php include '../css/admin.css' ?></style>
<body>
    <div class="admin__container">
        <div class="admin__left">
            <div class="left__option placesOption">
                <i class="fa-solid fa-location-dot"></i>
                <h1>Lugares</h1>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="menu__item showPlaces">
                <h1>Añadir lugar</h1>
            </div>
            <div class="left__option restaurantsOption">
                <i class="fa-solid fa-utensils"></i>
                <h1>Restaurantes</h1>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="menu__item showRestaurants">
                <h1>Añadir restaurante</h1>
            </div>
            <div class="left__option">
                <i class="fa-solid fa-comment"></i>
                <h1>Comentarios</h1>
            </div>
            <div class="left__option usersOption">
                <i class="fa-solid fa-user"></i>
                <h1>Usuarios</h1>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="menu__item showUsers">
                <div class="item gestion">
                    <h1>Desbloquear usuarios</h1>
                </div>
            </div>
        </div>
        <div class="admin__right">
            <div class="places">
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
            </div>
            <div class="places__add newplace">
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
                    <div class="input__field">
                        <input type="text" name="name" required spellcheck="false"> 
                        <label>Nombre</label>
                    </div>
                    <div class="input__field">
                        <input type="text" name="description" required spellcheck="false"> 
                        <label>Descripción</label>
                    </div>
                    <div class="input__field">
                        <input type="text" id="search-place" name="direction" placeholder="" required spellcheck="false">
                        <input type="hidden" name="location" id="location">
                        <label>Ubicación</label>
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
            </div>
            <div class="restaurants">
                <div class="place__body__right">
                    <div class="body__restaurant">
                        <form class="restaurant__info">
                            <div class="circle"></div>
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                            <h2>Rock & Roe´s</h2>
                            <button type="submit" class="deleteRes"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <form class="restaurant__info">
                            <div class="circle"></div>
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                            <h2>Rock & Roe´s</h2>
                            <button type="submit" class="deleteRes"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <form class="restaurant__info">
                            <div class="circle"></div>
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                            <h2>Rock & Roe´s</h2>
                            <button type="submit" class="deleteRes"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <div class="restaurant__place">
                            <h1>El Tunco</h1>
                        </div>
                    </div>
                    <div class="body__restaurant">
                        <form class="restaurant__info">
                            <div class="circle"></div>
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                            <h2>Rock & Roe´s</h2>
                            <button type="submit" class="deleteRes"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <form class="restaurant__info">
                            <div class="circle"></div>
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                            <h2>Rock & Roe´s</h2>
                            <button type="submit" class="deleteRes"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <form class="restaurant__info">
                            <div class="circle"></div>
                            <img src="https://media-cdn.tripadvisor.com/media/photo-s/16/1f/8c/70/dale-dale-cafe.jpg" alt="">
                            <h2>Rock & Roe´s</h2>
                            <button type="submit" class="deleteRes"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <div class="restaurant__place">
                            <h1>El Tunco</h1>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" class="newplace__restaurant" id="newPlaceForm" enctype="multipart/form-data">
                <i class="fa-solid fa-xmark close__newplace"></i>
                <div class="newplace__img">
                    <input type="file" name="image" id="upload-button" required accept="image/*" />
                    <label for="upload-button">
                        <i class="fa-solid fa-upload"></i>&nbsp; Fotografía
                    </label>
                    <p>Recuerda que el total de fotos es 1</p>
                    <div id="error"></div>
                    <div id="image-display"></div>
                </div>
                <div class="newplace__info">
                    <div class="input__field">
                        <input type="text" name="name" required spellcheck="false"> 
                        <label>Nombre del restaurante</label>
                    </div>
                    <div class="input__field">
                        <input type="text" name="nameDepartment" required spellcheck="false"> 
                        <label>Nombre del departmento</label>
                    </div>
                    <input type="submit" value="Enviar" name="newPlace">
                </div>
            </form>
            <div class="comments">

            </div>
            <div class="users">
                <div class="users__head">
                    <h2>ID</h2>
                    <h2>Nombre</h2>
                    <h2>Correo</h2>
                    <h2>Nombre de usuario</h2>
                    <h2>Edad</h2>
                    <h2>Sexo</h2>
                    <h2>Número telefónico</h2>
                    <h2>Dirección</h2>
                    <h2>Idioma</h2>
                    <h2>Verificado</h2>
                    <form>
                        <i class="fa-solid fa-user-slash"></i>
                        <i class="fa-solid fa-inbox"></i>
                    </form>
                </div>
                <?php
                    $users = "SELECT * FROM users";
                    $runUsers = mysqli_query($connection, $users);

                    while ($usersData = mysqli_fetch_assoc($runUsers)) {
                        ?>
                            <div class="users__body">
                                <h2><?php echo $usersData['id']; ?></h2>
                                <h2><?php echo $usersData['name']; ?></h2>
                                <h2><?php echo $usersData['email']; ?></h2>
                                <h2><?php echo $usersData['username']; ?></h2>
                                <h2><?php echo $usersData['age']; ?></h2>
                                <h2><?php echo $usersData['sex']; ?></h2>
                                <h2><?php echo $usersData['number']; ?></h2>
                                <h2><?php echo $usersData['address']; ?></h2>
                                <h2><?php echo $usersData['language']; ?></h2>
                                <h2><?php echo $usersData['verified'];?></h2>
                                <form>     
                                    <i class="fa-solid fa-user-slash"></i>
                                    <i class="fa-solid fa-inbox" onclick="sendMessage()"></i>
                                </form>
                            </div>
                        <?php
                    }
                ?>
            </div>
            <div class="users__gestion">
                <div class="gestion__head">
                    <h1>Usuarios baneados</h1>
                </div>
                <?php 
                $users = "SELECT * FROM users";
                $runUsers = mysqli_query($connection, $users);
                while ($usersData = mysqli_fetch_assoc($runUsers)) {
                ?>
                <div class="gestion__body">
                    <h2><?php echo $usersData['id']; ?></h2>
                    <h2><?php echo $usersData['name']; ?></h2>
                    <h2><?php echo $usersData['email']; ?></h2>
                    <h2><?php echo $usersData['username']; ?></h2>
                    <form>
                        <i class="fa-solid fa-user-minus"></i>
                    </form>
                </div>
                <?php
                }
                ?>
            </div>
            <form method="post" class="users__notifications">
                <h1>Axel Ramírez</h1>
                <textarea name="" id="" cols="30" rows="10" placeholder="Tu mensaje"></textarea>
                <input type="submit" value="Aceptar">
            </form>
        </div>
    </div>

    <script>
        document.querySelector('.placesOption').addEventListener('click', function(){
            document.querySelector('.showPlaces').classList.toggle('show');
            document.querySelector('.places').classList.add('show');
            document.querySelector('.users').classList.remove('showFlex');
            document.querySelector('.users__gestion').classList.remove('showFlex');
            document.querySelector('.places__add').classList.remove('showFlex');
            document.querySelector('.restaurants').classList.remove('show');
            document.querySelector('.users__notifications').classList.remove('showFlex');
            document.querySelector('.newplace__restaurant').classList.remove('showFlex');
        });

        document.querySelector('.showPlaces').addEventListener('click', function(){
            document.querySelector('.places__add').classList.add('showFlex');
            document.querySelector('.users').classList.remove('showFlex');
            document.querySelector('.users__gestion').classList.remove('showFlex');
            document.querySelector('.places').classList.remove('show');
            document.querySelector('.restaurants').classList.remove('show');
            document.querySelector('.newplace__restaurant').classList.remove('showFlex');
            document.querySelector('.users__notifications').classList.remove('showFlex');
        });

        document.querySelector('.restaurantsOption').addEventListener('click', function(){
            document.querySelector('.showRestaurants').classList.toggle('show');
            document.querySelector('.restaurants').classList.add('show');
            document.querySelector('.users').classList.remove('showFlex');
            document.querySelector('.users__gestion').classList.remove('showFlex');
            document.querySelector('.places').classList.remove('show');
            document.querySelector('.places__add').classList.remove('showFlex');
            document.querySelector('.newplace__restaurant').classList.remove('showFlex');
            document.querySelector('.users__notifications').classList.remove('showFlex');
        });

        document.querySelector('.usersOption').addEventListener('click', function(){
            document.querySelector('.showUsers').classList.toggle('show');
            document.querySelector('.users').classList.add('showFlex');
            document.querySelector('.users__gestion').classList.remove('showFlex');
            document.querySelector('.places').classList.remove('show');
            document.querySelector('.places__add').classList.remove('showFlex');
            document.querySelector('.restaurants').classList.remove('show');
            document.querySelector('.newplace__restaurant').classList.remove('showFlex');
            document.querySelector('.users__notifications').classList.remove('showFlex');
        });

        document.querySelector('.gestion').addEventListener('click', function(){
            document.querySelector('.users').classList.remove('showFlex');
            document.querySelector('.users__gestion').classList.toggle('showFlex');
            document.querySelector('.places').classList.remove('show');
            document.querySelector('.places__add').classList.remove('showFlex');
            document.querySelector('.restaurants').classList.remove('show');
            document.querySelector('.newplace__restaurant').classList.remove('showFlex');
            document.querySelector('.users__notifications').classList.remove('showFlex');
        });

        document.querySelector('.showRestaurants').addEventListener('click', function(){
            document.querySelector('.users').classList.remove('showFlex');
            document.querySelector('.newplace__restaurant').classList.toggle('showFlex');
            document.querySelector('.places').classList.remove('show');
            document.querySelector('.places__add').classList.remove('showFlex');
            document.querySelector('.restaurants').classList.remove('show');
            document.querySelector('.users__notifications').classList.remove('showFlex');
        });

        function sendMessage() {
            document.querySelector('.users__notifications').classList.add('showFlex');
            document.querySelector('.users__gestion').classList.remove('showFlex');
            document.querySelector('.users').classList.remove('showFlex');
            document.querySelector('.places').classList.remove('show');
            document.querySelector('.places__add').classList.remove('showFlex');
            document.querySelector('.newplace__restaurant').classList.remove('showFlex');
        }
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
                    <form method="post" class="card">
                        <div class="card__img">
                            <img src="${place.img1}">
                        </div>
                        <div class="card__info">
                            <h2>${place.name}</h2>
                        </div>
                        <button type="submit" value="${place.id}" class="delete"><i class="fa-solid fa-trash"></i></button>
                    </form>
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
                $.ajax({
                    method: 'POST',
                    url: 'filters.php', // Archivo PHP que realizará la consulta a la base de datos
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

            // Cargar los lugares iniciales al cargar la página
            getFilteredPlaces();
        });
    </script>

    <script src="../js/newPlace.js"></script>
</body>
</html>