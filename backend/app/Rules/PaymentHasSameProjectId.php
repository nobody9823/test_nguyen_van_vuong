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
        $this->payments = Payment::whereIn('id', $request->payment_ids)->get();

        $this->project = $request->route('project');
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
        foreach ($this->payments as $payment){
            if($payment->project_id !== $this->project->id)
            {
                return false;
            } else {
                break;
            }
        }
        return true;
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
