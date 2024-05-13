<?php
include '../../db/database.php';

// Verificar si se han enviado datos a través del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar si se han recibido todos los datos necesarios
    if (isset($_POST['nombreCliente'], $_POST['descripcionResena'], $_POST['notaResena'])) {
        // Preparar y vincular los parámetros
        $stmt = $conn->prepare("INSERT INTO opiniones (nombre, opinion, calificacion) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre, $opinion, $calificacion);

        // Establecer parámetros y ejecutar la consulta
        $nombre = $_POST['nombreCliente'];
        $opinion = $_POST['descripcionResena'];
        $calificacion = $_POST['notaResena'];

        if ($stmt->execute()) {
            header('Location: ../../index.html#reseñas');
            exit();            
        } else {
            echo "Error al guardar la reseña: " . $stmt->error;
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
