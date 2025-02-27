<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dream_event_db";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del contacto
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM contactos WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $contacto = $result->fetch_assoc();
    
    $stmt->close();
}

// Actualizar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $invitados = $_POST['invitados'];
    $servicio = $_POST['servicio'];
    $mensaje = $_POST['mensaje'];

    $sql = "UPDATE contactos SET nombre=?, telefono=?, invitados=?, servicio=?, mensaje=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $telefono, $invitados, $servicio, $mensaje, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Contacto actualizado correctamente.'); window.location='index2.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el contacto.');</script>";
    }

    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contacto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Editar Contacto</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $contacto['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $contacto['telefono']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Invitados</label>
                <input type="text" class="form-control" name="invitados" value="<?php echo $contacto['invitados']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Servicio</label>
                <input type="text" class="form-control" name="servicio" value="<?php echo $contacto['servicio']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mensaje</label>
                <textarea class="form-control" name="mensaje" required><?php echo $contacto['mensaje']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index2.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
