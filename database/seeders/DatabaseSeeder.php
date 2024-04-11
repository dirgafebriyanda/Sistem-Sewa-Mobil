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
            'name' => 'Admin Sebil',
            'gender' => 'Laki-laki',
            'address' => '123 Main Street',
            'phone_number' => '081234567890',
            'driver_license_number' => '00123456',
            'email' => 'adminsebil@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Windyna Arifah',
            'gender' => 'Perempuan',
            'address' => '123 Main Street',
            'phone_number' => '081234567890',
            'driver_license_number' => '11123456',
            'email' => 'windynaarifah@gmail.com',
            'role' => 'User',
            'password' => Hash::make('password'),
        ]);
        
    }
}
