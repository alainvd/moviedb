<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tableUser extends Component
{

    public $users;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($users, $title)
    {
        $this->users = $users;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table-user');
    }
}
