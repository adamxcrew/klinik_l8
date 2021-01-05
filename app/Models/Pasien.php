<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $dates = ['tanggal_lahir'];

  public function pendaftarans()
  {
    return $this->hasMany(Pendaftaran::class);
  }
}
