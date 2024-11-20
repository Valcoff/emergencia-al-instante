<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu base de datos está en otro servidor
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL (si corresponde)
$dbname = "contacto_db"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos recibidos del formulario
    $nombre = $conn->real_escape_string($_POST['name']);
    $correo = $conn->real_escape_string($_POST['email']);
    $mensaje = $conn->real_escape_string($_POST['message']);

    // Verificar que los campos no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($mensaje)) {
        // Preparar la consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO mensajes (nombre, correo, mensaje) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        // Vincular los parámetros a la consulta
        $stmt->bind_param("sss", $nombre, $correo, $mensaje);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Mensaje enviado correctamente.";
        } else {
            echo "Error al enviar el mensaje: " . $stmt->error;
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "No se recibió el formulario correctamente.";
}
?>
