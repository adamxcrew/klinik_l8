<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiagnosaController;
use App\Http\Controllers\admin\DokterController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\Pasien\{AddResepController, AddTindakanController, DiagnosaPasienController, PasienPoliAntriController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Pasien\TambahPasienController;
use App\Http\Controllers\Admin\PoliklinikController;
use App\Http\Controllers\Admin\TindakanController;
use App\Http\Controllers\Kasir\{DetailPasienController, ListPasienController};

Route::prefix("admin")->middleware(["auth"])->group(function () {
  Route::get('dashboard', [DashboardController::class, "index"])->name("dashboard");
  Route::middleware("can:Tambah Pasien")->get("tambah-pasien", [TambahPasienController::class, "index"])->name('pasien.tambah');
  Route::middleware("can:Tambah Pasien")->post("tambah-pasien", [TambahPasienController::class, "store"]);
  Route::middleware("can:Tambah Pasien")->get("pasien/{pendaftaran:nomor_pendaftaran}/detail", [TambahPasienController::class, "detail"])->name("pasien.detail");
  Route::middleware("can:Tambah Pasien")->get("pasien-terdaftar", [TambahPasienController::class, "terdaftar"])->name("pasien.terdaftar");
  Route::middleware("can:Tambah Pasien")->post("pasien-terdaftar", [TambahPasienController::class, "terdaftarStore"]);

  Route::middleware("role:poli")->prefix("pasien")->group(function () {
    Route::get("poli/antri", [PasienPoliAntriController::class, "index"])->name("pasien.poli.antri");
    Route::middleware("can:Diagnosa Pasien")->get("/{pendaftar}/diagnosa", [DiagnosaPasienController::class, "index"])->name("pasien.diagnosa");
    Route::middleware("can:Diagnosa Pasien")->get("/{pendaftar}/diagnosa-selesi", [DiagnosaPasienController::class, "selesai"])->name("pasien.diagnosa-selesai");


    Route::view("react/{any?}", "Pasien.React.index")->name("pasien.poli.antri.react");
  });

  /**
   * ! DATATABLE PASIEN
   */
  Route::match(["get", "post"], "diagnosa/datatable/{pendaftar?}/{show?}/", [DiagnosaController::class, "json"])->name("diagnosa.datatable");
  Route::match(["get", "post"], "resep/datatable/{pendaftar?}/{show?}/", [AddResepController::class, "json"])->name("resep.datatable");
  Route::match(["get", "post"], "tindakan/datatable/{pendaftar?}/{show?}/", [AddTindakanController::class, "json"])->name("pasien.tindakan.datatable");

  Route::middleware("can:Mengolah Poliklinik")->prefix("poliklinik")->group(function () {
    Route::get("/", [PoliklinikController::class, "index"])->name("poliklinik");
    Route::get("/tambah", [PoliklinikController::class, "add"])->name("poliklinik.tambah");
    Route::post("/tambah", [PoliklinikController::class, "store"]);
    Route::get("{poliklinik}/edit", [PoliklinikController::class, "edit"])->name("poliklinik.edit");
    Route::put("{poliklinik}/edit", [PoliklinikController::class, "update"]);
    Route::delete("{poliklinik}/delete", [PoliklinikController::class, "destroy"])->name("poliklinik.delete");
    Route::put("{poliklinik}/ganti-status", [PoliklinikController::class, "updateStatus"])->name("poliklinik.gantistatus");
  });
  Route::middleware("can:Mengolah Dokter")->prefix("dokter")->group(function () {
    Route::get("/", [DokterController::class, "index"])->name("dokter");
    Route::get("/tambah", [DokterController::class, "add"])->name("dokter.tambah");
    Route::post("/tambah", [DokterController::class, "store"]);
    Route::get("{dokter}/edit", [DokterController::class, "edit"])->name("dokter.edit");
    Route::put("{dokter}/edit", [DokterController::class, "update"]);
    Route::delete("{dokter}/delete", [DokterController::class, "destroy"])->name("dokter.delete");
  });
  Route::middleware("can:Mengolah Tindakan")->prefix("tindakan")->group(function () {
    Route::get("/", [TindakanController::class, "index"])->name("tindakan");
    Route::get("/tambah", [TindakanController::class, "add"])->name("tindakan.tambah");
    Route::post("/tambah", [TindakanController::class, "store"]);
    Route::get("{tindakan}/edit", [TindakanController::class, "edit"])->name("tindakan.edit");
    Route::put("{tindakan}/edit", [TindakanController::class, "update"]);
    Route::delete("{tindakan}/delete", [TindakanController::class, "destroy"])->name("tindakan.delete");
    Route::put("{tindakan}/ganti-status", [TindakanController::class, "updateStatus"])->name("tindakan.gantistatus");
  });

  /**
   * !DIAGNOSA
   * ? MASTER
   */
  Route::middleware("can:Mengolah Diagnosa")->prefix("diagnosa")->group(function () {
    Route::get("/", [DiagnosaController::class, "index"])->name("diagnosa");
    Route::get("/tambah", [DiagnosaController::class, "add"])->name("diagnosa.tambah");
    Route::post("/tambah", [DiagnosaController::class, "store"]);
    Route::get("{diagnosa}/edit", [DiagnosaController::class, "edit"])->name("diagnosa.edit");
    Route::put("{diagnosa}/edit", [DiagnosaController::class, "update"]);
    Route::delete("{diagnosa}/delete", [DiagnosaController::class, "destroy"])->name("diagnosa.delete");
    Route::put("{diagnosa}/ganti-status", [DiagnosaController::class, "updateStatus"])->name("diagnosa.gantistatus");
  });
  Route::middleware("can:Mengolah Obat")->prefix("obat")->group(function () {
    Route::get("/", [ObatController::class, "index"])->name("obat");
    Route::get("/tambah", [ObatController::class, "add"])->name("obat.tambah");
    Route::post("/tambah", [ObatController::class, "store"]);
    Route::get("{obat}/edit", [ObatController::class, "edit"])->name("obat.edit");
    Route::put("{obat}/edit", [ObatController::class, "update"]);
    Route::delete("{obat}/delete", [ObatController::class, "destroy"])->name("obat.delete");
    Route::put("{obat}/ganti-status", [ObatController::class, "updateStatus"])->name("obat.gantistatus");
  });
});

//=================  KASIR   =======================
Route::prefix("kasir")->middleware(["auth", "can:Mengolah Kasir"])->group(function () {
  Route::get("/pasien-lunas", [ListPasienController::class, "Lunas"])->name("kasir.pasien-lunas");
  Route::get("/pasien-belum-lunas", [ListPasienController::class, "belumLunas"])->name("kasir.pasien-belum-lunas");
  Route::get("/detail-pasien/{pendaftar}", [DetailPasienController::class, "index"])->name("kasir.detail-pasien");
  Route::post("/detail-pasien/{pendaftar}", [DetailPasienController::class, "savePembayaran"]);
});
// ====================== API ========================
Route::prefix("api")->group(function () {
  /*
  !Pasiens
*/
  Route::post("pasien/{pendaftar}/tambah-diagnosa", [DiagnosaPasienController::class, "tambahDiagnosa"])->name("api.pasien.tambahdiagnosa");
  Route::delete("pasien/{pendaftar}/delete-diagnosa", [DiagnosaController::class, "deleteDiagnosaPasien"])->name("api.pasien.hapusdiagnosa");

  Route::post("pasien/{pendaftar}/tambah-resep", [AddResepController::class, "tambahResep"])->name("api.pasien.tambahresep");
  Route::delete("pasien/{pendaftar}/delete-resep", [AddResepController::class, "deleteResepPasien"])->name("api.pasien.hapusresep");

  Route::post("pasien/{pendaftar}/tambah-tindakan", [AddTindakanController::class, "tambahTindakan"])->name("api.pasien.tambahtindakan");
  Route::delete("pasien/{pendaftar}/delete-tindakan", [AddTindakanController::class, "deleteTindakanPasien"])->name("api.pasien.hapustindakan");

  Route::put("dokter/{dokter}/ganti-status", [DokterController::class, "updateStatus"])->name("dokter.gantistatus");
  Route::get("poliklinik/{poliklinik}/dokter", [PoliklinikController::class, "dokter"])->name("poliklinik.dokter");
});
