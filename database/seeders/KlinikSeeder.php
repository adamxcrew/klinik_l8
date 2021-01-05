<?php

namespace Database\Seeders;

use App\Models\Diagnosa;
use App\Models\Dokter;
use App\Models\Menu;
use App\Models\Poliklinik;
use App\Models\Tindakan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class KlinikSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $diagnosas = collect([
      "Abses Anus",
      "Batuk", "Batu Ginjal",
      "Abses Gigi", "Tifus"
    ]);
    $gejalas = collect([
      "Sembelit",
      "Demam dan menggigil",
      "Tubuh mudah lelah",
      "Sulit buang air kecil",
      "Iritasi, bengkak, dan kemerahan di sekitar anus",
      "Keluar nanah atau darah dari dubur",
      "Sering buang air kecil.",
      "Sakit saat buang air kecil.",
      "Jumlah urine yang keluar sedikit atau urine tidak keluar sama sekali.",
      "Demam.",
      "Gusi bengkak.",
      "Rasa sakit saat mengunyah dan mengigit.",
      "Sakit gigi yang menyebar ke telinga, rahang, dan leher.",
      "Gigi berubah warna.",
      "Sensitif pada makanan panas atau dingin.",
      "Bau mulut.",
      "Kemerahan dan pembengkakan pada wajah.",
      "Pembengkakan kelenjar getah bening di leher atau bawah rahang.",
      "Sesak napas.",
      "Demam yang meningkat secara bertahap tiap hari hingga mencapai 39°C–40°C dan biasanya akan lebih tinggi pada malam hari",
      "Nyeri otot",
      "Sakit kepala",
      "Merasa tidak enak badan",
      "Sakit perut",
      "Berat badan menurun",
    ]);
    $diagnosas->each(function ($diagnosa) {
      Diagnosa::create([
        'kode' => getLastId(new Diagnosa(), "kode", "DNS-" . date("Ymd") . "-"),
        'nama' => $diagnosa,
      ]);
    });

    $poliUmum =  Poliklinik::create([
      "no_poli" => "poli-20201229-001",
      "nama" => "UMUM",
      "keterangan" => "Melayani Masyarakat Umum",
      "jam_layanan" => "05:00:00",
      "status" => 1
    ]);
    $dokter = User::create([
      "name" => "dr. Resti Amalia",
      "password" => bcrypt("root"),
      "email" => "dokter-" . uniqid() . "@klinik.com",
    ]);
    $poliUmum->dokters()->create([
      "user_id" => $dokter->id,
      "kode_dokter" => getLastId(new Dokter(), "kode_dokter", "DKT-" . date("Ymd") . "-"),
      "spesialis" => "UMUM",
    ]);

    $tindakans = collect([
      ['nama' => "Konsultasi", "harga" => 20000],
      ['nama' => "Terapi", "harga" => 50000],
      ['nama' => "Pelayanan Umum", "harga" => 20000],
    ]);
    $tindakans->each(function ($tindakan) {
      Tindakan::create([
        "kode" => getLastId(new Tindakan(), "kode", "TD-" . date("Ymd") . "-"),
        "nama" => $tindakan['nama'],
        "jasa_dokter" => $tindakan['harga'] * 0.65,
        "jasa_poli" => $tindakan['harga'] * 0.35,
        "harga" => $tindakan['harga'] * 1,
      ]);
    });



    //============== MENU
    $mKasir = Menu::create([
      'name' => "Kasir"
    ]);
    $p = Permission::create(['name' => "Mengolah Kasir"]);
    $mKasir->navigations()->create([
      "name" => "Pasien Belum Lunas",
      'permission_name' => $p->name,
      "url" => "kasir/pasien-belum-lunas",
    ]);
  }
}
