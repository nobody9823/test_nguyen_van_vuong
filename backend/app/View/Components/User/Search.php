<?php

namespace App\View\Components\User;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use Carbon\Carbon;

class Search extends Component
{
    public $sort_type;
    public $word;
    public $category_id;
    public $free_word;
    public $holding_check;
    public $cheered_check;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->sort_type = $request->get('sort_type');
        $this->word = $request->get('word');
        $this->category_id = $request->get('category_id');
        $this->free_word = $request->get('free_word');
        $this->holding_check = $request->get('holding_check');
        $this->cheered_check = $request->get('cheered_check');
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
        return view('components.user.search');
    }
}
