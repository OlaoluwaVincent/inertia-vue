<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['string', 'max:255'],
            'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'socials' => ['array'],
            'socials.*.handle' => ['required', 'string', 'max:255'],
            'socials.*.link' => ['required', 'string', 'max:255'],
        ];
    }
}
