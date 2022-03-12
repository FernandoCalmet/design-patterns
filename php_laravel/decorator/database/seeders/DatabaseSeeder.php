<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TicketSeeder::class,
            UserSeeder::class,
            CarSeeder::class
        ]);
    }
}
