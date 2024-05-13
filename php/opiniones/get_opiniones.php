<?php
include '../../db/database.php';

$sql = "SELECT id, nombre, opinion, calificacion FROM opiniones ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iterar sobre cada fila de resultados
    while($row = $result->fetch_assoc()) {
        // Mostrar cada reseña dentro de un elemento de la lista
        echo '<div class="list-group-item list-group-item-action">';

        echo '<div>';
        echo '"' . $row["opinion"] . '"';
        echo ' - ' . $row["nombre"];
        echo ' - ' . $row["calificacion"] . '/10';
        echo '</div>';

        echo '<div>';
        echo '<a href="php/opiniones/edit_opiniones.php?id=' . $row["id"] . '" class="btn btn-primary btn-sm">Editar</a>';
        echo '<a href="php/opiniones/delete_opiniones.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm">Eliminar</a>';
        echo '</div>';

        echo '</div>';
    }
} else {
    echo '<div class="list-group-item list-group-item-action">No hay reseñas disponibles.</div>';
}

$conn->close();
?>