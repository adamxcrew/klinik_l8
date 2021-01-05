<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolikliniksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('polikliniks', function (Blueprint $table) {
      $table->id();
      $table->string("no_poli")->unique();
      $table->string("nama");
      $table->string("keterangan");
      $table->time("jam_layanan");
      $table->integer("status");
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
    Schema::dropIfExists('polikliniks');
  }
}
