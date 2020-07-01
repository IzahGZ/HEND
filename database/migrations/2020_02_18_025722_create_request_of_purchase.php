<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestOfPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_of_purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pr_number');
            $table->integer('item_id');
            $table->integer('raw_material_supplier_id');
            $table->decimal('quantity', 8, 2);
            $table->date('request_date');
            $table->date('estimated_date');
            $table->char('request_by');
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
        Schema::dropIfExists('request_of_purchase');
    }
}
