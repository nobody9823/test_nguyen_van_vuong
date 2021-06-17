<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Options implements Rule
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
        if ($this->request->isMethod('post')) {
            return count($value) <= 10;
        } else {
            return $this->request->route('plan')->options->count() + count($value) <= 10;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'オプションの最大数は10です。';
    }
}
