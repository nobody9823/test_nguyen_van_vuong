<?php

namespace App\Http\Requests;

use App\Rules\Password;
use App\Rules\CurrentPassword;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'confirmed', Rule::unique('users')->ignore($this->user())->whereNull('deleted_at')],
            'email_confirmation' => ['nullable', 'string', 'email'],
            'current_password' => ['nullable', 'string', new CurrentPassword],
            'password' => ['nullable', 'string', 'confirmed', new Password],
            'password_confirmation' => ['nullable', 'string'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,jpg,gif,png'],
            'gender' => ['nullable', 'string', Rule::in(['女性', '男性', 'その他'])],
            'gender_is_published' => ['nullable', 'boolean'],
            'introduction' => ['nullable', 'string'],
            'birth_place' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled(['year', 'month', 'day'])) {
                try {
                    $birthday = Carbon::createSafe(
                        (int)$this->year,
                        (int)$this->month,
                        (int)$this->day,
                    );
                    $this->merge(['birthday' => $birthday]);
                } catch (InvalidDateException $e) {
                    $validator->errors()->add('birthday', '生年月日は正しい日付を指定してください。');
                }
            }
        });
    }

    public function prepareForValidation()
    {
        if (is_null($this->input('email')) && is_null($this->input('email_confirmation'))) {
            $this->merge(['email' => Auth::user()->email]);
            $this->merge(['email_confirmation' => Auth::user()->email]);
        } elseif (is_null($this->input('email'))) {
            $this->merge(['email' => Auth::user()->email]);
            $this->merge(['email_confirmation' => Auth::user()->email]);
        }

        if ($this->input('input_type') === 'sns_links') {
            if (is_null($this->input('twitter_url'))) {
                $this->merge(['twitter_url' => ""]);
            }
            if (is_null($this->input('instagram_url'))) {
                $this->merge(['instagram_url' => ""]);
            }
            if (is_null($this->input('youtube_url'))) {
                $this->merge(['youtube_url' => ""]);
            }
            if (is_null($this->input('tiktok_url'))) {
                $this->merge(['tiktok_url' => ""]);
            }
            if (is_null($this->input('other_url'))) {
                $this->merge(['other_url' => ""]);
            }
        }

        if ($this->has('introduction') && is_null($this->input('introduction'))) {
            $this->merge(['introduction' => ""]);
        }
    }
}
