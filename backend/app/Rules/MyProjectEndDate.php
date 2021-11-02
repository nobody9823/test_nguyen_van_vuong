<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Project;
use Carbon\Carbon;

class MyProjectEndDate implements Rule
{
    protected $project;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $end_date = new Carbon($value);
        // dd($this->project->start_date->addDays(50));
        // dd($end_date->lt($this->project->start_date->addDays(50)) || $end_date->gt($this->project->start_date) === true);
        // dd($end_date->lt($this->project->start_date->addDays(50)));
        // dd($end_date->gt($this->project->start_date));

        if ($end_date->gt($this->project->start_date->addDays(50))) {
            // dd('test');
            return false;
        }

        if ($end_date->lt($this->project->start_date)) {
            // dd('test2');
            return false;
        } else {
            // dd('成功');
            return true;
        }
        
        // if ($end_date->lt($this->project->start_date->addDays(50)) || $end_date->gt($this->project->start_date) === true) {
        //     return false;
        // } else {
        //     return true;
        // }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '掲載終了日(日付、時刻)には、掲載開始日(日付、時刻)より50日後までの日付を指定してください。';
    }
}
