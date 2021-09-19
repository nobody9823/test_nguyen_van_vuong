<?php

namespace App\Services\View;

class ProgressBarStateService
{
    public function getNumberClassName($project)
    {
        if ($project->achievement_rate < 30) {
            return 'progress_number_color_case_of_less_than_30';
        } else if ($project->achievement_rate < 50) {
            return 'progress_number_color_case_of_less_than_50';
        } else if ($project->achievement_rate < 90) {
            return 'progress_number_color_case_of_less_than_90';
        } else if ($project->achievement_rate < 100) {
            return 'progress_number_color_case_of_less_than_100';
        } else if ($project->achievement_rate >= 100) {
            return 'progress_number_color_case_of_greater_than_100';
        }
    }

    public function getBarClassName($project)
    {
        if ($project->achievement_rate < 30) {
            return 'progress_bar_color_case_of_less_than_30';
        } else if ($project->achievement_rate < 50) {
            return 'progress_bar_color_case_of_less_than_50';
        } else if ($project->achievement_rate < 90) {
            return 'progress_bar_color_case_of_less_than_90';
        } else if ($project->achievement_rate < 100) {
            return 'progress_bar_color_case_of_less_than_100';
        } else if ($project->achievement_rate >= 100) {
            return 'progress_bar_color_case_of_greater_than_100';
        }
    }

    public function getArrowBoxClassName($project)
    {
        if ($project->achievement_rate >= 100) {
            return 'progress_arrow_box_case_of_greater_100';
        } else if ($project->achievement_rate >= 90) {
            return 'progress_arrow_box_case_of_achieve_90';
        } else if ($project->achievement_rate >= 50) {
            return 'progress_arrow_box_case_of_achieve_50';
        } else if ($project->achievement_rate >= 30) {
            return 'progress_arrow_box_case_of_achieve_30';
        }
    }

    public function getArrowBoxText($project)
    {
        if ($project->achievement_rate >= 100) {
            return "第4段階達成！";
        } else if ($project->achievement_rate >= 90) {
            return "第3段階達成！";
        } else if ($project->achievement_rate >= 50) {
            return "第2段階達成！";
        } else if ($project->achievement_rate >= 30) {
            return "第1段階達成！";
        }
    }
}
