<?php

namespace App\View\Components;

use App\Models\Article;
use Illuminate\View\Component;

class ArticleCard extends Component
{
    public $article;

    public $col_size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Article $article, string $col_size)
    {
        $this->article = $article;
        $this->col_size = $col_size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.user.article-card');
    }
}
