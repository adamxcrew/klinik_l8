<?php

namespace App\View\Components\Sbadmin;

use App\Models\Menu;
use Illuminate\View\Component;

class sidebar extends Component
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
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    $menus = Menu::get();
    return view('components.sbadmin.sidebar', compact("menus"));
  }
}
