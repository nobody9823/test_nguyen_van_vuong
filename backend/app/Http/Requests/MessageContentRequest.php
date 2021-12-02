<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageContentRequest extends FormRequest
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
            'content' => ['required', 'string', 'max:10000'],
            'file_path' => ['nullable', 'file'],
        ];
    }

    public function messages()
    {
        return [
            'content.required' => "テキストを入力してください。",
            'content.string' => "テキストは文字で入力してください。",
            'content.max' => "テキストは10000文字以内で入力してください。",
            'file_path.file' => "ファイルは指定されたものを使用してください。",
        ];
    }
}
