<?php
// Comprobar si se ha enviado un ID válido
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Incluir archivo de conexión a la base de datos
    include '../../db/database.php';
    
    // Obtener el ID de la reseña
    $id = $_GET['id'];
    
    // Consulta SQL para obtener la reseña específica
    $sql = "SELECT * FROM opiniones WHERE id = $id";
    $result = $conn->query($sql);
    
    // Comprobar si se encontró una reseña con el ID dado
    if ($result->num_rows == 1) {
        // Obtener los datos de la reseña
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $opinion = $row['opinion'];
        $calificacion = $row['calificacion'];
?>

<!-- Formulario de edición de reseña -->
<h2>Editar reseña</h2>
<form action="update_opiniones.php" method="POST" class="mt-4">
    <!-- Campo oculto para enviar el ID de la reseña -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <!-- Campos para editar los detalles de la reseña -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>">
    </div>
    
    <div class="mb-3">
        <label for="opinion" class="form-label">Opinión:</label>
        <textarea class="form-control" name="opinion" rows="4" cols="50"><?php echo $opinion; ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="calificacion" class="form-label">Calificación:</label>
        <input type="number" class="form-control" name="calificacion" value="<?php echo $calificacion; ?>" min="0" max="10">
    </div>
    
    <!-- Botón para enviar el formulario -->
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>

<!-- Incluir los estilos y scripts de Bootstrap en el encabezado -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- scripts para añadir bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php
    } else {
        echo "<p>No se encontró ninguna reseña con el ID proporcionado.</p>";
    }
    
    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporciona un ID válido en la URL, redirigir o mostrar un mensaje de error
    echo "<p>ID de reseña no válido.</p>";
}
?>
