<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poliklinik;
use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
  public function index()
  {
    $dokter = new Dokter();
    $polikliniks = Poliklinik::get();
    $kodeDokter = "dkt-" . date("Ymd") . "-";
    $dokter->kode_dokter = getLastId($dokter, "kode_dokter", $kodeDokter);
    $dokters = Dokter::get();
    return view("dokter.index", compact("dokters", "dokter", "polikliniks"));
  }
  public function add()
  {
    $dokter = new Dokter();
    $dokters = Dokter::get();
    return view("dokter.index", compact("dokter"));
  }
  public function store()
  {
    $attr = request()->validate([
      "kode_dokter" => "required",
      "name" => "required|min:3",
      "spesialis" => "nullable|min:3",
      "poliklinik_id" => "required|array",
    ]);
    $user = User::create([
      'email' => uniqid("dokter_", true) . "@klinik.com",
      "password" => bcrypt("dokter"),
      "name" => $attr['name']
    ]);
    $dokter =  $user->dokter()->create([
      'kode_dokter' => $attr['kode_dokter'],
      'spesialis' => $attr['spesialis'],
    ]);
    $dokter->polikliniks()->sync($attr['poliklinik_id']);
    return back()->with('success', "Dokter {$dokter->nama} berhasil di tambahakan");
  }
  public function edit(Dokter $dokter)
  {

    return view("dokter.edit", [
      'dokter' => $dokter,
      "polikliniks" => Poliklinik::get(),
    ]);
  }
  public function update(Dokter $dokter)
  {
    $attr = request()->validate([
      "kode_dokter" => "required",
      "name" => "required|min:3",
      "spesialis" => "nullable|min:3",
      "poliklinik_id" => "required|array",
    ]);
    $dokter->update(
      [
        'kode_dokter' => $attr['kode_dokter'],
        'spesialis' => $attr['spesialis'],
      ]
    );
    $dokter->user()->update(["name" => $attr['name']]);
    $dokter->polikliniks()->sync($attr['poliklinik_id']);
    return redirect()->route("dokter")->with('success', "Dokter {$dokter->nama} berhasil di edit");
  }
  public function destroy(Dokter $dokter)
  {
    return response()->json([
      'status' =>    $dokter->delete(),
    ]);
  }
  public function updateStatus(Dokter $dokter)
  {
    $dokter->status = request("status");
    return response()->json([
      "data" => request("status"),
      'status' =>    $dokter->update(),
    ]);
  }
}
