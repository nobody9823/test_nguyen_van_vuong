<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;

class MyPlanRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:45'],
            'content' => ['nullable', 'string', 'max:2000'],
            'price' => ['integer', 'min:0', 'max:10000000'],
            'address_is_required' => ['nullable', 'boolean'],
            'limit_of_supporters_is_required' => ['nullable', 'boolean'],
            'limit_of_supporters' => ['integer', 'min:1'],
            'delivery_date' => ['nullable', 'date_format:Y-m', "after:{$this->route('project')->end_date->format('Y-m-d H:i:s')}"],
            'image_url' => ['nullable', 'image']
        ];
    }

    protected function prepareForValidation()
    {

        if ($this->has('title') && is_null($this->input('title'))) {
            $this->merge([
                'title' => ''
            ]);
        }

        if ($this->has('content') && is_null($this->input('content'))) {
            $this->merge([
                'content' => ''
            ]);
        }

        if ($this->has('price') && is_null($this->input('price'))) {
            $this->merge([
                'price' => 0
            ]);
        } else if ($this->has('price') && !is_null($this->input('price'))) {
            $converted_price = mb_convert_kana($this->price, "n");
            $replaced_price = preg_replace('/[^ぁ-んァ-ンーa-zA-Z0-9一-０-９\.]+/u', '', $converted_price);
            $this->merge([
                'price' => $replaced_price,
            ]);
        } 

        if ($this->input('limit_of_supporters_is_required') === 0) {
            $this->merge([
                'limit_of_supporters' => 1,
            ]);
        }

        if ($this->isMethod('patch') && $this->missing('limit_of_supporters_is_required') && $this->route('plan')->limit_of_supporters_is_required === 0) {
            $this->merge([
                'limit_of_supporters' => 1,
            ]);
        }

        if ($this->isMethod('post') && $this->missing('limit_of_supporters_is_required')) {
            $this->merge([
                'limit_of_supporters' => 1,
            ]);
        }

        if ($this->has('year') && $this->has('month')) {
            $delivery_date = Carbon::createFromDate($this->year, $this->month)->format('Y-m');
            $this->merge([
                'delivery_date' => $delivery_date
            ]);
        }
    }

    public function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json(['message' => $validator->errors()->toArray()])
            );
        } else {
            throw new HttpResponseException(
                redirect()
                    ->route('user.my_project.project.edit', ['project' => $this->route('project'), 'next_tab' => 'return', 'status' => 422, 'plan' => $this->route('plan')])
                    ->withErrors($validator)
                    ->withInput()
            );
        };
    }

    protected function passedValidation()
    {
        if ($this->image_url === null && !isset($this->route('plan')->image_url)) {
            $this->merge(['image_url' => "public/sampleImage/now_printing.png"]);
        }
    }

    public function messages()
    {
        return [
            'delivery_date.date_format' => ':attributeの形式は、「年-月-日」で指定してください。',
            'delivery_date.after' => ':attributeには、プロジェクト掲載終了日以降の日付を指定してください。',
        ];
    }
}
