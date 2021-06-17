<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SelectedOption implements Rule
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
        $filtered_options = $this->request->route('plan')->options->filter(function ($option) use ($value) {
            return ($option->name === $value && $option->quantity !== 0);
        });
        return count($filtered_options) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '指定されたオプションは存在していないか、すでに売り切れてしまった可能性があります。';
    }
}
