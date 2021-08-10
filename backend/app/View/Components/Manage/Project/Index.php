<?php

namespace App\View\Components\Manage\Project;

use App\Models\Curator;
use Illuminate\View\Component;

class Index extends Component
{
    public $role;
    public $projects;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($role, $projects)
    {
        $this->role = $role;
        $this->projects = $projects;
    }

    public function curators()
    {
        return Curator::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.manage.project.index');
    }
}
