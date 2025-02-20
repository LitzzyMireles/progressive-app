<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $guest = htmlspecialchars($_POST["guest"]);
    $event = htmlspecialchars($_POST["event"]);
    $message = htmlspecialchars($_POST["message"]);

    // Enviar correo
    $to = "TU_CORREO@ejemplo.com";
    $subject = "Nuevo mensaje de contacto de $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_body = "Nombre: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Número de invitados: $guest\n";
    $email_body .= "Evento: $event\n";
    $email_body .= "Mensaje:\n$message\n";

    // Firebase: Guardar los datos
    $firebase_url = "https://TU_PROYECTO.firebaseio.com/contactos.json";
    $data = json_encode(["name" => $name, "email" => $email, "guest" => $guest, "event" => $event, "message" => $message]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $firebase_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    if (mail($to, $subject, $email_body, $headers)) {
        echo "<script>alert('Mensaje enviado correctamente'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Acceso no permitido'); window.location.href='index.html';</script>";
}
?>
