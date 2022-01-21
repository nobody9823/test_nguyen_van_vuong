<?php

namespace App\Rules;

use App\Models\Plan;
use Illuminate\Contracts\Validation\Rule;

class CheckPlanAmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $plan = Plan::find(array_keys($value)[0]);
        return $plan->limit_of_supporters_is_required
            ? $plan->limit_of_supporters >= array_values($value)[0]['quantity']
            : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'リターンの購入数が不正です。確認をお願いします。';
    }
}
