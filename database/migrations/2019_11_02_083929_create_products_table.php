<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 100);
            $table->char('code', 100)->unique();
            $table->decimal('current_stock', 8, 2)->default(0);
            $table->integer('lead_time');
            $table->integer('uom');
            $table->decimal('price', 8, 2);
            $table->integer('shelf_life');
            $table->decimal('safety_stock', 8, 2);
            $table->decimal('holding_cost', 3, 2);
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
        Schema::dropIfExists('products');
    }
}
