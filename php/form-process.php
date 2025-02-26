<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

var_dump(realpath('vendor/autoload.php'));

 // Asegúrate de que PHPMailer está instalado

$errorMSG = "";

// Validar y obtener los datos del formulario
$name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8') : '';
$number = isset($_POST["number"]) ? htmlspecialchars($_POST["number"], ENT_QUOTES, 'UTF-8') : '';
$guest = isset($_POST["guest"]) ? htmlspecialchars($_POST["guest"], ENT_QUOTES, 'UTF-8') : '';
$event = isset($_POST["event"]) ? htmlspecialchars($_POST["event"], ENT_QUOTES, 'UTF-8') : '';
$message = isset($_POST["message"]) ? htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8') : '';

// Validaciones
if (empty($name)) $errorMSG .= "El nombre es obligatorio. ";
if (empty($number)) $errorMSG .= "El número de teléfono es obligatorio. ";
if (empty($guest)) $errorMSG .= "El número de invitados es obligatorio. ";
if (empty($event)) $errorMSG .= "El tipo de evento es obligatorio. ";
if (empty($message)) $errorMSG .= "El mensaje es obligatorio. ";

// Si hay errores, los mostramos
if (!empty($errorMSG)) {
    echo $errorMSG;
    exit;
}

// Datos de la cuenta de correo
$emailTo = "DreamEvent@gmail.com";  // Correo destinatario
$emailFrom = "mireleslitzzy.06@@gmail.com";  // Correo remitente
$emailPassword = "gcgdsyoqsufbsyuc";  // Contraseña de aplicación
$smtpHost = "smtp.gmail.com";  // Servidor SMTP de Gmail
$smtpPort = 587;  // Puerto SMTP (TLS)

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $emailFrom;
    $mail->Password = $emailPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtpPort;

    // Configuración del correo
    $mail->setFrom($emailFrom, 'Dream Event'); // Nombre del remitente
    $mail->addAddress($emailTo); // Destinatario
    $mail->addReplyTo($number, $name); // Responder al número de teléfono

    $mail->Subject = "Nueva solicitud de contacto";
    $mail->Body = "Nombre: $name\n"
        . "Teléfono: $number\n"
        . "Número de invitados: $guest\n"
        . "Evento: $event\n"
        . "Mensaje: $message\n";

    // Enviar el correo
    if ($mail->send()) {
        echo "success";
    } else {
        echo "Error al enviar el mensaje.";
    }
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>
