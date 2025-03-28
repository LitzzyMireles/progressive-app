<?php
// Configuración de la base de datos
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "dream_event_db";
$servername = "mnz.domcloud.co";
$username = "dream-event-team";
$password = ")1)X5gkmJ4W+1u1JiO";
$dbname = "dream_event_team_db";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se recibió el ID a eliminar
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM contactos WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Contacto eliminado correctamente.'); window.location='index2.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el contacto.'); window.location='index2.php';</script>";
    }
    
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>
