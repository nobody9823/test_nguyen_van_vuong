<?php

namespace App\Http\Requests;

use App\Rules\PaymentHasSameProjectId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SendToSupporterRequest extends FormRequest
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
            'payment_ids' => ['nullable', 'array', new PaymentHasSameProjectId($request)],
            'payment_ids.*' => ['nullable', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'payment_ids' => '決済情報'
        ];
    }
}
