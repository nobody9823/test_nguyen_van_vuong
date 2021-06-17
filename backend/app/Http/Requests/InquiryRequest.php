<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'tel' => ['required', 'regex:/^0\d{2,3}-\d{1,4}-\d{4}$/'],
            'inquiry_category' => ['required', 'string', 'max:255'],
            'inquiry_content' => ['required', 'string', 'max:10000'],
            'images[]' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "名前は必ず入力して下さい。",
            'name.max' => "名前は255文字以内で入力して下さい。",
            'email.required' => "メールアドレスは必ず入力してください。",
            'email.email' => "メールアドレスは、有効なメールアドレス形式で指定してください",
            'tel.required' => "電話番号は必ず入力して下さい。",
            'tel.regex' => "電話番号は以下の条件で入力してください。( 0から始まる2から3桁 － 1から4桁 － 1から4桁 )",
            'inquiry_category.required' => "お問い合わせ種別は必ず選択して下さい。",
            'inquiry_category.string' => "お問い合わせ種別に文字以外のものが含まれています",
            'inquiry_category.max' => "お問い合わせ種別は255文字以下で入力下さい。",
            'inquiry_content.required' => "お問い合わせ内容は必ず入力して下さい。",
            'inquiry_content.string' => "お問い合わせ内容に文字以外のものが含まれています。",
            'inquiry_content.max' => "お問い合わせ内容は10000文字以下で入力下さい。",
            'images[].image' => "画像の形式が不正です。ご確認下さい。(jpg、jpeg、png、bmp、gif、svg、webp)",
        ];
    }
}
