<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounsellorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counsellors', function (Blueprint $table) {
            $table->id('counsellor_id');
            // $table->uuid('counsellor_id')->primary();
            $table->string('full_name_with_rate')->nullable();;
            $table->string('title')->nullable();
            $table->string('post')->nullable();
            $table->string('NIC')->unique();;
            $table->enum('gender', ['female', 'male'])->nullable();;
            $table->string('mobile_no')->nullable();
            $table->string('email')->unique(); // Make email unique
            $table->string('username')->nullable(); // Add unique username field
            $table->string('password'); // Add password field
            $table->text('intro')->nullable();;
            $table->mediumText('bio')->nullable();;
            $table->json('languages')->nullable(); // Store multiple languages
            $table->json('specializations')->nullable(); // Store multiple specializations

            $table->string('profile_image')->nullable();
            $table->string('remember_token')->nullable(); // Add remember_token column
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
        Schema::dropIfExists('counsellors');
    }
}