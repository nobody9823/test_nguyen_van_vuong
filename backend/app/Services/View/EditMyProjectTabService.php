<?php

namespace App\Services\View;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EditMyProjectTabService
{

    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    protected $my_project_tab = [
        0 => 'target_amount',
        1 => 'overview',
        2 => 'visual',
        3 => 'return',
        4 => 'ps_return',
        5 => 'identification'
    ];

    protected $current_tag_order = null;

    protected $next_tag_order = null;

    public function getNextTab($tab_name)
    {
        if ($tab_name !== null) {
            $this->current_tag_order = array_search($tab_name, $this->my_project_tab);
        }

        if ($this->current_tag_order < 5) {
            $this->next_tag_order = $this->current_tag_order + 1;
        } elseif ($this->current_tag_order === 5) {
            $this->next_tag_order = 0;
        }
        return $this->my_project_tab[$this->next_tag_order];
    }

    public function TargetAmountTabIsFilled(Project $project)
    {
        if ($project->target_amount > 0 && !Carbon::minValue()->eq($project->start_date) && !Carbon::maxValue()->eq($project->end_date)) {
            return true;
        }
        return false;
    }

    public function OverviewTabIsFilled(Project $project)
    {
        if ($project->title !== '' && $project->content !== '' && !$project->tags->isEmpty()) {
            return true;
        }
        return false;
    }

    public function VisualTabIsFilled(Project $project)
    {
        if (!$project->projectFiles->isEmpty() && $project->projectFiles->first()->file_url !== 'public/sampleImage/now_printing.png') {
            return true;
        }
        return false;
    }

    public function ReturnTabIsFilled(Project $project)
    {
        if (!$project->plans->isEmpty()) {
            return true;
        }
        return false;
    }

    public function PSReturnTabIsFilled(Project $project)
    {
        if ($project->reward_by_total_amount !== "" && $project->reward_by_total_quantity) {
            return true;
        };
        return false;
    }

    public function IdentificationTabIsFilled()
    {
        if ($this->user->profile->first_name !== "" && $this->user->profile->last_name !== "" && $this->user->profile->first_name_kana !== "" && $this->user->profile->last_name_kana !== "" && $this->user->profile->phone_number !== "00000000000" && $this->user->address->postal_code !== '0' && $this->user->address->city !== "" && $this->user->address->block !== "" && !Carbon::minValue()->eq($this->user->profile->birthday) && $this->user->identification->bank_code !== "" && $this->user->identification->branch_code !== "" && $this->user->account_number !== "" && $this->user->account_name !== "" && $this->user->identify_image_1 !== 'public/sampleImage/now_printing.png' && $this->user->identify_image_2 !== 'public/sampleImage/now_printing.png') {
            return true;
        }
        return false;
    }
}
