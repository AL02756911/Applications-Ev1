<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $role = Role::inRandomOrder()->first() ?? Role::factory()->create();

        return [
            'username' => $this->faker->userName,
            'email'    => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'roleID'   => $role->roleID,
        ];
    }
}
