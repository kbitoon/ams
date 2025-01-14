<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lupon_case_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lupon_case_id');
            $table->foreign('lupon_case_id')->references('id')->on('lupon_cases')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lupon_case_comments');
    }
};


