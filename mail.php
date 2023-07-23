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
// $phpmailer->SMTPDebug = 1;
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password;

$phpmailer->SMTPSecure = 'ssl'; 
$phpmailer->Host = 'smtp.gmail.com';
$phpmailer->Port = 465; 
$phpmailer->isSMTP(); 
$phpmailer->SMTPAuth = true;

$phpmailer->CharSet = 'UTF-8';


$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); 


$phpmailer->FromName = 'SivarTour';  
$phpmailer->Subject = $the_subject;

$email_template = file_get_contents('template.html');
$email_template = str_replace("FGH-123-VBN", $code, $email_template);
$phpmailer->Body = $email_template;


$phpmailer->IsHTML(true);
if (!$phpmailer->Send()) {
    echo "no";
}else{
    echo "si"; 
    $sql = "UPDATE users SET code = '$code' WHERE token = '{$_SESSION['user_token']}'";
    $run = mysqli_query($connection, $sql);

}
?>