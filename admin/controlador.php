<?php

require '../vendor/autoload.php';
include '../php/connection.php';

session_start();

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$accessKey = 'AKIA46EOAGCOGN3YBO5E';
$secretKey = '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';


/* B O R R A R   L U G A R */
if (isset($_POST['deletePlace'])) {
    $sql = "DELETE FROM places WHERE id = '{$_POST['deletePlace']}'";
    $run = mysqli_query($connection, $sql);

    $sql2 = "INSERT INTO notifications (id_user, type) VALUES ({$_POST['idUserPlace']}, 3)";
    $run2 = mysqli_query($connection, $sql2);
    
    header ('Location: index.php', true, 303);
}




/* A Ñ A D I R   L U G A R */
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
                header ('Location: index.php', true, 303);
            } catch (S3Exception $e) {
                echo "Error al subir la imagen $file a S3: " . $e->getMessage() . "<br>";
            }
        }

        $sql = "INSERT INTO places (id_user, name, description, direction, location, img1, img2, img3, department, type, public, status) VALUES (0, '$name','$description', '$direction', '$location', '$imageLinks[0]', '$imageLinks[1]', '$imageLinks[2]', '$department','$type','$public', 1)";
        $run = mysqli_query($connection, $sql);

    } else {
        echo "Debe seleccionar exactamente 3 imágenes.<br>";
    }
}




/* B O R R A R   R E S T A U R A N T E */
if (isset($_POST['deleteRestaurant'])) {
    $sql = "DELETE FROM restaurants WHERE id = '{$_POST['deleteRestaurant']}'";
    $run = mysqli_query($connection, $sql);
    header ('Location: index.php', true, 303);
}



/* A Ñ A D I R   R E S T A U R A N T E */
if (isset($_POST['newRestaurant'])) {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $idPlace = $_POST['place'];
    $placeNameFind = mysqli_query($connection, "SELECT name FROM places WHERE id = $idPlace");
    $placeNameRow = mysqli_fetch_array($placeNameFind);
    $placeName = $placeNameRow['name'];

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
            header('Location: index.php', true, 303);

            $sql = "INSERT INTO restaurants (id_place, name, img) VALUES ('$idPlace','$name','$imageLink')";
            $run = mysqli_query($connection, $sql);
        } catch (S3Exception $e) {
            echo "Error al subir la imagen $file a S3: " . $e->getMessage() . "<br>";
        }

    } else {
        echo "Debe seleccionar una imagen.<br>";
    }
}




/* B A N E A R   U S U A R I O S */
if (isset($_POST['blockUser'])) {
    $sql = "UPDATE users SET banned = 1 WHERE id = {$_POST['idBlock']}";
    $run = mysqli_query($connection, $sql);

    header('Location: index.php', true, 303);
}




/* D E S B A N E A R   U S U A R I O S */
if (isset($_POST['unblockUser'])) {
    $sql = "UPDATE users SET banned = 0 WHERE id = {$_POST['idUnblock']}";
    $run = mysqli_query($connection, $sql);

    header('Location: index.php', true, 303);
}




/* E L I M I N A R   U S U A R I O S */
if (isset($_POST['deleteUser'])) {
    $sql = "DELETE FROM users WHERE id = {$_POST['idBlock']}";
    $run = mysqli_query($connection, $sql);

    header('Location: index.php', true, 303);
}




/* A C E P T A R   S O L I C I T U D */
if (isset($_POST['acceptRequest'])) {
    $sql = "UPDATE places SET status = 1 WHERE id = {$_POST['acceptRequest']}";
    $run = mysqli_query($connection, $sql);

    $sql2 = "INSERT INTO notifications (id_user, type) VALUES ({$_POST['idUserRequests']}, 1)";
    $run2 = mysqli_query($connection, $sql2);

    header('Location: index.php', true, 303);
}




/* E L I M I N A R   S O L I C I T U D */
if (isset($_POST['deleteRequest'])) {
    $sql = "DELETE FROM places WHERE id = {$_POST['deleteRequest']}";
    $run = mysqli_query($connection, $sql);

    $sql2 = "INSERT INTO notifications (id_user, type) VALUES ({$_POST['idUserRequests']}, 2)";
    $run2 = mysqli_query($connection, $sql2);

    header('Location: index.php', true, 303);
}
?>