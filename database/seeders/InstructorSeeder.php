<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\InstructorsFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instructor::factory()->count(1)->create();
        $instructors = Instructor::all();

        // Loop through each instructor and update the username column
        foreach ($instructors as $instructor) {
            // Update the username column with a fake name
            $instructor->update([
                'headline' => fake()->realTextBetween(50, 80),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
