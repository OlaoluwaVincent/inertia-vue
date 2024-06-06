<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait lessonProgressTrait
{
    public function loadCourse(): BelongsTo
    {
       return $this->course()->select('id','title');
    }
    public function loadLesson(): BelongsTo
    {
       return $this->lesson()->select('id','title','duration');
    }
}
