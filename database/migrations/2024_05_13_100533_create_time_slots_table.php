<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->unsignedBigInteger('timeslot_id');
            $table->primary('timeslot_id');
            $table->unsignedBigInteger('counsellor_id');
            $table->foreign('counsellor_id')->references('counsellor_id')->on('counsellors');
            $table->date('date')->default('2024-01-01');
            $table->time('time');
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
        Schema::dropIfExists('time_slots');
    }
}
