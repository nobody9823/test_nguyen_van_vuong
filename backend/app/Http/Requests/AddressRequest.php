<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'postal_code' => ['required', 'string'],
            'prefecture' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'block' => ['required', 'string', 'max:100'],
            'building' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        if (is_null($this->input('building'))) {
            $this->merge(['building' => ""]);
        }
    }

    public function messages()
    {
        return [
            'postal_code.required' => "郵便番号を入力してください。",
            'postal_code.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'prefecture.required' => "都道府県を選択してください。",
            'prefecture.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'city.required' => "住所1(市区町村など)を入力してください。",
            'city.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'block.required' => "住所2(番地など)を入力してください。",
            'block.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'building.required' => "住所3(建物番号など)を入力してください。",
            'building.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
        ];
    }
}
