<?php

namespace App\Console\Commands;

use App\Http\Controllers\Controller;
use App\Mail\MailService;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail containing weather data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {
            $mail = $subscriber->email;
            $location = $subscriber->location;

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
            $headline = $forecasts['Headline'];
            $daily = $forecasts['DailyForecasts'][0];

            Mail::to($mail)->send(new MailService($subscriber, $headline, $daily));
        }
    }
}
