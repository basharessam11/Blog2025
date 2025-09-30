<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'counter1' => 'required|integer',
            'counter2' => 'required|integer',
            'counter3' => 'required|integer',
            'counter4' => 'required|integer',
            'photo' => 'nullable|image',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'location' => 'nullable|string',
            'facebook' => 'nullable|url',
            'x' => 'nullable|url',
            'instagram' => 'nullable|url',
            'name' => 'nullable|string',
            'Contact' => 'nullable|boolean',
            'FAQ' => 'nullable|boolean',
            'Sessions' => 'nullable|boolean',
            'Products' => 'nullable|boolean',
            'Services' => 'nullable|boolean',
            'About' => 'nullable|boolean',
            'Story' => 'nullable|boolean',
            'Blogs' => 'nullable|boolean',
        ];
    }
}
