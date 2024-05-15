<?php

namespace App\Http\Requests\Auth;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthCheckers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Check if the authenticated user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        if (!Auth::user()->role) {
            return false;
        }
        return Auth::user()->role === UserRoleEnum::ADMIN;
    }

    /**
     * Check if the authenticated user is an instructor.
     *
     * @return bool
     */
    public function isInstructor(): bool
    {
        if (!Auth::user()->role) {
            return false;
        }
        return Auth::user()->role === UserRoleEnum::INSTRUCTOR;
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function authenticatedUser()
    {
        return $this->user();
    }

    // Other methods can be added here
}
