<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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
          'name' => 'required|string|max:255',
        'status' => 'required|in:1,2,3',
        'group_id' => 'required|exists:groups,id',
        'url' => 'array',
        'url.*' => 'nullable|url',
        'name1' => 'array',
        'name1.*' => 'nullable|string',
        'type' => 'array',
        'type.*' => 'nullable|in:1,2',
        ];
    }
}
