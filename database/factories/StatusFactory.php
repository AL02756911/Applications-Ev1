<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    protected $model = Status::class;

    public function definition()
    {
        return [
            'statusName' => $this->faker->randomElement(['Ordered', 'In Process', 'In Route', 'Delivered']),
        ];
    }
}
