<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class QuestionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'question_text' => 'required|string|max:1000',
            'type' => 'required|in:1,2,3',  // أنواع الأسئلة مثل اختيار من متعدد، نص، أكمل
            'exam_id' => 'required|exists:exams,id',
        ];

        // إذا كان النوع هو 1 (اختيار من متعدد)
        if ($this->type == 1) {
            $rules['name'] = 'required|array|min:2';  // يجب إدخال خيارات
            $rules['name.*'] = 'required|string|max:255';  // كل خيار يجب أن يحتوي على نص
            $rules['status'] = 'required|integer|min:1';  // يجب تحديد الخيار الصحيح
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'question_text.required' => 'نص السؤال مطلوب.',
            'type.required' => 'نوع السؤال مطلوب.',
            'type.in' => 'نوع السؤال غير صالح.',
            'exam_id.required' => 'الامتحان مطلوب.',
            'exam_id.exists' => 'الامتحان غير موجود.',
            'name.required' => 'يجب إدخال خيارات عندما يكون نوع السؤال اختيار من متعدد.',
            'name.*.required' => 'كل خيار يجب أن يحتوي على نص.',
            'status.required' => 'يجب تحديد الخيار الصحيح عندما يكون نوع السؤال اختيار من متعدد.',
        ];
    }
}
