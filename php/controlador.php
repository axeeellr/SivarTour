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

    //validar si ya está registrado
    $sql = "SELECT * FROM users WHERE email = '{$userInfo['email']}'";
    $run = mysqli_query($connection, $sql);

    //si ya está registrado
    if (mysqli_num_rows($run)) {
        $userInfo = mysqli_fetch_assoc($run);
        $token = $userInfo['token'];
        $id = $userInfo['id'];

    } else {
        //si no está registrado
        $sqll = "INSERT INTO users (name, email, password, img, token) VALUES ('{$userInfo['name']}', '{$userInfo['email']}', '', '{$userInfo['img']}', '{$userInfo['token']}')";
        $run = mysqli_query($connection, $sqll);

        if ($run) {
            $token = $userInfo['token'];
            $id = $userInfo['id'];
        }else {
            $error = "No se ha podido crear el usuario";
            die();
        }
    }

    $_SESSION['user_token'] = $token;
    $_SESSION['user_id'] = $id;
    $_SESSION['isLogin'] = 'si';
}




/****** L O G I N ******/
if(isset($_POST['login'])) {

    $correo = $_POST['email']; 
    $contraseña = $_POST['password'];

    $consulta_sql = mysqli_query($connection, "SELECT * FROM users WHERE email = '$correo' AND password = '$contraseña'");

    $nums = mysqli_num_rows($consulta_sql);
    $data = mysqli_fetch_assoc($consulta_sql);
    
    if($nums == 1){
        $token = $data['token'];
        $id = $data['id'];
        $_SESSION['isLogin'] = 'si';
        $_SESSION['user_token'] = $token;
        $_SESSION['user_id'] = $id;
        header('Location: ' . $_SESSION['url']);
    }else if ($nums == 0){
        $error = "Los datos no coinciden";
    }

}




/****** R E G I S T R O ******/
if(isset($_POST['register'])) {

    $nombre = $_POST['name']; 
    $correo = $_POST['email']; 
    $contraseña = $_POST['password'];
    $token = substr(str_shuffle(str_repeat('0123456789', 3)), 0, 21);

    //preparo mi consulta sql para el ingreso de los valores en la base de datos
    $consulta_sql =  "INSERT INTO users (name, email, password, token) VALUES('$nombre', '$correo', '$contraseña', '$token')";

    //verifico que correo no se repita en la base de datos
    $validarCorreo = mysqli_query($connection, "SELECT * FROM users WHERE email = '$correo'"); 
    
    //validacion de correo existente
    if(mysqli_num_rows($validarCorreo) == 1){
        $error = "Correo electrónico ya registrado";

    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $contraseña)) {
        $error = "Solo se permiten letras y números";

    } elseif (strlen($contraseña) > 15) {
        $error = "El máximo de caracteres es 15";

    } elseif (strlen($contraseña) < 5){
        $error = "El mínimo de caracteres es 5";

    } else {
        $resultado = mysqli_query($connection, $consulta_sql);

        $data = mysqli_fetch_assoc($validarCorreo);
        $id = $data['id'];
        
        if($resultado){
            $_SESSION['isLogin'] = 'si';
            $_SESSION['user_token'] = $token;
            $_SESSION['user_id'] = $id;
            header('Location: ' . $_SESSION['url']);
        }else{
            $error = "Ha ocurrido un error";
        }
    }
}




/****** A G R E G A R   C O M E N T A R I O ******/
if (isset($_POST['newComment'])) {
    $_SESSION['hostt'] = $_SERVER["HTTP_HOST"];
    $_SESSION['urll'] = $_SERVER["REQUEST_URI"];
    $comment = $_POST['comment'];
    $id = $_SESSION['user_id'];
    $id_place = $_GET['place'];

    $query = "INSERT INTO comments (id_user, id_place, comment) VALUES ('$id', '$id_place', '$comment')";

    if (mysqli_query($connection, $query)) {
        header('Location: ' . $_SESSION['urll'], true, 303);
    } else {
        echo "Error al guardar el comentario: " . mysqli_error($connection);
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
            $mensaje = "Tu cuenta ha sido activada";
            $submensaje = "Ya puedes usar todas las funcionalidades de nuestro sitio web";
            $sqll = "UPDATE users SET verified = 1 WHERE token = '{$_SESSION['user_token']}'";
            $runn = mysqli_query($connection, $sqll);
        } else {
            $mensaje = "Código incorrecto";
            $submensaje = "Ocurrió un error, intenta nuevamente";
        }
    }
}




/****** A C T U A L I Z A R   P E R F I L ******/
if (isset($_POST['userData'])) {
    $username = $_POST['username'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $language = $_POST['language'];

    $sql = "UPDATE users SET";
    $updates = array();

    if (!empty($username)) {
        $updates[] = "username = '$username'";
    }

    if (!empty($age)) {
        $updates[] = "age = '$age'";
    }

    if (!empty($sex)) {
        $updates[] = "sex = '$sex'";
    }

    if (!empty($number)) {
        $updates[] = "number = '$number'";
    }

    if (!empty($address)) {
        $updates[] = "address = '$address'";
    }

    if (!empty($language)) {
        $updates[] = "language = '$language'";
    }

    if (!empty($updates)) {
        $sql .= " " . implode(", ", $updates);
        $sql .= " WHERE token = '{$_SESSION['user_token']}'";
        $run = mysqli_query($connection, $sql);
        header('Location: profile.php', true, 303);
    }

}




/****** P U B L I C A R   L U G A R ******/
if (isset($_POST['newPlace'])) {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $description = $_POST['description'];
    $url = $_POST['url'];
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

        $sql = "INSERT INTO places (name, description, url, img1, img2, img3, department, type, public) VALUES ('$name','$description','$url', '$imageLinks[0]', '$imageLinks[1]', '$imageLinks[2]', '$department','$type','$public')";
        $run = mysqli_query($connection, $sql);

    } else {
        echo "Debe seleccionar exactamente 3 imágenes.<br>";
    }
}




/****** N U E V A   C O L E C C I O N ******/
if (isset($_POST['newCollection'])) {
    $_SESSION['hostt'] = $_SERVER["HTTP_HOST"];
    $_SESSION['urll'] = $_SERVER["REQUEST_URI"];
    
    $id_user = $_SESSION['user_id'];
    $name = $_POST['name'];

    $sql = "INSERT INTO collections (id_user, name) VALUES ('$id_user', '$name')";
    $run = mysqli_query($connection, $sql);

    if ($run) {
        $sqll = "SELECT * FROM collections WHERE id_user = '{$_SESSION['user_id']}' ORDER BY id DESC LIMIT 1";
        $runn = mysqli_query($connection, $sqll);
        $row = mysqli_fetch_assoc($runn);

        $sqlll = "INSERT INTO collections_places (id_user, id_collection, id_place) VALUES ('{$_SESSION['user_id']}', '{$row['id']}', '{$_GET['place']}')";
        $runnn = mysqli_query($connection, $sqlll);

        $notice = "Creado y agregado exitosamente a la colección";
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
        $notice = "Agregado exitosamente a la colección";
        //header('Location: ' . $_SESSION['urll'], true, 303);
    }
}




/****** V I S T O S   R E C I E N T E M E N T E ******/
if (isset($_GET['place'])) {
    $idLugar = $_GET['place'];

    // Obtener el ID del usuario desde la sesión (asegúrate de tener la sesión iniciada previamente)
    $idUser = $_SESSION['user_id'];

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

    // Agregar el nuevo ID del lugar al final del array de lugares visitados
    $lugaresVisitados[] = $idLugar;

    // Asegurarse de que solo haya 5 elementos en el array de lugares visitados
    $lugaresVisitados = array_slice($lugaresVisitados, -5);

    // Convertir el array de lugares visitados en una cadena
    $lugaresVisitadosStr = implode(',', $lugaresVisitados);

    // Guardar la cadena en una cookie con una duración de 30 días (puedes ajustar la duración según tus necesidades)
    setcookie($cookieName, $lugaresVisitadosStr, time() + (30 * 24 * 60 * 60));
}


?>