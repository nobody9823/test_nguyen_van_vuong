<?php

namespace App\Rules;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class AlterTran implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        $this->project = Project::find($project);
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
        return $this->project->end_date < Carbon::now();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'プロジェクトの終了時刻が過ぎていないため実行できません。';
    }
}
