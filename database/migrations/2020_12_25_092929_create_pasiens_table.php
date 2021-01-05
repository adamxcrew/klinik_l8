<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pasiens', function (Blueprint $table) {
      $table->id();
      $table->string("no_ktp")->unique();
      $table->string("nama");
      $table->string("email")->unique();
      $table->string("no_hp")->nullable();
      $table->string("pekerjaan")->nullable();
      $table->string("alamat");
      $table->string("rt_rw");
      $table->string("tempat_lahir");
      $table->dateTime("tanggal_lahir");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('pasiens');
  }
}
