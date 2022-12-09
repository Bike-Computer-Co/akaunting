<?php

namespace App\View\Components\Layouts;

use App\Abstracts\View\Component;
use App\Traits\Modules as RemoteModules;

class Modules extends Component
{
    use RemoteModules;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.layouts.modules');
    }
}
