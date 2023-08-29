<?php
include 'php/connection.php';

if (isset($_POST['notificationId'])) {
    $notificationId = $_POST['notificationId'];
    $sql = "DELETE FROM notifications WHERE id = $notificationId";
    $run = mysqli_query($connection, $sql);
}

mysqli_close($connection);
?>
