<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArticleItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('client.components.article.article-item',[
            'data' => $this->data
        ]);
    }
}
