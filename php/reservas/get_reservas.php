<?php
include '../../db/database.php';

$sql = "SELECT id, nombre_cliente, correo_electronico, telefono, fecha_reserva, TIME_FORMAT(hora_reserva, '%H:%i') AS hora_reserva, numero_personas, solicitudes_especiales FROM reservas ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iterar sobre cada fila de resultados
    while ($row = $result->fetch_assoc()) {
        // Mostrar cada reserva dentro de una fila de la tabla
        echo '<tr>';
        echo '<td>' . $row["nombre_cliente"] . '</td>';
        echo '<td>' . $row["correo_electronico"] . '</td>';
        echo '<td>' . $row["telefono"] . '</td>';
        echo '<td>' . $row["fecha_reserva"] . '</td>';
        echo '<td>' . $row["hora_reserva"] . '</td>'; // Mostrar solo las horas y los minutos
        echo '<td>' . $row["numero_personas"] . '</td>';
        echo '<td>' . $row["solicitudes_especiales"] . '</td>';

        echo '<td>';
        echo '<a href="php/reservas/edit_reservas.php?id=' . $row["id"] . '" class="btn btn-primary btn-sm">Editar</a>';
        echo '<a href="php/reservas/delete_reservas.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm">Eliminar</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    // Si no hay reservas, mostrar una fila de la tabla indicando que no hay reservas disponibles
    echo '<tr><td colspan="7">No hay reservas disponibles.</td></tr>';
}

$conn->close();
?>
