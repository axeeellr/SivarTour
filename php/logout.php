<?php
    session_start();
    unset($_SESSION['user_token']);
    unset($_SESSION['user_id']);
    unset($_SESSION['isLogin']);
    unset($_SESSION['idUserComment']);
    unset($_SESSION['collectionId']);
    session_destroy();
    header('Location: ../index.php');
?>