<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('counsellor_id')->default(0); // 0 means general feedback
            $table->string('name')->nullable(); // Optional name
            $table->string('email')->nullable(); // Optional email
            $table->text('message'); // Feedback message
            $table->boolean('is_published')->default(false); // Status to publish/unpublish
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
