<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
  public function index()
  {
    $tindakan = new Tindakan();
    $kode = "TD-" . date("Ymd") . "-";
    $tindakan->kode = getLastId($tindakan, "kode", $kode);
    $tindakans = Tindakan::get();
    return view("tindakan.index", compact("tindakans", "tindakan"));
  }
  public function add()
  {
    $tindakan = new Tindakan();
    $tindakans = Tindakan::get();
    return view("tindakan.index", compact("tindakan"));
  }
  public function store()
  {
    $attr = request()->validate([
      "kode" => "required",
      "nama" => "required|min:3",
      "jasa_dokter" => "nullable|integer",
      "jasa_poli" => "nullable|integer",
      "harga" => "required|integer",
    ]);
    if (request('jasa_dokter') && request('jasa_poli'))
      $attr['harga'] =  $attr['jasa_poli'] +  $attr['jasa_dokter'];
    $attr['jasa_dokter'] = $attr['jasa_dokter'] ?? 0.65 * $attr['harga'];
    $attr['jasa_poli'] = $attr['jasa_poli'] ?? 0.35 * $attr['harga'];
    $tindakan =  Tindakan::create($attr);
    return back()->with('success', "Tindakan {$tindakan->nama} berhasil di tambahakan");
  }
  public function edit(Tindakan $tindakan)
  {

    return view("tindakan.edit", [
      'tindakan' => $tindakan,
    ]);
  }
  public function update(Tindakan $tindakan)
  {
    $attr = request()->validate([
      "kode" => "required",
      "nama" => "required|min:3",
      "jasa_dokter" => "nullable|integer",
      "jasa_poli" => "nullable|integer",
      "harga" => "required|integer",
    ]);
    if (request('jasa_dokter') && request('jasa_poli'))
      $attr['harga'] =  $attr['jasa_poli'] +  $attr['jasa_dokter'];
    $attr['jasa_dokter'] = $attr['jasa_dokter'] ?? 0.65 * $attr['harga'];
    $attr['jasa_poli'] = $attr['jasa_poli'] ?? 0.35 * $attr['harga'];
    $tindakan->update($attr);
    return redirect()->route("tindakan")->with('success', "Tindakan {$tindakan->nama} berhasil di edit");
  }
  public function destroy(Tindakan $tindakan)
  {
    return response()->json([
      'status' =>    $tindakan->delete(),
    ]);
  }
  public function updateStatus(Tindakan $tindakan)
  {
    $tindakan->status = request("status");
    return response()->json([
      "data" => request("status"),
      'status' =>    $tindakan->update(),
    ]);
  }
}
