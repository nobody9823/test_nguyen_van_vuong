<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\BankAccountType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'video_url' => ['nullable', 'url', 'regex:#(https?\:\/\/)(www\.youtube\.com\/watch\?v=|youtu\.be\/)+[\S]{11}#'],
            'target_amount' => ['nullable', 'integer', 'min:10000','max:99999999'],
            'start_date' => ['nullable', 'date_format:Y-m-d H:i', /*'after_or_equal:+14 day'*/],
            'end_date' => ['nullable', 'date_format:Y-m-d H:i', 'after:start_date'],
            'reward_by_total_amount' => ['nullable', 'string', 'max:100000'],
            'reward_by_total_quantity' => ['nullable', 'string', 'max:100000'],
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

    // FIXME: ここは落ち着いたらリファクタリングしましょう.....
    protected function prepareForValidation()
    {
        if ($this->current_tab === 'target_amount' && $this->target_amount === null) {
            $this->merge([
                'target_amount' => 0
            ]);
        }

        if ($this->has('title') && $this->title === null) {
            $this->offsetUnset('title');
        }

        if ($this->has('content') && $this->input('content') === null) {
            $this->offsetUnset('content');
        }

        if ($this->filled(['start_year', 'start_month', 'start_day', 'start_hour', 'start_minute'])) {
            $this->merge([
                'start_date' => $this->start_year . '-' . $this->start_month . '-' . sprintf('%02d', $this->start_day) . ' ' . $this->start_hour . ':' . $this->start_minute
            ]);
        }

        if ($this->filled(['end_year', 'end_month', 'end_day', 'end_hour', 'end_minute'])) {
            $this->merge([
                'end_date' => $this->end_year . '-' . $this->end_month . '-' . sprintf('%02d', $this->end_day) . ' ' . $this->end_hour . ':' . $this->end_minute
            ]);
        }

        if ($this->current_tab === 'ps_return') {
            if ($this->reward_by_total_amount === null) {
                $this->merge([
                    'reward_by_total_amount' => ''
                ]);
            };
            if ($this->reward_by_total_quantity === null) {
                $this->merge([
                    'reward_by_total_quantity' => ''
                ]);
            };
        }

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

        if ($this->current_tab === 'identification') {
            if (!$this->filled('first_name_kana')) {
                $this->merge([
                    'first_name_kana' => ''
                ]);
            }
            if (!$this->filled('last_name_kana')) {
                $this->merge([
                    'last_name_kana' => ''
                ]);
            }
            if (!$this->filled('first_name')) {
                $this->merge([
                    'first_name' => ''
                ]);
            }
            if (!$this->filled('last_name')) {
                $this->merge([
                    'last_name' => ''
                ]);
            }
            if (!$this->filled('identify_image_1')) {
                $this->merge([
                    'identify_image_1' => Auth::user()->identification->identify_image_1 !== null ? Auth::user()->identification->identify_image_1 : 'public/sampleImage/now_printing.png'
                ]);
            }
            if (!$this->filled('identify_image_2')) {
                $this->merge([
                    'identify_image_2' => Auth::user()->identification->identify_image_2 !== null ? Auth::user()->identification->identify_image_2 : 'public/sampleImage/now_printing.png'
                ]);
            }
            if (!$this->filled('phone_number')) {
                $this->merge([
                    'phone_number' => ''
                ]);
            }
            if (!$this->filled('city')) {
                $this->merge([
                    'city' => ''
                ]);
            }
            if (!$this->filled('block')) {
                $this->merge([
                    'block' => ''
                ]);
            }
            if (!$this->filled('postal_code')) {
                $this->merge([
                    'postal_code' => ''
                ]);
            }
            if (!$this->filled('bank_code')) {
                $this->merge([
                    'bank_code' => ''
                ]);
            }
            if (!$this->filled('branch_code')) {
                $this->merge([
                    'branch_code' => ''
                ]);
            }
            if (!$this->filled('account_number')) {
                $this->merge([
                    'account_number' => ''
                ]);
            }
            if (!$this->filled('account_name')) {
                $this->merge([
                    'account_name' => ''
                ]);
            }
        }
    }

    public function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()){
            throw new HttpResponseException(
                response()->json(['message' => $validator->errors()->toArray()])
            );
        } else {
            switch ($this->current_tab) {
                case 'target_amount':
                    $redirect_route = redirect()
                        ->route('user.my_project.project.edit', ['project' => $this->route('project'), 'next_tab' => 'target_amount'])
                        ->withErrors($validator)
                        ->withInput();
                    break;

                case 'overview':
                    $redirect_route = redirect()
                        ->route('user.my_project.project.edit', ['project' => $this->route('project'), 'next_tab' => 'overview'])
                        ->withErrors($validator)
                        ->withInput();
                    break;

                case 'visual':
                    $redirect_route = redirect()
                        ->route('user.my_project.project.edit', ['project' => $this->route('project'), 'next_tab' => 'visual'])
                        ->withErrors($validator)
                        ->withInput();
                    break;

                case 'ps_return':
                    $redirect_route = redirect()
                        ->route('user.my_project.project.edit', ['project' => $this->route('project'), 'next_tab' => 'ps_return'])
                        ->withErrors($validator)
                        ->withInput();
                    break;

                case 'identification':
                    $redirect_route = redirect()
                        ->route('user.my_project.project.edit', ['project' => $this->route('project'), 'next_tab' => 'identification'])
                        ->withErrors($validator)
                        ->withInput();
                    break;

                default:
                    $redirect_route = redirect()
                        ->route('user.my_project.project.edit', ['project' => $this->route('project')])
                        ->withErrors($validator)
                        ->withInput();
                    break;
            }

            throw new HttpResponseException(
                $redirect_route
            );
        }

    }

    public function passedValidation()
    {
        // youtubeが短縮urlだった場合、通常のurlに変換する。その後通常通りバリデーションにかける
        if ($this->input('video_url')) {
            $short_url = $this->input('video_url');
            $headers = get_headers($short_url, 1);
            $original_url = isset($headers['Location']) ? $headers['Location'] : $short_url;

            $this->merge(['video_url' => $original_url]);
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
