@extends('layouts.weather')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white/80 backdrop-blur-sm rounded-lg shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">El Tiempo en</h1>
            <div class="flex space-x-4">
                <input type="text" id="cityInput" placeholder="Buscar ciudad..." 
                    class="px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                <button onclick="searchWeather()" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Buscar
                </button>
            </div>
        </div>

        <div id="weatherInfo" class="hidden">
            <div class="text-center mb-8">
                <h2 id="cityName" class="text-4xl font-bold text-gray-800 mb-2"></h2>
                <p id="currentDate" class="text-xl text-gray-600"></p>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-center">
                        <pre id="weatherAscii" class="font-mono text-sm whitespace-pre overflow-x-auto max-w-full"></pre>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Pronóstico Detallado</h3>
                    <div id="weatherDetails" class="text-lg"></div>
                </div>
            </div>
        </div>

        <div id="errorMessage" class="hidden text-center text-red-600 mt-4 p-4 bg-red-100 rounded-lg"></div>
    </div>
</div>

<script>
async function searchWeather() {
    const cityInput = document.getElementById('cityInput').value;
    if (!cityInput) return;

    try {
        const response = await fetch(`https://wttr.in/${encodeURIComponent(cityInput)}?format=j1`);
        if (!response.ok) {
            throw new Error('Ciudad no encontrada');
        }
        const data = await response.json();
        updateWeatherInfo(data, cityInput);
    } catch (error) {
        showError('No se pudo obtener la información del tiempo');
    }

    try {
        const asciiResponse = await fetch(`https://wttr.in/${encodeURIComponent(cityInput)}?0AT`);
        const asciiArt = await asciiResponse.text();
        document.getElementById('weatherAscii').textContent = asciiArt;
    } catch (error) {
        document.getElementById('weatherAscii').textContent = 'Arte ASCII no disponible';
    }
}

function updateWeatherInfo(data, city) {
    document.getElementById('weatherInfo').classList.remove('hidden');
    document.getElementById('errorMessage').classList.add('hidden');

    document.getElementById('cityName').textContent = city;
    document.getElementById('currentDate').textContent = new Date().toLocaleDateString('es-ES', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    const current = data.current_condition[0];
    const details = document.getElementById('weatherDetails');
    details.innerHTML = `
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600">Temperatura</p>
                <p class="text-xl font-semibold">${current.temp_C}°C</p>
            </div>
            <div>
                <p class="text-gray-600">Humedad</p>
                <p class="text-xl font-semibold">${current.humidity}%</p>
            </div>
            <div>
                <p class="text-gray-600">Viento</p>
                <p class="text-xl font-semibold">${current.windspeedKmph} km/h</p>
            </div>
            <div>
                <p class="text-gray-600">Visibilidad</p>
                <p class="text-xl font-semibold">${current.visibility} km</p>
            </div>
        </div>
        <div class="mt-4">
            <p class="text-gray-600">Descripción</p>
            <p class="text-xl font-semibold">${current.weatherDesc[0].value}</p>
        </div>
    `;
}

function showError(message) {
    const errorDiv = document.getElementById('errorMessage');
    errorDiv.textContent = message;
    errorDiv.classList.remove('hidden');
    document.getElementById('weatherInfo').classList.add('hidden');
}

// Cargar el tiempo de una ciudad por defecto al iniciar
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cityInput').value = 'Madrid';
    searchWeather();
});

// Permitir búsqueda al presionar Enter
document.getElementById('cityInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchWeather();
    }
});
</script>
@endsection
