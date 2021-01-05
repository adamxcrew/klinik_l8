<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
  use HasFactory;
  protected $guarded = [];
  public function pasiens()
  {
    return $this->belongsToMany(Pendaftaran::class);
  }
}
