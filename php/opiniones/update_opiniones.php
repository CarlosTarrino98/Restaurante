<?php
// Comprobar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Incluir archivo de conexión a la base de datos
    include '../../db/database.php';
    
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $opinion = $_POST['opinion'];
    $calificacion = $_POST['calificacion'];
    
    // Consulta SQL para actualizar la reseña
    $sql = "UPDATE opiniones SET nombre='$nombre', opinion='$opinion', calificacion='$calificacion' WHERE id='$id'";
    
    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        header('Location: ../../index.html#reseñas');
        exit();
    } else {
        echo "<p>Error al actualizar la reseña: " . $conn->error . "</p>";
    }
    
    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se reciben los datos del formulario, redirigir o mostrar un mensaje de error
    echo "<p>Error: No se han recibido datos para actualizar la reseña.</p>";
}
?>
