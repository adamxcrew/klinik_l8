<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $guarded = [];
  use HasFactory;
  public function Navigations()
  {
    return $this->hasMany(Navigation::class)->where('parent_id', null)->orderBy('sequence_number');
  }
}
