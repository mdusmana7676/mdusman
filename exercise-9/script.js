const apiKey = "YOUR_API_KEY";

function getWeather() {
    const city = document.getElementById("city").value.trim();
    const weather = document.getElementById("weather");

    if (city === "") {
        weather.innerHTML = "<p class='error'>Please enter a city name.</p>";
        return;
    }

    weather.innerHTML = "<p>Loading weather data...</p>";

    const url = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(city)}&appid=${apiKey}&units=metric`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error("City not found or API request failed");
            }
            return response.json();
        })
        .then(data => {
            weather.innerHTML = `
                <h2>${data.name}, ${data.sys.country}</h2>
                <img class="weather-icon"
                     src="https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png">
                <h2>${data.main.temp} °C</h2>
                <p>${data.weather[0].description}</p>
                <p>Feels Like: ${data.main.feels_like} °C</p>
                <p>Humidity: ${data.main.humidity}%</p>
                <p>Wind Speed: ${data.wind.speed} m/s</p>
            `;
        })
        .catch(error => {
            weather.innerHTML = `<p class="error">${error.message}</p>`;
        });
}