<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodReceiveNoteItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_receive_note_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('grn_id');
            $table->integer('po_item_id');
            $table->integer('order_quantity');
            $table->integer('receive_quantity');
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
        Schema::dropIfExists('good_receive_note_items');
    }
}
