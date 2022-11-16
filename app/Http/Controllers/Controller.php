<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use function MongoDB\BSON\toJSON;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index() {

    }

    /*
     * Receive input from user
     * request a location from API
     *
     * @return view
     */
    public function forecast(Request $request)
    {
        // receive requested location
        $loc = $request->input('location');

        // Get api key from config files
        $api_key = config('accu.api_key');

        // Parse the location data and get location key
        $loc_url = "http://dataservice.accuweather.com/locations/v1/cities/autocomplete?apikey=${api_key}&q=${loc}";
        $loc_file = file_get_contents($loc_url);
        $loc_data = json_decode($loc_file, true);
        $loc_key = $loc_data[0]['Key'];
        $location = $loc_data[0]['LocalizedName'];

        $url = "http://dataservice.accuweather.com/forecasts/v1/daily/1day/${loc_key}?apikey=${api_key}&details=true&metric=true";

        $json = file_get_contents($url);
        $forecasts = json_decode($json, true);

        $headline = $forecasts['Headline'];

        $daily = $forecasts['DailyForecasts'][0];

        return view('forecast', [
                'forecasts' => $forecasts,
                'headline' => $headline,
                'daily' => $daily,
                'location' => $location,
            ]
        );
    }
}

