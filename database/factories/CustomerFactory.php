<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'customerNumber' => $this->faker->unique()->numerify('CUST####'),
            'name'           => $this->faker->company,
            'fiscalData'     => $this->faker->numerify('TAX#######'),
        ];
    }
}
