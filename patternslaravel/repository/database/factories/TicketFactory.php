<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date('Y-m-d'),
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'car_id' => Car::factory()->create()->id
        ];
    }
}
