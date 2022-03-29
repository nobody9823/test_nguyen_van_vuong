<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Prefecture;

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
            'first_name' => ['required', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'last_name' => ['required', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'first_name_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'last_name_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'phone_number' => ['required', 'string', 'min:10', 'max:11'],
            'postal_code' => ['required', 'string', 'size:7'],
            'prefecture' => ['required', 'string', new Prefecture()],
            'city' => ['required', 'string'],
            'block' => ['required', 'string'],
            'block_number' => ['required', 'string'],
            'building' => ['nullable', 'string'],
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
            'block.required' => "住所2(町域など)を入力してください。",
            'block.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'block_number.required' => "住所3(番地など)を入力してください。",
            'block_number.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
        ];
    }
}
