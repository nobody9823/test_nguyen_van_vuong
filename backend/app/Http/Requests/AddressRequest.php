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
            'postal_code' => ['required', 'string', 'size:7', 'regex:/^[0-9]{3}-?[0-9]{4}+$/u'],
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

        if (!empty($this->input('postal_code'))) {
            // ハイフンのパターン
            $targetRegexs  = '/[\x{207B}\x{208B}\x{2010}\x{2012}\x{2013}\x{2014}\x{2015}\x{2212}\x{2500}\x{2501}\x{2796}\x{30FC}\x{3161}\x{FF0D}\x{FF70}]/u';
            $resultRegex = '-';
            $tmpPostalCode = $this->input('postal_code');
            $tmpPostalCode  = mb_convert_encoding($tmpPostalCode, 'UTF-8', 'auto');
            // ハイフンを変換
            $tmpPostalCode = preg_replace($targetRegexs, $resultRegex, $tmpPostalCode);
            // 半角に変換
            $tmpPostalCode = mb_convert_kana($tmpPostalCode, "a");
            if (preg_match("/\A\d{3}-?\d{4}\z/", $tmpPostalCode)) {
                // ハイフンを削除
                $this->merge(['postal_code' => str_replace('-', '', $tmpPostalCode)]);
            }
        }
    }

    public function messages()
    {
        return [
            'postal_code.required' => "郵便番号を入力してください。",
            'postal_code.string' => "不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。",
            'postal_code.regex' => "正しい郵便番号を入力してください。",
            'postal_code.size' => "正しい郵便番号を入力してください。",
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
