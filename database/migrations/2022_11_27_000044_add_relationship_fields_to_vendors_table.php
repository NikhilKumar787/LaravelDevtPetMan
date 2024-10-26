<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVendorsTable extends Migration
{
    public function up()
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_5910710')->references('id')->on('cities');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id', 'state_fk_5910711')->references('id')->on('states');
            $table->unsignedBigInteger('term_id')->nullable();
            $table->foreign('term_id', 'term_fk_7083609')->references('id')->on('terms');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7082711')->references('id')->on('teams');
        });
    }
}
