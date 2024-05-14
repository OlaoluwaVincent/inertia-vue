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
    }
}
