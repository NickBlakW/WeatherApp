<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="root">
        <h1 class="page-title">Today's Weather</h1>

        <p class="common-text">Good morning {{  $subscriber->name }}</p>
        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="title">Day</h2>
                    <p class="align-small location">{{ ucfirst($subscriber->location) }}</p>
                    <p class="align-small">Date: {{ $daily['Date'] }}</p>
                </div>

                <div class="temp">
                    <span>Temperatures:</span>
                    <p>Min: {{ $daily['Temperature']['Minimum']['Value'] }}C</p>
                    <p>Max: {{ $daily['Temperature']['Maximum']['Value'] }}C</p>

                </div>
                <div class="real-feel-temps">
                    <div>
                        <p>Real Feel Min: {{ $daily['RealFeelTemperature']['Minimum']['Value'] }}C</p>
                        <p>Real Feel Max: {{ $daily['RealFeelTemperature']['Maximum']['Value'] }}C</p>
                    </div>
                    <div class="real-feel-shade">
                        <p>Real Feel Min: {{ $daily['RealFeelTemperatureShade']['Minimum']['Value'] }}C</p>
                        <p>Real Feel Max: {{ $daily['RealFeelTemperatureShade']['Maximum']['Value'] }}C</p>
                    </div>
                </div>
            </div>

            <div class="card-content">
                <div class="common-text">
                    <p class="summary">{{ $headline['Text'] }}</p>
                    <p class="summary">{{ $daily['Day']['LongPhrase'] }}</p>
                </div>
                <div class="data-display">
                    <div class="data-display-left">
                        <p class="data-display-item">
                            Wind Speed
                            <span class="data-value">
                                {{ $daily['Day']['Wind']['Speed']['Value'] }}
                                {{ $daily['Day']['Wind']['Speed']['Unit'] }}
                                {{ $daily['Day']['Wind']['Direction']['English'] }}
                            </span>
                        </p>
                        <p class="data-display-item">
                            Wind Gusts
                            <span class="data-value">
                                {{ $daily['Day']['WindGust']['Speed']['Value'] }}
                                {{ $daily['Day']['WindGust']['Speed']['Unit'] }}
                            </span>
                        </p>
                        <p class="data-display-item">
                            Precipitation Probability
                            <span class="data-value">
                                {{ $daily['Day']['PrecipitationProbability'] }}%
                            </span>
                        </p>
                    </div>
                    <div class="data-display-right">
                        <p class="data-display-item">
                            Cloud Cover
                            <span class="data-value">
                                {{ $daily['Day']['CloudCover'] }}%
                            </span>
                        </p>
                        <p class="data-display-item">
                            UV Index
                            <span class="data-value">
                                {{ $daily['AirAndPollen'][5]['Value'] }}
                                {{ $daily['AirAndPollen'][5]['Category'] }}
                            </span>
                        </p>
                        <p class="data-display-item">
                            Overall Today
                            <span class="data-value">
                                {{ $daily['Day']['IconPhrase'] }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h2 class="title">Night</h2>
                    <p class="align-small location">{{ ucfirst($subscriber->location) }}</p>
                    <p class="align-small">Date: {{ $daily['Date'] }}</p>
                </div>

                <div class="temp">
                    <p>Temperatures:</p>
                    <p>Min: {{ $daily['Temperature']['Minimum']['Value'] }}C</p>
                    <p>Max: {{ $daily['Temperature']['Maximum']['Value'] }}C</p>
                    <span class="hi-lo"></span>
                </div>
                <div class="real-feel-temps">
                    <div>
                        <p>Real Feel: {{ $daily['RealFeelTemperature']['Minimum']['Value'] }}C</p>
                    </div>
                </div>
            </div>

            <div class="card-content">
                <div class="common-text">
                    <p class="summary">{{ $headline['Text'] }}</p>
                    <p class="summary">{{ $daily['Night']['LongPhrase'] }}</p>
                </div>
                <div class="data-display">
                    <div class="data-display-left">
                        <p class="data-display-item">
                            Wind Speed
                            <span class="data-value">
                                {{ $daily['Night']['Wind']['Speed']['Value'] }}
                                {{ $daily['Night']['Wind']['Speed']['Unit'] }}
                                {{ $daily['Night']['Wind']['Direction']['English'] }}
                            </span>
                        </p>
                        <p class="data-display-item">
                            Wind Gusts
                            <span class="data-value">
                                {{ $daily['Night']['WindGust']['Speed']['Value'] }}
                                {{ $daily['Night']['WindGust']['Speed']['Unit'] }}
                            </span>
                        </p>
                        <p class="data-display-item">
                            Precipitation Probability
                            <span class="data-value">
                                {{ $daily['Night']['PrecipitationProbability'] }}%
                            </span>
                        </p>
                    </div>
                    <div class="data-display-right">
                        <p class="data-display-item">
                            Cloud Cover
                            <span class="data-value">
                                {{ $daily['Night']['CloudCover'] }}%
                            </span>
                        </p>
                        <p class="data-display-item">
                            UV Index
                            <span class="data-value">
                                {{ $daily['AirAndPollen'][5]['Value'] }}
                                {{ $daily['AirAndPollen'][5]['Category'] }}
                            </span>
                        </p>
                        <p class="data-display-item">
                            Overall Today
                            <span class="data-value">
                                {{ $daily['Night']['IconPhrase'] }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <p>@Source: {{ $daily['Sources'][0] }}</p>
    </div>
</body>
</html>
