<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tindakans', function (Blueprint $table) {
      $table->id();
      $table->string("kode")->unique();
      $table->string("nama");
      $table->integer("jasa_dokter");
      $table->integer("jasa_poli");
      $table->integer("harga");
      $table->enum("status", [1, 2, 3, 4])->default(1);
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
    Schema::dropIfExists('tindakans');
  }
}
