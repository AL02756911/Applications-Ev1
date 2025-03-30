<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Status;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\AuditLog;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['statusName' => 'Ordered'],
            ['statusName' => 'In Process'],
            ['statusName' => 'In Route'],
            ['statusName' => 'Delivered']
        ];
        foreach ($statuses as $status) {
            \App\Models\Status::firstOrCreate($status);
        }

        $roles = ['Sales', 'Purchasing', 'Warehouse', 'Route', 'Administrator'];
        foreach ($roles as $roleName) {
            \App\Models\Role::firstOrCreate(['roleName' => $roleName], ['description' => $roleName . ' role']);
        }

        Customer::factory(10)->create();
        User::factory(10)->create();
        Order::factory(20)->create();
        AuditLog::factory(10)->create();
    }
}
