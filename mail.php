<?php
session_start();

require 'vendor/autoload.php';
include 'php/connection.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$email_user = 'sivartour.travel@gmail.com';
$email_password = 'bfvglsxmsjpbbknz';
$the_subject = "Código de verificación";
$code = rand(10000, 99999);
$address_to = $_GET['email']; 
$from_name = 'Cursos de programación';


$phpmailer = new PHPMailer();
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password;

$phpmailer->SMTPSecure = 'tls'; 
$phpmailer->Host = 'smtp.gmail.com';
$phpmailer->Port = 587; 
$phpmailer->isSMTP(); 
$phpmailer->SMTPAuth = true;


$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); 


$phpmailer->FromName = 'SivarTour';  
$phpmailer->Subject = $the_subject;
$phpmailer->Body = $code;


$phpmailer->IsHTML(true);
if (!$phpmailer->Send()) {
    echo "no";
}else{
    echo "si"; 
    $sql = "UPDATE users SET code = '$code' WHERE token = '{$_SESSION['user_token']}'";
    $run = mysqli_query($connection, $sql);

}
?>