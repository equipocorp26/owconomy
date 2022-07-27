<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('reference')->nullable();
            $table->double('amount')->default(0);
            $table->date('date');
            $table->string('detail')->nullable();
            $table->foreignId('balance_id')->references('id')->on('balances')->constrained('balances','id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movements');
    }
};
