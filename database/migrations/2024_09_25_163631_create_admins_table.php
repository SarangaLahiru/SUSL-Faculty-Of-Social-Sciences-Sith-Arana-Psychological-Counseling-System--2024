<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken(); // For remember me functionality
            $table->string('reset_token')->nullable(); // Column for storing the reset token
            $table->timestamp('token_expires_at')->nullable(); // Column for token expiration time
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
