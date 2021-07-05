<?php

namespace App\Http\Requests;

use App\Rules\Prefecture;
use App\Models\Plan;
use App\Rules\CheckPlanAmount;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConfirmPaymentRequest extends FormRequest
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
            'payment_way' => ['required', 'string'],
            'payjp_token' => [Rule::requiredIf($request->payment_way === "credit")],
            'plans' => ['required', new CheckPlanAmount($this)],
            'plans.*' => ['required', 'integer'],
            'total_amount' => ['required', 'integer'],
            'display_added_price' => ['nullable', 'integer'],
            'first_name_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'last_name_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'first_name' => ['required', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'last_name' => ['required', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'email' => ['required', 'string', 'email'],
            'gender' => ['required', 'string', 'in:男性,女性,その他'],
            'phone_number' => ['required', 'string', 'min:10', 'max:11'],
            'postal_code' => ['required', 'string', 'size:7'],
            'prefecture' => ['required', 'string', new Prefecture()],
            'city' => ['required', 'string'],
            'block' => ['required', 'string'],
            'building' => ['nullable', 'string'],
            'birthday'  => ['required_with:birth_year,birth_month,birth_day', 'string', 'date_format:Y-m-d'],
            'birth_year'  => ['required_with:birth_month,birth_day', 'string'],
            'birth_month' => ['required_with:birth_year,birth_day', 'string'],
            'birth_day'   => ['required_with:birth_year,birth_month', 'string'],
            'remarks' => ['required', 'string', 'max:300'],
            'comments' => ['required', 'string', 'max:300'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('phone_number')){
            $this->phone_number = (string) $this->phone_number;
        }
        if ($this->has('postal_code')){
            $this->postal_code = (string) $this->postal_code;
        }
        if ($this->input('birth_day') && $this->input('birth_month') && $this->input('birth_year'))
        {
            $birthDate = implode('-', $this->only(['birth_year', 'birth_month', 'birth_day']));
            $this->merge([
                $birth_day =  new Carbon($birthDate),
                'birthday' => $birth_day->format('Y-m-d'),
            ]);
        }
    }

    public function messages()
    {
        return [
            'first_name_kana.regex' => ':attributeは全角カナで入力してください。',
            'last_name_kana.regex' => ':attributeは全角カナで入力してください。',
            'first_name.regex' => ':attributeは全角漢字で入力してください。',
            'last_name.regex' => ':attributeは全角漢字で入力してください。',
            'gender.regex' => ':attributeを選択してください。',
            'phone_number.min' => ':attributeは10桁以上にしてください。',
            'phone_number.max' => ':attributeは11桁以内にしてください。',
            'postal_code' => 'attributeは7桁にしてください。',
        ];
    }
}
