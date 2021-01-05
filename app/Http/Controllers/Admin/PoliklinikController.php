<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
  public function index()
  {
    $poliklinik = new Poliklinik();
    $noPoli = "poli-" . date("Ymd") . "-";

    $poliklinik->no_poli = getLastId($poliklinik, "no_poli", $noPoli);
    $polikliniks = Poliklinik::get();
    return view("poliklinik.index", compact("polikliniks", "poliklinik"));
  }
  public function add()
  {

    $poliklinik = new Poliklinik();
    $polikliniks = Poliklinik::get();
    return view("poliklinik.index", compact("poliklinik"));
  }
  public function store()
  {
    $attr = request()->validate([
      "no_poli" => "required",
      "nama" => "required|min:3",
      "keterangan" => "nullable|min:6",
      "jam_layanan" => "required",
    ]);
    $poliklinik =  Poliklinik::create($attr);
    return back()->with('success', "Poliklinik {$poliklinik->nama} berhasil di tambahakan");
  }
  public function edit(Poliklinik $poliklinik)
  {

    return view("poliklinik.edit", compact("poliklinik"));
  }
  public function update(Poliklinik $poliklinik)
  {
    $attr = request()->validate([
      "no_poli" => "required",
      "nama" => "required|min:3",
      "keterangan" => "nullable|min:6",
      "jam_layanan" => "required",
    ]);
    $poliklinik->update($attr);
    return redirect()->route("poliklinik")->with('success', "Poliklinik {$poliklinik->nama} berhasil di edit");
  }
  public function destroy(Poliklinik $poliklinik)
  {
    return response()->json([
      'status' =>    $poliklinik->delete(),
    ]);
  }
  public function updateStatus(Poliklinik $poliklinik)
  {
    $poliklinik->status = request("status");
    return response()->json([
      "data" => request("status"),
      'status' =>    $poliklinik->update(),
    ]);
  }
  public function dokter(Poliklinik $poliklinik)
  {
    return response()->json([
      "dokters" => $poliklinik->dokters
    ]);
  }
}
