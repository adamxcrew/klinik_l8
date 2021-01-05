<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pendaftarans', function (Blueprint $table) {
      $table->id();
      $table->string("nomor_pendaftaran");
      $table->foreignId("pasien_id");
      $table->foreignId("dokter_id");
      $table->foreignId("poliklinik_id");
      $table->string("layanan");
      $table->string("status_poli");
      $table->string("status_kasir");
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
    Schema::dropIfExists('pendaftarans');
  }
}
