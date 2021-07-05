<?php

namespace App\View\Components\Manage;

use App\Models\Project;
use Illuminate\View\Component;
use Request;

class SearchTerms extends Component
{
    public $role;
    public $model;
    public $project;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($role, $model)
    {
        $this->role = $role;
        $this->model = $model;
        $this->project = Project::find(Request::get('project'));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.manage.search-terms');
    }
}
