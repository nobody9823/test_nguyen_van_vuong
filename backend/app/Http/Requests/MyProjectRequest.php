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
            'target_amount' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['required', 'date_format:Y-m-d H:i', 'after_or_equal:'.$request->route('project')->start_date],
            'end_date' => ['required', 'date_format:Y-m-d H:i', 'after:start_date', 'before_or_equal:'.$request->route('project')->end_date],
            'ps_plan_content' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->start_month === null){
            $this->merge([
                'start_month' => date('m', strtotime('1 day'))
            ]);
        }

        if ($this->start_day === null){
            $this->merge([
                'start_day' => date('d', strtotime('1 day'))
            ]);
        }

        if ($this->start_hour === null){
            $this->merge([
                'start_hour' => date('H', strtotime('1 day'))
            ]);
        }

        if ($this->start_minute === null){
            $this->merge([
                'start_minute' => date('i', strtotime('1 day'))
            ]);
        }

        $this->merge([
            'start_date' => $this->start_year.'-'.$this->start_month.'-'.$this->start_day.' '.$this->start_hour.':'.$this->start_minute
        ]);

        if ($this->end_month === null){
            $this->merge([
                'end_month' => date('m', strtotime('2 day'))
            ]);
        }

        if ($this->end_day === null){
            $this->merge([
                'end_day' => date('d', strtotime('2 day'))
            ]);
        }

        if ($this->end_hour === null){
            $this->merge([
                'end_hour' => date('H', strtotime('2 day'))
            ]);
        }

        if ($this->end_minute === null){
            $this->merge([
                'end_minute' => date('i', strtotime('2 day'))
            ]);
        }

        $this->merge([
            'end_date' => $this->end_year.'-'.$this->end_month.'-'.$this->end_day.' '.$this->end_hour.':'.$this->end_minute
        ]);

        if($this->ps_plan_content === null){
            $this->merge([
                'ps_plan_content' => ''
            ]);
        };
    }
}
