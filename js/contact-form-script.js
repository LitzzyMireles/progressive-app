$(document).ready(function() {
    $("#contactForm").on("submit", function(event) {
        event.preventDefault(); // Evita que la página se recargue

        // Obtener valores del formulario
        var name = $("#name").val();
        var number = $("#number").val();
        var guest = $("#guest").val();
        var eventType = $("#event").val();
        var message = $("#message").val();

        // Validar que todos los campos estén completos
        if (!name || !number || !guest || !eventType || !message) {
            submitMSG(false, "Todos los campos son obligatorios.");
            return;
        }

        // Enviar formulario mediante AJAX
        $.ajax({
            type: "POST",
            url: "php/contacto.php",  // Asegúrate de que esta ruta sea correcta
            data: {
                name: name,
                number: number,
                guest: guest,
                event: eventType,
                message: message
            },
            success: function(response) {
                console.log(response); // Agregar esto para depuración
                let data = JSON.parse(response);  // Suponemos que el servidor devuelve un JSON

                if (data.status === "success") {
                    $("#contactForm")[0].reset();
                    $("#msgSubmit").removeClass("hidden").text(data.message);
                    
                    // Ocultar el mensaje después de 5 segundos
                    setTimeout(function() {
                        $("#msgSubmit").addClass("hidden");
                    }, 5000);
                } else {
                    $("#msgSubmit").removeClass("hidden").text(data.message || "Error al enviar el formulario.");
                }
            },
            error: function() {
                $("#msgSubmit").removeClass("hidden").text("Hubo un error al procesar la solicitud.");
            }
        });
    });
});

// Funciones de retroalimentación visual
function submitMSG(valid, msg) {
    var msgClasses = valid ? "h3 text-center tada animated text-success" : "h3 text-center text-danger";
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}
