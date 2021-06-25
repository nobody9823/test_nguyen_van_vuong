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
        return [
            'title' => ['required', 'string', 'max:45'],
            'content' => ['required', 'string', 'max:2000'],
            'price' =>  ['integer', 'min:500', 'max:10000000', Rule::requiredIf($request->isMethod('post'))],
            'address_is_required' => ['required'],
            'limit_of_supporters' => ['required','integer'],
            'delivery_date' => ['required', 'date_format:Y-m-d', 'after:now'],
            'image' => ['nullable', 'image'],
            // NOTE:現状オプションは使用しない為、コメントアウト
            // 'options' => ['array'],
            // 'options.*.name' => ['nullable', 'string'],
            // 'options.*.quantity' => ['nullable', 'integer'],
        ]; 
    }

    // NOTE:現状オプションは使用しない為、コメントアウト
    // public function optionsToArray():array
    // {
    //     $options = array();
        
    //     foreach ($this->options as $option) {
    //         if(!empty($option['name']))
    //         $options[] = new Option([
    //             'name' => $option['name'],
    //             'quantity' => $option['quantity'],
    //         ]);
    //     }

    //     return $options;
    // }

    public function messages()
    {
        return [
            'title.required' => "プラン名を入力してください。",
            'title.string' => "プラン名は文字で入力してください。",
            'title.max' => "プラン名は255文字以内にしてください。",
            'content.required' => "プラン内容を入力してください。",
            'content.string' => "プラン内容は文字で入力してください。",
            'content.max' => "プラン内容は20000文字以内にしてください。",
            'address_is_required.required' => "支援者の方の住所登録が必要かどうか記載してください。",
            'limit_of_supporters.required' => "個数を入力してください。",
            'limit_of_supporters.integer' => "個数を数字で入力してください。",
            'delivery_date.required' => "リターン提供日を入力してください。",
            'delivery_date.date_format' => "リターン提供日のフォーマットを確認してください。",
            'delivery_date.after' => "リターン提供日を現在時刻より後にしてください。",
            'image.image' => "画像の拡張子を確認してください。",
            // NOTE:現状オプションは使用しない為、コメントアウト
            // 'options.array' => '不正なアクセスが検知されました。管理会社へのお問い合わせをお願い致します。',
            // 'options.*.name.string' => 'オプションのタイトルは文字列で入力してください。',
            // 'options.*.quantity.integer' => 'オプションの個数は数字で入力してください。',
            // 'options.*.quantity.min' => 'オプションの個数を指定する場合は１以上の値で入力してください。',
        ];
    }
}
