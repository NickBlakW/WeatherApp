# Weather App
This app is made to show a general weather forecast for a location
which can be searched for. It uses the AccuWeather API.

A simple database is implemented to get subscriptions for a mailing
service. This service sends a mail every day at 6am to all subscriber with information
about the weather of the day at a requested location.

A test case for checking if the database gets populated.

## How to use:
*   Get api key from https://developer.accuweather.com/
*   Run `cp .env.example .env` and insert remaining details:
    * ACCU_API_KEY
    * MAIL_USERNAME
    * MAIL_PASSWORD
    * MAIL_FROM_ADDRESS
*   Run `php artisan key:generate`
*   Run `composer install`
*   Run `docker-compose up -d` to start MySQL database in docker
*   Run `php artisan migrate` to create SQL tables 
*   Run `php artisan serve` to start dev server

## Issues
*   An issue with this app is that the api call for the location only considers the first item in the array from the JSON response.
This means that if there is two locations with the same name it will only show the first search result.


*   The email-addresses have been set as "unique" in the database.
This is done to ensure that a subscriber is not spammed with data every day.
The downside is that a subscriber can only receive data from one location.


*   The application has only been tested with the free AccuWeather API-key, which has a limit of 50 API calls per issued key.
The API calls work and is not a big issue, but have the limitation which a user should be aware of.
