// Función para obtener la ubicación
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showWeather);
    } else {
        alert("La geolocalización no está soportada por este navegador.");
    }
}

// Función para mostrar el clima usando la API de OpenWeather
function showWeather(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    // API Key de OpenWeather (obténla en https://openweathermap.org/)
    const apiKey = 'd0aa5ff64faa8720173625e03c5f973e';
    
    // URL de la API para obtener el clima
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric&lang=es`;

    // Hacer la solicitud a la API
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const temp = data.main.temp;
            const description = data.weather[0].description;
            const weatherInfo = `
                <p>Temperatura: ${temp}°C</p>
                <p>Condición: ${description}</p>
            `;
            document.getElementById('weather-info').innerHTML = weatherInfo;
        })
        .catch(error => {
            document.getElementById('weather-info').innerHTML = "<p>No se pudo obtener el clima.</p>";
        });
}
