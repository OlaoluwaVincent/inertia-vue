<?php

namespace App\Class;

use Illuminate\Support\Facades\Storage;

class ImageUploader
{

    public static function profileImage($image)
    {
        if (!$image) return null;

        $path = $image->store('images/profile', 'public');;
        return asset('storage/' . $path); // Update profile picture field
    }

    public static function course($image)
    {
        if (!$image) return null;

        $path = $image->store('images/course', 'public');;
        return asset('storage/' . $path); // Update profile picture field
    }


    public static function deleteImage($path)
    {
        if (!$path) return null;
        // Convert the URL to a path relative to the disk's root
        $path = str_replace(url('/storage'), 'public', $path);
        Storage::delete($path);
    }
}
