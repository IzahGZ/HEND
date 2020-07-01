<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodReceiveNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_receive_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('grn_number');
            $table->integer('po_id');
            $table->char('supplier_do_number');
            $table->date('supplier_do_date');
            $table->char('receiving_area');
            $table->char('receive_by');
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
        Schema::dropIfExists('good_receive_notes');
    }
}
