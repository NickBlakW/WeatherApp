<?php

namespace App\Console\Commands;

use App\Http\Controllers\Controller;
use App\Mail\MailService;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyMail extends Command
{
    private Controller $controller;

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
     * @return void
     */
    public function handle()
    {
        $subscribers = Subscriber::all();

        foreach ($subscribers as $subscriber) {
            $mail = $subscriber->email;
            $location = $subscriber->location;

            $this->controller = new Controller();
            $forecast = $this->controller->getData($location);

            $headline = $forecast['Headline'];
            $daily = $forecast['DailyForecasts'][0];

            Mail::to($mail)->send(new MailService($subscriber, $headline, $daily));
        }
    }
}
