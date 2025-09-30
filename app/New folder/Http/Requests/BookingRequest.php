<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'total' => 'required|integer|min:0',
             'type' => 'required|in:1,2',
             'discount' => 'required|numeric', // حتى لو كانت 0

            'note' => 'nullable|string|max:255'
        ];
    }
}
