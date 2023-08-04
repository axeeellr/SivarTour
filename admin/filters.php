<?php
// filter_places.php
include '../php/connection.php';

// Prepara la consulta SQL con los filtros seleccionados
$sql = "SELECT * FROM places";

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
