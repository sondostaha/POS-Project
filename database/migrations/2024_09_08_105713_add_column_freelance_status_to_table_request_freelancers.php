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
        Schema::table('request_freelancers', function (Blueprint $table) {
            $table->enum('freelancer_status',['مطلوب','موجود'])->default('مطلوب');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_freelancers', function (Blueprint $table) {
            //
        });
    }
};
