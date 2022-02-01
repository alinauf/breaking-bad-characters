<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfirmCreateModal extends Component
{

    public $title;
    public $subtitle;

    /**
     * Create the component instance.
     *
    //     * @param  string  $title
    //     * @param  string  $subtitle
     * @return void
     */
    public function __construct($title, $subtitle)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.confirm-create-modal');
    }
}
