<?php

namespace App\Http\Requests;

use App\Rules\CertificateFiles;
use App\Rules\Password;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'office_address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', new PhoneNumber],
            'bank_name' => ['required', 'string', 'max:255'],
            'bank_branch_name' => ['required', 'string', 'max:255'],
            'bank_account_number' => ['required', 'string', 'regex:/^\d{14,16}$/'],
            'bank_account_holder' => ['required', 'string', 'max:255', 'regex:/^[A-Z\x20]*$/'],
            'password' => ['required', 'confirmed', new Password],
            'password_confirmation' => 'required',
            'certificate_files' => ['bail', 'required', 'array', new CertificateFiles],
            'certificate_files.*' => ['file', 'mimes:jpeg,jpg,png,pdf,zip,doc,xls'],
        ];
    }

    public function messages()
    {
        return [
            'bank_account_number.regex' => ':attributeは14桁〜16桁の数字で入力してください。',
            'bank_account_holder.regex' => ':attributeは大文字英字で間に半角スペースを入れて入力してください。',
        ];
    }
}
