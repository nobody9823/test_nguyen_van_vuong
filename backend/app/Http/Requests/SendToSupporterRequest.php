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
            'payment_ids' => ['required', 'array'],
            'payment_ids.*' => ['integer', new PaymentHasSameProjectId($request)],
        ];
    }

    public function attributes()
    {
        return [
            'payment_ids' => '「未発送」チェックボックス'
        ];
    }
}
