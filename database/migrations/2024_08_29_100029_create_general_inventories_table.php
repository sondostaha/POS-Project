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
        Schema::create('general_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('totalRevenue');
            $table->string('netProfit');
            $table->string('totalFreelancerDues');
            $table->string('affiliateMarketersCommission');
            $table->string('agentAndSalesManagerCommission');
            $table->string('salesManagerDues');
            $table->string('technicalDirectorDues');
            $table->string('financialOfficerDues');
            $table->string('ceoRemuneration');;
            $table->string('totalSetting');
            $table->foreignId('new_franchise_id')->constrained('new_franchises')->onDelete('cascade')->onUpdate('cascade')->nullable();

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
        Schema::dropIfExists('general_inventories');
    }
};
