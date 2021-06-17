<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\Company,email'],
            'password' => ['required', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "名前を入力して下さい。",
            'name.string' => "名前は文字で入力してください。",
            'name.max' => "名前は255文字以内にしてください。",
            'email.required' => "メールアドレスを入力してください。",
            'email.string' => "メールアドレスは文字で入力してください。",
            'email.email' => "メールアドレスとして正しく無い値が入力されています。",
            'email.unique' => "既に登録されているメールアドレスです。",
            'email.max' => "メールアドレスは255文字以内にしてください。",
            'password.required' => "パスワードを入力してください。",
            'password.string' => "パスワードは文字で入力してください。",
            'password.confirmed' => "パスワードが一致しません。",
            'password_confirmation.required' => "パスワード(確認用)を入力してください。",
            'password_confirmation.string' => "パスワード(確認用)は文字で入力してください。",
        ];
    }
}
