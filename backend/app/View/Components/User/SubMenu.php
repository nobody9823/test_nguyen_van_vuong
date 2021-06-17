<?php

namespace App\View\Components\User;

use Illuminate\View\Component;
use App\Models\Category;

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

    public function categories()
    {
        $categories = Category::PluckNameAndId();
        return $categories;
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
