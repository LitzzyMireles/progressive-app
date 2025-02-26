<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dream_event_db";

// Establecer cabecera de respuesta para JSON
header('Content-Type: application/json');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['name'] ?? '');
    $telefono = trim($_POST['number'] ?? '');
    $invitados = trim($_POST['guest'] ?? '');
    $servicio = trim($_POST['event'] ?? '');
    $mensaje = trim($_POST['message'] ?? '');

    // Validar datos
    if (empty($nombre) || empty($telefono) || empty($invitados) || empty($servicio) || empty($mensaje)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    // Conectar a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "Error en la conexión a la base de datos."]);
        exit;
    }

    // Insertar datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO contactos (nombre, telefono, invitados, servicio, mensaje) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $telefono, $invitados, $servicio, $mensaje);

    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Error al guardar los datos en la base de datos."]);
        exit;
    }

    $stmt->close();
    $conn->close();

    // Enviar correo con PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mireleslitzzy.06@gmail.com';
        $mail->Password = 'gcgd syoq sufb syuc'; // Usa una App Password en lugar de tu clave real
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('Dream_Event_Team@gmail.com', 'Dream Event Team');
        $mail->addAddress('mireleslitzzy.06@gmail.com');

        $mail->Subject = "NUEVA SOLICITUD PARA EVENTO";
        $mail->isHTML(true);
        $mail->Body = "
            <h2>Nueva solicitud de evento</h2>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Teléfono:</strong> $telefono</p>
            <p><strong>Invitados:</strong> $invitados</p>
            <p><strong>Servicio:</strong> $servicio</p>
            <p><strong>Mensaje:</strong><br>$mensaje</p>
        ";

        if ($mail->send()) {
            echo json_encode(["status" => "success", "message" => "Solicitud enviada con éxito."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al enviar el correo."]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error en el envío del correo: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método de acceso no permitido."]);
}
?>