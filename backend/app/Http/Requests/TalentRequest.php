<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\Password;

class TalentRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('talents')
            ->ignore($this->route('talent') ? $this->route('talent') : $this->route('detail'))->whereNull('deleted_at')], 
            //更新時のみ該当タレントのメールアドレスはignoreされる
            'recruitment_status' => [Rule::requiredIf($request->is('admin/*'))], //guardがadminのみrequired
            'employment_status' => [Rule::requiredIf($request->is('admin/*'))],
            'evaluation_status' => [Rule::requiredIf($request->is('admin/*'))],
            'hourly_wage' => ['nullable', 'integer', 'min:0'],
            'resignation_status' => [Rule::requiredIf($request->is('admin/*'))],
            'company_id' => ['integer', Rule::requiredIf($request->is('admin/*'))], 
            'password' => ['confirmed', Rule::requiredIf($request->isMethod('post')), new Password], //作成時'post'のみrequired
            'password_confirmation' => Rule::requiredIf($request->isMethod('post')),
            'image_url' => ['image', Rule::requiredIf($request->isMethod('post'))],
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
            'name.required' => "タレント名を入力してください。",
            'name.string' => "タレント名は文字で入力してください。",
            'name.max' => "タレント名は255文字以内にしてください。",
            'email.required' => "メールアドレスを入力してください。",
            'email.string' => "メールアドレスは文字で入力してください。",
            'email.email' => "メールアドレスとして正しく無い値が入力されています。",
            'email.unique' => "メールアドレスがすでに登録されています。",
            'email.max' => "メールアドレスは255文字以内にしてください。",
            'hourly_wage.integer' => "時給には数字で入力してください。",
            'hourly_wage.min' => "時給は０以上の数値を入力してください。",
            'company_id.required' => "所属企業を入力してください。",
            'company_id.integer' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'password.required' => "パスワードを入力してください。",
            'password.confirmed' => "パスワードが一致しません。",
            'password_confirmation.required' => "パスワード(確認用)を入力してください。",
            'image_url.required' => "画像をアップロードしてください。",
            'image_url.image' => "ファイルは画像（jpg、jpeg、png、bmp、gif、svg、webp）である必要があります。",
        ];
    }
}
