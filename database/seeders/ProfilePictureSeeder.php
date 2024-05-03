<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilePictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->users();
    }

    /** This adds a random profile_picture to the user table for each user */
    private static function users()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->profile_picture = fake()->imageUrl();
            $user->save();
        }
    }
}
