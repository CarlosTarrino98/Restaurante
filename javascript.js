// Escuchar cuando el contenido DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    // Obtener los elementos del formulario, los inputs de fecha y hora
    const dateInput = document.getElementById('dateInput');
    const timeInput = document.getElementById('timeInput');

    // Configurar la fecha mínima para el input de fecha usando la fecha actual
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);

    // Función para actualizar la hora mínima basada en la fecha seleccionada
    function updateMinTime() {
        const now = new Date(); // Objeto Date para obtener la fecha y hora actual
        const currentDate = now.toISOString().split('T')[0]; // Fecha actual en formato aaaa-mm-dd
        let hours = now.getHours(); // Hora actual
        let minutes = now.getMinutes(); // Minutos actuales

        // Formatear la hora actual para cumplir con el formato requerido por input de tipo 'time'
        let minTime = (hours < 10 ? '0' + hours : hours) + ':' + (minutes < 10 ? '0' + minutes : minutes);

        // Si la fecha seleccionada es igual a la fecha actual
        if (dateInput.value === currentDate) {
            if (hours >= 23 && minutes > 0) {
                // Desactivar el input de hora si es después de las 23:00 y mostrar una alerta
                timeInput.setAttribute('disabled', true);
                timeInput.value = ''; // Limpiar cualquier valor previamente seleccionado
                alert('No se pueden hacer reservas para el resto del día. Por favor selecciona otro día.');
            } else if (hours >= 13) {
                // Establecer la hora mínima a la hora actual si es después de las 13:00
                timeInput.setAttribute('min', minTime);
                timeInput.removeAttribute('disabled');
            } else {
                // Establecer la hora mínima a las 13:00 si es antes de las 13:00
                timeInput.setAttribute('min', '13:00');
                timeInput.removeAttribute('disabled');
            }
        } else {
            // Para fechas futuras, configurar la hora mínima a las 13:00 y asegurarse de que el input esté habilitado
            timeInput.setAttribute('min', '13:00');
            timeInput.removeAttribute('disabled');
        }
    }

    // Agregar un event listener para cuando cambie la fecha, llamar a updateMinTime
    dateInput.addEventListener('change', updateMinTime);
    // Llamar a updateMinTime al cargar la página para establecer la configuración inicial
    updateMinTime();


    // Selecciona todos los elementos de entrada requeridos dentro del formulario.
    // Esto incluye tanto <input> como <textarea> que tienen el atributo 'required'.
    const requiredInputs = document.querySelectorAll('#reservas input[required], #reservas textarea[required]');
    // Obtiene el elemento de la barra de progreso por su ID para poder manipularlo más adelante.
    const progressBar = document.getElementById('progressBar');
    // Almacena el número total de campos requeridos para calcular el porcentaje de progreso.
    const totalRequired = requiredInputs.length;

    // Función que actualiza la barra de progreso cada vez que se modifica cualquier campo requerido.
    function updateProgressBar() {
        // Inicializa un contador para los campos llenados.
        let filled = 0;
        // Recorre cada campo requerido y aumenta el contador si el campo no está vacío.
        requiredInputs.forEach(input => {
            if (input.value !== '') filled++;
        });

        // Calcula el porcentaje de campos llenados en base al total de campos requeridos.
        const percentageFilled = (filled / totalRequired) * 100;
        // Actualiza el ancho de la barra de progreso y el atributo 'aria-valuenow' para reflejar el progreso visualmente.
        progressBar.style.width = `${percentageFilled}%`;
        progressBar.setAttribute('aria-valuenow', percentageFilled);
        // Actualiza el texto de la barra de progreso para mostrar el porcentaje redondeado actual.
        progressBar.textContent = `${Math.round(percentageFilled)}%`;
    }

    // Añade un evento 'input' a cada campo requerido. Este evento se dispara cada vez que el usuario cambia el valor del campo.
    // Esto garantiza que la función updateProgressBar se ejecute, actualizando la barra de progreso de acuerdo con el estado actual de llenado del formulario.
    requiredInputs.forEach(input => {
        input.addEventListener('input', updateProgressBar);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Realizar una solicitud AJAX para obtener las reseñas
    $.ajax({
        url: 'php/opiniones/get_opiniones.php',
        type: 'GET',
        success: function (data) {
            // Insertar las reseñas en el elemento con ID 'reseñas'
            $('#reseñas').append(data);
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar las reseñas:', error);
        }
    });

    // Realizar una solicitud AJAX para obtener las reservas
    $.ajax({
        url: 'php/reservas/get_reservas.php',
        type: 'GET',
        success: function (data) {
            // Insertar las reservas en el cuerpo de la tabla
            $('#tablaReservas table tbody').html(data);
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar las reservas:', error);
        }
    });

});
