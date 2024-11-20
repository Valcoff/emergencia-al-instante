<?php
$servername = "localhost";
$username = "root";  // Cambia esto por tu usuario de MySQL
$password = "";      // Cambia esto por tu contraseña de MySQL
$dbname = "contacto_db";  // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO turnos (nombre, apellido, email, fecha, hora) VALUES ('$nombre', '$apellido', '$email', '$fecha', '$hora')";

if ($conn->query($sql) === TRUE) {
    echo "Turno reservado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

