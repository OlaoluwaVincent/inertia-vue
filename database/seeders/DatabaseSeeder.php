<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create([
            'fullname' => fake()->name(),
            'username' => fake()->userName(),
            'email' => fake()->email(),
            'role' => $this->getRandomRole(),
            'password' => Hash::make('password'),
        ]);
    }


    private function getRandomRole(): string
    {
        $roles = ['USER', 'ADMIN', 'INSTRUCTOR'];
        return $roles[array_rand($roles)];
    }
}
