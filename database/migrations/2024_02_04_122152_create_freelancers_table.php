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
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("age");
            $table->string("country");
            $table->string("type");
            $table->string("certificate");
            $table->foreignId('main_field_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sub_field_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string("products");
            $table->string("languages");
            $table->string("wphone");
            $table->string("vphone");
            $table->string("email");
            $table->string("cv");
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('freelancers');
    }
};
