<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrpRawMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrp_raw_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('product_id');
            $table->integer('raw_material_id');
            $table->decimal('quantity', 8, 4);
            $table->decimal('on_hand', 8, 4);
            $table->decimal('schedule_receipt', 8, 4);
            $table->decimal('net_requirement', 8, 4);
            $table->decimal('order_release', 8, 4);
            $table->integer('pr_id');
            $table->decimal('order_receipt', 8, 4);
            $table->integer('order_release_status');
            $table->integer('order_receipt_status');
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
        Schema::dropIfExists('mrp_raw_materials');
    }
}
