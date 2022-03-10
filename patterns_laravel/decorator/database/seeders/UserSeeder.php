<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->times(30000)->create();
    }
}
