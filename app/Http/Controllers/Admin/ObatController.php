<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
  public function index()
  {
    $obat = new Obat();
    $noPoli = "OB-" . date("Ymd") . "-";

    $obat->kode = getLastId($obat, "kode", $noPoli);
    $obats = Obat::latest()->get();
    return view("obat.index", compact("obats", "obat"));
  }
  public function add()
  {

    $obat = new Obat();
    $obats = Obat::get();
    return view("obat.index", compact("obat"));
  }
  public function store()
  {
    $attr = request()->validate([
      "kode" => "required",
      "nama" => "required|min:3",
      "harga" => "required|integer",
      "satuan" => "required",
      "stock" => "required|integer",
    ]);
    $obat =  Obat::create($attr);
    return back()->with('success', "Obat {$obat->nama} berhasil di tambahakan");
  }
  public function edit(Obat $obat)
  {

    return view("obat.edit", compact("obat"));
  }
  public function update(Obat $obat)
  {
    $attr = request()->validate([
      "kode" => "required",
      "nama" => "required|min:3",
      "harga" => "required|integer",
      "satuan" => "required",
      "stock" => "required|integer",
    ]);
    $obat->update($attr);
    return redirect()->route("obat")->with('success', "Obat {$obat->nama} berhasil di edit");
  }
  public function destroy(Obat $obat)
  {
    return response()->json([
      'status' =>    $obat->delete(),
    ]);
  }
  public function updateStatus(Obat $obat)
  {
    $obat->status = request("status");
    return response()->json([
      "data" => request("status"),
      'status' =>    $obat->update(),
    ]);
  }
  public function dokter(Obat $obat)
  {
    return response()->json([
      "dokters" => $obat->dokters
    ]);
  }
}
