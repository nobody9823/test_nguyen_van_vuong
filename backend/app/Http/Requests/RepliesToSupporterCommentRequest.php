<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepliesToSupporterCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '支援者コメントへの返信は必須項目です。',
            'content.string' => '支援者コメントへの返信は文字列でお願いします。',
            'content.max' => '支援者コメントへの返信は255文字以内でお願いします。'
        ];
    }
}
