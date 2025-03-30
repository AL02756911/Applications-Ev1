<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'roleName'    => $this->faker->randomElement(['Sales', 'Purchasing', 'Warehouse', 'Route', 'Administrator']),
            'description' => $this->faker->sentence,
        ];
    }
}
