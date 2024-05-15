<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\User;
use App\RandomDBHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $random = new RandomDBHelper();

        // Create users
        User::factory(6)->create();

        // Retrieve instructor users
        $instructorUsers = User::where('role', 'INSTRUCTOR')->get();

        // Count of instructor users
        $instructorCount = $instructorUsers->count();

        foreach ($instructorUsers as $index => $user) {
            // Create instructor with unique user_id
            $instructor = Instructor::factory()->create([
                'headline' => fake()->realText(40),
                'professional_experience' => fake()->realTextBetween(200, 300),
                'user_id' => $user->id
            ]);

            // Assign unique instructor_id to the current user
            $user->instructor_id = $random->instructorId();
            $user->save();

            // If there are more instructor users than instructors created, reset the index to prevent out of bounds
            if ($index >= $instructorCount - 1) {
                $index = 0;
            }
        }
    }
}
