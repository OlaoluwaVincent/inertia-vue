<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = Lesson::factory()->count(40)->create();

        $sequence = 1;

        foreach ($lessons as $lesson) {
            // Assign the current sequence value to the lesson
            $lesson->sequence = $sequence;

            // Increment the sequence counter for the next lesson
            $sequence++;

            // Save the lesson with the updated sequence
            $lesson->save();
        }
    }
}
