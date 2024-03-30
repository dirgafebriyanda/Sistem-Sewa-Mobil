<?php

namespace Database\Seeders;

use App\Models\Cars;
use App\Models\Rentals;
use App\Models\Returns;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Dirga Febriyanda',
            'address' => '123 Main Street',
            'phone_number' => '1234567890',
            'driver_license_number' => 'DF123456',
            'email' => 'dirgafebriyanda@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Febriyanda',
            'address' => '123 Main Street',
            'phone_number' => '1234567890',
            'driver_license_number' => 'DL123456',
            'email' => 'febriyanda@gmail.com',
            'role' => 'User',
            'password' => Hash::make('password'),
        ]);
        Cars::create([
            'brand' => 'Toyota',
            'model' => 'Camry',
            'license_plate' => 'ABC123',
            'rental_rate' => 300000,
        ]);
    }
}