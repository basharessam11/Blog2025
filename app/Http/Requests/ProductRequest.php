<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
             'quantity' => 'required|integer|min:1',
             'price' => 'required|integer|min:0',
            'price1' => 'required|integer|min:0',
            'tax' => 'required|integer|min:0',
            'tax1' => 'required|integer|min:0',
             'description_ar' => 'required|string',
             'description_en' => 'required|string',
             'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
