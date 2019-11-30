<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_process', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('raw_material_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('process_id');
            $table->string('duration');
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
        Schema::dropIfExists('project_process');
    }
}
