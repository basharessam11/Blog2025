<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
    public function rules()
    {
        if ($this->input('type') == 1) {
            return [
                'type' => 'required|in:2,1',

                'photo1' => $this->isMethod('post') ? 'required|array|min:1' : 'nullable',
                'photo1.*' => $this->isMethod('post') ? 'required|image|mimes:jpg,jpeg,png,gif' : 'nullable|image|mimes:jpg,jpeg,png,gif',

                'video_url.*' => 'required|url',
            ];
        } else {
            return [
                'type' => 'required|in:2,1',

                'photo' => $this->isMethod('post') ? 'required|array|min:1' : 'nullable',
                'photo.*' => $this->isMethod('post') ? 'image|mimes:jpg,jpeg,png,gif' : 'nullable|image|mimes:jpg,jpeg,png,gif',
            ];
        }

    }



}
