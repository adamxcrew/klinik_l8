<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
  use HasFactory;
  protected $attributes = ['status' => 1];
  protected $guarded = [];

  public function dokters()
  {
    return $this->belongsToMany(Dokter::class);
  }
}
