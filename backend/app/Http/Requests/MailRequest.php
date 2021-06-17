<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'user_ids' => ['required'],
            'subject' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:10000'],
        ];
    }

    public function messages()
    {
        return [
            'user_ids.required' => "ユーザーを指定してください。",
            'subject.required' => "件名を入力してください。",
            'subject.string' => "件名は文字列で入力してください。",
            'subject.max' => "件名は100文字以内で入力してください。",
            'description.required' => "本文を入力してください。",
            'description.string' => "本文は文字列で入力してください。",
            'description.max' => "本文は10000文字以内で入力してください。",
        ];
    }
}
