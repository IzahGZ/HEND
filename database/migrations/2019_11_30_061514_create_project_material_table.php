<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('raw_material_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('lot_sizing_id')->default(0);
            $table->decimal('quantity',8,4);
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
        Schema::dropIfExists('project_material');
    }
}
