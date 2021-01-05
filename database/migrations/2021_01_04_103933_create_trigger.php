<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    \Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER increase_stock AFTER DELETE ON obat_pendaftaran
      FOR EACH ROW
      UPDATE obats SET stock = stock  + OLD.quantity WHERE id = OLD.obat_id
      ');
    \Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER update_stock AFTER UPDATE ON obat_pendaftaran
      FOR EACH ROW
      IF NEW.status = 1
        THEN 
          IF OLD.status = 0 
            THEN UPDATE obats SET stock = stock - OLD.quantity WHERE id = NEW.obat_id;
          ELSE
            IF NEW.quantity > OLD.quantity
              THEN UPDATE obats SET stock = stock - (NEW.quantity - OLD.quantity) WHERE id = NEW.obat_id;
            ELSE
              UPDATE obats SET stock = stock + (OLD.quantity - NEW.quantity) WHERE id = NEW.obat_id;
            END IF;
          END IF;
      ELSE
        IF NEW.status = 0 AND OLD.status = 1
          THEN UPDATE obats SET stock = stock  + OLD.quantity WHERE id = OLD.obat_id;
        END IF;
      END IF');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
  }
}
