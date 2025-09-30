<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends FormRequest
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
            'title_ar' => 'required|string|max:255|min:3',
            'title_en' => 'required|string|max:255|min:3',
            'overview_ar' => 'required|string',
            'overview_en' => 'required|string',
            'start_time.*' => 'required|date_format:H:i',
            'end_time.*' => 'required|date_format:H:i|after:start_time.*',

            'price' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',



        ];
    }
}
