<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetaRequest extends FormRequest
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
           'about_title_ar' => 'required|string|max:255',
    'about_title_en' => 'required|string|max:255',
    'about_description_ar' => 'nullable|string|max:255',
    'about_description_en' => 'nullable|string|max:255',

    'policies_title_ar' => 'required|string|max:255',
    'policies_title_en' => 'required|string|max:255',
    'policies_description_ar' => 'nullable|string|max:255',
    'policies_description_en' => 'nullable|string|max:255',

    'index_title_ar' => 'required|string|max:255',
    'index_title_en' => 'required|string|max:255',
    'index_description_ar' => 'nullable|string|max:255',
    'index_description_en' => 'nullable|string|max:255',

    'courses_title_ar' => 'required|string|max:255',
    'courses_title_en' => 'required|string|max:255',
    'courses_description_ar' => 'nullable|string|max:255',
    'courses_description_en' => 'nullable|string|max:255',

    'blog_title_ar' => 'required|string|max:255',
    'blog_title_en' => 'required|string|max:255',
    'blog_description_ar' => 'nullable|string|max:255',
    'blog_description_en' => 'nullable|string|max:255',

    'login_title_ar' => 'required|string|max:255',
    'login_title_en' => 'required|string|max:255',
    'login_description_ar' => 'nullable|string|max:255',
    'login_description_en' => 'nullable|string|max:255',

    'registr_title_ar' => 'required|string|max:255',
    'registr_title_en' => 'required|string|max:255',
    'registr_description_ar' => 'nullable|string|max:255',
    'registr_description_en' => 'nullable|string|max:255',
        ];
    }
}
