<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequestValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:700',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'objective' => 'required|array',
            'requirement' => 'required|array',
        ];
    }
}
