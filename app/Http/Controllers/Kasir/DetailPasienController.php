<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DetailPasienController extends Controller
{
  public function index(Pendaftaran $pendaftar)
  {
    return view("Kasir.detail-pasien", [
      "pendaftar" => $pendaftar,
    ]);
  }
  public function savePembayaran(Pendaftaran $pendaftar)
  {
    if (!$pendaftar->pembayaran()->exists()) {
      $pendaftar->pembayaran()->create([
        "total_bayar" => request("total_bayar"),
        "uang_bayar" => request("uang_bayar"),
        "kembalian" => request("kembalian"),
      ]);
      session()->flash("success", "Pembayaran berhasil");
    }
    if ($pendaftar->status_kasir != 1) {
      $pendaftar->status_kasir = 1;
      $pendaftar->update();
      $pendaftar->refresh();
    }
    return view("Kasir.invoice", [
      "pendaftar" => $pendaftar,
    ]);
    // return redirect(route("kasir.pasien-belum-lunas"))->with("success", "Pembayaran berhasil");
  }
}
