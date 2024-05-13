<?php
include '../../db/database.php';

// Verificar si se han enviado datos a través del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar si se han recibido todos los datos necesarios
    if (isset($_POST['nameInput'], $_POST['emailInput'], $_POST['phoneInput'], $_POST['dateInput'], $_POST['timeInput'], $_POST['peopleInput'])) {
        // Preparar y vincular los parámetros
        $stmt = $conn->prepare("INSERT INTO reservas (nombre_cliente, correo_electronico, telefono, fecha_reserva, hora_reserva, numero_personas, solicitudes_especiales) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", $nombre, $correo, $telefono, $fecha, $hora, $personas, $solicitudes);

        // Establecer parámetros y ejecutar la consulta
        $nombre = $_POST['nameInput'];
        $correo = $_POST['emailInput'];
        $telefono = $_POST['phoneInput'];
        $fecha = $_POST['dateInput'];
        $hora = substr($_POST['timeInput'], 0, 5);
        $personas = $_POST['peopleInput'];
        $solicitudes = isset($_POST['messageTextarea']) ? $_POST['messageTextarea'] : '';

        if ($stmt->execute()) {
            header('Location: ../../index.html#reservas');
            exit();            
        } else {
            echo "Error al realizar la reserva: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Falta información.";
    }
} else {
    echo "Error: Método de solicitud no permitido.";
}
$conn->close();
?>
