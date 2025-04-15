<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public ?string $buttonName;
    public ?string $buttonUrl;
    
    public function __construct(?string $buttonName = null, ?string $buttonUrl = null)
    {
        $this->buttonName = $buttonName;
        $this->buttonUrl = $buttonUrl;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}