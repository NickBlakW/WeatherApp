<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Seeder for testing purposes
         * Run for 4 iterations
         */
        $iterations = 4;

        for ($i = 0; $i < $iterations; $i++) {
            $this->populate();
        }
    }

    private function populate() {
        // Populate database with random data
        DB::table('subscribers')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'location' => Str::random(5),
        ]);
    }
}
