<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WeatherApp</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="root">
        <div class="index-page">
            <h1>Get Weather Forecast</h1>
            <form action="{{ route('forecast.page') }}" method="POST">
                @csrf
                <label for="location">Input location:</label><br>
                <input type="text" name="location" id="location">
                <button type="submit">Search</button>
            </form>

            @if(session()->has('success'))
                <p class="success">{{ session()->get('success') }}</p>
            @endif

            <h2>Subscribe to mailing list</h2>
            <button class="open-modal">Subscribe</button>

            <div class="modal">
                <div class="modal-content">
                    <form action="{{ route('service.subscribe') }}" method="POST">
                        @csrf
                        <label class="label" for="name-input">Name:</label><br>
                        <input type="text" name="name-input" id="name-input"><br>
                        <label class="label" for="email">Email:</label><br>
                        <input type="text" name="email" id="email"><br>
                        <label class="label" for="loc-of-sub">Forecast location:</label><br>
                        <input type="text" name="loc-of-sub" id="loc-of-sub"><br>
                        <button type="submit">Submit</button>
                    </form>
                    <button class="close-modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Shows modal for subscribing to mailing list
        $('.open-modal').on('click', function() {
            $('.modal, .modal-content').addClass('active');
            $('.open-modal').hide();
        });

        // Closes modal
        $('.close-modal').on('click', function() {
            $('.modal, .modal-content').removeClass('active');
            $('.open-modal').show();
        });
    </script>
</body>
</html>
