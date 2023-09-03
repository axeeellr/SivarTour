<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

// Configuración de correo
$email_user = 'sivartour.travel@gmail.com';
$email_password = 'bfvglsxmsjpbbknz';
$from_name = 'SivarTour';

$address_to = $_GET['email']; // Obtén la dirección de correo electrónico de la URL

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración de SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->Username = $email_user;
    $mail->Password = $email_password;

    // Configuración de correo
    $mail->setFrom($email_user, $from_name);
    $mail->addAddress($address_to);
    $mail->Subject = "Bienvenid@ a SivarTour";

    // Contenido HTML del correo
    $email_template = file_get_contents('templateWelcome.html');
    $mail->Body = $email_template;
    $mail->isHTML(true);

    // Enviar el correo
    $mail->send();
    
    echo 'si'; // Envío exitoso
} catch (Exception $e) {
    echo 'no: ' . $mail->ErrorInfo; // Error en el envío
}
?>
