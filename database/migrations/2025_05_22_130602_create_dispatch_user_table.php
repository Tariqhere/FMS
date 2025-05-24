<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchUserTable extends Migration
{
    public function up()
    {
        Schema::create('dispatch_user', function (Blueprint $table) {
            $table->id(); // Optional: Primary key
            $table->foreignId('dispatch_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps(); // Optional
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispatch_user');
    }
}