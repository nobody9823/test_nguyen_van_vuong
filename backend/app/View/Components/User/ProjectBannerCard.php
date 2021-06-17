<?php

namespace App\View\Components\User;

use Illuminate\View\Component;

class ProjectBannerCard extends Component
{
    public $sectionTitle;
    public $props;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sectionTitle, $props)
    {
        $this->sectionTitle = $sectionTitle;
        $this->props = $props;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.project-banner-card');
    }
}
