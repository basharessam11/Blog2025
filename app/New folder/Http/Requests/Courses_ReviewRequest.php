<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Courses_ReviewRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
             'rate' => 'required|numeric|min:1|max:5',
            'review' => 'required|string|max:255',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
        ];
    }
}
