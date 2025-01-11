<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lupon_cases_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lupon_case_id');
            $table->foreign('lupon_case_id')->references('id')->on('lupon_cases');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lupon_cases_comments');
    }
};

