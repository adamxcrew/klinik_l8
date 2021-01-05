<?php

namespace App\Http\Controllers\Admin\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Pendaftaran;
use Yajra\DataTables\Facades\DataTables;

class AddResepController extends Controller
{
  public function json(Pendaftaran $pendaftar, $view = null)
  {
    if ($view) {
      $routeDel = route('api.pasien.hapusresep', $pendaftar->id);
      request()->merge([
        'delete' => $routeDel
      ]);
      return DataTables::of($pendaftar->obats()->withPivot(["quantity", "aturan"])->getQuery())
        ->addColumn('delete', request("delete"))
        ->make(true);
    }
    if ($pendaftar) {
      request()->merge(['obat_id' => $pendaftar->obats->pluck('id')]);
    }

    $model = Obat::query()->latest();
    return DataTables::of($model)
      ->filter(function ($query) {
        if (request()->has('idSelected')) {
          $query->whereNotIn('id', explode(",", request('idSelected')));
        }
        if (request()->has('obat_id')) {
          $query->whereNotIn('id', request('obat_id'));
        }
        if (request()->has('search') && request('search')['value']) {
          $query->where('nama', 'like', '%' . request('search')['value'] . '%');
          $query->orWhere('kode', 'like', '%' . request('search')['value'] . '%');
        }
      })
      ->make(true);
  }
  public function tambahResep(Pendaftaran $pendaftar)
  {
    return response()->json([
      "status" =>   $pendaftar->obats()->attach([
        request("obat_id") => ['quantity' => request("quantity") ?? 0, "aturan" => request("aturan") ?? "..", "harga" => request("harga"), "total" => request("harga") * request("quantity")]
      ]),
      "data" => request()->all(),
      "pendaftar" => $pendaftar
    ]);
  }
  public function deleteResepPasien(Pendaftaran $pendaftar)
  {
    return response()->json([
      "status" => $pendaftar->obats()->detach(request("obat_id"))
    ]);
  }
}
