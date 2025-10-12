<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeader extends Component
{
    public $title;
    public $actions;

    public function __construct($title, $actions = null)
    {
        $this->title = $title;
        $this->actions = $actions;
    }

    public function render()
    {
        return view('components.page-header');
    }
}
