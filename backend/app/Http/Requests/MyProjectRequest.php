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
            'content' => ['nullable', 'string', 'max:10000'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'string'],
            'image_url' => ['nullable', 'array'],
            'image_url.*' => ['nullable', 'array'],
            'image_url.*.*' => ['nullable', 'image'],
            'video_url' => ['nullable', 'url', 'regex:#(https?://www.youtube.com/.*)(v=([-\w]{11}))#'],
            'target_amount' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['nullable', 'date_format:Y-m-d H:i', 'after_or_equal:'.$request->route('project')->start_date],
            'end_date' => ['nullable', 'date_format:Y-m-d H:i', 'after:start_date', 'before_or_equal:'.$request->route('project')->end_date],
            'ps_plan_content' => ['nullable', 'string', 'max:2000'],
            'first_name_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'last_name_kana' => ['required', 'string', 'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'first_name' => ['required', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'last_name' => ['required', 'string', 'regex:/^[ぁ-んァ-ヶ一-龥々]+$/u'],
            'phone_number' =>['nullable', 'string'],
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

    protected function prepareForValidation()
    {
        if ($this->has('title') && $this->title === null){
            $this->offsetUnset('title');
        }

        if ($this->has('content') && $this->input('content') === null){
            $this->offsetUnset('content');
        }

        if ($this->has('start_date')){
            $this->merge([
                'start_date' => $this->start_year.'-'.$this->start_month.'-'.$this->start_day.' '.$this->start_hour.':'.$this->start_minute
            ]);
        }

        if ($this->has('end_date')){
            $this->merge([
                'end_date' => $this->end_year.'-'.$this->end_month.'-'.$this->end_day.' '.$this->end_hour.':'.$this->end_minute
            ]);
        }

        if($this->ps_plan_content === null){
            $this->merge([
                'ps_plan_content' => ''
            ]);
        };

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

        if (is_null($this->input('building'))) {
            $this->merge(['building' => ""]);
        }

    }
}
