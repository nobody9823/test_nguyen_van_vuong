<?php

namespace App\Rules;

use App\Services\Date\DateFormatFacade;
use Illuminate\Contracts\Validation\Rule;

class CheckCVSTermDayIsBeforeToday implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($project_end_date)
    {
        $this->project_end_date = $project_end_date;
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
        if ($value === 'cvs') {
            return DateFormatFacade::getPaymentTermDay($this->project_end_date) > 0;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'コンビニ決済はプロジェクト終了の2日前まで選択が可能です。その他の決済手段をお選びください。';
    }
}
