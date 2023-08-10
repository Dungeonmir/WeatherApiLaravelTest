<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="antialiased">
<div class="flexColumn justifyItems">
    <div class="flexColumn">
        <h1 class="currentPosition">Санкт-Петербург</h1>
        <button class="btn btnGeo flexRow">
            <img src="../resources/images/location.png" class="iconPos" width="20px">
            Мое местоположение
        </button>
    </div>
    <div class="flexColumn">
        <div class="flexRow">
            <img class="imgIcon" src="/" alt="image" hidden>
            <h1 class="temp thin"></h1>
        </div>

        <p class="description"></p>
    </div>
    <div class="flexRow gap">

        <div class="block">
            <h3 class="">Ветер</h3>
            <p class="wind"></p>
        </div>
        <div class="block">
            <h3 class="">Влажность</h3>
            <p class="humidity"></p>
        </div>

        <div class="block">
            <h3 class="">Давление</h3>
            <p class="pressure"></p>
        </div>
    </div>
</div>


<script defer>
    function windDirection(deg) {
        const directions = [
            'северный', 'северо-восточный', 'восточный',
            'юго-восточный', 'южный', 'юго-западный',
            'западный', 'северо-западный'];
        return directions[Math.round(deg / 45) % 8];
    }

    function fetchData(position) {
        fetch(window.location + `api/getWeather?lat=${position.lat}&lon=${position.lon}`).then(async (data) => {
            console.log(data);
            let json = await data?.json();
            let tempEl = document.querySelector('.temp');
            let humidityEl = document.querySelector('.humidity');
            let descriptionEl = document.querySelector('.description');
            let pressureEl = document.querySelector('.pressure');
            let windEl = document.querySelector('.wind');
            let iconEl = document.querySelector('.imgIcon');
            let currentPositionEl = document.querySelector('.currentPosition');

            currentPositionEl.textContent = json?.name;
            humidityEl.textContent = json?.main?.humidity + "%";
            tempEl.textContent = json?.main?.temp + "°";

            let description = json?.weather[0]?.description;
            descriptionEl.textContent = description[0].toUpperCase() + description.slice(1);

            pressureEl.textContent = json?.main?.pressure + " мм рт. ст.";
            windEl.textContent = json?.wind?.speed + " м/с, " + windDirection(json?.wind?.deg);
            iconEl.src = '../resources/images/' + json?.weather[0].icon + '.png';
            iconEl.hidden = false;
            console.log(json);
        })
    }


    const btnGeo = document.querySelector('.btnGeo');
    btnGeo.addEventListener('click', () => {
        navigator.geolocation.getCurrentPosition((position) => {
            const lat = position.coords.latitude.toFixed(1);
            const lon = position.coords.longitude.toFixed(1);
            fetchData({lat, lon});
            console.log(position.coords.latitude, position.coords.longitude);
        });
    })
    fetchData({lat: 59.9, lon: 30.3})

</script>
</body>
</html>
