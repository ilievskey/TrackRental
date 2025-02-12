<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::factory()
            ->count(20)
            ->create();

        User::factory()->create([
            'name' => 'Rainbow Six',
            'email' => 'rainbow@six.com',
            'password' => \Hash::make('rainbow6')
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => \Hash::make('adminadmin')
        ]);
    }
}
