<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Password;

class UserPasswordRequest extends FormRequest
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
            'previous_password' => ['required', 'password:web'],
            'new_password' => ['required', 'confirmed', new Password],
            'new_password_confirmation' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'previous_password.required' => "今でのパスワードを入力してください。",
            'previous_password.password' => "今までのパスワードが違います。",
            'new_password.required' => "新しいパスワードを入力してください。",
            'new_password.confirmed' => "新しいパスワードと確認用パスワードが一致していません。",
            'new_password_confirmation.required' => "確認用パスワードを入力してください。",
        ];
    }
}
