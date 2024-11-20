<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambiar por tu servidor de base de datos
$username = "root";        // Tu usuario de base de datos
$password = "";            // Tu contraseña de base de datos
$dbname = "contacto_db";   // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger los datos del formulario
$nombre = $_POST['name'];
$correo_electronico = $_POST['email'];
$mensaje = $_POST['message'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO mensajes_contacto (nombre, correo_electronico, mensaje)
        VALUES ('$nombre', '$correo_electronico', '$mensaje')";

if ($conn->query($sql) === TRUE) {
    echo "Mensaje enviado correctamente.";
} else {
    echo "Error al enviar el mensaje: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
