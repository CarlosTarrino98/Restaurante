<?php
// Comprobar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Incluir archivo de conexión a la base de datos
    include '../../db/database.php';
    
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nameInput'];
    $correo = $_POST['emailInput'];
    $telefono = $_POST['phoneInput'];
    $fecha = $_POST['dateInput'];
    $hora = $_POST['timeInput']; // La hora aquí está en formato HH:MM
    $personas = $_POST['peopleInput'];
    $solicitudes = isset($_POST['messageTextarea']) ? $_POST['messageTextarea'] : '';

    // Consulta SQL para actualizar la reserva
    $sql = "UPDATE reservas SET nombre_cliente=?, correo_electronico=?, telefono=?, fecha_reserva=?, hora_reserva=TIME(?), numero_personas=?, solicitudes_especiales=? WHERE id=?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param("sssssisi", $nombre, $correo, $telefono, $fecha, $hora, $personas, $solicitudes, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../../index.html#reservas');
        exit();            
    } else {
        echo "Error al actualizar la reserva: " . $stmt->error;
    }
    
    // Cerrar la consulta y la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    echo "<p>Error: No se han recibido datos para actualizar la reserva.</p>";
}

?>
