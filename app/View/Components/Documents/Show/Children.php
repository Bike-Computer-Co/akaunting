<?php

namespace App\View\Components\Documents\Show;

use App\Abstracts\View\Components\Documents\Show as Component;
use App\Models\Common\Recurring;

class Children extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $recurring = Recurring::where('recurable_type', 'App\\Models\\Document\\Document')
            ->where('recurable_id', $this->document->id)
            ->first();

        return view('components.documents.show.children', compact('recurring'));
    }
}
