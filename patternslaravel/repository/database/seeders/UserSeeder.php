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
        User::create([
            'first_name' => 'Fernando',
            'last_name' => 'Calmet',
            'email' => 'user01@gmail.com'
        ]);

        User::create([
            'first_name' => 'Andres',
            'last_name' => 'Ramírez',
            'email' => 'user02@gmail.com'
        ]);

        User::factory()->times(10000)->create();
    }
}
