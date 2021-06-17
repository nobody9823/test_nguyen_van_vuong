<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\Password;

class CompanyRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('companies')
            ->ignore($this->route('company') ? $this->route('company') : $this->route('detail'))],
            'password' => ['confirmed', Rule::requiredIf($request->isMethod('post')), new Password], 
            'password_confirmation' => Rule::requiredIf($request->isMethod('post')),
            'contract_status' => ['nullable'],
            'contract_date' => ['nullable', 'date_format:Y-m-d'],
            'cancellation_date' => ['nullable', 'date_format:Y-m-d'],
            'image_url' => ['nullable', 'image'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->password === null && $this->Method('PUT')){
            $this->offsetUnset('password');
        }
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
            'password.confirmed' => "パスワードが一致しません。",
            'password_confirmation.required' => "パスワード(確認用)を入力してください。",
            'contract_date.date_format' => "契約日のフォーマットを確認してください。",
            'cancellation_date.date_format' => "契約終了日のフォーマットを確認してください。",
            'image_url.image' => "画像の拡張子がjpg,png,bmp,gif,svgである事を確認してください。",
        ];
    }
}
