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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderID');
            $table->string('invoiceNumber');
            $table->string('customerNumber');
            $table->foreign('customerNumber')->references('customerNumber')->on('customers');
            $table->dateTime('orderDateTime');
            $table->string('deliveryAddress');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('statusID');
            $table->foreign('statusID')->references('statusID')->on('statuses');
            $table->string('loadedPhoto')->nullable();
            $table->string('deliveredPhoto')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
