<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Password implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // :attribute は半角英字と半角数字8文字以上100文字以下の文字列で入力してください。
        // return preg_match('/\A[a-z\d]{8,100}+\z/i', $value);

        // :attribute は半角英字と半角数字それぞれ1文字以上含む8文字以上100文字以下の文字列で入力してください。
        return preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $value);

        // :attribute は半角英字小文字と半角英字大文字と半角数字をそれぞれ1文字以上含む8文字以上100文字以下の文字列で入力してください。
        // return preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/', $value);

        // :attribute は半角英字と半角数字と半角記号をそれぞれ1文字以上含む8文字以上100文字以下の文字列で入力してください。
        // return preg_match('/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/i', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return ':attribute は半角英字と半角数字8文字以上100文字以下の文字列で入力してください。';

        return ':attribute は半角英字と半角数字それぞれ1文字以上含む8文字以上100文字以下の文字列で入力してください。';

        // return ':attribute は半角英字小文字と半角英字大文字と半角数字をそれぞれ1文字以上含む8文字以上100文字以下の文字列で入力してください。';

        // return ':attribute は半角英字と半角数字と半角記号をそれぞれ1文字以上含む8文字以上100文字以下の文字列で入力してください。';
    }
}
