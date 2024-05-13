<?php
// Comprobar si se ha enviado un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Incluir archivo de conexión a la base de datos
    include '../../db/database.php';

    // Obtener el ID de la reserva
    $id = $_GET['id'];

    // Consulta SQL para obtener la reserva específica
    $sql = "SELECT id, nombre_cliente, correo_electronico, telefono, fecha_reserva, TIME_FORMAT(hora_reserva, '%H:%i') AS hora_reserva, numero_personas, solicitudes_especiales 
            FROM reservas WHERE id = $id";
    $result = $conn->query($sql);

    // Comprobar si se encontró una reserva con el ID dado
    if ($result->num_rows == 1) {
        // Obtener los datos de la reserva
        $row = $result->fetch_assoc();
        $nombre = $row['nombre_cliente'];
        $correo = $row['correo_electronico'];
        $telefono = $row['telefono'];
        $fecha = $row['fecha_reserva'];
        $hora = $row["hora_reserva"];
        $personas = $row['numero_personas'];
        $solicitudes = $row['solicitudes_especiales'];
?>

        <!-- Formulario de edición de reserva -->
        <h2>Editar Reserva</h2>
        <form action="update_reservas.php" method="POST" class="mt-4">
            <!-- Campo oculto para enviar el ID de la reserva -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <!-- Campos para editar los detalles de la reserva -->
            <div class="form-group">
                <label for="nameInput">Nombre</label>
                <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?php echo $nombre; ?>">
            </div>

            <div class="form-group">
                <label for="emailInput">Correo Electrónico</label>
                <input type="email" class="form-control" id="emailInput" name="emailInput" value="<?php echo $correo; ?>">
            </div>

            <div class="form-group">
                <label for="phoneInput">Teléfono</label>
                <input type="tel" class="form-control" id="phoneInput" name="phoneInput" value="<?php echo $telefono; ?>">
            </div>

            <div class="form-group">
                <label for="dateInput">Fecha</label>
                <input type="date" class="form-control" id="dateInput" name="dateInput" value="<?php echo $fecha; ?>">
            </div>

            <div class="form-group">
                <label for="timeInput">Hora</label>
                <input type="time" class="form-control" id="timeInput" name="timeInput" min="13:00" max="23:00" value="<?php echo date('H:i', strtotime($hora)); ?>"><br>
            </div>

            <div class="form-group">
                <label for="peopleInput">Número de Personas</label>
                <input type="number" class="form-control" id="peopleInput" name="peopleInput" min="1" value="<?php echo $personas; ?>">
            </div>

            <div class="form-group">
                <label for="messageTextarea">Solicitudes Especiales</label>
                <textarea class="form-control" id="messageTextarea" name="messageTextarea" rows="3"><?php echo $solicitudes; ?></textarea>
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
        echo "<p>No se encontró ninguna reserva con el ID proporcionado.</p>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se proporciona un ID válido en la URL, redirigir o mostrar un mensaje de error
    echo "<p>ID de reserva no válido.</p>";
}
?>