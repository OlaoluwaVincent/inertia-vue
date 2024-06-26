<?php

namespace App\Listeners;

use App\Class\VideoUploader;
use App\Events\UpdateDuration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateCourseDuration
{
    /**
     * Handle the event.
     */

    public function handle(UpdateDuration $event)
    {
        $course = $event->course;
        $videoPath = $event->video;

        $duration = VideoUploader::getVideoDuration($videoPath);

        // Add rounded duration to the existing duration
        $course->duration += $duration;

        // Save the updated course duration
        $course->save();
    }
}
