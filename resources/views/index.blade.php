<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WeatherApp</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="root">
        <h1>Get Weather Forecast</h1>
        <form action="{{ route('forecast.page') }}" method="POST">
            @csrf
            <label for="location">Input location:</label><br>
            <input type="text" name="location" id="location">
            <button type="submit">Search</button>
        </form>
    </div>
</body>
</html>
