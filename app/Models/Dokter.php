<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
  use HasFactory;
  protected $guarded = [];
  protected $with = ["user"];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function polikliniks()
  {
    return $this->belongsToMany(Poliklinik::class);
  }
}
