<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
  use HasFactory;
  protected $guarded = [];

  public function menu()
  {
    return $this->belongsTo(Menu::class);
  }
  public function children()
  {
    return $this->hasMany(self::class, "parent_id");
  }
}
