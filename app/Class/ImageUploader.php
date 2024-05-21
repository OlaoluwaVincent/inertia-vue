<?php

namespace App\Class;

class ImageUploader
{

    public static function profileImage($image)
    {
        if (!$image) return null;

        $path = $image->store('images/profile', 'public');;
        return asset('storage/' . $path); // Update profile picture field
    }

    public static function course($image): string
    {
        if (!$image) return null;

        $path = $image->store('images/course', 'public');;
        return asset('storage/' . $path); // Update profile picture field
    }
}
