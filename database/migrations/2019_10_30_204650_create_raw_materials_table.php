<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 100);
            $table->char('code', 100);
            $table->decimal('current_stock', 8, 2)->default(0);
            $table->integer('uom');
            $table->integer('shelf_life');
            $table->decimal('set_up_cost', 8, 2);
            $table->decimal('inventory_cost', 3, 2);
            $table->integer('category_id');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_materials');
    }
}
