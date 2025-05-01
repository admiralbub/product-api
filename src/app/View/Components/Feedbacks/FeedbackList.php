<?php

namespace App\View\Components\Feedbacks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class FeedbackList extends Component
{
    public $feedback;
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    public function render(): View|Closure|string
    {
        return view('components.feedbacks.feedback-list');
    }
}