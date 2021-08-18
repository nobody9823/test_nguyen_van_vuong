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
        return $end_date->gt($this->project->start_date);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '掲載終了日(日付、時刻)には、掲載開始日(日付、時刻)より後の日付を指定してください。';
    }
}
