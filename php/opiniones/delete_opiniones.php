<?php
// Comprobar si se ha enviado un ID válido
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Incluir archivo de conexión a la base de datos
    include '../../db/database.php';
    
    // Obtener el ID de la reseña
    $id = $_GET['id'];
    
    // Consulta SQL para eliminar la reseña específica
    $sql = "DELETE FROM opiniones WHERE id = $id";
    
    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        header('Location: ../../index.html#reseñas');
        exit(); 
    } else {
        echo "<p>Error al eliminar la reseña: " . $conn->error . "</p>";
    }
    
    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporciona un ID válido en la URL, redirigir o mostrar un mensaje de error
    echo "<p>ID de reseña no válido.</p>";
}
?>
