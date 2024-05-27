<?php

namespace App\Class;

use getID3;
use Illuminate\Support\Facades\Storage;

class VideoUploader
{
    public static function saveVideo($video)
    {
        if (!$video) return null;

        $path = $video->store('videos/', 'public');;
        return asset('storage/' . $path); // Update profile picture field
    }

    public static function deleteVideo($path)
    {
        if (!$path) return false;
        // Convert the URL to a path relative to the disk's root
        $path = str_replace(url('/storage'), 'public', $path);
        return Storage::delete($path);
    }

    public static function getVideoDuration($videoPath)
    {
        $getID3 = new getID3;

        // Analyze file and get metadata
        $fileInfo = $getID3->analyze($videoPath);

        // Get duration from metadata
        $duration = isset($fileInfo['playtime_seconds']) ? $fileInfo['playtime_seconds'] : null;

        return round($duration, 2);
    }
}
