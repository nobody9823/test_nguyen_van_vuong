<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
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
            'new_password' => ['nullable', 'string', 'confirmed', new Password],
            'new_password_confirmation' => ['nullable', 'string'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,jpg,gif,png'],
            'gender' => ['nullable', 'string', Rule::in(['女性', '男性', 'その他'])],
            'gender_is_published' => ['nullable', 'boolean'],
        ];
    }
}
