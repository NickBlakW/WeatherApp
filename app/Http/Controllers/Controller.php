<?php

namespace App\Http\Controllers;

use App\Mail\MailService;
use App\Models\Subscriber;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

        $forecasts = $this->getData($loc);

        // Variables for easy access of data in blade-files
        $headline = $forecasts['Headline'];
        $daily = $forecasts['DailyForecasts'][0];

        $location = ucfirst($loc);

        return view('forecast', [
                'forecasts' => $forecasts,
                'headline' => $headline,
                'daily' => $daily,
                'location' => $location,
            ]
        );
    }

    /*
     * Get data from the API
     *
     */
    private function getData(string $location) {
        // Get api key from config files
        $api_key = config('accu.api_key');

        // Parse the location data and get location key
        $loc_url = "http://dataservice.accuweather.com/locations/v1/cities/autocomplete?apikey=${api_key}&q=${location}";
        $loc_file = file_get_contents($loc_url);
        $loc_data = json_decode($loc_file, true);
        $loc_key = $loc_data[0]['Key'];

        // URL for getting general forecast for the day at given location
        $url = "http://dataservice.accuweather.com/forecasts/v1/daily/1day/${loc_key}?apikey=${api_key}&details=true&metric=true";

        // Parse data and decode for easier processing
        $json = file_get_contents($url);
        $forecasts = json_decode($json, true);

        return $forecasts;
    }

    /*
     *  Function for subscribing to mailing list
     *  Sends input data to MySQL database
     *
     */
    public function subscribe(Request $request) {
        $subscriber = new Subscriber();
        $subscriber->name= $request->input('name-input');
        $subscriber->email = $request->input('email');
        $subscriber->location = $request->input('loc-of-sub');
        $subscriber->save();

        return back()->with('success', 'Successfully subscribed to mailing list');
    }
}

