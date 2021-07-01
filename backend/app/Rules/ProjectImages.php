<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProjectImages implements Rule
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
            return $this->request->route('project')->projectFiles()->where('file_content_type', 'image_url')->count() + count($value) <= 10;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '画像は10枚まで登録ができます。';
    }
}
