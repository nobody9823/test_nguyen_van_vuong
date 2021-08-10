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
        $project_end_date = $this->route('project')->end_date->format('Y-m-d H:i:s');

        return [
            'title' => ['nullable', 'string', 'max:45'],
            'content' => ['nullable', 'string', 'max:2000'],
            'price' => ['nullable', 'integer', 'max:10000000'],
            'address_is_required' => ['nullable', 'boolean'],
            'limit_of_supporters' => ['nullable', 'integer', 'min:1'],
            'delivery_date' => ['nullable', 'date_format:Y-m-d', "after:{$project_end_date}"],
            'image_url' => ['nullable', 'image']
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('delivery_month') && $this->has('delivery_day')){
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

            $date = new Carbon($this->delivery_year . '-' . $this->delivery_month . '-' . $this->delivery_day);

            $this->merge([
                'delivery_date' => $date->format('Y-m-d')
            ]);
        }
    }

    public function failedValidation(Validator $validator)
    {
        if($this->expectsJson()){
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
