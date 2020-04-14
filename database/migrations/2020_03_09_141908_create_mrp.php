<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('date');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('on_hand');
            $table->integer('net_requirement');
            $table->integer('order_release');
            $table->integer('order_receipt');
            $table->integer('wo_status');
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
        Schema::dropIfExists('mrp');
    }
}
