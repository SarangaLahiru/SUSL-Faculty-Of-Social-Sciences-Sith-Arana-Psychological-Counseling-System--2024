<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('booking_details', function (Blueprint $table) {
        $table->bigIncrements('booking_id'); // Primary key
        $table->unsignedBigInteger('timeslot_id'); // Foreign key for timeslots
        $table->unsignedBigInteger('counsellor_id'); // Foreign key for counsellors

        // Foreign key constraints
        $table->foreign('timeslot_id')->references('timeslot_id')->on('time_slots')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('counsellor_id')->references('counsellor_id')->on('counsellors')->onDelete('cascade')->onUpdate('cascade');

        // Additional fields
        $table->string('mobile_no');
        $table->string('email');
        $table->string('faculty');
        $table->string('gender');
        $table->string('name')->nullable();
        $table->string('registration_no')->nullable();
        $table->text('message')->nullable();
        $table->text('status')->default('pending');

        $table->timestamps(); // created_at and updated_at columns
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_details');
    }
}