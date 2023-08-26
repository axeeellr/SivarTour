<?php
    include 'php/connection.php';
    include 'php/controlador.php';

    if (!isset($_GET['collection'])) {
        header ('Location: login.php');
    }elseif (!isset($_SESSION['user_id'])) {
        header ('Location: login.php');
    } else {
        $url = $_GET['collection'];
        $id = $_GET['p'];
        $sql = "SELECT * FROM collections WHERE url = 'http://localhost/sivartour/join_collection.php?collection=$url&p=$id' AND id_user != {$_SESSION['user_id']}";
        $run = mysqli_query($connection, $sql);

        if (mysqli_num_rows($run) == 1) {
            $row = mysqli_fetch_array($run);
            $getUser = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
            $rowUser = mysqli_fetch_array($getUser);
            ?>
                <style type="text/css">
                    .container p:nth-child(1){
                        display: none;
                    }

                    .container__btn input:nth-child(6){
                        display: none;
                    }
                </style>
            <?php
        }else {
            ?>
                <style type="text/css">
                    .container p:nth-child(2){
                        display: none;
                    }

                    .container__btn input:nth-child(1), .container__btn input:nth-child(2){
                        display: none;
                    }
                </style>
            <?php
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style><?php include 'css/join_collection.css' ?></style>
<body>
    <form method="post" class="container">
        <p>Ocurrió un error al unirte a la colección. Verifica que tengas una cuenta activa o que el enlace sea válido.</p>
        <p><span><?php echo $rowUser['name'] ?></span> te ha invitado a unirte a la colección <span><?php echo $row['name'] ?></span></p><span></span>
        <div class="container__btn">
            <input type="hidden" name="idCollection" value="<?php echo $row['id']?>">
            <input type="hidden" name="idUser" value="<?php echo $_SESSION['user_id'] ?>">
            <input type="hidden" name="name" value="<?php echo $row['name']?>">
            <input type="submit" name="acceptJoin" value="Aceptar">
            <input type="submit" name="deniedJoin" value="Rechazar">
            <input type="submit" name="back" class="back" value="Ir al inicio">
        </div>
    </form>

    <script>
        document.querySelector('.back').addEventListener('click', function(e){
            e.preventDefault();
            window.location = 'index.php';
        })
    </script>
</body>
</html>