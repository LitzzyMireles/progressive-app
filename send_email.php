<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "";
    $telefono = $_POST["number"] ?? "";
    $invitados = $_POST["guest"] ?? "";
    $servicio = $_POST["event"] ?? "";
    $mensaje = $_POST["message"] ?? "";

    if (empty($name) || empty($telefono) || empty($invitados) || empty($servicio) || empty($mensaje)) {
        die("Todos los campos son obligatorios.");
    }

    $mail = new PHPMailer(true);

    try {
        // Activar depuración SMTP
        $mail->SMTPDebug = 2;  
        $mail->Debugoutput = 'html';

        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mireleslitzzy.06@gmail.com';
        $mail->Password = 'gcgdsyoqsufbsyuc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el remitente y destinatario
        $mail->setFrom('mireleslitzzy.06@gmail.com', 'DreamEvent');
        $mail->addAddress('mireleslitzzy.06@gmail.com');  

        // Contenido del correo
        $mail->Subject = "Nueva solicitud de contacto";
        $mail->Body = "Nombre: $name\nTeléfono: $telefono\nInvitados: $invitados\nServicio: $servicio\nMensaje: $mensaje";

        // Enviar correo
        if ($mail->send()) {
            echo "success";
        } else {
            echo "Error al enviar el correo.";
        }
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Acceso no permitido.";
}
?>
