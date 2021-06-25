<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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

    public function messages(){
        return [
            'content.required' => "投稿内容を入力してください。",
            'content.string' => "投稿内容は文字で入力してください。",
            'content.max' => "投稿内容は255文字以内にしてください。",
        ];
    }
}
