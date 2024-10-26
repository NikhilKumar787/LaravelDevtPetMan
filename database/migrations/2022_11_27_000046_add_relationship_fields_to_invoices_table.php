<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_6436696')->references('id')->on('customers');
            $table->unsignedBigInteger('place_of_supply_id')->nullable();
            $table->foreign('place_of_supply_id', 'place_of_supply_fk_6436700')->references('id')->on('states');
            $table->unsignedBigInteger('terms_and_condition_id')->nullable();
            $table->foreign('terms_and_condition_id', 'terms_and_condition_fk_7191961')->references('id')->on('terms_andconditions');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7082735')->references('id')->on('teams');
        });
    }
}
