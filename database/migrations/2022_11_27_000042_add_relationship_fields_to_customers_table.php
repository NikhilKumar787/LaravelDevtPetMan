<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_5910666')->references('id')->on('cities');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id', 'state_fk_5910667')->references('id')->on('states');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_5910668')->references('id')->on('countries');
            $table->unsignedBigInteger('term_id')->nullable();
            $table->foreign('term_id', 'term_fk_7066333')->references('id')->on('terms');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7082693')->references('id')->on('teams');
        });
    }
}
