<?php

namespace App\Http\Requests;

use App\Models\Option;
use App\Rules\Options;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->contribution){
            return[
                'price' =>  ['integer', 'min:500', 'max:10000000', Rule::requiredIf($request->isMethod('post'))],
            ];
        } else {
            return [
                'title' => ['required', 'string', 'max:45'],
                'content' => ['required', 'string', 'max:2000'],
                'estimated_return_date' => ['required', 'date_format:Y-m-d', 'after:now'],
                'price' =>  ['integer', 'min:500', 'max:10000000', Rule::requiredIf($request->isMethod('post'))],
                'image' => ['nullable', 'image'],
                'options' => ['array'],
                'options.*.name' => ['nullable', 'string'],
                'options.*.quantity' => ['nullable', 'integer'],
            ];
        }
    }

    public function optionsToArray():array
    {
        // 寄付金プランの場合、固定で下記のデータが登録される。
        // さらに、プラン作成・更新画面の「作成・更新」ボタンに悪意のあるユーザーが検証ツールを用いて、nameとvalue="contribution"を記載したとしてもオプションは強制的に下記の通りに上書きされる。
        if ($this->contribution) {
            $options = [
                ['name' => null, 'quantity' => null],
            ];
            $this->merge(['options' => $options]);
        }

        $options = array();
        
        foreach ($this->options as $option) {
            if(!empty($option['name']))
            $options[] = new Option([
                'name' => $option['name'],
                'quantity' => $option['quantity'],
            ]);
        }

        return $options;
    }

    public function messages()
    {
        return [
            'title.required' => "プラン名を入力してください。",
            'title.string' => "プラン名は文字で入力してください。",
            'title.max' => "プラン名は255文字以内にしてください。",
            'content.required' => "プラン内容を入力してください。",
            'content.string' => "プラン内容は文字で入力してください。",
            'content.max' => "プラン内容は20000文字以内にしてください。",
            'estimated_return_date.required' => "リターン提供日を入力してください。",
            'estimated_return_date.date_format' => "リターン提供日のフォーマットを確認してください。",
            'estimated_return_date.after' => "リターン提供日を現在時刻より後にしてください。",
            'image.image' => "画像の拡張子を確認してください。",
            'options.array' => '不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。',
            'options.*.name.string' => 'オプションのタイトルは文字列で入力してください。',
            'options.*.quantity.integer' => 'オプションの個数は数字で入力してください。',
            'options.*.quantity.min' => 'オプションの個数を指定する場合は１以上の値で入力してください。',
        ];
    }
}
