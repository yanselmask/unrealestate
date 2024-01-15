<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class MasterLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public $outHeader;
    public $outFooter;
    public function __construct($outHeader = false, $outFooter = false)
    {
        $this->outHeader = $outHeader;
        $this->outFooter = $outFooter;
    }
    public function render(): View
    {
        return view('layouts.master');
    }
}
