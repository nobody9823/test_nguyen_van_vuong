<?php

namespace App\View\Components\User\Project;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProjectCardLarge extends Component
{
    public $projects;
    public $userLiked;
    public $carbon_now;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($projects,$userLiked)
    {
        $this->projects = $projects;
        $this->userLiked = $userLiked;
    }

    public function projectImageUrl() {
        return Storage::url($this->projects->first()->projectFiles()->where('file_content_type', 'image_url')->first()->file_url);
    }

    public function userLiked() {
        return $this->userLiked->where('project_id',$this->projects->first()->id)->isEmpty();
    }

    public function daysLeft() {
        return Carbon::now()->diffInDays(new Carbon($this->projects->first()->end_date));
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.project.project-card-large');
    }
}
