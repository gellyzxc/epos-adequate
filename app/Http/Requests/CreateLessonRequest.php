<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLessonRequest extends FormRequest
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
            'teacher' => 'required|exists:users,id',
            'subject' => 'required|exists:school_subjects,id',
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday',
            'number' => 'required|integer',
            'minutes' => 'required|integer',
            'week' => 'required|integer',
        ];
    }
}
