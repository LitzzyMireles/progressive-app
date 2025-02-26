<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $telefono = $_POST['number'];
    $invitados = $_POST['guest'];
    $servicio = $_POST['event'];
    $mensaje = $_POST['message'];

    // Conectar a la base de datos
    $conn = new mysqli("localhost", "root", "", "dream_event_db");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Insertar datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO contactos (nombre, telefono, invitados, servicio, mensaje) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $telefono, $invitados, $servicio, $mensaje);

    if ($stmt->execute()) {
        // Enviar correo
        $to = "mireleslitzzy.06@gmail.com";
        $subject = "Nueva solicitud de contacto";
        $body = "Nombre: $nombre\nTeléfono: $telefono\nInvitados: $invitados\nServicio: $servicio\nMensaje: $mensaje";
        $headers = "From: noreply@tuweb.com";

        if (mail($to, $subject, $body, $headers)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
