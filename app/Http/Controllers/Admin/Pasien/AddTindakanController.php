<?php

namespace App\Http\Controllers\Admin\pasien;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Tindakan;
use Yajra\DataTables\Facades\DataTables;

class AddTindakanController extends Controller
{
  public function json(Pendaftaran $pendaftar, $view = null)
  {
    if ($view) {
      $routeDel = route('api.pasien.hapustindakan', $pendaftar->id);
      request()->merge([
        'delete' => $routeDel
      ]);
      return DataTables::of($pendaftar->tindakans()->getQuery())
        ->addColumn('delete', request("delete"))
        ->make(true);
    }
    if ($pendaftar) {
      request()->merge(['tindakan_id' => $pendaftar->tindakans->pluck('id')]);
    }

    $model = Tindakan::query()->latest();
    return DataTables::of($model)
      ->filter(function ($query) {

        if (request()->has('search') && request('search')['value']) {
          $query->where('nama', 'like', '%' . request('search')['value'] . '%');
          $query->orWhere('kode', 'like', '%' . request('search')['value'] . '%');
        }
        if (request()->has('idSelected')) {
          $query->whereNotIn('id', explode(",", request('idSelected')));
        }
        if (request()->has('tindakan_id')) {
          $query->whereNotIn('id', request('tindakan_id'));
        }
      })
      ->make(true);
  }
  public function tambahTindakan(Pendaftaran $pendaftar)
  {
    return response()->json([
      "status" =>   $pendaftar->tindakans()->attach(request("tindakan_id")),
      "data" => request()->all(),
      "pendaftar" => $pendaftar
    ]);
  }
  public function deleteTindakanPasien(Pendaftaran $pendaftar)
  {
    return response()->json([
      "status" => $pendaftar->tindakans()->detach(request("tindakan_id"))
    ]);
  }
}
