<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardDashboard extends Component
{
    public $icon;
    public $iconColor;
    public $category;
    public $value;
    public $backgroundClass;

    public $moreInfo;
    public function __construct($icon, $iconColor, $category, $value, $moreInfo,$backgroundClass)
    {
        $this->icon = $icon;
        $this->iconColor = $iconColor;
        $this->category = $category;
        $this->value = $value;
        $this->moreInfo = $moreInfo;
        $this->backgroundClass = $backgroundClass;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.card-dashboard-admin');
    }
}
