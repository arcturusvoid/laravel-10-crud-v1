<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmModal extends Component
{

    public function __construct(public $message)
    {
        //
    }

    public function render()
    {
        return view('components.confirm-modal');
    }
}
