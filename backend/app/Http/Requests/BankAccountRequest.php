<?php

namespace App\Http\Requests;

use App\Enums\GmoBankAccountType;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
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
            'bank_code' => ['required', 'string', 'size:4'],
            'branch_code' => ['required', 'string', 'size:3'],
            'account_type' => ['required', new EnumValue(GmoBankAccountType::class)],
            'account_number' => ['required', 'string', 'min:4', 'max:7'],
            'account_name' => ['required', 'string']
        ];
    }

    public function passedValidation()
    {
        switch ($this->input('account_type')) {
            case '普通':
                $this->merge(['account_type' => '1']);
                return;
            case '当座':
                $this->merge(['account_type' => '2']);
                return;
            case '貯蓄':
                $this->merge(['account_type' => '4']);
                return;
        }
    }
}
