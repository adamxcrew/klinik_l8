<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('navigations', function (Blueprint $table) {
      $table->id();
      $table->foreignId("parent_id")->nullable();
      $table->integer("sequence_number")->default(10);
      $table->foreignId("menu_id");
      $table->string("permission_name");
      $table->string("name");
      $table->string('url')->nullable();
      $table->string('icon')->nullable();
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
    Schema::dropIfExists('navigations');
  }
}
