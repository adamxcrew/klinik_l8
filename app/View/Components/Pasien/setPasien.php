<?php

namespace App\View\Components\Pasien;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poliklinik;
use Illuminate\View\Component;

class setPasien extends Component
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
    $pasienId = session("pasienID");
    $pasien = Pasien::find($pasienId);
    $pendaftar = new Pendaftaran();

    $polikliniks  = Poliklinik::latest()->get();

    return view('components.pasien.set-pasien', compact("pasien", "pendaftar", "polikliniks"));
  }
}
