<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Password;

class AdminRequest extends FormRequest
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
            'email' => ['required', 'string','email', 'max:255'],
            'password' => ['confirmed',new Password],
        ];
    }

    protected function prepareForValidation()
    {        
        if ($this->password === null && !$this->isMethod('post')){
            $this->offsetUnset('password');
        }
    }

    public function messages(){
    return [
        'name.required' => "名前を入力してください。",
        'name.string' => "名前は文字で入力してください。",
        'name.max' => "名前は255文字以内にしてください。",
        'email.required' => "メールアドレスを入力してください。",
        'email.string' => "メールアドレスは文字で入力してください。",
        'email.email' => "メールアドレスとして正しく無い値が入力されています。",
        'email.unique' => "既に登録されているメールアドレスです。",
        'email.max' => "メールアドレスは255文字以内にしてください。",

    ];
    }
}
