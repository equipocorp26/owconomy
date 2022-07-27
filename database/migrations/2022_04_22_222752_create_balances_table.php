<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->constrained('users','id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('currency_id')->references('id')->on('currencies')->constrained('currencies','id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->double('amount')->default(0);
            $table->string('background_url')->default('/images/bg-cards/0.jpg');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('balances');
    }
};
