<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
    public function rules()
    {
        return [
            //
        ];
    }

    // 全角スペースを半角スペースに変換
    public function getWords()
    {
        if (isset($this->all()["word"])){
            return str_replace("　", " ", $this->all()["word"]);
        }
        return null;
    }

    public function getArrayWords()
    {
        if ($this->getWords()){
            $words = $this->getWords();
            // 半角スペースごとに区切って配列に代入
            return explode(" ", $words);
        }
        return [
            0 => '',
        ];
    }


}
