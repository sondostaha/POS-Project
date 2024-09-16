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
        Schema::create('request_freelancers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_field_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sub_field_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string("desc");
            $table->enum('status', ['هام و عاجل', 'هام وغير عاجل' , 'غير هام وغير عاجل']);
            
            $table->foreignId('new_franchise_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('request_freelancers');
    }
};
