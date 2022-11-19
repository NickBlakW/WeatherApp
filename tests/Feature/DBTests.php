<?php

namespace Tests\Feature;

use Database\Seeders\SubscriberSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DBTests extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to show if db gets populated using seeder.
     * @test
     * @return void
     */
    public function test_populate_db(): void
    {
        $this->seed(SubscriberSeeder::class);

        $this->assertDatabaseCount('subscribers', 4);
    }

    /**
     * Test if database gets refreshed after first test.
     * @test
     * @return void
     */
    public function test_db_empty(): void
    {
        $this->assertDatabaseEmpty('subscribers');
    }
}
