<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\BankAccountType;
use Carbon\Carbon;

class MyProjectRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:100000'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'string'],
            'image_url' => ['nullable', 'array'],
            'image_url.*' => ['nullable', 'array'],
            'image_url.*.*' => ['nullable', 'image'],
            'video_url' => ['nullable', 'url', 'regex:#(https?://www.youtube.com/.*)(v=([-\w]{11}))#'],
            'target_amount' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['nullable', 'date_format:Y-m-d H:i', 'after_or_equal:+7 day'],
            'end_date' => ['nullable', 'date_format:Y-m-d H:i', 'after:start_date'],
            'ps_plan_content' => ['nullable', 'string', 'max:100000'],
            'first_name_kana' => ['nullable', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'last_name_kana' => ['nullable', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'first_name' => ['nullable', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'last_name' => ['nullable', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'phone_number' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string'],
            'prefecture' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'block' => ['nullable', 'string', 'max:100'],
            'building' => ['nullable', 'string'],
            'birthday'  => ['required_with:birth_year,birth_month,birth_day', 'string', 'date_format:Y-m-d'],
            'birth_year'  => ['required_with:birth_month,birth_day', 'string'],
            'birth_month' => ['required_with:birth_year,birth_day', 'string'],
            'birth_day'   => ['required_with:birth_year,birth_month', 'string'],
            'bank_code' => ['nullable', 'string', 'size:4'],
            'branch_code' => ['nullable', 'string', 'size:3'],
            'account_type' => ['nullable', new EnumValue(BankAccountType::class)],
            'account_number' => ['nullable', 'string', 'min:4', 'max:7'],
            'account_name' => ['nullable', 'string']
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled(['start_date', 'end_date'])) {
                $start_date = new Carbon($this->start_date);
                if ($this->end_date > $start_date->addDay(60)) {
                    $validator->errors()->add('end_date', '掲載終了日(日付、時刻)には掲載開始日(日付、時刻)より60日以内の日付で指定してください。');
                }
            }
        });
    }

    protected function prepareForValidation()
    {
        if ($this->has('title') && $this->title === null) {
            $this->offsetUnset('title');
        }

        if ($this->has('content') && $this->input('content') === null) {
            $this->offsetUnset('content');
        }

        if ($this->has('start_year') && $this->has('start_month') && $this->has('start_day') && $this->has('start_hour') && $this->has('start_minute')) {
            $this->merge([
                'start_date' => $this->start_year . '-' . $this->start_month . '-' . $this->start_day . ' ' . $this->start_hour . ':' . $this->start_minute
            ]);
        }

        if ($this->has('end_year') && $this->has('end_month') && $this->has('end_day') && $this->has('end_hour') && $this->has('end_minute')) {
            $this->merge([
                'end_date' => $this->end_year . '-' . $this->end_month . '-' . $this->end_day . ' ' . $this->end_hour . ':' . $this->end_minute
            ]);
        }

        if ($this->ps_plan_content === null) {
            $this->merge([
                'ps_plan_content' => ''
            ]);
        };

        if ($this->has('phone_number')) {
            $this->phone_number = (string) $this->phone_number;
        }

        if ($this->has('postal_code')) {
            $this->postal_code = (string) $this->postal_code;
        }

        if ($this->input('birth_day') && $this->input('birth_month') && $this->input('birth_year')) {
            $birthDate = implode('-', $this->only(['birth_year', 'birth_month', 'birth_day']));
            $this->merge([
                $birth_day =  new Carbon($birthDate),
                'birthday' => $birth_day->format('Y-m-d'),
            ]);
        }

        if (is_null($this->input('building'))) {
            $this->merge(['building' => ""]);
        }
    }

    public function messages()
    {
        return [
            'video_url.regex' => ':attributeは正しいURLを指定してください。例）https://www.youtube.com/watch?v=ABCDEFG',
            'first_name_kana.regex' => ':attributeは全角のカタカナを指定してください。',
            'last_name_kana.regex' => ':attributeは全角のカタカナを指定してください。',
            'first_name.regex' => ':attributeは全角の漢字、またはひらがなを指定してください。',
            'last_name.regex' => ':attributeは全角の漢字、またはひらがなを指定してください。',
            'birthday.date_format' => ':attributeの形式は、「年-月-日」 で指定してください。',
            'start_date.date_format' => ':attributeの形式は、「年-月-日 時：分」 で指定してください。',
            'start_date.after_or_equal' => ':attributeには、1週間後以降の日付を指定してください。',
            'end_date.date_format' => ':attributeの形式は、「年-月-日 時：分」 で指定してください。',
        ];
    }
}
