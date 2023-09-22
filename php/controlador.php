<?php

require 'vendor/autoload.php';
include 'connection.php';

$error = "";
$notice = "";
$mensaje = "";
$submensaje = "";
session_start();

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$accessKey = 'AKIA46EOAGCOGN3YBO5E';
$secretKey = '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';




/****** G E T   U R L ******/
//despues del login redirecciono a la pagina donde estaba cuando le dió click al login
if (isset($_POST['goLogin'])) {
    $_SESSION['host'] = $_SERVER["HTTP_HOST"];
    $_SESSION['url'] = $_SERVER["REQUEST_URI"];
    header ('Location: login.php', true, 303);
}




/****** G O O G L E   L O G I N ******/
$clientID = '765073225137-1gggl6d22ovr6ne69sp9qdil8p6hb980.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/SivarTour/profile.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

//si google me envía 'code' por url
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    //array con la info que almacenaré en la db
    $userInfo = [
        'name' => $google_account_info['name'],
        'email' => $google_account_info['email'],
        'img' => $google_account_info['picture'],
        'token' => $google_account_info['id']
    ];

    //validar si está baneado
    $sqlll = "SELECT * FROM users WHERE email = '{$userInfo['email']}' AND banned = 1";
    $runnn = mysqli_query($connection, $sqlll);

    if (mysqli_num_rows($runnn)) {
        $error = "Usuario baneado.";
        header('Location: login.php', true, 303);
        die();
    }

    //validar si ya está registrado
    $sql = "SELECT * FROM users WHERE email = '{$userInfo['email']}'";
    $run = mysqli_query($connection, $sql);

    //si ya está registrado
    if (mysqli_num_rows($run)) {
        $userInfo = mysqli_fetch_assoc($run);
        $token = $userInfo['token'];
        $id = $userInfo['id'];
        $_SESSION['user_token'] = $token;
        $_SESSION['user_id'] = $id;
        $_SESSION['isLogin'] = 'si';

    } else {
        //si no está registrado
        $sqll = "INSERT INTO users (name, email, password, img, token) VALUES ('{$userInfo['name']}', '{$userInfo['email']}', '', '{$userInfo['img']}', '{$userInfo['token']}')";
        $runn = mysqli_query($connection, $sqll);
        $sqllll = "SELECT * FROM users WHERE email = '{$userInfo['email']}' ORDER BY id DESC LIMIT 1";
        $runnnn = mysqli_query($connection, $sqllll);
        $row = mysqli_fetch_assoc($runnnn);

        if ($runn) {
            $token = $row['token'];
            $id = $row['id'];
            $_SESSION['user_token'] = $token;
            $_SESSION['user_id'] = $id;
            $_SESSION['isLogin'] = 'si';
        }
    }

}




/****** L O G I N ******/
if(isset($_POST['login'])) {
    $correo = $_POST['email']; 
    $contraseña = $_POST['password'];

    if ($correo === 'admin777@gmail.com' && $contraseña === 'admin777') {
        $_SESSION['admin'] = true;
        header('Location: admin/index.php', true, 303);
        die();
    }

    $stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $correo, $contraseña);
    mysqli_stmt_execute($stmt);

    $consulta_sql = mysqli_stmt_get_result($stmt);

    $nums = mysqli_num_rows($consulta_sql);
    $data = mysqli_fetch_assoc($consulta_sql);
    
    if($nums == 1){
        $token = $data['token'];
        $id = $data['id'];
        $_SESSION['isLogin'] = 'si';
        $_SESSION['user_token'] = $token;
        $_SESSION['user_id'] = $id;
        header('Location: ' . $_SESSION['url']);
    } else {
        $error = "Los datos no coinciden";
    }

    mysqli_stmt_close($stmt);
}




/****** R E G I S T R O ******/
if(isset($_POST['register'])) {
    $nombre = $_POST['name']; 
    $correo = $_POST['email']; 
    $contraseña = $_POST['password'];
    $imageLink = isset($_POST['avatar']) ? $_POST['avatar'] : '';
    $token = bin2hex(random_bytes(10)); // Generar un token seguro

    if (isset($_FILES['profilePic']) && !empty($_FILES['profilePic']) && $imageLink == '') {
        $imageLink = '';
        // Configuración del cliente de S3
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-2', // Reemplaza con tu región deseada
            'credentials' => [
                'key' => $accessKey,
                'secret' => $secretKey,
            ],
        ]);

        // Nombre del bucket en S3
        $bucketName = 'sivartour';

        // Carpeta en S3
        $s3FolderName = 'users/';

        // Datos de la imagen
        $file = $_FILES['profilePic']['name'];
        $tempFilePath = $_FILES['profilePic']['tmp_name'];
        $s3FileName = $s3FolderName . $file;

        // Obtener el tipo de archivo MIME para la extensión de la imagen
        $contentType = mime_content_type($tempFilePath);

        try {
            // Subida del archivo a S3 con el encabezado "Content-Type" adecuado
            $result = $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key' => $s3FileName,
                'SourceFile' => $tempFilePath,
                'ContentType' => $contentType,
            ]);

            // Obtener el enlace público del objeto subido a S3
            $imageLink = $s3Client->getObjectUrl($bucketName, $s3FileName);

        } catch (S3Exception $e) {
            echo "Error al subir la imagen $file a S3: " . $e->getMessage() . "<br>";
        }

    }

    // Verificar contraseña segura
    if ($correo === 'admin777@gmail.com' && $contraseña === 'admin777') {
        header('Location: login.php');
        die();
    } elseif(!preg_match('/^[a-zA-Z0-9]+$/', $contraseña)) {
        $error = "Solo se permiten letras y números";
    } elseif (strlen($contraseña) > 15) {
        $error = "El máximo de caracteres es 15";
    } elseif (strlen($contraseña) < 5){
        $error = "El mínimo de caracteres es 5";
    } else {
        // Preparar consulta SQL con sentencia preparada
        $consulta_sql = "INSERT INTO users (name, email, password, img, token) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $consulta_sql);
        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $correo, $contraseña, $imageLink, $token);

        // Verificar si el correo ya está registrado
        $validar = "SELECT * FROM users WHERE email = ?";
        $validar_stmt = mysqli_prepare($connection, $validar);
        mysqli_stmt_bind_param($validar_stmt, "s", $correo);
        mysqli_stmt_execute($validar_stmt);
        $validarCorreo = mysqli_stmt_get_result($validar_stmt);

        if(mysqli_num_rows($validarCorreo) == 1){
            $error = "Correo electrónico ya registrado";
        } else {
            // Ejecutar consulta preparada para inserción
            if(mysqli_stmt_execute($stmt)){
                $id = mysqli_insert_id($connection);
                $_SESSION['isLogin'] = 'si';
                $_SESSION['user_token'] = $token;
                $_SESSION['user_id'] = $id;
                header('Location: ' . $_SESSION['url']);
            } else {
                $error = "Ha ocurrido un error";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($validar_stmt);
    }
}




/****** A G R E G A R   C O M E N T A R I O ******/
if (isset($_POST['newComment'])) {
    $_SESSION['hostt'] = $_SERVER["HTTP_HOST"];
    $_SESSION['urll'] = $_SERVER["REQUEST_URI"];
    
    // Obtén el comentario y el ID del lugar, asegurándote de escapar las variables correctamente
    $comment = mysqli_real_escape_string($connection, $_POST['comment']);
    $id_place = mysqli_real_escape_string($connection, $_GET['place']);
    
    // Escapa el comentario para prevenir la ejecución de scripts maliciosos
    $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
    
    // Utiliza una consulta preparada para evitar la inyección de SQL
    $query = "INSERT INTO comments (id_user, id_place, comment) VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($connection, $query);
    
    // Verifica si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincula los parámetros y ejecuta la consulta
        mysqli_stmt_bind_param($stmt, "iss", $_SESSION['user_id'], $id_place, $comment);
        
        if (mysqli_stmt_execute($stmt)) {
            $notice = "Se añadió el comentario!";
            //header('Location: ' . $_SESSION['urll'], true, 303);
        } else {
            $notice = "Error al guardar el comentario!";
        }
        
        // Cierra la consulta preparada
        mysqli_stmt_close($stmt);
    } else {
        $notice = "Error al guardar el comentario!";
    }
}





/****** V E R I F I C A R   C O D I G O ******/
if (isset($_POST['veriCode'])) {
    $code = $_POST['code'];

    $sql = "SELECT * FROM users WHERE token = '{$_SESSION['user_token']}'";
    $run = mysqli_query($connection, $sql);

    if ($row = mysqli_fetch_assoc($run)) {
        $codedb = $row['code']; // Código almacenado en la base de datos
    
        if ($code == $codedb) {
            $notice = "Cuenta activada!. Ya puedes usar todas las funciones de SivarTour.";
            $sqll = "UPDATE users SET verified = 1 WHERE token = '{$_SESSION['user_token']}'";
            $runn = mysqli_query($connection, $sqll);
        } else {
            $notice = "El código es incorrecto.";
        }
    }
}




/****** A C T U A L I Z A R   P E R F I L ******/
if (isset($_POST['userData'])) {
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $number = $_POST['number'];
    $instagram = $_POST['instagram'];
    $whatsapp = $_POST['whatsapp'];
    $twitter = $_POST['twitter'];

    $sql = "UPDATE users SET";
    $updates = array();

    if (!empty($age)) {
        $updates[] = "age = '$age'";
    }

    if (!empty($sex)) {
        $updates[] = "sex = '$sex'";
    }

    if (!empty($number)) {
        $updates[] = "number = '$number'";
    }

    if (!empty($instagram)) {
        $updates[] = "instagram = '$instagram'";
    }

    if (!empty($whatsapp)) {
        $updates[] = "whatsapp = '$whatsapp'";
    }

    if (!empty($twitter)) {
        $updates[] = "twitter = '$twitter'";
    }

    if (!empty($updates)) {
        $sql .= " " . implode(", ", $updates);
        $sql .= " WHERE token = '{$_SESSION['user_token']}'";
        $run = mysqli_query($connection, $sql);
        $notice = "Datos actualizados correctamente!";
        //header('Location: profile.php', true, 303);
    }

}




/****** P U B L I C A R   L U G A R ******/
if (isset($_POST['newPlace'])) {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $description = $_POST['description'];
    $direction = $_POST['direction'];
    $location = $_POST['location'];
    $department = $_POST['department'];
    $type = $_POST['type'];
    $public = $_POST['public'];

    // Validar que se hayan seleccionado exactamente 3 imágenes
    if (isset($_FILES['images']['name']) && count($_FILES['images']['name']) === 3) {
        // Configuración del cliente de S3
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-2', // Reemplaza con tu región deseada
            'credentials' => [
                'key' => $accessKey,
                'secret' => $secretKey,
            ],
        ]);

        // Nombre del bucket en S3
        $bucketName = 'sivartour';

        // Carpeta en S3 con el nombre del lugar
        $s3FolderName = $name . '/';

        // Subida de las imágenes a S3
        $imageLinks = array(); // Almacenar los enlaces de las imágenes subidas

        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $file = $_FILES['images']['name'][$i];
            $tempFilePath = $_FILES['images']['tmp_name'][$i];
            $s3FileName = $s3FolderName . $file;

            // Obtener el tipo de archivo MIME para la extensión de la imagen
            $contentType = mime_content_type($tempFilePath);

            try {
                // Subida del archivo a S3 con el encabezado "Content-Type" adecuado
                $result = $s3Client->putObject([
                    'Bucket' => $bucketName,
                    'Key' => $s3FileName,
                    'SourceFile' => $tempFilePath,
                    'ContentType' => $contentType,
                ]);

                // Obtener el enlace público del objeto subido a S3
                $imageLink = $s3Client->getObjectUrl($bucketName, $s3FileName);
                $imageLinks[] = $imageLink;

                echo "Imagen $file subida exitosamente a S3.<br>";
                header("Location: filtered.php");
            } catch (S3Exception $e) {
                echo "Error al subir la imagen $file a S3: " . $e->getMessage() . "<br>";
            }
        }

        $sql = "INSERT INTO places (id_user, name, description, direction, location, img1, img2, img3, department, type, public, status) VALUES ('{$_SESSION['user_id']}', '$name','$description', '$direction', '$location', '$imageLinks[0]', '$imageLinks[1]', '$imageLinks[2]', '$department','$type','$public', 0)";
        $run = mysqli_query($connection, $sql);

    } else {
        echo "Debe seleccionar exactamente 3 imágenes.<br>";
    }
}




/****** P U B L I C A R   R E S T A U R A N T E ******/
if (isset($_POST['newRestaurant'])) {
    $_SESSION['hostt'] = $_SERVER["HTTP_HOST"];
    $_SESSION['urll'] = $_SERVER["REQUEST_URI"];
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $idPlace = $_POST['placeId'];
    $placeName = $_POST['placeName'];

    // Validar que se haya seleccionado exactamente 1 imagen
    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
        // Configuración del cliente de S3
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-2', // Reemplaza con tu región deseada
            'credentials' => [
                'key' => $accessKey,
                'secret' => $secretKey,
            ],
        ]);

        // Nombre del bucket en S3
        $bucketName = 'sivartour';

        // Carpeta en S3 con el nombre del lugar
        $s3FolderName = $placeName . '/';

        // Datos de la imagen
        $file = $_FILES['image']['name'];
        $tempFilePath = $_FILES['image']['tmp_name'];
        $s3FileName = $s3FolderName . $file;

        // Obtener el tipo de archivo MIME para la extensión de la imagen
        $contentType = mime_content_type($tempFilePath);

        try {
            // Subida del archivo a S3 con el encabezado "Content-Type" adecuado
            $result = $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key' => $s3FileName,
                'SourceFile' => $tempFilePath,
                'ContentType' => $contentType,
            ]);

            // Obtener el enlace público del objeto subido a S3
            $imageLink = $s3Client->getObjectUrl($bucketName, $s3FileName);

            echo "Imagen $file subida exitosamente a S3.<br>";
            header('Location: ' . $_SESSION['urll'], true, 303);

            $sql = "INSERT INTO restaurants (id_place, name, img) VALUES ('$idPlace','$name','$imageLink')";
            $run = mysqli_query($connection, $sql);

            $notice = "Se añadió el restaurante!";
        } catch (S3Exception $e) {
            echo "Error al subir la imagen $file a S3: " . $e->getMessage() . "<br>";
        }

    } else {
        echo "Debe seleccionar una imagen.<br>";
    }
}




/****** N U E V A   C O L E C C I O N ******/
if (isset($_POST['newCollection'])) {
    $_SESSION['hostt'] = $_SERVER["HTTP_HOST"];
    $_SESSION['urll'] = $_SERVER["REQUEST_URI"];
    
    $id_user = $_SESSION['user_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];

    if ($type == 2) {
        $uniqueId = substr(md5(uniqid(rand(), true)), 0, 10);
        $url = 'http://localhost/sivartour/join_collection.php?collection=' . $uniqueId . '&p=' . $id_user;
    } else {
        $url = '';
    }

    $sql = "INSERT INTO collections (id_user, name, type, url) VALUES ('$id_user', '$name', '$type', '$url')";
    $run = mysqli_query($connection, $sql);

    
    if ($run) {
        $sqlll = "SELECT * FROM collections WHERE id_user = '{$_SESSION['user_id']}' ORDER BY id DESC LIMIT 1";
        $runn = mysqli_query($connection, $sqlll);
        $row = mysqli_fetch_assoc($runn);

        $sqll = "INSERT INTO collections_share (id_collection, id_user, owner) VALUES ('{$row['id']}', '{$_SESSION['user_id']}', 1)";
        $runnn = mysqli_query($connection, $sqll);

        $sqllll = "INSERT INTO collections_places (id_user, id_collection, id_place) VALUES ('{$_SESSION['user_id']}', '{$row['id']}', '{$_GET['place']}')";
        $runnnn = mysqli_query($connection, $sqllll);

        $notice = "Creado y agregado a la colección!";
        //header('Location: ' . $_SESSION['urll'], true, 303);
    }
}




/****** N U E V A   C O L E C C I O N (PROFILE) ******/
if (isset($_POST['newCollectionP'])) {
    $id_user = $_SESSION['user_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];

    if ($type == 2) {
        $uniqueId = substr(md5(uniqid(rand(), true)), 0, 10);
        $url = 'http://localhost/sivartour/join_collection.php?collection=' . $uniqueId . '&p=' . $id_user;
    } else {
        $url = '';
    }

    $sql = "INSERT INTO collections (id_user, name, type, url) VALUES ('$id_user', '$name', '$type', '$url')";
    $run = mysqli_query($connection, $sql);

    if ($run) {
        $sqlll = "SELECT * FROM collections WHERE id_user = '{$_SESSION['user_id']}' ORDER BY id DESC LIMIT 1";
        $runn = mysqli_query($connection, $sqlll);
        $row = mysqli_fetch_assoc($runn);

        $sqll = "INSERT INTO collections_share (id_collection, id_user, owner) VALUES ('{$row['id']}', '{$_SESSION['user_id']}', 1)";
        $runnn = mysqli_query($connection, $sqll);

        $notice = "Colección creada exitosamente!";
        //header('Location: ' . $_SESSION['urll'], true, 303);
    }
}




/****** A G R E G A R   A   C O L E C C I O N ******/
if (isset($_POST['collection'])) {
    $_SESSION['hostt'] = $_SERVER["HTTP_HOST"];
    $_SESSION['urll'] = $_SERVER["REQUEST_URI"];

    $id_user = $_SESSION['user_id'];
    $id_collection = $_POST['collection'];
    $id_place = $_GET['place'];

    $sql = "INSERT INTO collections_places (id_user, id_collection, id_place) VALUES ('$id_user', '$id_collection', '$id_place')";
    $run = mysqli_query($connection, $sql);

    if ($run) {
        $notice = "Agregado exitosamente a la colección!";
        //header('Location: ' . $_SESSION['urll'], true, 303);
    }
}




/****** V I S T O S   R E C I E N T E M E N T E ******/
if (isset($_GET['place'])) {
    $idLugar = $_GET['place'];

    // Obtener el ID del usuario desde la sesión (asegúrate de tener la sesión iniciada previamente)
    $sql = mysqli_query($connection, "SELECT * FROM users WHERE token = '{$_SESSION['user_token']}'");
    $rows = mysqli_fetch_assoc($sql);
    $idUser = $rows['id'];

    // Nombre de la cookie con el ID del usuario
    $cookieName = 'ultimos_lugares_' . $idUser;

    // Verificar si la cookie de lugares visitados ya existe para este usuario
    if (isset($_COOKIE[$cookieName])) {
        // Obtener el valor de la cookie y convertirlo en un array
        $lugaresVisitados = explode(',', $_COOKIE[$cookieName]);
    } else {
        // Si la cookie no existe, crear un array vacío
        $lugaresVisitados = array();
    }

    // Verificar si el ID del lugar ya existe en el array de lugares visitados
    if (!in_array($idLugar, $lugaresVisitados)) {
        // Agregar el nuevo ID del lugar al final del array de lugares visitados
        $lugaresVisitados[] = $idLugar;

        // Asegurarse de que solo haya 5 elementos en el array de lugares visitados
        $lugaresVisitados = array_slice($lugaresVisitados, -5);

        // Convertir el array de lugares visitados en una cadena
        $lugaresVisitadosStr = implode(',', $lugaresVisitados);

        // Guardar la cadena en una cookie con una duración de 30 días (puedes ajustar la duración según tus necesidades)
        setcookie($cookieName, $lugaresVisitadosStr, time() + (30 * 24 * 60 * 60));
    }
}





/****** R A T I N G ******/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['rating'])) {
        // Obtener el lugar actual desde el parámetro de URL
        $placeId = $_GET['place'];

        // Verificar si el usuario ya ha calificado el lugar
        $userId = $_SESSION['user_id'];
        $sqlCheckRating = "SELECT * FROM user_ratings WHERE user_id = '$userId' AND place_id = '$placeId'";
        $resultCheckRating = mysqli_query($connection, $sqlCheckRating);

        if (mysqli_num_rows($resultCheckRating) > 0) {
            // El usuario ya ha calificado el lugar, mostrar mensaje de error
            $notice = "Ya has calificado este lugar!";
        } else {
            // El usuario no ha calificado el lugar, permitir que envíe su calificación
            $ratingValue = $_POST['rating']; // Valor de la calificación enviada desde el formulario

            // Incrementar el contador de calificaciones en 1
            $sqlGetRating = "SELECT rating_count FROM places WHERE id = $placeId";
            $resultGetRating = mysqli_query($connection, $sqlGetRating);
            $dataPlace = mysqli_fetch_array($resultGetRating);
            $ratingCount = $dataPlace['rating_count'] + 1;

            // Calcular el nuevo valor del campo "rating" con el promedio
            $newRating = ceil($ratingCount / 3); // Redondear hacia arriba

            // Limitar el rating máximo a 5
            $newRating = min($newRating, 5);

            // Actualizar la calificación en la base de datos
            $sqlUpdateRating = "UPDATE places SET rating_count = $ratingCount, rating = $newRating WHERE id = $placeId";
            $resultUpdate = mysqli_query($connection, $sqlUpdateRating);

            // Almacenar la calificación del usuario en la nueva tabla user_ratings
            $sqlInsertRating = "INSERT INTO user_ratings (user_id, place_id, rating) VALUES ('$userId', '$placeId', '$ratingValue')";
            mysqli_query($connection, $sqlInsertRating);

            if ($resultUpdate) {
                // La calificación se actualizó correctamente en la base de datos
                //$notice = "La calificación se actualizó correctamente. Calificación promedio: $newRating/5";
                $notice = "Gracias por calificar este lugar!";
            } else {
                // Hubo un error al actualizar la calificación
                // Mostrar un mensaje de error
                $notice = "Hubo un error al actualizar la calificación!";
            }
        }
    }
}




/****** V E R   P E R F I L ******/
if (isset($_POST['userComment'])) {
    if ($_POST['idUserComment'] == $_SESSION['user_id']) {
        header('Location: profile.php');
    } else {
        $_SESSION['idUserComment'] = $_POST['idUserComment'];
        header('Location: user.php');
    }
}




/****** V E R   P E R F I L ******/
if (isset($_POST['goUser'])) {
    if ($_POST['idUserComment'] == $_SESSION['user_id']) {
        header('Location: profile.php');
    } else {
        $_SESSION['idUserComment'] = $_POST['idUserComment'];
        header('Location: user.php');
    }
}




/****** V E R   C O L E C C I O N E S ******/
if (isset($_POST['collectionPage'])) {
    $_SESSION['collectionId'] = $_POST['collectionId'];
    header('Location: collections.php');
}




/****** V E R   F A V O R I T O S ******/
if (isset($_POST['favoritePage'])) {
    header('Location: collections.php?favorites');
}









/* A G R E G A R   L U G A R   A   R U T A */
if (isset($_POST['route'])) {
    $notice = "Se agregó correctamente a la ruta!";
}




/* E L I M I N A R   R U T A */
if (isset($_POST['deleteRoute'])) {
    $notice = "Se ha eliminado la ruta!";
}




/* U N I R S E   A   L A   C O L E C C I O N */
if (isset($_POST['acceptJoin'])) {
    $idCollection = $_POST['idCollection'];
    $idUser = $_POST['idUser'];
    $name = $_POST['name'];

    $sql = "INSERT INTO collections_share (id_collection, id_user) VALUES ('$idCollection', '$idUser')";
    $run = mysqli_query($connection, $sql);

    $_SESSION['collectionId'] = $idCollection;
    header('Location: collections.php');
}




/*  */
if (isset($_POST['deniedJoin'])) {
    header('Location: index.php');
}


?>