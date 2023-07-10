<?php
    session_start();
    unset($_SESSION['user_token']);
    unset($_SESSION['isLogin']);
    session_destroy();
    header('Location: ../index.php');
?>