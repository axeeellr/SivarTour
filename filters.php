<?php
include 'php/connection.php';

$department = $_POST['department'];
$type = $_POST['type'];
$public = $_POST['public'];

$sql = "SELECT * FROM places WHERE 1=1";

if ($department !== '') {
  $sql .= " AND department = '$department'";
}

if ($type !== '') {
  $sql .= " AND type = '$type'";
}

if ($public !== '') {
  $sql .= " AND public = '$public'";
}

$run = mysqli_query($connection, $sql);

$count = 0;
$containerCount = 1;

ob_start();

echo '<div class="cards">'; // Abrir el primer contenedor "cards"

while ($data = mysqli_fetch_array($run)) {
  if ($count === 6) {
    echo '</div>'; // Cerrar el contenedor anterior
    echo '<div class="cards">'; // Abrir un nuevo contenedor "cards"
    $count = 0;
    $containerCount++;
  }

  ?>
  <a href="place.php?place=<?php echo $data['id']?>" class="card">
    <div class="card__img">
      <?php echo '<img src="'.$data["img1"].'">'?>
    </div>
    <div class="card__info">
      <h2><?php echo $data['name'] ?></h2>
      <div class="card__info__stars">
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
      </div>
    </div>
  </a>
  <?php

  $count++;
}

echo '</div>'; // Cerrar el último contenedor "cards"

$html = ob_get_clean();

echo $html;
?>




