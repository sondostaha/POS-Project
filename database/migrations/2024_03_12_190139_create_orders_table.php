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
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('client_id')->constrained('clients', 'id')->onDelete('cascade')->onUpdate('cascade');
    $table->foreignId('main_field_id')->constrained('main_fields', 'id')->onDelete('cascade')->onUpdate('cascade');
    $table->foreignId('sub_field_id')->constrained('sub_fields', 'id')->onDelete('cascade')->onUpdate('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
    $table->timestamps();
    $table->string("deadline");
    $table->longText('desc');
    $table->string('cvalue');
    $table->string('fvalue');
    $table->string('avalue')->default("20% من ربح الطلب");
    $table->string("method");
    $table->string("proof");
    $table->json("freelancer_details"); // Store freelancers and their compensation as JSON
    
                $table->foreignId('new_franchise_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');

});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
