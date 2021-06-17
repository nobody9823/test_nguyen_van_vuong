<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\PostalCode;
use App\Rules\PhoneNumber;
use App\Rules\SelectedOption;
use App\Rules\UserAddressLimit;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

class UserAddressRequest extends FormRequest
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
            'selected_option' => ['required', 'string', new SelectedOption($this)],
            'address_type' => [new UserAddressLimit($this), Rule::requiredIf($this->route('plan')->necessary_address)],
            'phone_number' => [new PhoneNumber, Rule::requiredIf($this->route('plan')->necessary_address)],
            'zip11' => ['exclude_unless:address_type,other_address', 'required', new PostalCode],
            'addr11' => ['exclude_unless:address_type,other_address', 'required', 'string', 'max:255'],
            'address' => ['exclude_unless:address_type,other_address', 'required', 'string', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'address_type' => '住所情報',
            'zip11' => "郵便番号",
            'addr11' => "住所",
            'address' => "番地、建物",
            'phone_number' => "電話番号"
        ];
    }

    public function allForPrepared()
    {
        $address = [];
        if ($this->zip11 && $this->addr11 !== null && $this->address !== null){
            $address = array('postal_code' => $this->zip11, 'address' => $this->addr11 . $this->address);
        }
        return array_merge($this->all(), $address);
    }
}
