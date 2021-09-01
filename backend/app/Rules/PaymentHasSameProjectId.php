<?php

namespace App\Rules;

use App\Models\Payment;
use Illuminate\Contracts\Validation\Rule;

class PaymentHasSameProjectId implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Payment::find($value)->id !== $this->request->route('project')->id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '決済情報に紐づいているプロジェクト情報が不一致しています。';
    }
}
