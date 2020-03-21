<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MainTitle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $text;
    public $h1;

    public function __construct($title, $text = null, $h1 = true)
    {
        $this->title = $title;
        $this->text = $text;
        $this->h1 = $h1;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('client.components.main-title', [
            'title' => $this->title,
            'text' => $this->text,
            'h1' => $this->h1
        ]);
    }
}
