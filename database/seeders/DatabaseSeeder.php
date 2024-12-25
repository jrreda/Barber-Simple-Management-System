<?php

namespace Database\Seeders;

use App\Models\Barber;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'role'  => 'owner'
        ]);

        User::create([
            'name'     => 'Owner',
            'email'    => 'owner@zema.com',
            'password' => bcrypt('password'),
            'role'     => 'owner'
        ]);

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@zema.com',
            'password' => bcrypt('password'),
            'role'     => 'admin'
        ]);

        Barber::factory(10)->create();
        Service::factory(10)->create();
    }
}
