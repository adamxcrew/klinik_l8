<?php

namespace App\Http\Controllers\Admin;

use App\Models\Diagnosa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;

class DiagnosaController extends Controller
{
  public function json(Pendaftaran $pendaftar, $view = null)
  {
    if ($view) {
      $routeDel = route('api.pasien.hapusdiagnosa', $pendaftar->id);
      request()->merge([
        'delete' => $routeDel
      ]);
      return DataTables::of($pendaftar->diagnosas()->withPivot("keterangan")->getQuery())
        ->addColumn('delete', request("delete"))
        ->make(true);
    }
    if ($pendaftar) {
      $pendaftar->diagnosas->pluck('id');
      request()->merge(['diagnosa_id' => $pendaftar->diagnosas->pluck('id')]);
    }

    $model = Diagnosa::query();
    return DataTables::of($model)
      ->filter(function ($query) {
        if (request()->has('idSelected')) {
          $query->whereNotIn('id', explode(",", request('idSelected')));
        }
        if (request()->has('diagnosa_id')) {
          $query->whereNotIn('id', request('diagnosa_id'));
        }
        if (request()->has('search') && request('search')['value']) {
          $query->where('nama', 'like', '%' . request('search')['value'] . '%');
          $query->orWhere('kode', 'like', '%' . request('search')['value'] . '%');
        }
      })

      ->make(true);
  }
  public function deleteDiagnosaPasien(Pendaftaran $pendaftar)
  {
    return response()->json([
      "status" => $pendaftar->diagnosas()->detach(request("diagnosa_id"))
    ]);
  }

  public function index()
  {
    $diagnosa = new Diagnosa();
    $kode = "DNS-" . date("Ymd") . "-";
    $diagnosa->kode = getLastId($diagnosa, "kode", $kode);
    $diagnosas = Diagnosa::latest()->get();
    return view("diagnosa.index", compact("diagnosas", "diagnosa"));
  }
  public function add()
  {
    $diagnosa = new Diagnosa();
    $diagnosas = Diagnosa::get();
    return view("diagnosa.index", compact("diagnosa"));
  }
  public function store()
  {
    $attr = request()->validate([
      "kode" => "required",
      "nama" => "required|min:3",
    ]);

    $diagnosa = Diagnosa::create($attr);
    return back()->with('success', "Diagnosa {$diagnosa->nama} berhasil di tambahakan");
  }
  public function edit(Diagnosa $diagnosa)
  {
    return view("diagnosa.edit", [
      'diagnosa' => $diagnosa,
    ]);
  }
  public function update(Diagnosa $diagnosa)
  {
    $attr = request()->validate([
      "kode" => "required",
      "nama" => "required|min:3",
    ]);
    $diagnosa->update($attr);
    return redirect()->route("diagnosa")->with('success', "Diagnosa {$diagnosa->nama} berhasil di edit");
  }
  public function destroy(Diagnosa $diagnosa)
  {
    $diagnosa->pasiens()->detach();
    return response()->json([
      'status' =>   $diagnosa->delete(),
    ]);
  }
  public function updateStatus(Diagnosa $diagnosa)
  {
    $diagnosa->status = request("status");
    return response()->json([
      "data" => request("status"),
      'status' =>    $diagnosa->update(),
    ]);
  }
}
