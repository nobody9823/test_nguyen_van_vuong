<?php

namespace App\View\Components\User;

use Illuminate\View\Component;
use App\Models\Tag;

class SubMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function tags()
    {
        $tags = Tag::pluck('name', 'id');
        return $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user.sub-menu');
    }
}
