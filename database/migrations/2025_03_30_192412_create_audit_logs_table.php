<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id('logID');
            $table->unsignedBigInteger('orderID');
            $table->foreign('orderID')->references('orderID')->on('orders');
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('id')->on('users');
            $table->dateTime('actionDateTime');
            $table->string('action');
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
