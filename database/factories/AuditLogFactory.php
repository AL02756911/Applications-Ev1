<?php

namespace Database\Factories;

use App\Models\AuditLog;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditLogFactory extends Factory
{
    protected $model = AuditLog::class;

    public function definition()
    {
        $order = Order::inRandomOrder()->first() ?? Order::factory()->create();
        $user  = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'orderID'        => $order->orderID,
            'userID'         => $user->id,
            'actionDateTime' => $this->faker->dateTimeBetween($order->orderDateTime, 'now'),
            'action'         => $this->faker->randomElement(['Created', 'Updated', 'Status Changed', 'Photo Uploaded']),
            'details'        => $this->faker->sentence,
        ];
    }
}
