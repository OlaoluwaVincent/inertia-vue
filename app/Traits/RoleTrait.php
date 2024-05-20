<?php

namespace App\Traits;

use App\Enums\UserRoleEnum;

trait RoleTrait
{
    /**Checks that is is not a studen */
    public function isNotStudent(): bool
    {
        return $this->role === UserRoleEnum::ADMIN || UserRoleEnum::INSTRUCTOR;
    }

    public function hasOnboarded(): bool
    {
        if (!$this->instructor_id && $this->role !== UserRoleEnum::INSTRUCTOR) {
            return false;
        }
        return true;
    }
}
