<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('project_id');
            $table->decimal('gro_fund_transfer', 12, 2)->default(0);
            $table->decimal('amount_group_saving', 12, 2)->default(0);
            $table->decimal('amount_group_risk', 12, 2)->default(0);
            $table->decimal('amount_group_profit', 12, 2)->default(0);
            $table->decimal('bank_profit', 12, 2)->default(0);
            $table->decimal('bank_charge', 12, 2)->default(0);
            $table->decimal('other_income', 12, 2)->default(0);
            $table->decimal('gro_and_other_cost', 12, 2)->default(0);
            $table->decimal('fund_position_automatic', 12, 2)->default(0);
            $table->decimal('outstanding_amount', 12, 2)->default(0);
            $table->decimal('amount_in_gro_bank', 12, 2)->default(0);
            $table->decimal('cash_in_hand', 12, 2)->default(0);
            $table->decimal('number_of_districts', 12, 2)->default(0);
            $table->decimal('number_of_upazilas', 12, 2)->default(0);
            $table->decimal('number_of_unions', 12, 2)->default(0);
            $table->decimal('number_of_villages', 12, 2)->default(0);
            $table->decimal('number_of_households', 12, 2)->default(0);
            $table->decimal('number_of_populations', 24, 2)->default(0);
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_details');
    }
}
