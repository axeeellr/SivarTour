<?php
// filter_places.php
include 'php/connection.php';

$department = $_POST['department'] ?? '';
$type = $_POST['type'] ?? '';
$public = $_POST['public'] ?? '';

// Prepara la consulta SQL con los filtros seleccionados
$sql = "SELECT * FROM places WHERE 1=1";
if (!empty($department)) {
  $sql .= " AND department = '$department'";
}
if (!empty($type)) {
  $sql .= " AND type = '$type'";
}
if (!empty($public)) {
  $sql .= " AND public = '$public'";
}

// Ejecuta la consulta
$run = mysqli_query($connection, $sql);

// Prepara el array para almacenar los lugares filtrados
$filteredPlaces = array();

// Almacena los resultados en el array
while ($data = mysqli_fetch_assoc($run)) {
  $filteredPlaces[] = $data;
}

// Cierra la conexión con la base de datos
mysqli_close($connection);

// Devuelve los resultados en formato JSON
echo json_encode($filteredPlaces);
?>
