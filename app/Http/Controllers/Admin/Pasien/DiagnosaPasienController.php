<?php

namespace App\Http\Controllers\Admin\Pasien;

use App\Http\Controllers\Controller;
use App\Http\Resources\PasienResaurce;
use App\Models\Diagnosa;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class DiagnosaPasienController extends Controller
{
  public function index(Pendaftaran $pendaftar)
  {
    $diagnosas = Diagnosa::get();
    return view("Pasien.diagnosa-pasien", compact('pendaftar', "diagnosas"));
  }
  public function selesai(Pendaftaran $pendaftar)
  {
    if ($pendaftar->diagnosas()->count() < 1 || $pendaftar->obats()->count() < 1) {
      return back()->with("danger", "Lengkapi data Diagnosa dan Resep");
    }
    if ($pendaftar->tindakans()->count() < 1) {
      $pendaftar->tindakans()->attach(3);
    }
    $idObat  = $pendaftar->obats->pluck("id");
    foreach ($idObat as $id) {
      $pendaftar->obats()->updateExistingPivot($id, ['status' => 1]);
    }
    $pendaftar->status_poli = 1;
    $pendaftar->update();
    return redirect(route("pasien.poli.antri"));
  }
  public function store()
  {
    $attr =  request()->validate([
      'nama' => "required|min:3",
      'email' => "nullable|min:3|email|unique:pasiens",
      "no_ktp" => "integer|required|min:16",
      "alamat" => "required|min:5",
      "no_hp" => "nullable|min:5",
      "pekerjaan" => "nullable|string",
      "rt_rw" => "required",
      "tempat_lahir" => "required",
      "tanggal_lahir" => "required",
      "dokter_id" => "required",
      "poliklinik_id" => "required",
      "layanan" => "required",
    ]);

    $attr['email']  = $attr['email'] ?? uniqid("pasien", true) . "@klinik.com";
    $pasien = Pasien::create([
      "nama" => $attr['nama'],
      'email' => $attr['email'],
      'no_ktp' => $attr['no_ktp'],
      'pekerjaan' => $attr['pekerjaan'],
      'alamat' => $attr['alamat'],
      'rt_rw' => $attr['rt_rw'],
      'tempat_lahir' => $attr['tempat_lahir'],
      'tanggal_lahir' => $attr['tanggal_lahir'],
    ]);
    $nmrPendaftar = "PS-" . date("Ymd") . "-";
    $pendaftaran =  $pasien->pendaftarans()->create([
      'dokter_id' => $attr['dokter_id'],
      "nomor_pendaftaran" =>  getLastId(new Pendaftaran(), "nomor_pendaftaran", $nmrPendaftar),
      "layanan" => $attr['layanan'],
      "poliklinik_id" => $attr['poliklinik_id'],
      "status" => "mengantri",
    ]);
    return redirect(route("pasien.detail", $pendaftaran->nomor_pendaftaran))->with("success", "Pasien Di tambahkan");
  }
  public function detail(Pendaftaran $pendaftaran)
  {
    return view("Pasien.details", compact("pendaftaran"));
  }
  public function terdaftar()
  {
    $pasiens =  PasienResaurce::collection(Pasien::all());
    $polikliniks =  Poliklinik::latest()->get();
    return view("Pasien.terdaftar", compact("pasiens", "polikliniks"));
  }
  public function terdaftarStore()
  {
    $attr = request()->validate([
      "dokter_id" => "required",
      "pasien_id" => "required",
      "poliklinik_id" => "required",
      "layanan" => "required",
    ]);
    $nmrPendaftar = "PS-" . date("Ymd") . "-";
    $attr['nomor_pendaftaran'] = $nmrPendaftar;
    $attr['status'] = "Mengantri";
    $pendaftaran = Pendaftaran::create($attr);
    return redirect(route("pasien.detail", $pendaftaran->nomor_pendaftaran))->with("success", "Pasien Di tambahkan");
  }
  public function tambahDiagnosa(Pendaftaran $pendaftar)
  {
    return response()->json([
      "status" =>   $pendaftar->diagnosas()->attach([
        request("diagnosa_id") => ['keterangan' => request("keterangan") ?? null]
      ])
    ]);
  }
}
