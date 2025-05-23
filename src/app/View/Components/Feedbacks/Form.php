<?php

namespace App\View\Components\Feedbacks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $slug;
    public function __construct($id,$slug)
    {
        $this->id = $id;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.feedbacks.form');
    }
}
