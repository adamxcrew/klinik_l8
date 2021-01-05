<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosaPendaftaranTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('diagnosa_pendaftaran', function (Blueprint $table) {
      $table->foreignId("pendaftaran_id");
      $table->foreignId("diagnosa_id");
      $table->string("keterangan")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('diagnosa_pendaftaran');
  }
}
