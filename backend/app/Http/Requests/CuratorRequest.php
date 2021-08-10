<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CuratorRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('curators')->ignore($this->route('curator'))->whereNull('deleted_at')],
            'password' => [Rule::requiredIf($this->isMethod('post')), new Password, 'confirmed'],
            'password_confirmation' => [Rule::requiredIf($this->isMethod('post'))],
        ];
    }
}
