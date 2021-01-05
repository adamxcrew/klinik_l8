<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;

class ListPasienController extends Controller
{
  public function belumLunas()
  {
    return view("Kasir.list-pasien", [
      'pasiens' => Pendaftaran::where('status_poli', 1)->where('status_kasir', 0)->get(),
    ]);
  }
  public function Lunas()
  {
    return view("Kasir.list-pasien", [
      'pasiens' => Pendaftaran::where('status_poli', 1)->where('status_kasir', 1)->get(),
    ]);
  }
}
