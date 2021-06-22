<?php

namespace App\Rules;

use App\Models\Tag;
use Illuminate\Contracts\Validation\Rule;

class Tags implements Rule
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
     * 選択されたタグがDBに存在するか確認
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tag_count = Tag::whereIn('id', $this->request->tags)->get()->count();
        return $tag_count === count($this->request->tags);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '選択したタグは存在しません。';
    }
}
