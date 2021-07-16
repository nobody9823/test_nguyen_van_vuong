<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
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
    public function rules(Request $request)
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:5000'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'string'],
            'target_amount' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['nullable', 'date_format:Y-m-d H:i', 'after_or_equal:'.$request->route('project')->start_date],
            'end_date' => ['nullable', 'date_format:Y-m-d H:i', 'after:start_date', 'before_or_equal:'.$request->route('project')->end_date],
            'ps_plan_content' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('title') && $this->title === null){
            $this->offsetUnset('title');
        }

        if ($this->has('content') && $this->input('content') === null){
            $this->offsetUnset('content');
        }

        if ($this->has('start_date')){
            $this->merge([
                'start_date' => $this->start_year.'-'.$this->start_month.'-'.$this->start_day.' '.$this->start_hour.':'.$this->start_minute
            ]);
        }

        if ($this->has('end_date')){
            $this->merge([
                'end_date' => $this->end_year.'-'.$this->end_month.'-'.$this->end_day.' '.$this->end_hour.':'.$this->end_minute
            ]);
        }

        if($this->ps_plan_content === null){
            $this->merge([
                'ps_plan_content' => ''
            ]);
        };
    }
}
