<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurante_exquisite";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// La conexión está ahora disponible para ser incluida y usada en otros scripts PHP
?>
