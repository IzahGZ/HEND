<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawMaterialSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_material_supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('raw_material_id');
            $table->integer('supplier_id');
            $table->integer('uom_id');
            $table->integer('moq_id');
            $table->decimal('price', 8, 2);
            $table->decimal('lead_time', 8, 2);
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
        Schema::dropIfExists('raw_material_supplier');
    }
}
