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
            $table->unsignedBigInteger('counsellor_id');
            $table->primary('counsellor_id');
            $table->string('full_name_with_rate');
            $table->string('title');
            $table->enum('gender',['female','male']);
            $table->string('mobile_no');
            $table->string('email');
            $table->text('intro');
            $table->mediumText('bio');
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
