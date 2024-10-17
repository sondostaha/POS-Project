<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancer_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->references('id')->on('freelancers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('order_id')->references('id')->on('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('recieve');
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
        Schema::dropIfExists('freelancer_orders');
    }
};
