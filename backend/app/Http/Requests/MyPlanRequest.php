<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $project_end_date = $this->route('project')->end_date->format('Y-m-d H:i:s');
        
        return [
            'title' => ['nullable', 'string', 'max:45'],
            'content' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'integer', 'max:10000000'],
            'address_is_required' => ['required', 'boolean'],
            'limit_of_supporters' => ['required', 'integer', 'min:1'],
            'delivery_date' => ['required', 'date_format:Y-m-d', "after:{$project_end_date}"],
            'image_url' => ['nullable', 'image']
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->title === null) {
            $this->merge([
                'title' => ''
            ]);
        };

        if ($this->input('content') === null) {
            $this->merge([
                'content' => ''
            ]);
        };
        if ($this->limit_of_supporters === null) {
            $this->merge([
                'limit_of_supporters' => 1
            ]);
        }

        if ($this->delivery_month === "00") {
            $this->merge([
                'delivery_month' => date('m')
            ]);
        };

        if ($this->delivery_day === "00") {
            $this->merge([
                'delivery_day' => date('y')
            ]);
        }

        $this->merge([
            'delivery_date' => $this->delivery_year . '-' . $this->delivery_month . '-' . $this->delivery_day
        ]);

        if ($this->price === null) {
            $this->merge([
                'price' => 0
            ]);
        }
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
