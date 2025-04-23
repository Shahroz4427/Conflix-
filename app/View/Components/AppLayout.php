<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public ?string $navBarAddBtn;
    public ?string $navBarAddBtnUrl;

    public ?string $routePrefix;


    public function __construct(?string $navBarAddBtn = null, ?string $navBarAddBtnUrl = null, ?string $routePrefix = null)
    {
        $this->navBarAddBtn = $navBarAddBtn;

        $this->navBarAddBtnUrl = $navBarAddBtnUrl;

        $this->routePrefix  =  $routePrefix;
    }



    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
