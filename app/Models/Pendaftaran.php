<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $with = ["poliklinik", "pasien", "dokter", "obats"];

  public function pasien()
  {
    return $this->belongsTo(Pasien::class);
  }
  public function poliklinik()
  {
    return $this->belongsTo(Poliklinik::class);
  }
  public function dokter()
  {
    return $this->belongsTo(Dokter::class);
  }
  public function diagnosas()
  {
    return $this->belongsToMany(Diagnosa::class);
  }
  public function obats()
  {
    return $this->belongsToMany(Obat::class)->withPivot("quantity", "harga", "total")->withTimestamps();
  }
  public function tindakans()
  {
    return $this->belongsToMany(Tindakan::class);
  }
  public function pembayaran()
  {
    return $this->hasOne(Pembayaran::class);
  }
}
