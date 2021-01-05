<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('obats', function (Blueprint $table) {
      $table->id();
      $table->string("kode")->unique();
      $table->string("nama");
      $table->string("satuan");
      $table->integer("harga");
      $table->integer("stock")->default(1);
      $table->integer("status")->nullable()->default(1);
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
    Schema::dropIfExists('obats');
  }
}
