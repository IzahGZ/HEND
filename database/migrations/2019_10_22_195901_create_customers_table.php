<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name',100);
            $table->longText('position', 50);
            $table->longText('school',100);
            $table->longText('address',100);
            $table->char('phone',15);
            $table->char('office_no',15);
            $table->integer('status');
            $table->integer('login_id');
            $table->integer('student_no');
            $table->longText('profile_pic',50);
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
        Schema::dropIfExists('customers');
    }
}
