<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatPendaftaranTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {


    Schema::create('obat_pendaftaran', function (Blueprint $table) {
      $table->foreignId("obat_id");
      $table->foreignId("pendaftaran_id");
      $table->integer("quantity");
      $table->integer("harga")->nullable();
      $table->integer("total")->nullable();
      $table->string("aturan");
      $table->integer("status")->default(0);
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
    Schema::dropIfExists('obat_pendaftaran');
  }
}
