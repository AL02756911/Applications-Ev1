<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();
        $status   = Status::inRandomOrder()->first() ?? Status::factory()->create();

        return [
            'invoiceNumber'   => $this->faker->numerify('INV####'),
            'customerNumber'  => $customer->customerNumber,
            'orderDateTime'   => $this->faker->dateTimeBetween('-1 month', 'now'),
            'deliveryAddress' => $this->faker->address,
            'notes'           => $this->faker->sentence,
            'statusID'        => $status->statusID,
            'loadedPhoto'     => null,
            'deliveredPhoto'  => null,
            'isDeleted'       => false,
        ];
    }
}
