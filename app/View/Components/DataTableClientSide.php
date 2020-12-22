<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTableClientSide extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public $data;
  public function __construct($data = [])
  {
    $this->data = $data;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('components.data-table-client-side');
  }
}
