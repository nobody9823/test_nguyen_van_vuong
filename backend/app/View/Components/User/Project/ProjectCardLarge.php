<?php

namespace App\View\Components\User\Project;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProjectCardLarge extends Component
{
    public $project;
    public $userLiked;
    public $cardSize;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($project,$userLiked,$cardSize)
    {
        $this->project = $project;
        $this->userLiked = $userLiked;
        $this->cardSize = $cardSize;
    }

    public function projectImageUrl() {
        return Storage::url($this->project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url);
    }

    public function userLiked() {
        return $this->userLiked->where('project_id',$this->project->id)->isEmpty();
    }

    public function daysLeft() {
        return Carbon::now()->diffInDays(new Carbon($this->project->end_date));
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
