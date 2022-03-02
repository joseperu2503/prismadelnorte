<?php

namespace App\View\Components;

use Illuminate\View\Component;

class post extends Component
{
    public $post;
    public $meses;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post,$meses)
    {
        $this->post = $post;
        $this->meses = $meses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post');
    }
}
