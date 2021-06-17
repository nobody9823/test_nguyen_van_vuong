<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserAddressLimit implements Rule
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
        if ($value === "other_address") {
            return $this->request->user()->userAddresses->count() <= 9;
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
        return '郵送先は10カ所まで登録できます。';
    }
}
