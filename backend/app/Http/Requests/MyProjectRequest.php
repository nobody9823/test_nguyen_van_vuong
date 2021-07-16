<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyProjectRequest extends FormRequest
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
            'ps_plan_content' => ['nullable', 'string', 'max:2000']
        ];
    }

    protected function prepareForValidation()
    {
        if($this->ps_plan_content === null){
            $this->merge([
                'ps_plan_content' => ''
            ]);
        };
    }
}
