<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Status;

class StatusDropdownList extends Component
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

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.projects.status-dropdown-list',[
            'statuses' => Status::all()
        ]);
    }
}
